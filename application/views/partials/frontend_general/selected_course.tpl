{if $list_student_account_model|is_object and $list_student_account_model->exists()}
    <span id="active_course_id">
    {if $list_student_account_model->active_course_id and $list_student_account_model->participant->where('course_id', $list_student_account_model->active_course_id)->where('allowed', 1)->get()->exists()}
        {translate_text text=$list_student_account_model->active_course->get()->name} / {translate_text text=$list_student_account_model->active_course->period->get()->name}
    {else}
        {translate line='students_no_active_course'}
    {/if}
        {if $list_student_courses|is_object and $list_student_courses->exists()}
        <ul id="top_courses_selector_id">
            {foreach $list_student_courses as $course}
            <li><a href="{internal_url url="courses/quick_course_change/{$course->id}/-CURRENT_URL-"}">{translate_text text=$course->name} / {translate_text text=$course->period_name}</a></li>
            {/foreach}
        </ul>
        {/if}
    </span>
{else}
    {$student_registration = $this->config->item('student_registration')}
    <span id="not_loged_in_links_id">
    {if $student_registration.enabled}
        <a href="{internal_url url='students/registration'}">{translate line='students_registration_link'}</a>
    {/if}
    {if $this->router->class eq 'students' and $this->router->method neq 'login' and $this->router->method neq 'do_login'}
        <a href="{internal_url url='students/login'}">{translate line='students_login_link'}</a>
    {/if}
    </span>
{/if}