<?php //netteCache[01]000253a:2:{s:4:"time";s:21:"0.04016500 1284557313";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:98:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Template/add.phtml";i:2;i:1284557254;}}}?><?php
// file …/AdminModule/templates/Template/add.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '4314cec56a'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb4e9fdf931c_title')) { function _cbb4e9fdf931c_title($_args) { extract($_args)
;call_user_func(reset($_cb->blocks['h1']), get_defined_vars()) ?> | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbb3ee3514cfc_h1')) { function _cbb3ee3514cfc_h1($_args) { extract($_args)
?>Přidat šablonu<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbbe2ed1c1eab_content')) { function _cbbe2ed1c1eab_content($_args) { extract($_args)
?>

<?php $control->getWidget("templateForm")->render() ?>

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
