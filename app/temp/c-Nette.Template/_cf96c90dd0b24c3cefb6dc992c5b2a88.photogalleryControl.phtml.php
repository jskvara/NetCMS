<?php //netteCache[01]000248a:2:{s:4:"time";s:21:"0.42153200 1287604590";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:93:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/templates/photogalleryControl.phtml";i:2;i:1287604585;}}}?><?php
// file …/templates/photogalleryControl.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '2884160058'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
?>
<div id="photogallery">
<pre>
<?php if (!empty($photos)): foreach ($iterator = $_cb->its[] = new SmartCachingIterator($photos) as $photo): $thumb = $photo->getMediaGroup()->getThumbnail(); $content = $photo->getMediaGroup()->getContent() ?>
<!--  <div>
    <a href="<?php echo TemplateHelpers::escapeHtmlComment($content[0]->getUrl()) ?>">
      <img src="<?php echo TemplateHelpers::escapeHtmlComment($thumb[0]->getUrl()) ?>" alt="<?php echo TemplateHelpers::escapeHtmlComment($photo->getSummary()) ?>" />
    </a>
<?php if ($photo->getSummary() != ''): ?>
    <span><?php echo TemplateHelpers::escapeHtmlComment($photo->getSummary()) ?></span>
<?php endif ?>
  </div>-->		$photos[] = new PhotoVO("<?php echo TemplateHelpers::escapeHtml($content[0]->getUrl()) ?>", "<?php echo TemplateHelpers::escapeHtml($thumb[0]->getUrl()) ?>", "<?php echo TemplateHelpers::escapeHtml($photo->getSummary()) ?>");
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ;else: ?>
<p>Nebyly přidány žádné fotografie</p>
<?php endif ?>
</pre>
</div>
<?php
}
