<?php //netteCache[01]000252a:2:{s:4:"time";s:21:"0.06922700 1283760266";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:97:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/News/delete.phtml";i:2;i:1283760254;}}}?><?php
// file …/AdminModule/templates/News/delete.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'd8fdd437ad'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb72b7ea6aea_title')) { function _cbb72b7ea6aea_title($_args) { extract($_args)
;call_user_func(reset($_cb->blocks['h1']), get_defined_vars()) ?> | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbb7bb363a059_h1')) { function _cbb7bb363a059_h1($_args) { extract($_args)
?>Smazat novinku<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb2521f25636_content')) { function _cbb2521f25636_content($_args) { extract($_args)
?>

<div class="notice">Opravdu chcete smazat novinku: ’<?php echo TemplateHelpers::escapeHtml($news->getTitle()) ?>’?</div>
<?php $control->getWidget("deleteForm")->render() ?>

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
