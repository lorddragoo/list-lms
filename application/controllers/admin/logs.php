<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Logs controller for backend.
 * @package LIST_BE_Controllers
 * @author Andrej Jursa
 */
class Logs extends LIST_Controller {
    
    const STORED_FILTER_SESSION_NAME = 'admin_logs_filter_data';
    
    const PATTERN_IP_ADDRESS_SINGLE = '/^(?P<firstIP>[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})$/';
    const PATTERN_IP_ADDRESS_RANGE = '/^(?P<firstIP>[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})(\-|\:)(?P<secondIP>[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})$/';
    const PATTERN_INTERVAL_DATETIME = '/^[0-9]{4}\-[0-9]{2}\-[0-9]{2} [0-9]{2}\:[0-9]{2}\:[0-9]{2}$/';
    const PATTERN_IP_ADDRESS_WILDCARD = '/^(?P<firstIP>([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.\*|[0-9]{1,3}\.[0-9]{1,3}\.\*\.\*|[0-9]{1,3}\.\*\.\*\.\*|\*\.\*\.\*\.\*))$/';
    
    public function __construct() {
        parent::__construct();
        $this->_init_language_for_teacher();
        $this->_load_teacher_langfile();
        $this->_initialize_teacher_menu();
        $this->_initialize_open_task_set();
        $this->_init_teacher_quick_prefered_course_menu();
        $this->usermanager->teacher_login_protected_redirect();
    }
    
    public function index() {
        $this->_select_teacher_menu_pagetag('logs');
        $this->parser->add_js_file('admin_logs/list.js');
        $this->parser->add_css_file('admin_logs.css');
        $this->inject_stored_filter();
        $this->inject_courses();
        $this->inject_students();
        $this->inject_teachers();
        $this->parser->parse('backend/logs/index.tpl');
    }
    
    public function all_logs() {
        $filter = $this->input->post('filter');
        $this->store_filter($filter);
        $logs = new Log();
        $logs->include_related('student');
        $logs->include_related('teacher');
        if (isset($filter['type']) && $filter['type'] > 0) {
            $logs->where('log_type', $filter['type']);
        }
        if (isset($filter['ip_address']) && trim($filter['ip_address']) !== '') {
            $addresses = explode(',', $filter['ip_address']);
            $at_least_one_valid = FALSE;
            $logs->group_start();
            foreach ($addresses as $address) {
                if (preg_match(self::PATTERN_IP_ADDRESS_SINGLE, trim($address), $matches)) {
                    $logs->or_where('INET_ATON(`logs`.`ip_address`) = INET_ATON(\'' . $matches['firstIP'] . '\')');
                    $at_least_one_valid = TRUE;
                } else if (preg_match(self::PATTERN_IP_ADDRESS_RANGE, trim($address), $matches)) {
                    $logs->or_group_start();
                    $logs->where('INET_ATON(`logs`.`ip_address`) >= INET_ATON(\'' . $matches['firstIP'] . '\')');
                    $logs->where('INET_ATON(`logs`.`ip_address`) <= INET_ATON(\'' . $matches['secondIP'] . '\')');
                    $logs->group_end();
                    $at_least_one_valid = TRUE;
                } else if (preg_match(self::PATTERN_IP_ADDRESS_WILDCARD, trim($address), $matches)) {
                    $segments = explode('.', $matches['firstIP']);
                    $build_ip_start = '';
                    $build_ip_end = '';
                    $wildcard_found = FALSE;
                    for ($i=0; $i < 4; $i++) {
                        if (!$wildcard_found) {
                            if ($segments[$i] == '*') {
                                $wildcard_found = TRUE;
                            } else {
                                $build_ip_start .= ($build_ip_start !== '' ? '.' : '') . $segments[$i];
                                $build_ip_end .= ($build_ip_end !== '' ? '.' : '') . $segments[$i];
                            }
                        }
                        if ($wildcard_found) {
                            $build_ip_start .= ($build_ip_start !== '' ? '.' : '') . '0';
                            $build_ip_end .= ($build_ip_end !== '' ? '.' : '') . '255';
                        }
                    }
                    $logs->or_group_start();
                    $logs->where('INET_ATON(`logs`.`ip_address`) >= INET_ATON(\'' . $build_ip_start . '\')');
                    $logs->where('INET_ATON(`logs`.`ip_address`) <= INET_ATON(\'' . $build_ip_end . '\')');
                    $logs->group_end();
                    $at_least_one_valid = TRUE;
                }
            }
            if (!$at_least_one_valid) {
                $logs->where('logs.ip_address = `logs`.`ip_address`');
            }
            $logs->group_end();
        }
        if (isset($filter['interval_start']) && preg_match(self::PATTERN_INTERVAL_DATETIME, $filter['interval_start'])) {
            $logs->where('created >=', $filter['interval_start']);
        }
        if (isset($filter['interval_end']) && preg_match(self::PATTERN_INTERVAL_DATETIME, $filter['interval_end'])) {
            $logs->where('created <=', $filter['interval_end']);
        }
        if (isset($filter['course']) && (int)$filter['course'] > 0) {
            $logs->where_related('student/participant/course', 'id', (int)$filter['course']);
            $logs->where_related('student/participant', 'allowed', 1);
        }
        if (isset($filter['student']) && (int)$filter['student'] > 0) {
            $logs->where_related('student', 'id', (int)$filter['student']);
        }
        if (isset($filter['teacher']) && (int)$filter['teacher'] > 0) {
            $logs->where_related('teacher', 'id', (int)$filter['teacher']);
        }
        $order_by_direction = $filter['order_by_direction'] == 'desc' ? 'desc' : 'asc';
        if ($filter['order_by_field'] == 'created') {
            $logs->order_by('created', $order_by_direction);
        } elseif ($filter['order_by_field'] == 'log_type') {
            $logs->order_by('log_type', $order_by_direction);
        } elseif ($filter['order_by_field'] == 'ip_address') {
            $logs->order_by_func('INET_ATON', array('@ip_address'), $order_by_direction);
        } elseif ($filter['order_by_field'] == 'language') {
            $logs->order_by('language', $order_by_direction);
        } elseif ($filter['order_by_field'] == 'message') {
            $logs->order_by('message', $order_by_direction);
        } elseif ($filter['order_by_field'] == 'student') {
            $logs->order_by_related_as_fullname('student', 'id', $order_by_direction);
        } elseif ($filter['order_by_field'] == 'teacher') {
            $logs->order_by_related_as_fullname('teacher', 'id', $order_by_direction);
        }
        $logs->get_paged_iterated(isset($filter['page']) ? intval($filter['page']) : 1, isset($filter['rows_per_page']) ? intval($filter['rows_per_page']) : 25);
        $this->parser->parse('backend/logs/all_logs.tpl', array('logs' => $logs));
    }
    
