<?php //netteCache[01]000234a:2:{s:4:"time";s:21:"0.40637500 1290190403";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:79:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/templates/order.phtml";i:2;i:1290190385;}}}?><?php
// file …/templates/order.phtml
//

$_cb = LatteMacros::initRuntime($template, true, 'dcd508fa39'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbba4a6ac022f_content')) { function _cbba4a6ac022f_content($_args) { extract($_args)
;echo $page->getContent() ?>

<?php $control->getWidget("order")->render() ;
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
