<?php //netteCache[01]000254a:2:{s:4:"time";s:21:"0.72980200 1290511108";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:99:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Calendar/edit.phtml";i:2;i:1290509713;}}}?><?php
// file …/AdminModule/templates/Calendar/edit.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'fb59ad451c'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb76a9d990e1_title')) { function _cbb76a9d990e1_title($_args) { extract($_args)
?>Upravit záznam | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbb7718143796_h1')) { function _cbb7718143796_h1($_args) { extract($_args)
?>Upravit záznam<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb0428d7dbb3_content')) { function _cbb0428d7dbb3_content($_args) { extract($_args)
;$control->getWidget("calendarForm")->render() ;
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
if (!$_cb->extends) { call_user_func(reset($_cb->blocks['title']), get_defined_vars()); } ?>

<?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['h1']), get_defined_vars()); } ?>


<?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
