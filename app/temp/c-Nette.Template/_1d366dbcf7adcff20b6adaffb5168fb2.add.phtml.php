<?php //netteCache[01]000249a:2:{s:4:"time";s:21:"0.46522300 1285251466";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:94:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/File/add.phtml";i:2;i:1285251331;}}}?><?php
// file …/AdminModule/templates/File/add.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '04d49f37db'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb1c8aeab545_title')) { function _cbb1c8aeab545_title($_args) { extract($_args)
;call_user_func(reset($_cb->blocks['h1']), get_defined_vars()) ?> | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbbdef4437c37_h1')) { function _cbbdef4437c37_h1($_args) { extract($_args)
?>Přidat soubory<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb445f9dca32_content')) { function _cbb445f9dca32_content($_args) { extract($_args)
?>

<?php $control->getWidget("fileForm")->render() ?>

<?php
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
