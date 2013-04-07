jQuery(document).ready(function($) {
    
    var reload_all_rooms = function() {
        var url = global_base_url + 'index.php/admin_rooms/get_table_content/' + current_group_id;
        api_ajax_load(url, '#rooms_table_body_id');
    };
    
    reload_all_rooms();
    
    $('#new_room_form_id').submit(function(event) {
        event.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serializeArray();
        var success = function() {
            if ($('#new_room_form_id .flash_message.message_success').length > 0) {
                reload_all_rooms();
            }
            $.getScript(global_base_url + 'public/js/rooms/form.js');
        };
        api_ajax_load(url, '#new_room_form_id', 'post', data, success);
    });
    
});