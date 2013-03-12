<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html" charset="utf-8" />
        <title>{block name='title'}{/block}</title>
        <link href="{'/public/css/admin_general.css'|base_url}" rel="stylesheet" type="text/css" media="screen" />
        <script type="text/javascript">
            var global_base_url = "{'/'|base_url}";
        </script>
        <script type="text/javascript" src="{'/public/js/jquery.js'|base_url}"></script>
        <script type="text/javascript" src="{'/public/js/jquery.mousewheel-3.0.6.pack.js'|base_url}"></script>
        <script type="text/javascript" src="{'/public/js/jquery.fancybox.pack.js?v=2.1.4'|base_url}"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="{'/public/css/jquery.fancybox.css?v=2.1.4'|base_url}" />
        <link rel="stylesheet" type="text/css" media="screen" href="{'/public/css/jquery.fancybox-buttons.css?v=2.1.4'|base_url}" />
        <script type="text/javascript" src="{'/public/js/jquery.fancybox-buttons.js?v=2.1.4'|base_url}"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="{'/public/css/jquery.fancybox-thumbs.css?v=2.1.4'|base_url}" />
        <script type="text/javascript" src="{'/public/js/jquery.fancybox-thumbs.js?v=2.1.4'|base_url}"></script>
        <script type="text/javascript" src="{'/public/js/jquery.fancybox-media.js?v=1.0.0'|base_url}"></script>
        <script type="text/javascript" src="{'/public/js/jMenu.jquery.min.js'}"></script>
        <script type="text/javascript" src="{'/public/js/admin_menu.js'}"></script>
        {foreach $list_internal_css_files as $file}{$file.html}{/foreach}
        {foreach $list_internal_js_files as $file}{$file.html}{/foreach}
        {block name='custom_head'}{/block}
    </head>
    {include file='partials/backend_general/adminmenu.tpl' inline}
    <body>
        <h1>{translate line='adminmenu_administration_title'}</h1>
        <nav>{make_adminmenu menu=$list_adminmenu current=$list_adminmenu_current}</nav>
        <div class="backend_body" style="border: 1px solid black; border-radius: 5px; padding: 5px; margin: 5px 5px 0 0; box-shadow: 5px 5px 5px black;">{block name='main_content'}{/block}</div>
    </body>
</html>