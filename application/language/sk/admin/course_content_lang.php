<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$lang['admin_course_content_page_title'] = 'Obsah kurzu';
$lang['admin_course_content_fieldset_legend_new_content'] = 'Nový obsah';
$lang['admin_course_content_fieldset_legend_all_content'] = 'Zoznam obsahu';

$lang['admin_course_content_form_label_created_by'] = 'Vytvoril';
$lang['admin_course_content_form_label_updated_by'] = 'Upravil';
$lang['admin_course_content_form_label_course_id'] = 'Kurz';
$lang['admin_course_content_form_label_title'] = 'Názov obsahu';
$lang['admin_course_content_form_label_content'] = 'Textový obsah';
$lang['admin_course_content_form_label_published'] = 'Publikovať?';
$lang['admin_course_content_form_label_published_from'] = 'Publikovať od';
$lang['admin_course_content_form_label_published_to'] = 'Publikovať do';
$lang['admin_course_content_form_label_public'] = 'Verejné?';
$lang['admin_course_content_form_label_course_content_group_id'] = 'Zoskupiť obsah do';
$lang['admin_course_content_form_label_files_default'] = 'Súbory (všeobecné)';
$lang['admin_course_content_form_label_files_language'] = 'Súbory (%s)';
$lang['admin_course_content_form_error_course_content_group_not_related_to_course'] = 'Hodnota pola <strong>%s</strong> nepatrí k zvolenému kurzu.';
$lang['admin_course_content_form_hint_edit_files'] = 'Pozor: Zmazanie súborov je uložené okamžite, nezávisí od tlačidla Uložiť na spodu tohoto formulára.';

$lang['admin_course_content_form_field_course_id'] = 'kurz';
$lang['admin_course_content_form_field_title'] = 'názov obsahu';
$lang['admin_course_content_form_field_course_content_group_id'] = 'zoskupiť obsah do';

$lang['admin_course_content_form_button_submit'] = 'Uložiť';

$lang['admin_course_content_filter_by_course'] = 'Filtrovať podľa kurzu';
$lang['admin_course_content_filter_submit_button'] = 'Použiť';

$lang['admin_course_content_flash_message_save_successful'] = 'Nový obsah úspešne uložený.';
$lang['admin_course_content_flash_message_save_fail'] = 'Nový obsah sa nepodarilo uložiť.';
$lang['admin_course_content_flash_message_save_fail_folder_rename'] = 'Ukladanie nového obsahu sa nepodarilo, pretože sa nedá premenovať obsahový adresár.';
$lang['admin_course_content_flash_message_content_not_found'] = 'Obsah sa nedá nájsť.';

$lang['admin_course_content_table_header_title'] = 'Nadpis';
$lang['admin_course_content_table_header_course'] = 'Kurz';
$lang['admin_course_content_table_header_published'] = 'Publikovať?';
$lang['admin_course_content_table_header_public'] = 'Verejné?';
$lang['admin_course_content_table_header_content_group'] = 'Skupina obsahu';
$lang['admin_course_content_table_header_published_from'] = 'Publikovať od';
$lang['admin_course_content_table_header_published_to'] = 'Publikovať do';
$lang['admin_course_content_table_header_file'] = 'Súbor';
$lang['admin_course_content_table_header_controlls'] = 'Ovládanie';

$lang['admin_course_content_table_content_published_yes'] = 'Áno';
$lang['admin_course_content_table_content_published_no'] = 'Nie';
$lang['admin_course_content_table_content_none_content_group'] = '&lt; žiadna &gt;';
$lang['admin_course_content_table_content_no_files_here'] = 'V tejto kategórii nie sú žiadne súbory.';
$lang['admin_course_content_table_content_all_languages'] = 'Všetky jazyky';
$lang['admin_course_content_table_content_no_published_from'] = '< bez spodného limitu >';
$lang['admin_course_content_table_content_no_published_to'] = '< bez horného limitu >';

