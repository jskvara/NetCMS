<?php //netteCache[01]000278a:2:{s:4:"time";s:21:"0.59516200 1285251466";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:122:"/home/skvaros/PHP/www/Nette/Nettecms/app/controls/MultipleFileUpload/UserInterface/Interfaces/HTML4SingleUpload/html.phtml";i:2;i:1285185239;}}}?><?php
// file /home/skvaros/PHP/www/Nette/Nettecms/app/controls/MultipleFileUpload/UserInterface/Interfaces/HTML4SingleUpload/html.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '85a673020f'); unset($_extends);

if (SnippetHelper::$outputAllowed) {

$input =  Html::el("input type=file")->name($mfu->getHtmlName().'[files][]') ?>

<div class="ui-widget ui-widget-content ui-corner-all" style="padding: 5px;">
	<table cellspacing="5">
<?php  for($i=1;$i<=5;$i++): ?>
		<tr>
			<th>
				<?php echo TemplateHelpers::escapeHtml($i) ?>. soubor
			</th>
			<td>
				<?php echo $input ?>

			</td>
		</tr>
<?php  EndFor ?>
	</table>
</div><?php
}
