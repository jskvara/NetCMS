<?php //netteCache[01]000229a:2:{s:4:"time";s:21:"0.04152000 1282901936";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:74:"/home/skvaros/PHP/www/Nette/Nettecms/app/models/controls/NewsControl.phtml";i:2;i:1282873705;}}}?><?php
// file /home/skvaros/PHP/www/Nette/Nettecms/app/models/controls/NewsControl.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'ea71c80287'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
?>

<div class="sidebar">O blogu</div>

<p><?php echo TemplateHelpers::escapeHtml($news) ?></p>

<?php
}
