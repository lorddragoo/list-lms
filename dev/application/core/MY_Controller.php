<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('usermanager');
        $this->usermanager->set_student_data_to_smarty();
        $this->usermanager->set_teacher_data_to_smarty();
    }
    
    protected function _init_language_for_student() {
        if ($this->usermanager->is_student_session_valid()) {
            $this->lang->reinitialize_for_idiom($this->usermanager->get_student_language());
        }
    }
    
    protected function _load_student_langfile($filename = NULL) {
        if (is_null($filename)) {
            $this->lang->load(strtolower(get_class($this)));
        } else {
            $this->lang->load($filename);
        }
    }
    
    protected function _init_language_for_teacher() {
        if ($this->usermanager->is_teacher_session_valid()) {
            $this->lang->reinitialize_for_idiom($this->usermanager->get_teacher_language());
        }
    }
    
    protected function _load_teacher_langfile($filename = NULL) {
        if (is_null($filename)) {
            $this->lang->load('admin/' . strtolower(get_class($this)));
        } else {
            $this->lang->load('admin/' . $filename);
        }
    }
    
    protected function _initialize_teacher_menu() {
        $this->config->load('adminmenu');
        $this->parser->assign('list_adminmenu', $this->config->item('adminmenu'));
        $this->_load_teacher_langfile('adminmenu');
    }
    
    protected function _select_teacher_menu_pagetag($tag = '') {
        $this->parser->assign('list_adminmenu_current', $tag);
    }
    
}