<?php //netteCache[01]000253a:2:{s:4:"time";s:21:"0.42507100 1290514021";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:98:"/home/skvaros/PHP/www/Nette/Nettecms/document_root/../app/AdminModule/templates/Calendar/add.phtml";i:2;i:1290514010;}}}?><?php
// file …/AdminModule/templates/Calendar/add.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '8b6108d868'); unset($_extends);


//
// block title
//
if (!function_exists($_cb->blocks['title'][] = '_cbb04c9505935_title')) { function _cbb04c9505935_title($_args) { extract($_args)
?>Přidat záznam | <?php LatteMacros::callBlockParent($_cb->blocks, 'title', get_defined_vars()) ;
}}


//
// block h1
//
if (!function_exists($_cb->blocks['h1'][] = '_cbb7344a8d330_h1')) { function _cbb7344a8d330_h1($_args) { extract($_args)
?>Přidat záznam<?php
}}


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbb8b388bf65d_content')) { function _cbb8b388bf65d_content($_args) { extract($_args)
?>
<script>
$(function() {
	$(".datepicker").datepicker({
		// showOn: "button",
		// buttonImage: "<?php echo $basePath ?>/images/calendar.gif",
		// buttonImageOnly: true,
		dateFormat: 'd. m. yy',
		
		// localize
		closeText: 'Zavřít',
		prevText: '&#x3c; Dříve',
		nextText: 'Později &#x3e;',
		currentText: 'Nyní',
		monthNames: ['leden','únor','březen','duben','květen','červen','červenec','srpen','září','říjen','listopad','prosinec'],
		monthNamesShort: ['led','úno','bře','dub','kvě','čer','čvc','srp','zář','říj','lis','pro'],
		dayNames: ['neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota'],
		dayNamesShort: ['ne', 'po', 'út', 'st', 'čt', 'pá', 'so'],
		dayNamesMin: ['ne','po','út','st','čt','pá','so'],
		weekHeader: 'Týd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: '',
	});
});
</script>
<?php $control->getWidget("calendarForm")->render() ;
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }

if (SnippetHelper::$outputAllowed) {
if (!$_cb->extends) { call_user_func(reset($_cb->blocks['title']), get_defined_vars()); } ?>

<?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['h1']), get_defined_vars()); } ?>


<?php if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), get_defined_vars()); } ?>


<?php
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
