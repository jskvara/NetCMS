<?php //netteCache[01]000252a:2:{s:4:"time";s:21:"0.29056500 1285682927";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:97:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/File/delete.phtml";i:2;i:1285618885;}}}?><?php
// file …/AdminModule/templates/File/delete.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'ed358d80d3'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb54681333ab_title')) { function _cbb54681333ab_title($_args) { extract($_args)
;call_user_func(reset($_cb->blocks['h1']), get_defined_vars()) ?> | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbba2cc416eec_h1')) { function _cbba2cc416eec_h1($_args) { extract($_args)
?>Smazat soubor<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb744800ee95_content')) { function _cbb744800ee95_content($_args) { extract($_args)
?>

<div class="notice">Opravdu chcete smazat soubor: ’<?php echo TemplateHelpers::escapeHtml($file) ?>’?</div>
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
