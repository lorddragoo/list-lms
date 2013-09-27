{foreach $solutions as $solution}
<tr class="{if $solution->revalidate eq 1}revalidate_this{/if} {if $solution->not_considered}not_considered{/if}">
    <td>{$solution->id|intval}</td>
    <td>{$solution->created|date_format:{translate line='common_datetime_format'}}</td>
    <td>{$solution->updated|date_format:{translate line='common_datetime_format'}}</td>
    <td>{$solution->student_fullname} ({$solution->student_email})</td>
    <td>{translate_text text=$solution->student_participant_group_name}</td>
    <td>{$task_set->get_student_files_count($solution->student_id)|intval}</td>
    {if is_null($solution->points)}
    <td colspan="3">{translate line='admin_solutions_list_solution_not_valuated'}</td>
    {else}
    <td>{$solution->points|floatval}</td>
    <td>{$solution->comment|nl2br}</td>
    <td>{$solution->teacher_fullname} ({$solution->teacher_email})</td>
    {/if}
    <td class="controlls"><a href="{internal_url|add_to_url:{"group_id/{$solution->student_participant_group_id}"}:{!is_null($solution->student_participant_group_id)} url="admin_solutions/valuation/{$task_set->id|intval}/{$solution->id|intval}"}" class="button special open_valuation_dialog">{translate line='admin_solutions_list_table_button_valuate'}</a></td>
</tr>
{/foreach}