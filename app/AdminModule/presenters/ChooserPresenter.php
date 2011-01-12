<?php

final class Admin_ChooserPresenter extends Admin_BasePresenter {

	private $fileService;

	public function __construct() {
		parent::__construct();
	}

	public function renderImages() {
		$fileService = new FileService();
		
		$this->template->uploadDir = Environment::getVariable('uploadDir');
		$this->template->files = $fileService->getImages();
	}
	
}
