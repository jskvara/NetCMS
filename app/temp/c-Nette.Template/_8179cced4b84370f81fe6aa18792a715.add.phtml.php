<?php //netteCache[01]000249a:2:{s:4:"time";s:21:"0.77345300 1284718525";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:94:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Page/add.phtml";i:2;i:1284478458;}}}?><?php
// file …/AdminModule/templates/Page/add.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '593f102348'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb45f6e52942_title')) { function _cbb45f6e52942_title($_args) { extract($_args)
;call_user_func(reset($_cb->blocks['h1']), get_defined_vars()) ?> | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbb213ff0cdc5_h1')) { function _cbb213ff0cdc5_h1($_args) { extract($_args)
?>Přidat stránku<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb18b2020eb7_content')) { function _cbb18b2020eb7_content($_args) { extract($_args)
?>

<?php $control->getWidget("pageForm")->render() ?>

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