$lang['admin_course_content_table_button_edit'] = 'Upraviť obsah';
$lang['admin_course_content_table_button_delete'] = 'Vymazať obsah';
$lang['admin_course_content_table_button_delete_file'] = 'Vymazať súbor';
$lang['admin_course_content_table_button_switch_file_visibility'] = 'Prepnúť viditeľnosť súboru';

$lang['admin_course_content_success_updated'] = 'Obsah bol úspešne aktualizovaný.';
$lang['admin_course_content_success_course_content_deleted'] = 'Obsah bol úspešne vymazaný.';

$lang['admin_course_content_error_course_content_cant_be_deleted'] = 'Obsah sa nedá zmazať.';
$lang['admin_course_content_error_not_updated'] = 'Obsah sa nepodarilo aktualizovať.';
$lang['admin_course_content_error_course_content_not_found'] = 'Požadovaný obsah kurzu sa nenašiel.';
$lang['admin_course_content_error_write_disabled'] = 'Súkromný adresár obsahu kurzov nie je zapisovateľný!';
$lang['admin_course_content_error_cant_save_form'] = 'Formulár nemožno uložiť, pretože súkromný adresár obsahu kurzov nie je zapisovateľný!';

$lang['admin_course_content_message_file_delete_success'] = 'Súbor %s zmazaný.';
$lang['admin_course_content_message_file_delete_failed'] = 'Súbor %s sa nedá zmazať kvôli chybe.';
$lang['admin_course_content_message_file_delete_not_found'] = 'Súbor %s sa nenašiel.';

$lang['admin_course_content_delete_file_question'] = 'Táto akcia zmaže súbor {0} zo servra. Toto nie je možné vziať späť. Určite chcete súbor zmazať?';
$lang['admin_course_content_delete_content_question'] = 'Táto akcia vymaže obsah {0} z databázy spolu s jeho súbormi (ak existujú). Toto nie je možné vzia späť. Určite chcete obsah zmazať?';

$lang['admin_course_content_text_show_uploader'] = 'Zobraziť uploader';
$lang['admin_course_content_text_coppied_to_clipboard'] = 'Úspešne skopírované do schránky.';

$lang['admin_course_content_publication_status_switched'] = 'Stav publikovania obsahu <strong>%s</strong> bol prepnutý.';
$lang['admin_course_content_public_status_switched'] = 'Stav súkromný/verejný obsahu <strong>%s</strong> bol prepnutý.';

$lang['admin_course_content_legend_table_caption'] = 'Legenda farieb tabuľky.';
$lang['admin_course_content_header_public_yes'] = 'Verejné';
$lang['admin_course_content_header_public_no'] = 'Neverejné';
$lang['admin_course_content_header_published_yes'] = 'Publikované';
$lang['admin_course_content_header_published_no'] = 'Nepublikované';

$lang['admin_course_content_sorting_page_header'] = 'Obsah kurzu - zotriedenie';
$lang['admin_course_content_fieldset_sort_all_content'] = 'Zotriedenie celého obsahu';

$lang['admin_course_content_sorting_course_not_found'] = 'Kurz, v ktorom chcete zotriediť obsah, sa nenašiel.';
$lang['admin_course_content_sorting_group_not_found'] = 'Nie je možné nájsť skupinu obsahu kurzu, v ktorej sa má zoradiť obsah.';
$lang['admin_course_content_sorting_nothing_to_sort'] = 'Nie je čo zoradiť.';
$lang['admin_course_content_sorting_order_inconsistent'] = 'Nie je možné vykonať zotriedenie kvôli nekonzistentnému vstupu: nie je možné miešať obsah a skupiny vrámci vnútroskupinového triedenia.';
$lang['admin_course_content_sorting_failed_to_update_sorting'] = 'Zlyhanie pri aplikovaní zoradenia, skúste to znovu.';
$lang['admin_course_content_sorting_successful'] = 'Zoradenie úspešné.';

$lang['admin_course_content_switch_to_sorting'] = 'Na zotriedenie';
$lang['admin_course_content_switch_to_listing'] = 'Na zoznam';
$lang['admin_course_content_switch_to_groups'] = 'Na skupiny';