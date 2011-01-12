<?php //netteCache[01]000253a:2:{s:4:"time";s:21:"0.25240200 1282922461";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:98:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/News/default.phtml";i:2;i:1282922457;}}}?><?php
// file …/AdminModule/templates/News/default.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '0f2d8020f8'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb3082e379a5_title')) { function _cbb3082e379a5_title($_args) { extract($_args)
?>Novinky | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbbe1d6a00ff1_h1')) { function _cbbe1d6a00ff1_h1($_args) { extract($_args)
?>Novinky<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb8720c27b2c_content')) { function _cbb8720c27b2c_content($_args) { extract($_args)
?>

<p><a href="<?php echo TemplateHelpers::escapeHtml($control->link("add")) ?>">Přidat novinku</a></p>

<table class="grid">
<tr>
	<th>Nadpis</th>
	<th>Text</th>
	<th>Akce</th>
</tr>

<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($newsCollection) as $news): ?>
<tr>
	<td><?php echo TemplateHelpers::escapeHtml($news->getTitle()) ?></td>
	<td><?php echo TemplateHelpers::escapeHtml($news->getText()) ?></td>
	<td>
		<a href="<?php echo TemplateHelpers::escapeHtml($control->link("edit", array($news->getId()))) ?>">Upravit</a> &nbsp;
		<a href="<?php echo TemplateHelpers::escapeHtml($control->link("delete", array($news->getId()))) ?>">Smazat</a>
	</td>
</tr>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
</table>
<?php
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
if (!$_cb->extends) { call_user_func(reset($_cb->blocks['title']), get_defined_vars()); } ?>

<?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['h1']), get_defined_vars()); } ?>


<?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
