<?php //netteCache[01]000254a:2:{s:4:"time";s:21:"0.46577100 1284559467";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:99:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Template/edit.phtml";i:2;i:1284557307;}}}?><?php
// file …/AdminModule/templates/Template/edit.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '47de4441b5'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb37cf8b84ed_title')) { function _cbb37cf8b84ed_title($_args) { extract($_args)
;call_user_func(reset($_cb->blocks['h1']), get_defined_vars()) ?> | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbb2e47117c6d_h1')) { function _cbb2e47117c6d_h1($_args) { extract($_args)
?>Upravit šablonu<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb74301aadc1_content')) { function _cbb74301aadc1_content($_args) { extract($_args)
?>

<?php $control->getWidget("templateForm")->render() ;
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
if (!$_cb->extends) { call_user_func(reset($_cb->blocks['title']), get_defined_vars()); } ?>


<?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
