<?php

class NewsControl extends Control {
	
	public function render($type = "homepage") {
		$template = parent::createTemplate();
		
		$templateService = new TemplateService();
		$newsService = new NewsService();
		
		if ($type === "homepage") {
			$templateName = $templateService->getTemplateFile('homepageNewsControl');
			$template->homepageNews = $newsService->getHomepageNews();
		} else {
			$templateName = $templateService->getTemplateFile('newsControl');
			
			$this->addComponent(new VisualPaginator, "paginator");
			$paginator = $this->getComponent("paginator")->getPaginator();
			$paginator->setItemsPerPage(1);
			$paginator->setItemCount($newsService->getNewsCount());
			
			$httpRequest = Environment::getHttpRequest();
			$page = $httpRequest->getQuery("news-paginator-page");
			$paginator->setPage($page);
			
			$template->news = $newsService->getNews($paginator->itemsPerPage, $paginator->offset);
			$template->paginator = $paginator;
		}
		
		$template->setFile($templateName);
		$template->render();
	}
	
	public function handlePage($page) {
		echo "PAGE";
	}
	
	public function handlePaginatorPage($paginatorPage) {
		echo "PAGE";
	}
}

