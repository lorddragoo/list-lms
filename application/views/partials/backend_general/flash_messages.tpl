{foreach $list_flash_messages as $flash_message}
    {if $flash_message.type eq 'default'}
    <div class="flash_message message_default">
        {translate_text text=$flash_message.message}
    </div>
    {elseif $flash_message.type eq 'success'}
    <div class="flash_message message_success">
        {translate_text text=$flash_message.message}
    </div>
    {elseif $flash_message.type eq 'error'}
    <div class="flash_message message_error">
        {translate_text text=$flash_message.message}
    </div>
    {elseif $flash_message.type eq 'script'}
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            {$flash_message.message}
        });
    </script>
    {/if}
{/foreach}
{$list_flash_messages = [] scope=global}