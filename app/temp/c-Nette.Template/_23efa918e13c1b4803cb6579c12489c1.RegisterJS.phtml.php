<?php //netteCache[01]000240a:2:{s:4:"time";s:21:"0.76561900 1285252611";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:85:"/home/skvaros/PHP/www/Nette/Nettecms/app/controls/MultipleFileUpload/RegisterJS.phtml";i:2;i:1285252568;}}}?><?php
// file /home/skvaros/PHP/www/Nette/Nettecms/app/controls/MultipleFileUpload/RegisterJS.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '4c29b8484d'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
?>
<script type="text/javaScript">
new MFUFallbackController(document.getElementById(<?php echo TemplateHelpers::escapeJs($id) ?>),<?php echo json_encode($fallbacks) ?>);
</script>
<?php
}
