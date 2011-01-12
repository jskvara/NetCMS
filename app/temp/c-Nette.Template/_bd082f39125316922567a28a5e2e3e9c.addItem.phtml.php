<?php //netteCache[01]000257a:2:{s:4:"time";s:21:"0.48758300 1283933137";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:101:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/FrontModule/templates/Default/addItem.phtml";i:2;i:1278008476;}}}?><?php
// file …/FrontModule/templates/Default/addItem.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '41836a1d66'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbbd2705ee717_content')) { function _cbbd2705ee717_content($_args) { extract($_args)
?>
<ul>
	<li><a href="<?php echo TemplateHelpers::escapeHtml($control->link("default")) ?>"><code>default</code></a> - link to view <em>default</em> in current presenter</li>
	<li><a href="<?php echo TemplateHelpers::escapeHtml($control->link("CatalogList:")) ?>"><code>CatalogList:</code></a> - link to presenter <em>CatalogList</em> in current module (view <em>default</em>)</li>
</ul><?php
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
