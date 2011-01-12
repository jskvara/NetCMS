<?php //netteCache[01]000257a:2:{s:4:"time";s:21:"0.18730900 1284646899";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:101:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Template/delete.phtml";i:2;i:1284646896;}}}?><?php
// file …/AdminModule/templates/Template/delete.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'dcc5a96120'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb2446dfb49a_title')) { function _cbb2446dfb49a_title($_args) { extract($_args)
;call_user_func(reset($_cb->blocks['h1']), get_defined_vars()) ?> | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbbb0da2e311a_h1')) { function _cbbb0da2e311a_h1($_args) { extract($_args)
?>Smazat šablonu<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbbb676156cb0_content')) { function _cbbb676156cb0_content($_args) { extract($_args)
?>

<div class="notice">Opravdu chcete smazat šablonu: ’<?php echo TemplateHelpers::escapeHtml($templateEntity->getName()) ?>’?</div>
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
