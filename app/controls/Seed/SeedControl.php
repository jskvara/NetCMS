<?php

class SeedControl extends Control {
	
	public function render($seedId = 0) {
		$seedService = new SeedService();
		
		$template = parent::createTemplate();
		$templateService = new TemplateService();
		$templateName = $templateService->getTemplateFile('seedControl');
		$template->setFile($templateName);
		
		$template->seed = $seedService->get($seedId);
		$template->seedItems = $seedService->getSeedItems($seedId);
		$template->render();
	}
}

