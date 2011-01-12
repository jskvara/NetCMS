<?php //netteCache[01]000238a:2:{s:4:"time";s:21:"0.32081600 1284026613";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:83:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/templates/Error/404.phtml";i:2;i:1278008478;}}}?><?php
// file …/templates/Error/404.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'a69e24abe8'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbba3449038d3_content')) { function _cbba3449038d3_content($_args) { extract($_args)
?>

<h1>404 Not Found</h1>

<p>The requested URL was not found on this server.</p>
<?php
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
extract(array('robots' =>'noindex')) ?>

<?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
