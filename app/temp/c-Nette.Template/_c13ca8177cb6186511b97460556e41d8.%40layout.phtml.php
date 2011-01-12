<?php //netteCache[01]000248a:2:{s:4:"time";s:21:"0.57534700 1284721348";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:93:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/FrontModule/templates/@layout.phtml";i:2;i:1284720712;}}}?><?php
// file …/FrontModule/templates/@layout.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '0c99740a9b'); unset($_extends);

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
	
<?php $control->getWidget("menu")->render() ;$control->getWidget("news")->render() ?>
	
	<?php echo $page->getContent() ?>

	<!-- <?php echo TemplateHelpers::escapeHtmlComment($moduleName) ?> <?php echo TemplateHelpers::escapeHtmlComment($presenterName) ?> <?php echo TemplateHelpers::escapeHtmlComment($viewName) ?> <?php echo TemplateHelpers::escapeHtmlComment($template->getFile()) ?> <?php echo TemplateHelpers::escapeHtmlComment($presenter->template->getFile()) ?> <?php echo TemplateHelpers::escapeHtmlComment($control->link(":Admin:Default:")) ?> -->
</body>
</html>
<?php
}
