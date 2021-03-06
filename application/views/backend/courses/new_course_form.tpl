{include file='partials/backend_general/flash_messages.tpl' inline}
<div class="field">
    <label for="course_name_id" class="required">{translate line='admin_courses_form_label_course_name'}:</label>
    <p class="input"><input type="text" name="course[name]" value="{$smarty.post.course.name|escape:'html'}" id="course_name_id" /></p>
    {form_error field='course[name]' left_delimiter='<p class="error"><span class="message">' right_delimiter='</span></p>'}
</div>
<div class="field">
    <label for="course_period_id_id" class="required">{translate line='admin_courses_form_label_course_period'}:</label>
    <p class="input"><select name="course[period_id]" size="1">
        {list_html_options options=$periods selected=$smarty.post.course.period_id}
    </select></p>
    {form_error field='course[period_id]' left_delimiter='<p class="error"><span class="message">' right_delimiter='</span></p>'}
</div>
<div class="field">
    <label for="course_capacity_id" class="required">{translate line='admin_courses_form_label_course_capacity'}:</label>
    <p class="input"><input type="text" name="course[capacity]" id="course_capacity_id" value="{$smarty.post.course.capacity|escape:'html'}" /></p>
    {form_error field='course[capacity]' left_delimiter='<p class="error"><span class="message">' right_delimiter='</span></p>'}
</div>
<div class="field">
    <label for="course_groups_change_deadline_id">{translate line='admin_courses_form_label_course_groups_change_deadline'}:</label>
    <p class="input"><input type="text" name="course[groups_change_deadline]" value="{$smarty.post.course.groups_change_deadline|escape:'html'}" id="course_groups_change_deadline_id" /></p>
    <p class="input"><em>{translate line='admin_courses_form_label_course_groups_change_deadline_hint'}</em></p>
</div>
<div class="field">
    <label for="course_default_points_to_remove_id" class="required">{translate line='admin_courses_form_label_course_default_points_to_remove'}:</label>
    <p class="input"><input type="text" name="course[default_points_to_remove]" value="{$smarty.post.course.default_points_to_remove}" id="course_default_points_to_remove_id" /></p>
    <p class="input"><em>{translate line='admin_courses_form_label_course_default_points_to_remove_hint'}</em></p>
    {form_error field='course[default_points_to_remove]' left_delimiter='<p class="error"><span class="message">' right_delimiter='</span></p>'}
</div>
<div class="field">
    <label for="course_allow_subscription_to_id">{translate line='admin_courses_form_label_allow_subscription_to'}:</label>
    <p class="input"><input type="text" name="course[allow_subscription_to]" value="{$smarty.post.course.allow_subscription_to|escape:'html'}" id="course_allow_subscription_to_id" /></p>
    <p class="input"><em>{translate line='admin_courses_form_label_allow_subscription_to_hint'}</em></p>
</div>
<div class="field">
    <label for="course_test_scoring_deadline_id">{translate line='admin_courses_form_label_test_scoring_deadline'}:</label>
    <p class="input"><input type="text" name="course[test_scoring_deadline]" value="{$smarty.post.course.test_scoring_deadline|escape:'html'}" id="course_test_scoring_deadline_id" /></p>
    <p class="input"><em>{translate line='admin_courses_form_label_test_scoring_deadline_hint'}</em></p>
</div>
<div class="field">
    <label for="course_hide_in_lists_id">{translate line='admin_courses_form_label_hide_in_lists'}:</label>
    <p class="input"><input type="checkbox" name="course[hide_in_lists]" id="course_hide_in_lists_id" value="1"{if $smarty.post.course.hide_in_lists eq 1} checked="checked"{/if} /></p>
    <p class="input"><em>{translate line='admin_courses_form_label_hide_in_lists_hint'}</em></p>
</div>
<div class="field">
    <label for="course_auto_accept_students_id">{translate line='admin_courses_form_label_auto_accept_students'}:</label>
    <p class="input"><input type="checkbox" name="course[auto_accept_students]" id="course_auto_accept_students_id" value="1"{if $smarty.post.course.auto_accelpt_students eq 1} checked="checked"{/if} /></p>
    <p class="input"><em>{translate line='admin_courses_form_label_auto_accept_students_hint'}</em></p>
</div>
<div class="field">
    <label for="course_disable_public_groups_page_id">{translate line='admin_courses_form_label_disable_public_groups_page'}:</label>
    <p class="input"><input type="checkbox" name="course[disable_public_groups_page]" id="course_disable_public_groups_page_id" value="1"{if $smarty.post.course.disable_public_groups_page eq 1} checked="checked"{/if} /></p>
</div>
<div class="buttons">
    <input type="submit" name="submit_button" class="button" value="{translate line='admin_courses_form_button_submit'}" />
</div>