<?php //netteCache[01]000251a:2:{s:4:"time";s:21:"0.21750900 1283292581";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:96:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Auth/login.phtml";i:2;i:1283073655;}}}?><?php
// file …/AdminModule/templates/Auth/login.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '4676a8d3e1'); unset($_extends);


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbbb355be2439_h1')) { function _cbbb355be2439_h1($_args) { extract($_args)
?>Přihlášení<?php
}}


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb435fa61248_title')) { function _cbb435fa61248_title($_args) { extract($_args)
?>Přihlášení | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb7ff626b28b_content')) { function _cbb7ff626b28b_content($_args) { extract($_args)
;$control->getWidget("loginForm")->render() ;
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
extract(array('robots' =>'noindex')) ?>

<?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['h1']), get_defined_vars()); } ?>


<?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['title']), get_defined_vars()); } ?>


<?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
