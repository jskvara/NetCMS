<?php //netteCache[01]000243a:2:{s:4:"time";s:21:"0.62140300 1290185063";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:88:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/templates/contactControl.phtml";i:2;i:1290185058;}}}?><?php
// file …/templates/contactControl.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '001ae28dde'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
$showForm = true ;foreach ($iterator = $_cb->its[] = new SmartCachingIterator($flashes) as $flash): if ($flash->type === "contact"): ?>
        <?php echo TemplateHelpers::escapeHtml($showForm = false) ?>

        <div class="notice"><?php echo TemplateHelpers::escapeHtml($flash->message) ?></div>
<?php endif ;endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>

<?php if ($showForm === true): $control->getWidget("contactForm")->render() ;endif ;
}
