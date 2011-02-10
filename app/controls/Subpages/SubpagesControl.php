<?php

class SubpagesControl extends Control {
	public function render($url) {
		$template = parent::createTemplate();
		$templateService = new TemplateService();
		$templateName = $templateService->getTemplateFile("subpagesControl");
		$template->setFile($templateName);
		
		$pageService = new PageService();
		$allSubpages = $pageService->getSubpages($url);
		$subpages = array();
		foreach ($allSubpages as $subpage) {
			$u = str_replace($url."/", "", $subpage->getUrl());
			if (strpos($u, "/") === false) {
				$subpages[] = $subpage;
			}
		}
		
		$template->subpages = $subpages;
		$template->render();
	}
}
