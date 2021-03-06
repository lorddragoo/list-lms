var histogram_bin_size = 0.5;

jQuery(document).ready(function($) {
    make_switchable_form('#new_solution_form_id');
    make_filter_form('#filter_form_id');

    histogram_bin_size = parseFloat($('#histogram_size_id').val());
    
    var url_anchor = api_read_url_anchor();
    if (url_anchor.substring(0, 6) === 'group_') {
        var group_id = url_anchor.substring(6);
        var regex = /^[1-9][0-9]*$/;
        if (regex.test(group_id)) {
            $('#filter_group_id option[value="' + group_id + '"]').prop('selected', true);
        }
    }
    
    var refresh_all_solutions = function() {
        var data = $('#filter_form_id').serializeArray();
        var url = global_base_url + 'index.php/admin_solutions/get_solutions_list_for_task_set/' + task_set_id;
        var target = '#table_content_id';
        api_ajax_load(url, target, 'post', data);
    };


    $('#histogramForm').submit(function(event) {
        event.preventDefault();
    });

    $('#histogram_size_id').change(function() {
        histogram_bin_size = parseFloat($(this).val());
        refresh_all_solutions();
        refresh_points_overview(histogram_bin_size);
    });
    
    $('#filter_form_id').submit(function(event) {
        event.preventDefault();
        refresh_all_solutions();
        refresh_points_overview(histogram_bin_size);
    });
    
    refresh_all_solutions();
    refresh_points_overview(histogram_bin_size);
    
    $('#new_solution_form_id').submit(function(event) {
        event.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serializeArray();
        var success = function() {
            if ($('#new_solution_form_id .flash_message.message_success').length > 0) {
                refresh_all_solutions();
                refresh_points_overview(histogram_bin_size);
            }
            $('#new_solution_form_id').formErrorWarning();
            var last_created_id = $('#new_solution_form_id input[type=hidden][name=last_created_solution_id]');
            if (last_created_id.length > 0 && last_created_id.val() > 0) {
                open_upload_dialog(global_base_url + 'index.php/admin_solutions/student_solution_upload/' + last_created_id.val());
            }
        };
        api_ajax_load(url, '#new_solution_form_id', 'post', data, success);
    });
    
    $(document).on('click', '#table_content_id a.open_valuation_dialog, #table_content_id a.open_upload_dialog', function(event) {
        event.preventDefault();
        var url = $(this).attr('href');
        open_upload_dialog(url);
    });
    
    var open_upload_dialog = function(url) {
        $.fancybox(url, {
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
                refresh_all_solutions();
                refresh_points_overview(histogram_bin_size);
                return true;
            }
        });
    };
    
});