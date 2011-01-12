<?php //netteCache[01]000252a:2:{s:4:"time";s:21:"0.22116800 1283953930";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:97:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Page/delete.phtml";i:2;i:1283953923;}}}?><?php
// file …/AdminModule/templates/Page/delete.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '969aabc8ec'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb88aa07d9fd_title')) { function _cbb88aa07d9fd_title($_args) { extract($_args)
;call_user_func(reset($_cb->blocks['h1']), get_defined_vars()) ?> | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbb110521afe9_h1')) { function _cbb110521afe9_h1($_args) { extract($_args)
?>Smazat stránku<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb486fb660ea_content')) { function _cbb486fb660ea_content($_args) { extract($_args)
?>

<div class="notice">Opravdu chcete smazat stránku: ’<?php echo TemplateHelpers::escapeHtml($page->getName()) ?>’?</div>
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
