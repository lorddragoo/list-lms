<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Task_set_types controller for backend.
 * @package LIST_BE_Controllers
 * @author Andrej Jursa
 */
class Task_set_types extends MY_Controller {
        
    public function __construct() {
        parent::__construct();
        $this->_init_language_for_teacher();
        $this->_load_teacher_langfile();
        $this->_initialize_teacher_menu();
        $this->usermanager->teacher_login_protected_redirect();
    }
    
    public function index() {
        $this->_select_teacher_menu_pagetag('task_set_types');
        $this->parser->add_js_file('translation_selector.js');
        $this->parser->add_js_file('task_set_types_api.js');
        $this->parser->add_js_file('task_set_types/form.js');
        $this->parser->add_css_file('admin_task_set_types.css');
        $this->parser->parse('backend/task_set_types/index.tpl');
    }
    
    public function get_table_content() {
        $task_set_types = new Task_set_type();
        $task_set_types->order_by('name', 'asc')->get_iterated();
        $this->parser->parse('backend/task_set_types/table_content.tpl', array('task_set_types' => $task_set_types));
    }
    
    public function new_task_set_type_form() {
        $this->parser->parse('backend/task_set_types/new_task_set_type_form.tpl');
    }
    
    public function create() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('task_set_type[name]', 'lang:admin_task_set_types_form_field_name', 'required');
        
        if ($this->form_validation->run()) {
            $task_set_type_data = $this->input->post('task_set_type');
            $task_set_type = new Task_set_type();
            $task_set_type->from_array($task_set_type_data, array('name'));
            
            $this->_transaction_isolation();
            $this->db->trans_begin();
            
            if ($task_set_type->save() && $this->db->trans_status()) {
                $this->db->trans_commit();
                $this->messages->add_message('lang:admin_task_set_types_flash_message_save_successful', Messages::MESSAGE_TYPE_SUCCESS);
            } else {
                $this->db->trans_rollback();
                $this->messages->add_message('lang:admin_task_set_types_flash_message_save_failed', Messages::MESSAGE_TYPE_ERROR);
            }
            
            redirect(create_internal_url('admin_task_set_types/new_task_set_type_form'));
        } else {
            $this->new_task_set_type_form();
        }
    }
    
    public function delete() {
        $this->output->set_content_type('application/json');
        $url = $this->uri->ruri_to_assoc(3);
        $task_set_type_id = isset($url['task_set_type_id']) ? intval($url['task_set_type_id']) : 0;
        if ($task_set_type_id !== 0) {
            $this->_transaction_isolation();
            $this->db->trans_begin();
            $task_set_type = new Task_set_type();
            $task_set_type->get_by_id($task_set_type_id);
            $task_set_type->delete();
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
    
}