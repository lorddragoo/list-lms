{include file='partials/backend_general/flash_messages.tpl' inline}
<div class="field">
    <label for="room_name_id" class="required">{translate line='admin_rooms_form_label_name'}:</label>
    <p class="input"><input type="text" name="room[name]" value="{$smarty.post.room.name|escape:'html'}" id="room_name_id" /></p>
    {form_error field='room[name]' left_delimiter='<p class="error"><span class="message">' right_delimiter='</span></p>'}
</div>
<div class="field">
    <label for="room_time_begin_id" class="required">{translate line='admin_rooms_form_label_time_begin'}:</label>
    <p class="input"><input type="text" name="room[time_begin]" value="{$smarty.post.room.time_begin|escape:'html'}" id="room_time_begin_id" /></p>
    {form_error field='room[time_begin]' left_delimiter='<p class="error"><span class="message">' right_delimiter='</span></p>'}
</div>
<div class="field">
    <label for="room_time_end_id" class="required">{translate line='admin_rooms_form_label_time_end'}:</label>
    <p class="input"><input type="text" name="room[time_end]" value="{$smarty.post.room.time_end|escape:'html'}" id="room_time_end_id" /></p>
    {form_error field='room[time_end]' left_delimiter='<p class="error"><span class="message">' right_delimiter='</span></p>'}
</div>
<div class="field">
    <label for="room_time_day_id" class="required">{translate line='admin_rooms_form_label_time_day'}:</label>
    <select name="room[time_day]" size="1" id="room_time_day_id"><option value=""></option>{list_html_options options=$list_days selected=$smarty.post.room.time_day}</select>
    {form_error field='room[time_day]' left_delimiter='<p class="error"><span class="message">' right_delimiter='</span></p>'}
</div>
<div class="field">
    <label for="room_capacity_id" class="required">{translate line='admin_rooms_form_label_capacity'}:</label>
    <p class="input"><input type="text" name="room[capacity]" value="{$smarty.post.room.capacity|escape:'html'}" id="room_capacity_id" /></p>
    {form_error field='room[capacity]' left_delimiter='<p class="error"><span class="message">' right_delimiter='</span></p>'}
</div>
<div class="field">
    <label for="room_teachers_id">{translate line='admin_rooms_form_label_teachers'}:</label>
    <div class="input">
        <select name="room[teachers][]" multiple="multiple" size="5" id="room_teachers_id">
            {html_options options=$teachers selected=$smarty.post.room.teachers}
        </select>
    </div>
    <p class="input"><em>{translate line='admin_rooms_form_label_teachers_hint'}</em></p>
    {form_error field='room[teachers][]' left_delimiter='<p class="error"><span class="message">' right_delimiter='</span></p>'}
</div>
<div class="field">
    <label for="room_teachers_plain_id">{translate line='admin_rooms_form_label_teachers_plain'}:</label>
    <p class="input"><input type="text" name="room[teachers_plain]" value="{$smarty.post.room.teachers_plain|escape:'html'}" id="room_teachers_plain_id" /></p>
    <p class="input"><em>{translate line='admin_rooms_form_label_teachers_plain_hint'}</em></p>
    {form_error field='room[teachers_plain]' left_delimiter='<p class="error"><span class="message">' right_delimiter='</span></p>'}
</div>
<div class="buttons">
    <input type="submit" name="submit_button" value="{translate line='admin_rooms_form_button_save'}" class="button" />
</div>
<input type="hidden" name="room[group_id]" value="{$smarty.post.room.group_id|default:$group->id|intval}" />