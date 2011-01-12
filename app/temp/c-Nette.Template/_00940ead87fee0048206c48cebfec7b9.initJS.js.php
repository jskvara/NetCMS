<?php //netteCache[01]000277a:2:{s:4:"time";s:21:"0.59769100 1285251466";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:121:"/home/skvaros/PHP/www/Nette/Nettecms/app/controls/MultipleFileUpload/UserInterface/Interfaces/HTML4SingleUpload/initJS.js";i:2;i:1285185245;}}}?><?php
// file /home/skvaros/PHP/www/Nette/Nettecms/app/controls/MultipleFileUpload/UserInterface/Interfaces/HTML4SingleUpload/initJS.js
//

$_cb = LatteMacros::initRuntime($template, NULL, 'fbfe5d6b67'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
?>
(function() {
	jQuery("#"+this.activeUI.id).parents("form").disableAjaxSubmit(); // @see nette-ajax-form.js
	return true;
}).call(this);<?php
}
