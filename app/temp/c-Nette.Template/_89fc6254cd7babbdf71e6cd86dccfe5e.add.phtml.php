<?php //netteCache[01]000249a:2:{s:4:"time";s:21:"0.10769700 1282922257";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:94:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/News/add.phtml";i:2;i:1282922216;}}}?><?php
// file …/AdminModule/templates/News/add.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '11502ae2a5'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb3105320ff7_title')) { function _cbb3105320ff7_title($_args) { extract($_args)
?>Přidat novinku | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbbaa2ad71fb3_h1')) { function _cbbaa2ad71fb3_h1($_args) { extract($_args)
?>Přidat novinku<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbbee7e8f4515_content')) { function _cbbee7e8f4515_content($_args) { extract($_args)
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
