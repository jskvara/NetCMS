<?php //netteCache[01]000253a:2:{s:4:"time";s:21:"0.66959200 1286711332";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:98:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Page/default.phtml";i:2;i:1286642545;}}}?><?php
// file …/AdminModule/templates/Page/default.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '0f14d2dc71'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbbbe03e15f03_title')) { function _cbbbe03e15f03_title($_args) { extract($_args)
;call_user_func(reset($_cb->blocks['h1']), get_defined_vars()) ?> | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbb60224c0175_h1')) { function _cbb60224c0175_h1($_args) { extract($_args)
?>Stránky<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbbb2df55ebc2_content')) { function _cbbb2df55ebc2_content($_args) { extract($_args)
?>

<p><a href="<?php echo TemplateHelpers::escapeHtml($control->link("add")) ?>">Přidat stránku</a></p>

<table class="grid">
<tr>
	<th>Url</th>
	<th>Akce</th>
</tr>

<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($pages) as $page): ?>
<tr>
	<td><?php if ($page->getUrl() !== ""): ?>/<?php endif ;echo TemplateHelpers::escapeHtml($page->getUrl()) ?>/</td>
	<td>
		<a target="_blank" href="<?php echo TemplateHelpers::escapeHtml($control->link(":Front:Default:default", array($page->getUrl()))) ?>">Zobrazit</a> &nbsp; 
		<a href="<?php echo TemplateHelpers::escapeHtml($control->link("editContent", array($page->getId()))) ?>">Obsah</a> &nbsp; 
		<a href="<?php echo TemplateHelpers::escapeHtml($control->link("edit", array($page->getId()))) ?>">Nastavení</a> &nbsp; 
		<a href="<?php echo TemplateHelpers::escapeHtml($control->link("delete", array($page->getId()))) ?>">Smazat</a> &nbsp; 
		<?php if ($page->getPosition() != 1): ?><a href="<?php echo TemplateHelpers::escapeHtml($control->link("moveUp", array($page->getId()))) ?>" title="Posunout nahoru">^</a><?php else: ?>&nbsp;<?php endif ?> &nbsp; 
		<?php if ($page->getPosition() != $maxPosition): ?><a href="<?php echo TemplateHelpers::escapeHtml($control->link("moveDown", array($page->getId()))) ?>" title="Posunout dolů">v</a><?php else: ?>&nbsp;<?php endif ?> &nbsp; 
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


<?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
