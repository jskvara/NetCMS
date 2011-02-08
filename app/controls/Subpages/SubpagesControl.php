<?php

class SubpagesControl extends Control {
	public function render($url) {
		$template = parent::createTemplate();
		$templateService = new TemplateService();
		$templateName = $templateService->getTemplateFile("subpagesControl");
		$template->setFile($templateName);
		
		$pageService = new PageService();
		$allSubpages = $pageService->getSubpages($url);
		$subpages = null;
		foreach ($allSubpages as $subpage) {
			$url = str_replace($url ."/", "", $subpage->getUrl());
			if (strpos($url, "/") === false) {
				$subpages[] = $subpage;
			}
		}
		
		$template->subpages = $subpages;
		$template->render();
	}
}
