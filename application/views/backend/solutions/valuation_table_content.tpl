{if $course->exists()}
    <h3>{translate_text text=$course->name} / {translate_text text=$course->period_name}{if $group->exists()} / {translate_text text=$group->name}{/if}</h3>
    {capture name='show_hide_menu' assign='show_hide_menu'}
    {if count($table_data.header.content_type_task_set.items) gt 0 or count($table_data.header.content_type_project.items) gt 0}
    <a href="javascript:void(0);" class="show_hide_button button special">...</a>
    <ul class="show_hide_menu" style="display: none; position: absolute;">
        <li class="name"><a href="javascript:void(0);" data-column="1"><span class="ui-icon ui-icon-circle-check"></span>{translate line='admin_solutions_valuation_tables_table_header_student_firstname'}</a></li>
        <li class="name"><a href="javascript:void(0);" data-column="2"><span class="ui-icon ui-icon-circle-check"></span>{translate line='admin_solutions_valuation_tables_table_header_student_lastname'}</a></li>{$col_position = 3}
        <li class="task_sets">
            <a href="javascript:void(0);">{$table_data.header.content_type_task_set.content_type_name}</a>
            <ul>
                {foreach $table_data.header.content_type_task_set.items as $header_item}
                    {if $header_item.type eq 'task_set_type'}
                        <li title="{$header_item.title|escape:'html'}" class="section"><a href="javascript:void(0);" data-column="{$col_position}"><span class="ui-icon ui-icon-circle-check"></span>{$header_item.name|str_to_first_upper|replace:' ':'&nbsp;'}</a></li>
                    {else}
                        <li title="{$header_item.name|escape:'html'}{if $header_item.title} | {$header_item.title|escape:'html'}{/if}" class="task_set"><a href="javascript:void(0);" data-column="{$col_position}"><span class="ui-icon ui-icon-circle-check"></span>{$header_item.name|escape:'html'|replace:' ':'&nbsp;'}</a></li>
                    {/if}
                    {$col_position = $col_position + 1}
                {/foreach}
                <li class="subtotal"><a href="javascript:void(0);" data-column="{$col_position}"><span class="ui-icon ui-icon-circle-check"></span>{translate line='admin_solutions_valuation_tables_table_header_task_sets_subtotal'}</a></li>{$col_position = $col_position + 1}
            </ul>
        </li>
        <li class="projects">
            <a href="javascript:void(0);">{$table_data.header.content_type_project.content_type_name}</a>
            <ul>
                {foreach $table_data.header.content_type_project.items as $header_item}
                    <li title="{$header_item.name|escape:'html'}" class="project"><a href="javascript:void(0);" data-column="{$col_position}"><span class="ui-icon ui-icon-circle-check"></span>{$header_item.name|escape:'html'|replace:' ':'&nbsp;'}</a></li>
                    {$col_position = $col_position + 1}
                {/foreach}
                <li class="subtotal"><a href="javascript:void(0);" data-column="{$col_position}"><span class="ui-icon ui-icon-circle-check"></span>{translate line='admin_solutions_valuation_tables_table_header_projects_subtotal'}</a></li>
            </ul>
        </li>
        <li class="total"><a href="javascript:void(0);" data-column="{$table_data.header.content_type_task_set.items|count + $table_data.header.content_type_project.items|count + 5}"><span class="ui-icon ui-icon-circle-check"></span>{translate line='admin_solutions_valuation_tables_table_header_total'}</a></li>
    </ul>
    {/if}
    {/capture}
    <table id="valutation_table" width="100%">
        <thead>
            {if count($table_data.header.content_type_task_set.items) gt 0 or count($table_data.header.content_type_project.items) gt 0}
            <tr>
                <th rowspan="2" class="index">{$show_hide_menu}</th>
                <th rowspan="2" class="static" data-position="1">{translate line='admin_solutions_valuation_tables_table_header_student_firstname'}</th>
                <th rowspan="2" class="static sort-asc" data-position="2">{translate line='admin_solutions_valuation_tables_table_header_student_lastname'}</th>
                <th class="content_type_task_sets centering show_hide_multicolumn" colspan="{$table_data.header.content_type_task_set.items|count + 1}" data-size="{$table_data.header.content_type_task_set.items|count + 1}">{$table_data.header.content_type_task_set.content_type_name}</th>
                <th class="content_type_projects centering show_hide_multicolumn" colspan="{$table_data.header.content_type_project.items|count + 1}" data-size="{$table_data.header.content_type_project.items|count + 1}">{$table_data.header.content_type_project.content_type_name}</th>
                <th rowspan="2" class="total_sum" data-position="{$table_data.header.content_type_task_set.items|count + $table_data.header.content_type_project.items|count + 5}">{translate line='admin_solutions_valuation_tables_table_header_total'}</th>
            </tr>
            <tr>{$col_position = 3}
                {foreach $table_data.header.content_type_task_set.items as $header_item}
                    {if $header_item.type eq 'task_set_type'}
                        <th class="type_{$header_item.type} ctype_task_set" title="{$header_item.title|escape:'html'}" data-position="{$col_position}">{$header_item.name|str_to_first_upper}</th>{$col_position = $col_position + 1}
                    {else}
                        <th class="type_{$header_item.type} ctype_task_set" title="{$header_item.name|escape:'html'}{if $header_item.title} | {$header_item.title|escape:'html'}{/if}" data-position="{$col_position}">{$header_item.name|abbreviation}</th>{$col_position = $col_position + 1}
                    {/if}
                {/foreach}
                <th class="summary ctype_task_set" data-position="{$col_position}">{translate line='admin_solutions_valuation_tables_table_header_task_sets_subtotal'}</th>{$col_position = $col_position + 1}
                {foreach $table_data.header.content_type_project.items as $header_item}
                    <th class="type_{$header_item.type} ctype_project" title="{$header_item.name|escape:'html'}" data-position="{$col_position}">{$header_item.name|abbreviation}</th>{$col_position = $col_position + 1}
                {/foreach}
                <th class="summary ctype_project" data-position="{$col_position}">{translate line='admin_solutions_valuation_tables_table_header_projects_subtotal'}</th>
            </tr>
            {else}
            <tr>
                <th class="static">{translate line='admin_solutions_valuation_tables_table_header_student_firstname'}</th>
                <th class="static">{translate line='admin_solutions_valuation_tables_table_header_student_lastname'}</th>
                <th class="no_content">{translate line='admin_solutions_valuation_tables_table_header_no_content'}</th>
                <th class="total_sum">{translate line='admin_solutions_valuation_tables_table_header_total'}</th>
            </tr>
            {/if}
        </thead>
        <tbody>
            {$col_index = 1}
            {foreach $table_data.content as $row}{$col_position = 3}
            <tr data-row="{$col_index}">
                {if count($table_data.header.content_type_task_set.items) gt 0 or count($table_data.header.content_type_project.items) gt 0}<td class="index">{$col_index}.</td>{/if}
                <td class="type_name" data-order="{$row.fullname|get_firstname_from_fullname|normalize|strtolower}" data-position="1"><a href="mailto:{$row.email}">{$row.fullname|get_firstname_from_fullname}</a></td>
                <td class="type_name" data-order="{$row.fullname|get_lastname_from_fullname|normalize|strtolower}" data-position="2"><a href="mailto:{$row.email}">{$row.fullname|get_lastname_from_fullname}</a></td>
                {if count($row.task_sets_points) gt 0 or count($row.projects_points) gt 0}
                {if count($row.task_sets_points) gt 0}
                    {foreach $row.task_sets_points as $item}
                        <td class="type_{$item.type} flag_{$item.flag} ctype_task_set" title="{translate line="admin_solutions_valuation_tables_table_body_flag_{$item.flag}"}" data-order="{$item.points|valuation_table_col_points_to_data_order}" data-position="{$col_position}"{if $item.solution_id && $item.task_set_id} data-solution-id="{$item.solution_id}" data-task-set-id="{$item.task_set_id}"{/if}>{$item.points}</td>{$col_position = $col_position + 1}
                    {/foreach}
                {/if}
                <td class="type_summary ctype_task_set" data-position="{$col_position}" data-order="{$row.task_sets_points_total}">{$row.task_sets_points_total}</td>{$col_position = $col_position + 1}
                {if count($row.projects_points) gt 0}
                    {foreach $row.projects_points as $item}
                        <td class="type_{$item.type} flag_{$item.flag} ctype_project" title="{translate line="admin_solutions_valuation_tables_table_body_flag_{$item.flag}"}" data-order="{$item.points|valuation_table_col_points_to_data_order}" data-position="{$col_position}"{if $item.solution_id && $item.task_set_id} data-solution-id="{$item.solution_id}" data-task-set-id="{$item.task_set_id}"{/if}>{$item.points}</td>{$col_position = $col_position + 1}
                    {/foreach}
                {/if}
                <td class="type_summary ctype_project" data-position="{$col_position}" data-order="{$row.projects_points_total}">{$row.projects_points_total}</td>{$col_position = $col_position + 1}
                {else}
                <td data-position="{$col_position}" data-order="0">{translate line='admin_solutions_valuation_tables_table_body_no_content'}</td>{$col_position = $col_position + 1}
                {/if}
                <td class="type_summary" data-order="{$row.total_points}" data-position="{$col_position}">{$row.total_points}</td>
            </tr>{$col_index = $col_index + 1}
            {/foreach}
        </tbody>
    </table>
{else}
    {include file='partials/backend_general/error_box.tpl' message='lang:admin_solutions_valuation_tables_error_no_course_selected' inline}
{/if}