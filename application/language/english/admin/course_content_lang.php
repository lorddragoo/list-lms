<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$lang['admin_course_content_page_title'] = 'Course content';
$lang['admin_course_content_fieldset_legend_new_content'] = 'New content';
$lang['admin_course_content_fieldset_legend_all_content'] = 'List of content';

$lang['admin_course_content_form_label_created_by'] = 'Created by';
$lang['admin_course_content_form_label_updated_by'] = 'Updated by';
$lang['admin_course_content_form_label_course_id'] = 'Course';
$lang['admin_course_content_form_label_title'] = 'Content title';
$lang['admin_course_content_form_label_content'] = 'Text content';
$lang['admin_course_content_form_label_published'] = 'Is published?';
$lang['admin_course_content_form_label_published_from'] = 'Published from';
$lang['admin_course_content_form_label_published_to'] = 'Published to';
$lang['admin_course_content_form_label_public'] = 'Is public?';
$lang['admin_course_content_form_label_course_content_group_id'] = 'Group content to';
$lang['admin_course_content_form_label_files_default'] = 'Files (general)';
$lang['admin_course_content_form_label_files_language'] = 'Files (%s)';
$lang['admin_course_content_form_error_course_content_group_not_related_to_course'] = 'The field <strong>%s</strong> value is not related to selected course.';
$lang['admin_course_content_form_hint_edit_files'] = 'Warning: The deletion of files is saved immediately, it do not rely on Save button at the bottom of this form.';

$lang['admin_course_content_form_field_course_id'] = 'course';
$lang['admin_course_content_form_field_title'] = 'content title';
$lang['admin_course_content_form_field_course_content_group_id'] = 'group content to';

$lang['admin_course_content_form_button_submit'] = 'Save';

$lang['admin_course_content_filter_by_course'] = 'Filter by course';
$lang['admin_course_content_filter_submit_button'] = 'Apply';

$lang['admin_course_content_flash_message_save_successful'] = 'New content successfully saved.';
$lang['admin_course_content_flash_message_save_fail'] = 'Saving of new content was unsucessful.';
$lang['admin_course_content_flash_message_save_fail_folder_rename'] = 'Saving of new content failed because content folder can\'t be renamed.';
$lang['admin_course_content_flash_message_content_not_found'] = 'Content can\'t be found.';

$lang['admin_course_content_table_header_title'] = 'Title';
$lang['admin_course_content_table_header_course'] = 'Course';
$lang['admin_course_content_table_header_published'] = 'Is published?';
$lang['admin_course_content_table_header_public'] = 'Is public?';
$lang['admin_course_content_table_header_content_group'] = 'Content group';
$lang['admin_course_content_table_header_published_from'] = 'Published from';
$lang['admin_course_content_table_header_published_to'] = 'Published to';
$lang['admin_course_content_table_header_file'] = 'File';
$lang['admin_course_content_table_header_controlls'] = 'Controlls';

$lang['admin_course_content_table_content_published_yes'] = 'Yes';
$lang['admin_course_content_table_content_published_no'] = 'No';
$lang['admin_course_content_table_content_none_content_group'] = '&lt; none &gt;';
$lang['admin_course_content_table_content_no_files_here'] = 'There are no files in this category.';
$lang['admin_course_content_table_content_all_languages'] = 'All languages';
$lang['admin_course_content_table_content_no_published_from'] = '< no lower limit >';
$lang['admin_course_content_table_content_no_published_to'] = '< no upper limit >';

$lang['admin_course_content_table_button_edit'] = 'Edit content';
$lang['admin_course_content_table_button_delete'] = 'Delete content';
$lang['admin_course_content_table_button_delete_file'] = 'Delete file';
$lang['admin_course_content_table_button_switch_file_visibility'] = 'Switch file visibility';

$lang['admin_course_content_success_updated'] = 'Content successfully updated.';
$lang['admin_course_content_success_course_content_deleted'] = 'Content successfully deleted.';

$lang['admin_course_content_error_course_content_cant_be_deleted'] = 'Content can\'t be deleted.';
$lang['admin_course_content_error_not_updated'] = 'Content failed to be updated.';
$lang['admin_course_content_error_course_content_not_found'] = 'Requested course content not found.';
$lang['admin_course_content_error_write_disabled'] = 'Course content private folder is not writable!';
$lang['admin_course_content_error_cant_save_form'] = 'Form can\\\'t be saved because course content private folder is not writable!';

$lang['admin_course_content_message_file_delete_success'] = 'File %s deleted.';
$lang['admin_course_content_message_file_delete_failed'] = 'File %s can\'t be deleted due to unknown error.';
$lang['admin_course_content_message_file_delete_not_found'] = 'File %s not found.';

$lang['admin_course_content_delete_file_question'] = 'This action will delete file {0} from server. This can\\\'t be undone. Are you sure to do this?';
$lang['admin_course_content_delete_content_question'] = 'This action will delete content {0} from database and all it files (if exists). This can\\\'t be undone. Are you sure to do this?';

$lang['admin_course_content_text_show_uploader'] = 'Show uploader';
$lang['admin_course_content_text_coppied_to_clipboard'] = 'Copy to clipboard successful.';

$lang['admin_course_content_publication_status_switched'] = 'Publication status of content <strong>%s</strong> was switched.';
$lang['admin_course_content_public_status_switched'] = 'Public/private status of content <strong>%s</strong> was changed.';

$lang['admin_course_content_legend_table_caption'] = 'Table colors legend.';
$lang['admin_course_content_header_public_yes'] = 'Public';
$lang['admin_course_content_header_public_no'] = 'Non-public';
$lang['admin_course_content_header_published_yes'] = 'Published';
$lang['admin_course_content_header_published_no'] = 'Non-published';

$lang['admin_course_content_sorting_page_header'] = 'Course content - sorting';
$lang['admin_course_content_fieldset_sort_all_content'] = 'Sort all content';

$lang['admin_course_content_sorting_course_not_found'] = 'Course, in which you want to sort content, was not found.';
$lang['admin_course_content_sorting_group_not_found'] = 'Can\'t find course content group in which content has to be sort.';
$lang['admin_course_content_sorting_nothing_to_sort'] = 'There is nothing to sort.';
$lang['admin_course_content_sorting_order_inconsistent'] = 'Can\'t perform sorting due to inconsistent input: can\'t mix groups and content inside group sorting.';
$lang['admin_course_content_sorting_failed_to_update_sorting'] = 'Failed to apply sorting, try again.';
$lang['admin_course_content_sorting_successful'] = 'Sorting successful.';

$lang['admin_course_content_switch_to_sorting'] = 'To sorting';
$lang['admin_course_content_switch_to_listing'] = 'To listing';
$lang['admin_course_content_switch_to_groups'] = 'To groups';