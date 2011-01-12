<?php //netteCache[01]000250a:2:{s:4:"time";s:21:"0.04843100 1282922335";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:95:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/News/edit.phtml";i:2;i:1282922328;}}}?><?php
// file …/AdminModule/templates/News/edit.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '031051b7e0'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb79f57c353c_title')) { function _cbb79f57c353c_title($_args) { extract($_args)
?>Upravit novinku | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbb529db56f35_h1')) { function _cbb529db56f35_h1($_args) { extract($_args)
?>Upravit novinku<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbbddf16bee7f_content')) { function _cbbddf16bee7f_content($_args) { extract($_args)
?>

<?php $control->getWidget("newsForm")->render() ;
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
