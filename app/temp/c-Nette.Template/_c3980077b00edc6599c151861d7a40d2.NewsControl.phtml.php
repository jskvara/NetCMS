<?php //netteCache[01]000222a:2:{s:4:"time";s:21:"0.39138300 1284456502";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:67:"/home/skvaros/PHP/www/Nette/Nettecms/app/controls/NewsControl.phtml";i:2;i:1284456498;}}}?><?php
// file /home/skvaros/PHP/www/Nette/Nettecms/app/controls/NewsControl.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'bed1f80e9b'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
?>

<div id="news">
<?php $homepageNews = $newsService->getHomepageNews() ?>
	<h3>Novinky</h3>
<?php if (isset($homepageNews)): ?>
	<ul>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($homepageNews) as $hpNews): ?>
		<li><?php echo TemplateHelpers::escapeHtml($hpNews->getTitle()) ?></li>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
	</ul>
<?php else: ?>
	<p>Nebyly přidány žádné novinky</p>
<?php endif ?>
</div>

<?php
}
