<?php

class BreadcrumbsControl extends Control {
	
	public function render($url) {
		$template = parent::createTemplate();
		$templateService = new TemplateService();
		$templateName = $templateService->getTemplateFile('breadcrumbsControl');
		$template->setFile($templateName);
		
		$pageService = new PageService();
		$pages = $pageService->getMenu();
		$breadcrumbs = array();
		
		// homepage
		$breadcrumbs[] = $pages['']->toArray();
		
		if ($url !== '') {
			$urlParts = explode('/', $url);
			$urlKey = "";
			foreach ($urlParts as $key => $part) {
				$urlKey .= $part;
				$breadcrumbs[] = $pages[$urlKey]->toArray();
				$urlKey .= '/';
			}
		}
		
		$template->breadcrumbs = $breadcrumbs;
		
		$template->render();
	}
}

