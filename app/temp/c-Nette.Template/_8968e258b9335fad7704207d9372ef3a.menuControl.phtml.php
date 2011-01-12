<?php //netteCache[01]000240a:2:{s:4:"time";s:21:"0.90874400 1286728348";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:85:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/templates/menuControl.phtml";i:2;i:1286728346;}}}?><?php
// file …/templates/menuControl.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '6df97db789'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
?>
<div id="menu">
  <h3>Menu</h3>
<?php if (isset($menu)): ?>
  <ul>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($menu) as $menuPage): ?>
      <li <?php if (isset($menuPage['active'])): ?>class="active"<?php endif ?>><a href="<?php echo TemplateHelpers::escapeHtml($presenter->link(":Front:Default:default", array($menuPage['url']))) ?>"><?php echo TemplateHelpers::escapeHtml($menuPage['title']) ?></a></li>
<?php if (isset($menuPage['active']) && !empty($menuPage['childern'])): ?>
        <ul>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($menuPage['childern']) as $child): ?>
          <li <?php if (isset($child['active'])): ?>class="active"<?php endif ?>><a href="<?php echo TemplateHelpers::escapeHtml($presenter->link(":Front:Default:default", array($child['url']))) ?>"><?php echo TemplateHelpers::escapeHtml($child['title']) ?></a></li>
<?php if (isset($child['active']) && !empty($child['childern'])): ?>
            <ul>
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($child['childern']) as $child2): ?>
              <li <?php if (isset($child2['active'])): ?>class="active"<?php endif ?>><a href="<?php echo TemplateHelpers::escapeHtml($presenter->link(":Front:Default:default", array($child2['url']))) ?>"><?php echo TemplateHelpers::escapeHtml($child2['title']) ?></a></li>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
            </ul>
<?php endif ;endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
        </ul>
<?php endif ;endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
  </ul>
<?php else: ?>
  <p>Nebyly přidány žádné stránky</p>
<?php endif ?>
</div>
<?php
}
