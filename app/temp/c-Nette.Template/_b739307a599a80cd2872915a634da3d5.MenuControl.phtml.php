<?php //netteCache[01]000227a:2:{s:4:"time";s:21:"0.11674800 1284457241";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:72:"/home/skvaros/PHP/www/Nette/Nettecms/app/controls/Menu/MenuControl.phtml";i:2;i:1284457225;}}}?><?php
// file /home/skvaros/PHP/www/Nette/Nettecms/app/controls/Menu/MenuControl.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '662d35e197'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
?>

<div id="menu">
<?php $menu = $pageService->getMenu() ?>
	<h3>Menu</h3>
<?php if (isset($menu)): ?>
	<ul>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($menu) as $menuPage): ?>
		<li><a href="<?php echo TemplateHelpers::escapeHtml($presenter->link(":Front:Default:default", array($menuPage->getUrl()))) ?>"><?php echo TemplateHelpers::escapeHtml($menuPage->getTitle()) ?></a></li>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
	</ul>
<?php else: ?>
	<p>Nebyly přidány žádné stránky</p>
<?php endif ?>
</div>

<?php
}
