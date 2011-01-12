<?php //netteCache[01]000269a:2:{s:4:"time";s:21:"0.58633300 1285251466";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:113:"/home/skvaros/PHP/www/Nette/Nettecms/app/controls/MultipleFileUpload/UserInterface/Interfaces/Uploadify/initJS.js";i:2;i:1285185141;}}}?><?php
// file /home/skvaros/PHP/www/Nette/Nettecms/app/controls/MultipleFileUpload/UserInterface/Interfaces/Uploadify/initJS.js
//

$_cb = LatteMacros::initRuntime($template, NULL, '544ed40276'); unset($_extends);

if (SnippetHelper::$outputAllowed) {
?>
(function($){

	var queue = $("#<?php echo $uploadifyId ?>-queue");
	var uploadify = $("#<?php echo $uploadifyId ?>");
	var box = uploadify.parents("div.withJS");

	// TODO: add this to stylesheet
	$("span.button",box)
	.addClass("ui-state-default ui-corner-all")
	.css("cursor","pointer")
	.css("padding","3px")
	.css("font-size","12px")
	.css("font-family","Constantia,Palatino,'palatino linotype',Georgia,'New York CE',utopia,serif");

	uploadify.uploadify({
		width: 70,
		height: 22,
		wmode: "transparent",
		auto: false,
		multi: true,
		queueID: <?php echo $template->escapeJS($uploadifyId) ?>+"-queue",
		buttonImg: <?php echo $template->escapeJS(Environment::expand("%baseUri%images/MultipleFileUpload/uploadify/uploadifyButton.png")) ?>,
		uploader: <?php echo $template->escapeJS(Environment::expand("%baseUri%swf/MultipleFileUpload/uploadify/uploadify.allglyphs.swf")) ?>,
		cancelImg: <?php echo $template->escapeJS(Environment::expand("%baseUri%images/MultipleFileUpload/uploadify/cancel.png")) ?>,
		queueSizeLimit: <?php echo $template->escapeJS($maxFiles) ?>,
		sizeLimit: <?php echo $template->escapeJS($sizeLimit) ?>,
		script: <?php echo $template->escapeJS($backLink) ?>,
		simUploadLimit: <?php echo $template->escapeJS($simUploadFiles) ?>,
		scriptData: {
			token: <?php echo $template->escapeJS($token) ?>,
			sender: "MFU-Uploadify"
		},
		onInit: function(){
			//box.parent().parent().find(".withoutJS").hide();
		},
		onComplete: function(event, ID, fileObj, response, data){
			jQuery("#" + <?php echo $template->escapeJS($uploadifyId) ?> + ID).hide();
			return false;
		},
		onSelect: function(event,queueID,fileObj){
			if(fileObj.size > uploadify.uploadifySettings("sizeLimit")) {
				uploadify.trigger({
					type: "sizeLimitExcessed",
					fileObj: fileObj,
					queueID: queueID
				});
				uploadify.uploadifyCancel(queueID);
				return false;
			}
			if(fileObj.size == 0) {
				uploadify.trigger({
					type: "emptyFile",
					fileObj: fileObj,
					queueID: queueID
				});
				uploadify.uploadifyCancel(queueID);
				return false;
			}
		},
		onSelectOnce: function(){
			var queue = $("#"+$(this).attr("id")+"-queue");
			$("#"+$(this).attr("id")+"ClearQueue").fadeIn(500);
			queue.slideDown(1000,function(){
				$("div.uploadifyQueueItem:first",queue).livequery(function(){
					$(this).animate({ marginTop:"0px"},200);
				});
			});
			$("#"+$(this).attr("id")+"Count").text(uploadify.uploadifySettings("queueSize")+" vybraných souborů");
			return false;
		}
	});

	uploadify.bind("sizeLimitExcessed",function(event){
		alert("soubor '"+event.fileObj.name+"' je moc velký! Bude přeskočen.");
	});

	uploadify.bind("emptyFile",function(event){
		alert("soubor '"+event.fileObj.name+"' je prázdný! Bude přeskočen.");
	});

	return true; // OK

})(jQuery);<?php
}
