<?php //netteCache[01]000258a:2:{s:4:"time";s:21:"0.67913900 1284478340";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:102:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Page/editContent.phtml";i:2;i:1284478129;}}}?><?php
// file …/AdminModule/templates/Page/editContent.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '1db51a1525'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb582becd8c9_title')) { function _cbb582becd8c9_title($_args) { extract($_args)
;call_user_func(reset($_cb->blocks['h1']), get_defined_vars()) ?> | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbbee0ee21a6f_h1')) { function _cbbee0ee21a6f_h1($_args) { extract($_args)
?>Upravit obsah stránky<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb4ff1de871f_content')) { function _cbb4ff1de871f_content($_args) { extract($_args)
?>

<?php $control->getWidget("pageContentForm")->render() ;LatteMacros::includeTemplate('ckeditor.phtml', $template->getParams(), $_cb->templates['1db51a1525'])->render() ;
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
