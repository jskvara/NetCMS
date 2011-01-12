<?php

class MenuControl extends Control {
	
	public function render($url) {
		$template = parent::createTemplate();
		$templateService = new TemplateService();
		$templateName = $templateService->getTemplateFile('menuControl');
		$template->setFile($templateName);
		
		$pageService = new PageService();
		$pages = $pageService->getMenu();
		$menu = array();
		foreach ($pages as $key => $page) {
			$urlParts = explode('/', $page->getUrl());
			$active = ($page->getUrl() === $url);
			if (count($urlParts) === 1) {
				$menu[$urlParts[0]] = $page->toArray();
				$menu[$urlParts[0]]['childern'] = array();
				if ($active) {
					$menu[$urlParts[0]]['active'] = true;
				}
			} else if(count($urlParts) === 2) {
				$menu[$urlParts[0]]['childern'][$urlParts[1]] = $page->toArray();
				$menu[$urlParts[0]]['childern'][$urlParts[1]]['childern'] = array();
				if ($active) {
					$menu[$urlParts[0]]['active'] = true;
					$menu[$urlParts[0]]['childern'][$urlParts[1]]['active'] = true;
				}
			} else if(count($urlParts) === 3) {
				$menu[$urlParts[0]]['childern'][$urlParts[1]]['childern'][$urlParts[2]] = $page->toArray();
				$menu[$urlParts[0]]['childern'][$urlParts[1]]['childern'][$urlParts[2]]['childern'] = array();
				if ($active) {
					$menu[$urlParts[0]]['active'] = true;
					$menu[$urlParts[0]]['childern'][$urlParts[1]]['active'] = true;
					$menu[$urlParts[0]]['childern'][$urlParts[1]]['childern'][$urlParts[2]]['active'] = true;
				}
			} else if(count($urlParts) === 4) {
				$menu[$urlParts[0]]['childern'][$urlParts[1]]['childern'][$urlParts[2]]['childern'][$urlParts[3]] = $page->toArray();
				$menu[$urlParts[0]]['childern'][$urlParts[1]]['childern'][$urlParts[2]]['childern'][$urlParts[3]]['childern'] = array();
				if ($active) {
					$menu[$urlParts[0]]['active'] = true;
					$menu[$urlParts[0]]['childern'][$urlParts[1]]['active'] = true;
					$menu[$urlParts[0]]['childern'][$urlParts[1]]['childern'][$urlParts[2]]['active'] = true;
					$menu[$urlParts[0]]['childern'][$urlParts[1]]['childern'][$urlParts[2]]['childern'][$urlParts[3]]['active'] = true;
				}
			} else if(count($urlParts) === 5) {
				$menu[$urlParts[0]]['childern'][$urlParts[1]]['childern'][$urlParts[2]]['childern'][$urlParts[3]]['childern'][$urlParts[4]] = $page->toArray();
				$menu[$urlParts[0]]['childern'][$urlParts[1]]['childern'][$urlParts[2]]['childern'][$urlParts[3]]['childern'][$urlParts[4]]['childern'] = array();
				if ($active) {
					$menu[$urlParts[0]]['active'] = true;
					$menu[$urlParts[0]]['childern'][$urlParts[1]]['active'] = true;
					$menu[$urlParts[0]]['childern'][$urlParts[1]]['childern'][$urlParts[2]]['active'] = true;
					$menu[$urlParts[0]]['childern'][$urlParts[1]]['childern'][$urlParts[2]]['childern'][$urlParts[3]]['active'] = true;
					$menu[$urlParts[0]]['childern'][$urlParts[1]]['childern'][$urlParts[2]]['childern'][$urlParts[3]]['childern'][$urlParts[4]]['active'] = true;
				}
			}
		}
		
		$template->menu = $menu;
		
		$template->render();
	}
}

