<?php

class Front_DefaultPresenter extends BasePresenter {
	
	protected $pageService;
	protected $templateService;
	protected $translationService;
	
	public function __construct() {
		$this->pageService = new PageService();
		$this->templateService = new TemplateService();
		$this->translationService = new TranslationService();
		parent::__construct();
	}
	
	public function renderDefault($url) {
		$page = $this->pageService->getByUrl($url);
				
		if ($page === null) {
			throw new BadRequestException();
		}
		
		if ($page->getRedirect() != "") {
			$redirect = $page->getRedirect();
			if (!String::startsWith($redirect, "http://")) {
				$redirect = rtrim(Environment::getVariable('baseUri'), "/") . $redirect;
			}
			$this->redirectUri($redirect);
		}
		
		// Set page template
		$templateFile = $this->templateService->getTemplateFile($page->getTemplate());
		$this->template->setFile($templateFile);
		
		$this->template->url = $url;
		$this->template->page = $page;
		$this->template->translation = new TranslationDTO($page);
	}
	
	public function createComponentNews() {
		return new NewsControl();
	}
	
	public function createComponentMenu() {
		return new MenuControl();
	}
	
	public function createComponentBreadcrumbs() {
		return new BreadcrumbsControl();
	}
	
	public function createComponentPhotogallery() {
		return new PhotogalleryControl();
	}
	
	public function createComponentContact() {
		return new ContactControl();
	}
	
	public function createComponentOrder() {
		return new OrderControl();
	}
	
	public function createComponentSeed() {
		return new SeedControl();
	}
	
	public function createComponentEmailing() {
		return new EmailingControl();
	}
	
	public function createComponentSubpages() {
		return new SubpagesControl();
	}
}
