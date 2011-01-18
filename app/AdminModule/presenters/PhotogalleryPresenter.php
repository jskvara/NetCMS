<?php

final class Admin_PhotogalleryPresenter extends Admin_BasePresenter {

	private $photogalleryService;

	public function __construct() {
		parent::__construct();
		
		$this->photogalleryService = new PhotogalleryService();
	}

	public function renderDefault() {
	}
	
	public function renderRegenerate() {
		$this->photogalleryService->regenerate();
		
		$this->flashMessage('Fotogalerie byla přegenerována.', 'success');
		$this->redirect('default');
	}
}
