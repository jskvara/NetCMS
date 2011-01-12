<?php //netteCache[01]000253a:2:{s:4:"time";s:21:"0.23993200 1285859536";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:98:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Auth/@layout.phtml";i:2;i:1285856703;}}}?><?php
// file …/AdminModule/templates/Auth/@layout.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'eaa00a4065'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb4fa09ed130_title')) { function _cbb4fa09ed130_title($_args) { extract($_args)
?>NetCMS<?php
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbb92a8be50be_h1')) { function _cbb92a8be50be_h1($_args) { extract($_args)
?>Administrace<?php
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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php if (isset($robots)): ?>
	<meta name="robots" content="<?php echo TemplateHelpers::escapeHtml($robots) ?>" />
<?php endif ?>
	<title><?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['title']), get_defined_vars()); } ?></title>
	
	<link rel="stylesheet" href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/css/login.css" type="text/css" media="screen, projection, tv" />
</head>
<body>

<div id="content">
	<h1><?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['h1']), get_defined_vars()); } ?></h1> 
	
	<div id="login">
		<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($flashes) as $flash): ?><div class="flash <?php echo TemplateHelpers::escapeHtml($flash->type) ?>"><?php echo TemplateHelpers::escapeHtml($flash->message) ?></div><?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>

		
<?php LatteMacros::callBlock($_cb->blocks, 'content', get_defined_vars()) ?>
	</div>
</div>
<!-- /#content --> 

</body>
</html>
<?php
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
