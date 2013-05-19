<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'courses',
  'fields' => 
  array (
    0 => 'id',
    1 => 'updated',
    2 => 'created',
    3 => 'name',
    4 => 'period_id',
    5 => 'description',
    6 => 'capacity',
  ),
  'validation' => 
  array (
    'id' => 
    array (
      'field' => 'id',
      'rules' => 
      array (
        0 => 'integer',
      ),
    ),
    'updated' => 
    array (
      'field' => 'updated',
      'rules' => 
      array (
      ),
    ),
    'created' => 
    array (
      'field' => 'created',
      'rules' => 
      array (
      ),
    ),
    'name' => 
    array (
      'field' => 'name',
      'rules' => 
      array (
      ),
    ),
    'period_id' => 
    array (
      'field' => 'period_id',
      'rules' => 
      array (
      ),
    ),
    'description' => 
    array (
      'field' => 'description',
      'rules' => 
      array (
      ),
    ),
    'capacity' => 
    array (
      'field' => 'capacity',
      'rules' => 
      array (
      ),
    ),
    'period' => 
    array (
      'field' => 'period',
      'rules' => 
      array (
      ),
    ),
    'group' => 
    array (
      'field' => 'group',
      'rules' => 
      array (
      ),
    ),
    'task_set_type' => 
    array (
      'field' => 'task_set_type',
      'rules' => 
      array (
      ),
    ),
    'task_set' => 
    array (
      'field' => 'task_set',
      'rules' => 
      array (
      ),
    ),
  ),
  'has_one' => 
  array (
    'period' => 
    array (
      'class' => 'period',
      'other_field' => 'course',
      'join_self_as' => 'course',
      'join_other_as' => 'period',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
  ),
  'has_many' => 
  array (
    'task_set_type' => 
    array (
      'join_table' => 'course_task_set_type_rel',
      'class' => 'task_set_type',
      'other_field' => 'course',
      'join_self_as' => 'course',
      'join_other_as' => 'task_set_type',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
    'group' => 
    array (
      'class' => 'group',
      'other_field' => 'course',
      'join_self_as' => 'course',
      'join_other_as' => 'group',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
    'task_set' => 
    array (
      'class' => 'task_set',
      'other_field' => 'course',
      'join_self_as' => 'course',
      'join_other_as' => 'task_set',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
  ),
  '_field_tracking' => 
  array (
    'get_rules' => 
    array (
    ),
    'matches' => 
    array (
    ),
    'intval' => 
    array (
      0 => 'id',
    ),
  ),
);