    public function details($log_id) {
        $log = new Log();
        $log->include_related('student');
        $log->include_related('teacher');
        $log->get_by_id($log_id);
        
        if ($log->exists()) {
            if ($log->log_type == Log::LOG_TYPE_STUDENT_SOLUTION_UPLOAD || $log->log_type == Log::LOG_TYPE_TEACHER_SOLUTION_UPLOAD) {
                $solution = new Solution();
                $solution->include_related('student');
                $solution->include_related('task_set');
                $solution->include_related('task_set/course');
                $solution->include_related('task_set/course/period');
                $solution->get_by_id((int)$log->affected_row_primary_id);
                $this->parser->assign('solution', $solution);
            } elseif ($log->log_type == Log::LOG_TYPE_STUDENT_SOLUTION_DOWNLOAD) {
                $additional_data = unserialize($log->additional_data);
                $task_set = new Task_set();
                $task_set->include_related('course');
                $task_set->include_related('course/period');
                $task_set->get_by_id(@$additional_data['task_set_id']);
                $this->parser->assign(array(
                    'task_set' => $task_set,
                    'filename' => @$additional_data['solution_file'],
                ));
            }
        }
        
        $this->parser->add_css_file('admin_logs.css');
        $this->parser->parse('backend/logs/details.tpl', array('log' => $log));
    }
    
    private function store_filter($filter) {
        if (is_array($filter)) {
            $this->load->library('filter');
            $old_filter = $this->filter->restore_filter(self::STORED_FILTER_SESSION_NAME);
            $new_filter = is_array($old_filter) ? array_merge($old_filter, $filter) : $filter;
            $this->filter->store_filter(self::STORED_FILTER_SESSION_NAME, $new_filter);
        }
    }
    
    private function inject_stored_filter() {
        $this->load->library('filter');
        $filter = $this->filter->restore_filter(self::STORED_FILTER_SESSION_NAME);
        $this->parser->assign('filter', $filter);
    }
    
    private function inject_courses() {
        $courses = new Course();
        $courses->include_related('period');
        $courses->order_by_related('period', 'sorting', 'asc');
        $courses->order_by_with_constant('name', 'asc');
        $courses->get_iterated();
        
        $data = array();
        
        foreach ($courses as $course) {
            $data[$course->period_name][$course->id] = $course->name;
        }
        
        $this->parser->assign('courses', $data);
    }
    
    private function inject_students() {
        $students = new Student();
        $students->order_by_as_fullname('fullname');
        $students->get_iterated();
        
        $data = array();
        
        foreach ($students as $student) {
            $data[$student->id] = $student->fullname . ' (' . $student->email . ')';
        }
        
        $this->parser->assign('students', $data);
    }
    
    private function inject_teachers() {
        $teachers = new Teacher();
        $teachers->order_by_as_fullname('fullname');
        $teachers->get_iterated();
        
        $data = array();
        
        foreach ($teachers as $teacher) {
            $data[$teacher->id] = $teacher->fullname . ' (' . $teacher->email . ')';
        }
        
        $this->parser->assign('teachers', $data);
    }
    
}