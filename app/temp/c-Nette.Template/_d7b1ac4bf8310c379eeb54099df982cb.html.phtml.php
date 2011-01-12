<?php //netteCache[01]000270a:2:{s:4:"time";s:21:"0.57333600 1285251466";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:114:"/home/skvaros/PHP/www/Nette/Nettecms/app/controls/MultipleFileUpload/UserInterface/Interfaces/Uploadify/html.phtml";i:2;i:1285185134;}}}?><?php
// file /home/skvaros/PHP/www/Nette/Nettecms/app/controls/MultipleFileUpload/UserInterface/Interfaces/Uploadify/html.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '6f52c3c51f'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
?>
<table cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<div id="<?php echo TemplateHelpers::escapeHtml($uploadifyId) ?>" class="uploadify"></div>
		</td>
		<td>
			<span id="<?php echo TemplateHelpers::escapeHtml($uploadifyId) ?>ClearQueue" style="display: none;margin-left: 5px;" class="button" onclick="$('#'+<?php echo TemplateHelpers::escapeHtmlJs($uploadifyId) ?>).uploadifyClearQueue();">Vymazat frontu</span>
		</td>
		<td id="<?php echo TemplateHelpers::escapeHtml($uploadifyId) ?>Count">

		</td>
	</tr>
</table>
<div id="<?php echo TemplateHelpers::escapeHtml($uploadifyId) ?>-queue" class="ui-widget-content ui-corner-all" style="max-height: 300px;overflow:auto;display: none;margin-top: 5px;margin-bottom: 10px;"></div><?php
}
