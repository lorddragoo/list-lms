<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Flash messages wraping library.
 * @package LIST_Libraries
 * @author Andrej Jursa
 */
class Messages {
    
    /**
     * var object $CI CodeIgniter.
     */
    protected $CI = null;
    
    const MESSAGE_TYPE_DEFAULT = 'default';
    const MESSAGE_TYPE_SUCCESS = 'success';
    const MESSAGE_TYPE_ERROR = 'error';
    const MESSAGE_TYPE_SCRIPT = 'script';
    
    const FLASH_MESSAGES_NAME = 'flash_messages';
    
    /**
     * Constructor of library, will automatically inject flash messages to smarty.
     */
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->flash_messages_to_smarty();        
    }
    
    /**
     * Add flash message to array of flash messages.
     * @param string $message message text or language constant prepended with lang: prefix.
     * @param string $type message type, one of MESSAGE_TYPE_* constant from Messages class.
     */
    public function add_message($message, $type = self::MESSAGE_TYPE_DEFAULT) {
        $flashdata_key = $this->CI->session->flashdata_key;
        $flash_userdata = $flashdata_key . ':new:' . self::FLASH_MESSAGES_NAME;
        $messages = $this->CI->session->userdata($flash_userdata);
        $messages[] = array('message' => $message, 'type' => $type);
        $this->CI->session->set_flashdata(self::FLASH_MESSAGES_NAME, $messages);
    }
    
    /**
     * Force flash messages to be kept to next request.
     */
    public function keep_messages() {
        $this->CI->session->keep_flashdata(self::FLASH_MESSAGES_NAME);
    }
    
    /**
     * Returns array of all flash messages currently stored in session.
     * @return array<mixed> flash messages.
     */
    public function read_messages() {
        $messages = $this->CI->session->flashdata(self::FLASH_MESSAGES_NAME);
        $flashdata_key = $this->CI->session->flashdata_key;
        $flash_userdata = $flashdata_key . ':new:' . self::FLASH_MESSAGES_NAME;
        $messages_new = $this->CI->session->userdata($flash_userdata);
        if (is_array($messages_new) && count($messages_new)) {
            foreach ($messages_new as $message) {
                $messages[] = $message;
            }
        }
        return is_array($messages) ? $messages : array();
    }
    
    /**
     * Inject flash messages to smarty template as $list_flash_messages template variable.
     */
    public function flash_messages_to_smarty() {
        $this->CI->load->library('parser');
        $this->CI->parser->assign('list_flash_messages', $this->read_messages());
    }
}