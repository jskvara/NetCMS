<?php //netteCache[01]000236a:2:{s:4:"time";s:21:"0.75679900 1289764257";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:81:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/templates/default.phtml";i:2;i:1289764201;}}}?><?php
// file …/templates/default.phtml
//

$_cb = LatteMacros::initRuntime($template, true, '16a7768144'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb70fed9d978_content')) { function _cbb70fed9d978_content($_args) { extract($_args)
;echo $page->getContent() ?>

<?php
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
