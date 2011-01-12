<?php //netteCache[01]000257a:2:{s:4:"time";s:21:"0.64561500 1284456102";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:101:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Default.default.phtml";i:2;i:1284456099;}}}?><?php
// file …/AdminModule/templates/Default.default.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '59cbfe1422'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb470a840d8f_title')) { function _cbb470a840d8f_title($_args) { extract($_args)
;call_user_func(reset($_cb->blocks['h1']), get_defined_vars()) ?> | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbb0ba691e6cc_h1')) { function _cbb0ba691e6cc_h1($_args) { extract($_args)
?>Administrace<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbbe4fc45bf59_content')) { function _cbbe4fc45bf59_content($_args) { extract($_args)
;
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
