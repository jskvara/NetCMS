<?php //netteCache[01]000250a:2:{s:4:"time";s:21:"0.10387500 1286637092";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:95:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Page/edit.phtml";i:2;i:1286637088;}}}?><?php
// file …/AdminModule/templates/Page/edit.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'eb0021fb99'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbba31d55708f_title')) { function _cbba31d55708f_title($_args) { extract($_args)
;call_user_func(reset($_cb->blocks['h1']), get_defined_vars()) ?> | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbbc0dd50ded0_h1')) { function _cbbc0dd50ded0_h1($_args) { extract($_args)
?>Upravit stránku<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbbecb24e3ca9_content')) { function _cbbecb24e3ca9_content($_args) { extract($_args)
?>

<?php $control->getWidget("pageForm")->render() ?>

<p><a href="<?php echo TemplateHelpers::escapeHtml($control->link("add", array('parentUrl' => $page->getUrl()))) ?>">Přidat podstránku</a></p>
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
