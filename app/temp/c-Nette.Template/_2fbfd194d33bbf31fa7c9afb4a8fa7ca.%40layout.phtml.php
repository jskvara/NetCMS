<?php //netteCache[01]000248a:2:{s:4:"time";s:21:"0.42149700 1294834387";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:93:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/@layout.phtml";i:2;i:1294834379;}}}?><?php
// file …/AdminModule/templates/@layout.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '114b510337'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbbdf080c38c3_title')) { function _cbbdf080c38c3_title($_args) { extract($_args)
?>NetCMS<?php
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbb06472d1abe_h1')) { function _cbb06472d1abe_h1($_args) { extract($_args)
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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php if (isset($robots)): ?>
	<meta name="robots" content="<?php echo TemplateHelpers::escapeHtml($robots) ?>" />
<?php endif ?>
	<title><?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['title']), get_defined_vars()); } ?></title>
	
	<link rel="shortcut icon" href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/images/favicon.ico" type="image/x-icon" />
	
	<!-- blueprint -->
	<link rel="stylesheet" href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/css/blueprint/screen.css" type="text/css" media="screen, projection, tv" />
	<link rel="stylesheet" href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/css/blueprint/print.css" type="text/css" media="print" />
	<!--[if lt IE 8]><link rel="stylesheet" href="<?php echo TemplateHelpers::escapeHtmlComment($basePath) ?>/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
	
	<link rel="stylesheet" href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/css/admin.css" type="text/css" media="screen, projection, tv" />
	<link rel="stylesheet" href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/css/ui-lightness/jquery-ui-1.8.6.custom.css" type="text/css" />
	
	<script type="text/javascript" src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/js/jquery-ui-1.8.6.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/js/ckeditor/ckeditor.js"></script>
</head>
<body>

<!-- #wrapper -->
<div id="wrapper" class="container">

  <!-- #header -->
  <div id="header" class="span-24 last">
  	<div class="span-12">
	  <a id="homelink" href="<?php echo TemplateHelpers::escapeHtml($presenter->link("Default:")) ?>">Admin</a>
	</div>

    <div id="userbox" class="span-12 last">
<?php if (isset($user)): ?>
      <p>
        <strong><?php echo TemplateHelpers::escapeHtml($user->name) ?></strong> |
        <a href="<?php echo TemplateHelpers::escapeHtml($control->link("Auth:logout")) ?>">odhlásit</a>
      </p>
<?php endif ?>
    </div>
  </div>
  <hr />
  <!-- /#header -->
  
  <!-- #sibdebar -->
  <div id="sidebar" class="span-4">
    <br />
    <br />
    <br />
    
    <ul>
      <li><a href="<?php echo TemplateHelpers::escapeHtml($presenter->link("Page:")) ?>">Stránky</a></li>
  	  <li><a href="<?php echo TemplateHelpers::escapeHtml($presenter->link("News:")) ?>">Novinky</a></li>
  	  <li><a href="<?php echo TemplateHelpers::escapeHtml($presenter->link("Calendar:")) ?>">Kalendář</a></li>
  	  <li><a href="<?php echo TemplateHelpers::escapeHtml($presenter->link("File:")) ?>">Soubory</a></li>
  	  <li><a href="<?php echo TemplateHelpers::escapeHtml($presenter->link("Template:")) ?>">Šablony</a></li>
  	</ul>
  </div>
  <!-- /#sibdebar -->
  
  <!-- #content -->
  <div id="content" class="span-20 last">
  	
  	<h1><?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['h1']), get_defined_vars()); } ?></h1>
  	
<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($flashes) as $flash): ?>
    	<div class="<?php if ($flash->type != null): echo TemplateHelpers::escapeHtml($flash->type) ;else: ?>notice<?php endif ?>"><?php echo $flash->message ?></div>
<?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>
    
<?php LatteMacros::callBlock($_cb->blocks, 'content', get_defined_vars()) ?>
    
    <!-- #footer -->
    <div id="footer">
      <span class="quiet">Copyright &copy; 2010 &nbsp; | &nbsp; NetCMS</span>
    </div>
    <!-- /#footer -->
  </div>
  <!-- /#content -->

</div>
<!-- /#wrapper -->
</body>
</html>
<?php
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
