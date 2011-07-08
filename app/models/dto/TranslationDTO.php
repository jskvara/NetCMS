<?php

class TranslationDTO {
	protected $translationService;
	protected $page;
	
	public function __construct(PageEntity $page = null) {
		if ($page === null) {
			throw new IllegalStateException("TranslationDTO needs PageEntity.");
		}
		$this->page = $page;
		$this->translationService = new TranslationService();
	}
		
	public function getTranslation() {
		return $this->translationService->getTranslation($this->page->getUrl());
	}
		
	public function getLanguage() {
		return $this->translationService->getLanguage($this->page->getUrl());
	}
	
	public function getTranslationLanguage() {
		return $this->translationService->getLanguage($this->getTranslation());
	}
}
