<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tasks extends CI_Controller {
    
    public function index() {
        $this->load->library('migration');
        $this->migration->version(4);
        show_error($this->migration->error_string());
    }
    
}