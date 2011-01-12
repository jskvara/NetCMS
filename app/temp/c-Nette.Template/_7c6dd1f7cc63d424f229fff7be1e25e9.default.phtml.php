<?php //netteCache[01]000258a:2:{s:4:"time";s:21:"0.99703500 1284559245";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:102:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Template/default.phtml";i:2;i:1284559200;}}}?><?php
// file …/AdminModule/templates/Template/default.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '34848c37c1'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbbb9954a8ba1_title')) { function _cbbb9954a8ba1_title($_args) { extract($_args)
;call_user_func(reset($_cb->blocks['h1']), get_defined_vars()) ?> | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbb17cd272969_h1')) { function _cbb17cd272969_h1($_args) { extract($_args)
?>Šablony<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb880a442c19_content')) { function _cbb880a442c19_content($_args) { extract($_args)
?>

<p><a href="<?php echo TemplateHelpers::escapeHtml($control->link("add")) ?>">Přidat šablonu</a></p>

<table class="grid">
<tr>
	<th>Jméno</th>
	<th>Akce</th>
</tr>

<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($files) as $file): ?>
<tr>
	<td><?php echo TemplateHelpers::escapeHtml($file->getName()) ?></td>
	<td>
		<a href="<?php echo TemplateHelpers::escapeHtml($control->link("edit", array("id" => $file->getName()))) ?>">Upravit</a> &nbsp; 
		<a href="<?php echo TemplateHelpers::escapeHtml($control->link("delete", array("id" => $file->getName()))) ?>">Smazat</a> &nbsp; 
	</td>
</tr>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
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
