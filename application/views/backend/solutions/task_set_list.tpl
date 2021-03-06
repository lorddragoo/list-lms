{foreach $task_sets as $task_set}
    {if $task_set->task_set_permission_count ne 0}
        {$task_set_permissions = $task_set->task_set_permission->where('enabled', 1)->include_related('group')->order_by_related_with_constant('group', 'name', 'asc')->get()}
    {/if}
    <tr class="{if $task_set->published eq 1}{$task_set->get_task_set_time_class()}{/if}">
        <td>{$task_set->id|intval}</td>
        <td>{overlay table='task_sets' table_id=$task_set->id column='name' default=$task_set->name}</td>
        <td>{translate line="admin_solutions_table_body_content_type_{$task_set->content_type}"}</td>
        <td><span title="{translate_text text=$task_set->course_name}">{translate_text|abbreviation text=$task_set->course_name}</span> / <span title="{translate_text text=$task_set->course_period_name}">{translate_text|abbreviation text=$task_set->course_period_name}</span></td>
        <td>
            {if $task_set->task_set_permission_count eq 0}
                <span title="{translate_text text=$task_set->group_name}">{translate_text|abbreviation text=$task_set->group_name}</span>
            {else}
                <ol>
                {foreach $task_set_permissions->all as $task_set_permission}
                    <li class="{if $task_set->published eq 1}{$task_set->get_task_set_time_class($task_set_permission->id)}{/if}"><span title="{translate_text text=$task_set_permission->group_name}">{translate_text|abbreviation text=$task_set_permission->group_name}</span></li>
                {/foreach}
                </ol>
            {/if}
        </td>
        <td>{translate_text text=$task_set->task_set_type_name}</td>
        <td>{$task_set->solution_count}</td>
        <td>{$task_set->task_count}</td>
        <td>
            {if $task_set->join_upload_solution eq 1}
                {if $task_set->task_set_permission_count eq 0}
                    {$task_set->upload_end_time|date_format:{translate line='admin_solutions_datetime_format'}|default:{translate line='admin_solutions_no_time_information'}}
                {else}
                    <ol>
                    {foreach $task_set_permissions->all as $task_set_permission}
                        <li class="{if $task_set->published eq 1}{$task_set->get_task_set_time_class($task_set_permission->id)}{/if}">{$task_set_permission->upload_end_time|date_format:{translate line='admin_solutions_datetime_format'}|default:{translate line='admin_solutions_no_time_information'}}</li>
                    {/foreach}
                    </ol>
                {/if}
            {else}
                {translate line='admin_solutions_no_solution_uploading'}
            {/if}
        </td>
        <td class="controlls"><a href="{internal_url url="admin_solutions/download_solutions/{$task_set->id}"}" target="_blank" class="button special" title="{translate line='admin_solutions_table_button_download_solutions'}"><span class="list-icon list-icon-download"></span></a></td>
        <td class="controlls"><a href="{internal_url url="admin_solutions/solutions_list/{$task_set->id}"}" class="button special" title="{translate line='admin_solutions_table_button_select_task_set'}"><span class="list-icon list-icon-open"></span></a></td>
        <td class="controlls"><a href="{internal_url url="admin_solutions/batch_valuation/{$task_set->id}"}" class="button special" title="{translate line='admin_solutions_table_button_batch_valuation'}"><span class="list-icon list-icon-table"></span></a></td>
        <td class="controlls"><a href="{internal_url url="admin_solutions/remove_points/{$task_set->id}"}" class="button special remove_points points:{$task_set->course_default_points_to_remove|floatval}" title="{translate line='admin_solutions_table_button_remove_points'}"><span class="list-icon list-icon-remove"></span></a></td>
    </tr>
{/foreach}
<tr id="pagination_row_id">
    <td colspan="13">{include file='partials/backend_general/pagination.tpl' paged=$task_sets->paged inline}</td>
</tr>