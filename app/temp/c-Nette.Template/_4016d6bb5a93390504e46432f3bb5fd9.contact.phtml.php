<?php //netteCache[01]000236a:2:{s:4:"time";s:21:"0.01863400 1289764259";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:81:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/templates/contact.phtml";i:2;i:1289764236;}}}?><?php
// file …/templates/contact.phtml
//

$_cb = LatteMacros::initRuntime($template, true, 'a53cc31ee2'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb3000e2922e_content')) { function _cbb3000e2922e_content($_args) { extract($_args)
;echo $page->getContent() ?>

<?php $control->getWidget("contact")->render() ;
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
$_cb->extends = "@layout.phtml" ?>

<?php
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
