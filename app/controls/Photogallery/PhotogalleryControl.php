<?php

class PhotogalleryControl extends Control {
	
	public function render($album) {
		$template = parent::createTemplate();
		
		$templateService = new TemplateService();
		$templateName = $templateService->getTemplateFile('photogalleryControl');
		$template->setFile($templateName);
		
		$photogalleryService = new PhotogalleryService();
		$template->photos = $photogalleryService->getPhotos($album);
		
		$template->render();
	}
}
