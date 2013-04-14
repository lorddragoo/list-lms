{extends file='layouts/backend.tpl'}
{block title}{translate line='admin_tasks_page_title'}{/block}
{block main_content}
    <h2>{translate line='admin_tasks_page_title'}</h2>
    {include file='partials/backend_general/flash_messages.tpl' inline}
    {include file='backend/tasks/category_checkboxes.tpl' inline}
    {if $smarty.post.task or $task->exists()}
    <fieldset>
        <legend>{translate line='admin_tasks_fieldset_legend_new_task'}</legend>
        <form action="{internal_url url='admin_tasks/update'}" method="post">
            <div class="field">
                <label for="task_name_id">{translate line='admin_tasks_form_label_name'}:</label>
                <p class="input"><input type="text" name="task[name]" value="{$smarty.post.task.name|default:$task->name|escape:'html'}" id="task_name_id" /></p>
                {form_error field='task[name]' left_delimiter='<p class="error"><span class="message">' right_delimiter='</span></p>'}
                {include file='partials/backend_general/overlay_editor.tpl' table='tasks' table_id=$task->id column='name' editor_type='input' inline}
            </div>
            <div class="field">
                <label for="task_text_id">{translate line='admin_tasks_form_label_text'}:</label>
                <p class="input"><textarea name="task[text]" id="task_text_id" class="tinymce">{$smarty.post.task.text|default:$task->text}</textarea></p>
                {form_error field='task[text]' left_delimiter='<p class="error"><span class="message">' right_delimiter='</span></p>'}
                {include file='partials/backend_general/overlay_editor.tpl' table='tasks' table_id=$task->id column='text' editor_type='textarea' class='tinymce' inline}
            </div>
            <div class="field">
                <label>{translate line='admin_tasks_form_label_categories'}:</label>
                <div class="input categories_structure">{category_checkboxes chbname='task[categories][]' structure=$structure selected=$smarty.post.task.categories|default:$task->category->get()->all_to_single_array('id')|default:[]}</div>
                {form_error field='task[categories][]' left_delimiter='<p class="error"><span class="message">' right_delimiter='</span></p>'}
            </div>
            <div class="buttons">
                <input type="submit" name="submit_button" value="{translate line='admin_tasks_form_button_save'}" class="button" />
                <input type="hidden" name="task_id" value="{$smarty.post.task_id|default:$task->id|intval}" />
            </div>
        </form>
    </fieldset>
    {else}
        {include file='partials/backend_general/error_box.tpl' message='lang:admin_tasks_error_message_task_not_found' inline}
    {/if}
{/block}