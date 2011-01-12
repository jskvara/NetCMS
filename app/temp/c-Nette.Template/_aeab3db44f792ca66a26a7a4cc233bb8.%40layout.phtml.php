<?php //netteCache[01]000236a:2:{s:4:"time";s:21:"0.14627200 1286712497";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:81:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/templates/@layout.phtml";i:2;i:1286712434;}}}?><?php
// file …/templates/@layout.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '683457cf82'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbbf7b874da83_content')) { function _cbbf7b874da83_content($_args) { extract($_args)
?>
    <!-- <?php echo TemplateHelpers::escapeHtmlComment($moduleName) ?> <?php echo TemplateHelpers::escapeHtmlComment($presenterName) ?> <?php echo TemplateHelpers::escapeHtmlComment($viewName) ?> <?php echo TemplateHelpers::escapeHtmlComment($template->getFile()) ?> <?php echo TemplateHelpers::escapeHtmlComment($presenter->template->getFile()) ?> <?php echo TemplateHelpers::escapeHtmlComment($control->link(":Admin:Default:")) ?> -->
  </div>
</body>
</html><?php
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title><?php echo TemplateHelpers::escapeHtml($page->getTitle()) ?> | NetCMS</title>
	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/css/frontend.css" />
</head>

<body>
  <div id="header">Header</div>

  <div id="sidebar">
<?php $control->getWidget("menu")->render($url) ;$control->getWidget("news")->render() ?>
  </div>

  <div id="content">
<?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
