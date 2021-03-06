{extends file='layouts/backend.tpl'}
{block title}{translate line='adminmenu_title_translations_editor'}{/block}
{block main_content}
    <h2>{translate line='adminmenu_title_translations_editor'}</h2>
    {include file='partials/backend_general/flash_messages.tpl' inline}
    <fieldset>
        <input type="button" name="button_new" value="{translate line='admin_translationseditor_new_translation_button_text'}" class="button" />
    </fieldset>
    <fieldset>
        <legend>{translate line='admin_translationseditor_fieldset_table_legend'}</legend>
        <div class="translations_table_wrap">
            <table style="min-width: 100%;" id="translations_table">
                <thead>
                    <tr>
                        <th>{translate line='admin_translationseditor_table_header_constant'}</th>
                        {foreach $languages as $language}
                        <th>{$language}<br /><small>[{$language@key}]</small></th>
                        {/foreach}
                        <th>{translate line='admin_translationseditor_table_header_controlls'}</th>
                    </tr>
                </thead>
                <tbody>
                    {include file='backend/translationseditor/table_body.tpl' inline}
                </tbody>
            </table>
        </div>
    </fieldset>
{/block}
{block custom_head}<script type="text/javascript">
    var messages = {
        error: {
            operation_failed: '{translate|addslashes line="admin_translationseditor_javascript_message_error_operation_failed"}'
        },
        success: {
          deleted: '{translate|addslashes line="admin_translationseditor_javascript_message_success_deleted"}'
        },
        working: '{translate|addslashes line="admin_translationseditor_javascript_message_working"}',
        delete_question: '{translate|addslashes line="admin_translationseditor_javascript_message_delete_question"}'
    };
</script>{/block}