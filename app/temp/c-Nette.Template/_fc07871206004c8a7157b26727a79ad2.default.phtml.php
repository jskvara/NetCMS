<?php //netteCache[01]000258a:2:{s:4:"time";s:21:"0.95921400 1290516346";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:102:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Calendar/default.phtml";i:2;i:1290516342;}}}?><?php
// file …/AdminModule/templates/Calendar/default.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '8f61417d82'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbbe0091013d4_title')) { function _cbbe0091013d4_title($_args) { extract($_args)
?>Kalendář | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbbc03d8d0b3f_h1')) { function _cbbc03d8d0b3f_h1($_args) { extract($_args)
?>Kalendář<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbbddcda79aa8_content')) { function _cbbddcda79aa8_content($_args) { extract($_args)
?>

<p><a href="<?php echo TemplateHelpers::escapeHtml($control->link("add")) ?>">Přidat záznam</a></p>

<table class="grid">
<tr>
	<th>Datum</th>
	<th>Text</th>
	<th>Akce</th>
</tr>

<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($itemsCollection) as $item): ?>
<tr>
	<td><?php echo TemplateHelpers::escapeHtml($template->date($item->getDate(), '%e. %-m. %Y')) ?></td>
	<td><?php echo TemplateHelpers::escapeHtml($template->truncate($item->getText(), 80)) ?></td>
	<td>
		<a href="<?php echo TemplateHelpers::escapeHtml($control->link("edit", array($item->getId()))) ?>">Upravit</a> &nbsp;
		<a href="<?php echo TemplateHelpers::escapeHtml($control->link("delete", array($item->getId()))) ?>">Smazat</a>
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
