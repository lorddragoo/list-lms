{extends file='layouts/frontend.tpl'}
{block title}{translate line='students_login_welcome_text'}{/block}
{block main_content}
    <div id="loginbox">
        <div class="boxborder">
            <h1>{translate line='students_login_welcome_text'}</h1>
            {include file='partials/frontend_general/error_box.tpl' message=$general_error inline}
            <form action="{internal_url url="students/do_login/{$uri_params|implode_uri_params}"}" method="post">
                <p><label for="id_students_email">{translate line='students_login_label_email'}:</label></p>
                <p><input type="text" name="student[email]" value="{$smarty.post.student.email|escape:'html'}" id="id_students_email" /></p>
                {form_error field='student[email]' left_delimiter = '<p class="error">' right_delimiter='</p>'}
                <p><label for="id_students_password">{translate line='students_login_label_password'}:</label></p>
                <p><input type="password" name="student[password]" value="{$smarty.post.student.password|escape:'html'}" id="id_students_password" /></p>
                {form_error field='student[password]' left_delimiter = '<p class="error">' right_delimiter='</p>'}
                <p><input type="submit" name="button_submit" value="{translate line='students_login_submit_button_label'}" /></p>
            </form>
        </div>
    </div>
{/block}