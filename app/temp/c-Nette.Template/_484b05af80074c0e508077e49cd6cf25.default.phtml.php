<?php //netteCache[01]000253a:2:{s:4:"time";s:21:"0.30780300 1285683525";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:98:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/File/default.phtml";i:2;i:1285683520;}}}?><?php
// file …/AdminModule/templates/File/default.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'f66770d860'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbbfe4e33ae46_title')) { function _cbbfe4e33ae46_title($_args) { extract($_args)
;call_user_func(reset($_cb->blocks['h1']), get_defined_vars()) ?> | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbbcebbc65e48_h1')) { function _cbbcebbc65e48_h1($_args) { extract($_args)
?>Soubory<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbba93a20ac62_content')) { function _cbba93a20ac62_content($_args) { extract($_args)
?>

<p><a href="<?php echo TemplateHelpers::escapeHtml($control->link("add")) ?>">Přidat soubory</a></p>

<table class="grid">
<tr>
	<th>Soubor</th>
	<th>Akce</th>
</tr>
<?php if ($files === null): ?>
<tr>
	<td colspan="2">Nejsou nahrány žádné soubory.</td>
</tr>
<?php else: foreach ($iterator = $_cb->its[] = new SmartCachingIterator($files) as $file): ?>
<tr>
	<td><!--<?php echo TemplateHelpers::escapeHtmlComment($basePath) ?>/<?php echo TemplateHelpers::escapeHtmlComment($uploadDir) ?>/--><?php echo TemplateHelpers::escapeHtml($file) ?></td>
	<td><a href="<?php echo TemplateHelpers::escapeHtml($control->link("delete", array('file' => $file))) ?>">Smazat</a></td>
</tr>

<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ;endif ?>
</table>
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
