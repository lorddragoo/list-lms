var reload_all_tasks = function() {};
jQuery(document).ready(function($) {
    
    make_filter_form('#filter_form_id');
    
    reload_all_tasks = function() {
        var url = global_base_url + 'index.php/admin_tasks/get_all_tasks';
        var data = $('#filter_form_id').serializeArray();
        var onSuccess = function() {
            fields_filter('#open_fields_config_id', reload_all_tasks);
            field_filter_checkbox('#fields_config_created_checkbox_id', '#filter_form_id', 'created');
            field_filter_checkbox('#fields_config_updated_checkbox_id', '#filter_form_id', 'updated');
            field_filter_checkbox('#fields_config_name_checkbox_id', '#filter_form_id', 'name');
            field_filter_checkbox('#fields_config_categories_checkbox_id', '#filter_form_id', 'categories');
            field_filter_checkbox('#fields_config_task_sets_checkbox_id', '#filter_form_id', 'task_sets');
            field_filter_checkbox('#fields_config_test_count_checkbox_id', '#filter_form_id', 'test_count');
            field_filter_checkbox('#fields_config_author_checkbox_id', '#filter_form_id', 'author');
            sort_table('table.tasks_table', '#filter_form_id');
        };
        api_ajax_load(url, '#table_content_id', 'post', data, onSuccess);
    };
    
    reload_all_tasks();
    
    $('#filter_form_id').submit(function(event) {
        event.preventDefault();
        reload_all_tasks();
    });
    
    $(document).on('change', '#table_pagination_footer_id select[name=paging_page]', function() {
        var value = $(this).val();
        $('#filter_form_id input[name="filter[page]"]').val(value);
        reload_all_tasks();
    });
    
    $(document).on('change', '#table_pagination_footer_id select[name=paging_rows_per_page]', function() {
        var value = $(this).val();
        $('#filter_form_id input[name="filter[rows_per_page]"]').val(value);
        reload_all_tasks();
    });
    
    $(document).on('click', '#table_content_id a.delete', function(event) {
        event.preventDefault();
        if (confirm(messages.delete_question)) {
            api_ajax_update($(this).attr('href'), 'get', {}, function(output) {
                if (output === true) {
                    reload_all_tasks();
                    show_notification(messages.after_delete, 'success');    
                }
            });
        }
    });
    
    $(document).on('click', '#table_content_id a.button.clone_task', function(event) {
        event.preventDefault();
        api_ajax_update($(this).attr('href'), 'get', {}, function(output) {
            if (output.result !== undefined && output.message !== undefined) {
                if (output.result === true) {
                    reload_all_tasks();
                    show_notification(output.message, 'success');    
                } else {
                    show_notification(output.message, 'error');    
                }
            }
        });
    });
    
    $(document).on('click', '#table_content_id a.preview', function(event) {
        event.preventDefault();
        $.fancybox($(this).attr('href'), {
            type: 'iframe',
            width: '75%',
            height: '100%',
            autoSize: false,
            autoHeight: false,
            autoWidth: false,
            helpers: {
                overlay: {
                    css: {
                        background: 'rgba(255,255,255,0)'
                    }
                }
            }
        });
    });
    
    $(document).on('click', '#table_content_id a.add_to_task_set', function(event) {
        event.preventDefault();
        $.fancybox($(this).attr('href'), {
            type: 'iframe',
            width: '100%',
            height: '100%',
            autoSize: false,
            autoHeight: false,
            autoWidth: false,
            helpers: {
                overlay: {
                    css: {
                        background: 'rgba(255,255,255,0)'
                    }
                }
            },
            beforeClose: function() {
                reload_all_tasks();
                var url = global_base_url + 'index.php/admin_tasks/get_metainfo_open_task_set';
                api_ajax_load(url, '#header_open_task_set_id, #list-quick-info span.list-current-task-set-open');
                return true;
            }
        });
    });
    
    $('#filter_form_id').activeForm();
    
    $('#filter_form_id div.field.filter_by_test_types').setActiveFormDisplayCondition(function() {
        var tests_select = $('#filter_form_id input[type=radio][name="filter[tests]"]:checked');
        if (tests_select.val() === 'have') {
            return true;
        }
        return false;
    });
    
    $('#filter_form_id').activeForm().applyConditions();
    
});