<?php //netteCache[01]000241a:2:{s:4:"time";s:21:"0.76151300 1287606233";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:86:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/templates/photogallery.phtml";i:2;i:1287606231;}}}?><?php
// file …/templates/photogallery.phtml
//

$_cb = LatteMacros::initRuntime($template, true, 'd1561d443a'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb56fb9ba99e_content')) { function _cbb56fb9ba99e_content($_args) { extract($_args)
;echo $page->getContent() ?>


<?php $control->getWidget("photogallery")->render('5527177246094624481') ;
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
