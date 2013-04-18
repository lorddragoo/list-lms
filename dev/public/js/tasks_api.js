var reload_all_tasks = function() {};
jQuery(document).ready(function($) {
    
    reload_all_tasks = function() {
        var url = global_base_url + 'index.php/admin_tasks/get_all_tasks';
        var data = $('#filter_form_id').serializeArray();
        var onSuccess = function() {
            $('#table_pagination_footer_id').html('');
            $('#table_content_id #pagination_row_id').appendTo($('#table_pagination_footer_id'));
        };
        api_ajax_load(url, '#table_content_id', 'post', data, onSuccess);
    }
    
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
            api_ajax_update($(this).attr('href'), 'get', {}, function() {
                reload_all_tasks();
            });
        }
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
        })
    });
    
});