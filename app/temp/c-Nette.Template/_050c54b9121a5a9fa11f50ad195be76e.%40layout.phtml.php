<?php //netteCache[01]000257a:2:{s:4:"time";s:21:"0.15722300 1285856599";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:101:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Chooser/@layout.phtml";i:2;i:1285856593;}}}?><?php
// file …/AdminModule/templates/Chooser/@layout.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'f5db819611'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb6cb7c34dc7_title')) { function _cbb6cb7c34dc7_title($_args) { extract($_args)
?>NetCMS<?php
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sk" lang="sk">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php if (isset($robots)): ?>
	<meta name="robots" content="<?php echo TemplateHelpers::escapeHtml($robots) ?>" />
<?php endif ?>
	<title><?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['title']), get_defined_vars()); } ?></title>
	
	<!-- blueprint --/>
	<link rel="stylesheet" href="<?php echo TemplateHelpers::escapeHtmlComment($basePath) ?>/css/blueprint/screen.css" type="text/css" media="screen, projection, tv" />
	<link rel="stylesheet" href="<?php echo TemplateHelpers::escapeHtmlComment($basePath) ?>/css/blueprint/print.css" type="text/css" media="print" />
	<!--[if lt IE 8]><link rel="stylesheet" href="<?php echo TemplateHelpers::escapeHtmlComment($basePath) ?>/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
	<!-- /blueprint -->
	
	<link rel="stylesheet" href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/css/admin.css" type="text/css" media="screen, projection, tv" />
</head>
<body>

<!-- #wrapper -->
<div>
<?php LatteMacros::callBlock($_cb->blocks, 'content', get_defined_vars()) ?>
</div>
<!-- /#wrapper -->
</body>
</html>
<?php
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
