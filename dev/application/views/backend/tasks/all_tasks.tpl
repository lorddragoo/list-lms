<table class="tasks_table">
    <thead>
        <tr>
            <th>ID</th>
            {if $filter.fields.created}<th class="sort:created">{translate line='common_table_header_created'}</th>{/if}
            {if $filter.fields.updated}<th class="sort:updated">{translate line='common_table_header_updated'}</th>{/if}
            {if $filter.fields.name}<th class="sort:name">{translate line='admin_tasks_table_header_name'}</th>{/if}
            {if $filter.fields.categories}<th>{translate line='admin_tasks_table_header_categories'}</th>{/if}
            {if $filter.fields.task_sets}<th class="sort:task_sets:desc">{translate line='admin_tasks_table_header_task_sets'}</th>{/if}
            {if $filter.fields.author}<th class="sort:author">{translate line='admin_tasks_table_header_author'}</th>{/if}
            <th colspan="4" class="controlls"><div id="open_fields_config_id">{translate line='admin_tasks_table_header_controlls'}</div>{include file='partials/backend_general/fields_filter.tpl' fields=$filter.fields inline}</th>
        </tr>
    </thead>
    <tfoot id="table_pagination_footer_id">
        <tr>
            <td colspan="{5 + $filter.fields|sum_array}">{include file='partials/backend_general/pagination.tpl' paged=$tasks->paged inline}</td>
        </tr>
    </tfoot>
    <tbody>
        {foreach $tasks as $task}
        <tr>
            <td>{$task->id|intval}</td>
            {if $filter.fields.created}<td>{$task->created|date_format:{translate line='common_datetime_format'}}</td>{/if}
            {if $filter.fields.updated}<td>{$task->updated|date_format:{translate line='common_datetime_format'}}</td>{/if}
            {if $filter.fields.name}<td>{overlay|escape:'html' table='tasks' table_id=$task->id column='name' default=$task->name}</td>{/if}
            {if $filter.fields.categories}<td>{foreach $task->category->order_by('name', 'asc')->get_iterated() as $category}{if !$category@first}, {/if}{translate_text|escape:'html' text=$category->name}{/foreach}</td>{/if}
            {if $filter.fields.task_sets}<td>{$task->task_set_count}</td>{/if}
            {if $filter.fields.author}<td>{$task->author_fullname|default:{translate line='admin_tasks_table_content_unknown_author'}}</td>{/if}
            <td class="controlls"><a href="{internal_url url="admin_tasks/add_to_task_set/task_id/{$task->id}"}" class="button special add_to_task_set">{translate line='admin_tasks_form_button_add_to_task_set'}</a></td>
            <td class="controlls"><a href="{internal_url url="admin_tasks/preview/task_id/{$task->id}"}" class="button special preview">{translate line='admin_tasks_form_button_preview'}</a></td>
            <td class="controlls"><a href="{internal_url url="admin_tasks/edit/task_id/{$task->id}"}" class="button">{translate line='admin_tasks_form_button_edit'}</a></td>
            <td class="controlls"><a href="{internal_url url="admin_tasks/delete/task_id/{$task->id}"}" class="button delete">{translate line='admin_tasks_form_button_delete'}</a></td>
        </tr>
        {/foreach}
    </tbody>
</table>