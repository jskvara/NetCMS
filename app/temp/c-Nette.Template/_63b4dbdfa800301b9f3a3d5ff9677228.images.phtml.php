<?php //netteCache[01]000256a:2:{s:4:"time";s:21:"0.15833000 1285859482";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:100:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Chooser/images.phtml";i:2;i:1285859476;}}}?><?php
// file …/AdminModule/templates/Chooser/images.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '9f3cddbe3e'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb0b36f7f5a2_title')) { function _cbb0b36f7f5a2_title($_args) { extract($_args)
;call_user_func(reset($_cb->blocks['h1']), get_defined_vars()) ?> | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbbb66280b444_h1')) { function _cbbb66280b444_h1($_args) { extract($_args)
?>Obrázky<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb4544f43359_content')) { function _cbb4544f43359_content($_args) { extract($_args)
?>

<script type="text/javascript">
//<![CDATA[
var fileDir = '<?php echo $basePath ?>/<?php echo $uploadDir ?>/';

function getUrlParam(paramName) {
	var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
	var match = window.location.search.match(reParam) ;
	
	return (match && match.length > 1) ? match[1] : '' ;
}

function selectImage(imageName) {
	var funcNum = getUrlParam('CKEditorFuncNum');
	window.opener.CKEDITOR.tools.callFunction(funcNum, fileDir + imageName);
	window.close();
}
//]]>
</script>

<table class="grid" width="100%">
<tr>
	<th>Soubor</th><th>Náhled</th>
</tr>
<?php if ($files === null): ?>
<tr>
	<td colspan="2">Nejsou nahrány žádné obrázky (soubory .jpg, .jpeg, .png, .gif).</td>
</tr>
<?php else: foreach ($iterator = $_cb->its[] = new SmartCachingIterator($files) as $file): ?>
<tr>
	<td><a href="javascript:selectImage('<?php echo TemplateHelpers::escapeHtml($file) ?>');"><?php echo TemplateHelpers::escapeHtml($file) ?></a></td>
	<td><img src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/<?php echo TemplateHelpers::escapeHtml($uploadDir) ?>/<?php echo TemplateHelpers::escapeHtml($file) ?>" width="100" /></td>
</tr>

<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ;endif ?>
</table>
<?php
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
if (!$_cb->extends) { call_user_func(reset($_cb->blocks['title']), get_defined_vars()); } ?>


<?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
