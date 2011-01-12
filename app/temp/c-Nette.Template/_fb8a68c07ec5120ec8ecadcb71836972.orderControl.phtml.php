<?php //netteCache[01]000241a:2:{s:4:"time";s:21:"0.66024800 1290190502";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:86:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/templates/orderControl.phtml";i:2;i:1290190488;}}}?><?php
// file …/templates/orderControl.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'e58671d820'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
$showForm = true ;foreach ($iterator = $_cb->its[] = new SmartCachingIterator($flashes) as $flash): if ($flash->type === "order"): ?>
        <?php echo TemplateHelpers::escapeHtml($showForm = false) ?>

        <div class="notice"><?php echo TemplateHelpers::escapeHtml($flash->message) ?></div>
<?php endif ;endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>

<?php if ($showForm === true): $control->getWidget("orderForm")->render() ;endif ;
}
