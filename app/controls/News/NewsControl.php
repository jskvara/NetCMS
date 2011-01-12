<?php

// http://forum.nette.org/cs/5085-struktura-slozitejsi-aplikace-dedeni-presenteru-nebo-komponenty
// http://forum.nette.org/cs/5278-vice-presenteru-tvorici-jedinou-stranku

class NewsControl extends Control {
	
	public function render() {
		$template = parent::createTemplate();
		
		$templateService = new TemplateService();
		$templateName = $templateService->getTemplateFile('newsControl');
		$template->setFile($templateName);
		$template->newsService = new NewsService();
		$template->render();
	}
}

