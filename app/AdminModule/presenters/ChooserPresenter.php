<?php

final class Admin_ChooserPresenter extends Admin_BasePresenter {

	private $fileService;

	public function __construct() {
		parent::__construct();
	}

	public function renderImages($folder = null, $CKEditor, $CKEditorFuncNum, $langCode) {
		$fileService = new FileService();
		
		$this->template->uploadDir = Environment::getVariable('uploadDir');
		$this->template->folders = $fileService->getFolders();
		$this->template->current_folder = $folder;
		$this->template->files = $fileService->getImages($folder);
	}
	
}
