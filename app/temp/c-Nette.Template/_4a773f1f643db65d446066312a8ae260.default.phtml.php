<?php //netteCache[01]000257a:2:{s:4:"time";s:21:"0.86811700 1284025799";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:101:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/FrontModule/templates/Default/default.phtml";i:2;i:1284025711;}}}?><?php
// file …/FrontModule/templates/Default/default.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '19b8fbe7c2'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb6e7b09706f_content')) { function _cbb6e7b09706f_content($_args) { extract($_args)
?>

<?php
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
