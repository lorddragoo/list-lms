{extends file='layouts/backend.tpl'}
{block title}{translate|sprintf:{overlay|default:'' table='task_sets' table_id=$task_set->id column='name' default=$task_set->name} line='admin_solutions_list_page_title'}{/block}
{block main_content}
    <h2>{translate|sprintf:{overlay|default:'' table='task_sets' table_id=$task_set->id column='name' default=$task_set->name} line='admin_solutions_list_page_title'}</h2>
    {if $task_set->exists()}<h3>{translate_text text=$task_set->course_name} / {translate_text text=$task_set->course_period_name} / {if $task_set->group_name}{translate_text text=$task_set->group_name}{else}{translate line='admin_solutions_list_h3_all_groups'}{/if}</h3>{/if}
    {include file='partials/backend_general/flash_messages.tpl' inline}
    <fieldset>
        <a href="{internal_url url='admin_solutions'}" class="button special">{translate line='common_button_back'}</a>
    </fieldset>
    {if $task_set->exists()}
        <fieldset>
            <legend>{translate line='admin_solutions_list_fieldset_legend_add_solution_record'}</legend>
            <form action="{internal_url url="admin_solutions/create_solution/{$task_set->id|intval}"}" method="post" id="new_solution_form_id">
                {include file='backend/solutions/new_solution_form.tpl' inline}
            </form>
        </fieldset>
        <fieldset>
            <legend>{translate line='admin_solutions_list_fieldset_legend_all_solutions'}</legend>
            <div class="filter_wrap">
                <form action="{internal_url url='admin_solutions/get_task_set_list'}" method="post" id="filter_form_id">          
                    {if is_null($task_set->group_id) OR $task_set->task_set_permission_count gt 0}
                    <div class="field">
                        <label>{translate line='admin_solutions_filter_label_group'}:</label>
                        <p class="input"><select name="filter[group]" size="1" id="filter_group_id">
                            {list_html_options options=$possible_groups selected=$filter.group|intval}
                        </select></p>
                    </div>
                    {else}
                    <div class="field">
                        <label>{translate line='admin_solutions_filter_label_group'}:</label>
                        <p class="input"><em>{translate line='admin_solutions_solution_list_filter_label_group_not_found'}</em></p>
                    </div>
                    {/if}
                    {if $task_set->content_type eq 'project'}
                    <div class="field">
                        <label>{translate line='admin_solutions_filter_label_author'}:</label>
                        <p class="input"><select name="filter[author]">
                            <option value="all"></option>
                            {html_options options=$authors selected=$filter.author|default:$list_teacher_account.id}
                        </select></p>
                    </div>
                    {/if}
                    <div class="buttons">
                        <input type="submit" name="filter_submit" value="{translate line='admin_solutions_filter_submit'}" class="button" />
                        <input type="hidden" name="filter[page]" value="{$filter.page|default:1|intval}" />
                        <input type="hidden" name="filter[rows_per_page]" value="{$filter.rows_per_page|default:25|intval}" />
                        {*<input type="hidden" name="filter[order_by_field]" value="{$filter.order_by_field|default:'task_set_name'}" />
                        <input type="hidden" name="filter[order_by_direction]" value="{$filter.order_by_direction|default:'asc'}" />*}
                    </div>
                </form>
            </div>
            <table class="solutions_table">
                <thead>
                    <tr>
                        <th rowspan="2" class="left_corner">ID</th>
                        <th rowspan="2">{translate line='common_table_header_created'}</th>
                        <th rowspan="2">{translate line='common_table_header_updated'}</th>
                        <th rowspan="2">{translate line='admin_solutions_list_table_header_student'}</th>
                        <th rowspan="2">{translate line='admin_solutions_list_table_header_group'}</th>
                        <th rowspan="2">{translate line='admin_solutions_list_table_header_files_count'}</th>
                        <th rowspan="2">{translate line='admin_solutions_list_table_header_ip_address'}</th>
                        <th colspan="3" class="valuation">{translate line='admin_solutions_list_table_header_valuation'}</th>
                        <th rowspan="2" colspan="2" class="controlls right_corner">{translate line='admin_solutions_table_header_controlls'}</th>
                    </tr>
                    <tr>
                        <th>{translate line='admin_solutions_list_table_header_points'}</th>
                        <th>{translate line='admin_solutions_list_table_header_comment'}</th>
                        <th>{translate line='admin_solutions_list_table_header_teacher'}</th>
                    </tr>
                </thead>
                <tbody id="table_content_id"></tbody>
            </table>
        </fieldset>
        <fieldset>
            <legend>{translate line="admin_solutions_list_fieldset_legend_valuation_charts"}</legend>
            <div id="valuationCharts" style="height: 500px;"></div>
            <form id="histogramForm">
                <div class="field">
                    <label>{translate line='admin_solutions_histogram_bin_size'}:</label>
                    <p class="input">
                        <select name="histogram[size]" size="1" id="histogram_size_id">
                            <option value="0.25">0.25</option>
                            <option value="0.5" selected="selected">0.5</option>
                            <option value="0.75">0.75</option>
                            <option value="1.0">1.0</option>
                            <option value="1.25">1.25</option>
                            <option value="1.5">1.5</option>
                            <option value="1.75">1.75</option>
                            <option value="2.0">2.0</option>
                        </select>
                    </p>
                </div>
                <div class="field">
                    <label>{translate line='admin_solutions_histogram_hints'}:</label>
                    <p class="input">
                        <em>{translate line='admin_solutions_histogram_hint_text'}</em>
                    </p>
                </div>
            </form>
        </fieldset>
    {else}
        {include file='partials/backend_general/error_box.tpl' message='lang:admin_solutions_list_task_set_not_found' back_url={internal_url url='admin_solutions'} inline}     
    {/if}
{/block}
{block custom_head}
<script type="text/javascript">
    var task_set_id = {$task_set->id|intval};
    var chartmessages = {
        'chartTitle': '{translate line="admin_solutions_list_chart_title"}',
        'xAxis': '{translate line="admin_solutions_list_chart_xaxis"}',
        'yAxis': '{translate line="admin_solutions_list_chart_yaxis"}',
        'to': '{translate line="admin_solutions_list_chart_to"}',
        'range': '{translate line="admin_solutions_list_chart_tootlip_range"}',
        'sum': '{translate line="admin_solutions_list_chart_tootlip_sum"}',
        'subtitle': '{overlay|default:'' table='task_sets' table_id=$task_set->id column='name' default=$task_set->name}',
        'mean': '{translate line="admin_solutions_list_chart_mean"}',
        'sd': '{translate line="admin_solutions_list_chart_sd"}',
        'pointseries': {
            'name': '{translate line="admin_solutions_list_chart_pointseries_name"}',
            'x': '{translate line="admin_solutions_list_chart_pointseries_tooltip_x"}',
            'y': '{translate line="admin_solutions_list_chart_pointseries_tooltip_y"}'
        }
    };
</script>
{/block}