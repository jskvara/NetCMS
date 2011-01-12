<?php //netteCache[01]000254a:2:{s:4:"time";s:21:"0.70037600 1286465225";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:99:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Page/ckeditor.phtml";i:2;i:1286118898;}}}?><?php
// file …/AdminModule/templates/Page/ckeditor.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'a593bc7f97'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
?>
<script type="text/javascript">
//<![CDATA[
CKEDITOR.replace('pageContent', {
	language: 'cs',
	width: 600,
	toolbar: [
		['Source'],
		['Cut','Copy','Paste','PasteText','PasteFromWord'],
		['Undo','Redo'], '/',
		['Format'],
		['Bold','Italic'],
		['NumberedList','BulletedList'],
		['Link','Unlink'],
		['Image','Table','SpecialChar'],
	],
	filebrowserBrowseUrl : '<?php echo $basePath ?>/admin/chooser/images/',
});
//]]>
</script>
<?php
}
