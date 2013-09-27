<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Rooms controller for backend.
 * @package LIST_BE_Controllers
 * @author Andrej Jursa
 */
class Rooms extends LIST_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->_init_language_for_teacher();
        $this->_load_teacher_langfile();
        $this->_init_teacher_quick_prefered_course_menu();
        $this->usermanager->teacher_login_protected_redirect();
    }
    
    public function index($group_id) {
        $group = new Group();
        $group->get_by_id($group_id);
        $this->parser->add_js_file('translation_selector.js');
        $this->parser->add_js_file('admin_rooms/list.js');
        $this->parser->add_js_file('admin_rooms/form.js');
        $this->parser->add_css_file('admin_rooms.css');
        smarty_inject_days();
        $this->inject_teachers();
        $this->parser->parse('backend/rooms/index.tpl', array('group' => $group, 'group_id' => $group_id));
    }
    
    public function get_table_content($group_id) {
        smarty_inject_days();
        $rooms = new Room();
        $rooms->where_related_group('id', $group_id);
        $rooms->order_by('time_day', 'asc')->order_by('time_begin', 'asc');
        $rooms->get_iterated();
        $this->parser->parse('backend/rooms/table_content.tpl', array('rooms' => $rooms, 'group_id' => $group_id));
    }
    
    public function create() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('room[name]', 'lang:admin_rooms_form_field_name', 'required');
        $this->form_validation->set_rules('room[time_begin]', 'lang:admin_rooms_form_field_time_begin', 'required|callback__is_time');
        $this->form_validation->set_rules('room[time_end]', 'lang:admin_rooms_form_field_time_end', 'required|callback__is_time|callback__is_later_time');
        $this->form_validation->set_rules('room[time_day]', 'lang:admin_rooms_form_field_time_day', 'required|callback__is_day');
        $this->form_validation->set_rules('room[capacity]', 'lang:admin_rooms_form_field_capacity', 'required|integer|greater_than[0]');
        $this->form_validation->set_rules('room[group_id]', 'group_id', 'required');
        $this->form_validation->set_message('_is_time', $this->lang->line('admin_rooms_form_error_message_is_time'));
        $this->form_validation->set_message('_is_day', $this->lang->line('admin_rooms_form_error_message_is_day'));
        $this->form_validation->set_message('_is_later_time', $this->lang->line('admin_rooms_form_error_message_is_later_time'));
        
        if ($this->form_validation->run()) {
            $room_data = $this->input->post('room');
            
            $this->_transaction_isolation();
            $this->db->trans_begin();
            
            $group = new Group();
            $group->get_by_id($room_data['group_id']);
            
            if ($group->exists()) {
                $room = new Room();
                $room->name = $room_data['name'];
                $room->time_day = intval($room_data['time_day']);
                $room->time_begin = $this->time_to_int($room_data['time_begin']);
                $room->time_end = $this->time_to_int($room_data['time_end']);
                $room->capacity = intval($room_data['capacity']);
                if (trim($room_data['teachers_plain']) != '') {
                    $room->teachers_plain = trim($room_data['teachers_plain']);
                } else {
                    $room->teachers_plain = NULL;
                }
                $teachers = new Teacher();
                if (is_array($room_data['teachers']) && count($room_data['teachers'])) {
                    foreach ($room_data['teachers'] as $teacher_id) {
                        $teachers->or_where('id', $teacher_id);
                    }
                    $teachers->get();
                }
                if ($room->save(array($teachers->all)) && $group->save($room) && $this->db->trans_status()) {
                    $this->db->trans_commit();
                    $this->messages->add_message('lang:admin_rooms_flash_message_save_successful', Messages::MESSAGE_TYPE_SUCCESS);
                } else {
                    $this->db->trans_rollback();
                    $this->messages->add_message('lang:admin_rooms_flash_message_save_failed', Messages::MESSAGE_TYPE_ERROR);
                }
            } else {
                $this->db->trans_rollback();
                $this->messages->add_message('lang:admin_rooms_flash_message_group_not_found', Messages::MESSAGE_TYPE_ERROR);
            }
            redirect(create_internal_url('admin_rooms/new_room_form/' . intval($room_data['group_id'])));
        } else {
            $room_data = $this->input->post('room');
            $this->new_room_form(intval($room_data['group_id']));
        }
    }
    
    public function _is_time($str) {
        if (preg_match('/^(?P<h>[0-9]{2}):(?P<m>[0-9]{2}):(?P<s>[0-9]{2})$/', $str, $matches)) {
            $h = intval($matches['h']);
            $m = intval($matches['m']);
            $s = intval($matches['s']);
            if ($h >= 0 && $h <= 23 && $m >= 0 && $m <= 59 && $s >= 0 && $s <= 59) {
                return TRUE;
            }
        }
        return FALSE;
    }
    
    public function _is_later_time($str) {
        $room = $this->input->post('room');
        if (isset($room['time_begin']) && $this->_is_time($room['time_begin']) && $this->_is_time($str)) {
            $time_begin = $this->time_to_int($room['time_begin']);
            $time_end = $this->time_to_int($str);
            if ($time_begin >= $time_end) {
                return FALSE;
            }
        }
        return TRUE;
    }
    
    public function _is_day($str) {
        if (is_numeric($str)) {
            $day = intval($str);
            if ($day >= 1 && $day <= 7) {
                return TRUE;
            }
        }
        return FALSE;
    }
    
    public function new_room_form($group_id) {
        $group = new Group();
        $group->get_by_id($group_id);
        smarty_inject_days();
        $this->inject_teachers();
        $this->parser->parse('backend/rooms/new_room_form.tpl', array('group' => $group, 'group_id' => $group_id));
    }
    
    public function delete($group_id) {
        $this->output->set_content_type('application/json');
        $url = $this->uri->ruri_to_assoc(4);
        $room_id = isset($url['room_id']) ? intval($url['room_id']) : 0;
        if ($room_id !== 0) {
            $this->_transaction_isolation();
            $this->db->trans_begin();
            $room = new Room();
            $room->get_by_id($room_id);
            $room->delete();
            if ($this->db->trans_status()) {
                $this->db->trans_commit();
                $this->output->set_output(json_encode(TRUE));    
            } else {
                $this->db->trans_rollback();
                $this->output->set_output(json_encode(FALSE));                
            }
        } else {
            $this->output->set_output(json_encode(FALSE));
        }
    }
    
    public function edit($group_id) {
        $this->parser->add_js_file('translation_selector.js');
        $this->parser->add_js_file('admin_rooms/form.js');
        
        $url = $this->uri->ruri_to_assoc(4);
        $room_id = isset($url['room_id']) ? intval($url['room_id']) : 0;
        $room = new Room();
        $room->get_by_id($room_id);
        smarty_inject_days();
        $this->inject_teachers();
        $this->parser->parse('backend/rooms/edit.tpl', array('room' => $room, 'group_id' => $group_id));
    }
    
    public function update($group_id) {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('room[name]', 'lang:admin_rooms_form_field_name', 'required');
        $this->form_validation->set_rules('room[time_begin]', 'lang:admin_rooms_form_field_time_begin', 'required|callback__is_time');
        $this->form_validation->set_rules('room[time_end]', 'lang:admin_rooms_form_field_time_end', 'required|callback__is_time|callback__is_later_time');
        $this->form_validation->set_rules('room[time_day]', 'lang:admin_rooms_form_field_time_day', 'required|callback__is_day');
        $this->form_validation->set_rules('room[capacity]', 'lang:admin_rooms_form_field_capacity', 'required|integer|greater_than[0]');
        $this->form_validation->set_rules('room_id', 'room_id', 'required');
        $this->form_validation->set_message('_is_time', $this->lang->line('admin_rooms_form_error_message_is_time'));
        $this->form_validation->set_message('_is_day', $this->lang->line('admin_rooms_form_error_message_is_day'));
        $this->form_validation->set_message('_is_later_time', $this->lang->line('admin_rooms_form_error_message_is_later_time'));
        
        if ($this->form_validation->run()) {
            $room_id = intval($this->input->post('room_id'));
            $room = new Room();
            $room->get_by_id($room_id);
            if ($room->exists()) {
                $room_data = $this->input->post('room');
                $room->from_array($room_data, array('name', 'time_day'));
                $room->time_begin = $this->time_to_int($room_data['time_begin']);
                $room->time_end = $this->time_to_int($room_data['time_end']);
                $room->capacity = intval($room_data['capacity']);
                
                $this->_transaction_isolation();
                $this->db->trans_begin();
                
                if (trim($room_data['teachers_plain']) != '') {
                    $room->teachers_plain = trim($room_data['teachers_plain']);
                } else {
                    $room->teachers_plain = NULL;
                }
                $teachers = new Teacher();
                if (is_array($room_data['teachers']) && count($room_data['teachers'])) {
                    foreach ($room_data['teachers'] as $teacher_id) {
                        $teachers->or_where('id', $teacher_id);
                    }
                    $teachers->get();
                }
                if ($room->save(array($teachers->all)) && $this->db->trans_status()) {
                    $this->db->trans_commit();
                    $this->messages->add_message('lang:admin_rooms_flash_message_save_successful', Messages::MESSAGE_TYPE_SUCCESS);
                } else {
                    $this->db->trans_rollback();
                    $this->messages->add_message('lang:admin_rooms_flash_message_save_failed', Messages::MESSAGE_TYPE_ERROR);
                }
            } else {
                $this->messages->add_message('lang:admin_rooms_error_room_not_found', Messages::MESSAGE_TYPE_ERROR);
            }
            redirect(create_internal_url('admin_rooms/index/' . $group_id));
        } else {
            $this->edit($group_id);
        }
    }
    
    private function time_to_int($time) {
        if (preg_match('/^(?P<h>[0-9]{2}):(?P<m>[0-9]{2}):(?P<s>[0-9]{2})$/', $time, $matches)) {
            $h = intval($matches['h']);
            $m = intval($matches['m']);
            $s = intval($matches['s']);
            if ($h >= 0 && $h <= 23 && $m >= 0 && $m <= 59 && $s >= 0 && $s <= 59) {
                return $s + 60 * $m + 3600 * $h;
            }
        }
        return 0;
    }
    
    private function inject_teachers() {
        $teachers = new Teacher();
        $teachers->order_by_as_fullname('fullname', 'asc');
        $teachers->get_iterated();
        
        $data = array();
        
        foreach($teachers as $teacher) {
            $data[$teacher->id] = $teacher->fullname . ' (' . $teacher->email . ')';
        }
        
        $this->parser->assign('teachers', $data);
    }
}