<?php

final class Admin_BackupPresenter extends Admin_BasePresenter {

	private $backupService;

	public function __construct() {
		parent::__construct();
		$this->backupService = new BackupService();
	}

	public function renderDefault() {
	}
	
	public function renderDatabase() {
		try {
			$database = $this->backupService->getDatabase();
		} catch(ServiceException $e) {
			$this->showErrors($e);
			$this->redirect("default");
		}
		
		$this->terminate(new DownloadResponse($database));
	}
	
	public function renderUserfiles() {
		try {
			$userfiles = $this->backupService->getUserfiles();
		} catch(ServiceException $e) {
			$this->showErrors($e);
			$this->redirect("default");
		}
		
		$this->terminate(new DownloadResponse($userfiles));
	}
	
	public function renderTemplates() {
		try {
			$templates = $this->backupService->getTemplates();
		} catch(ServiceException $e) {
			$this->showErrors($e);
			$this->redirect("default");
		}
		
		$this->terminate(new DownloadResponse($templates));
	}
	
	public function renderAll() {
		try {
			$backup = $this->backupService->getAll();
		} catch(ServiceException $e) {
			$this->showErrors($e);
			$this->redirect("default");
		}
		
		$this->terminate(new DownloadResponse($backup));
	}
	
	public function renderClear() {
		try {
			$this->backupService->clear();
			$this->flashMessage("Adresář byl vyčištěn.", "success");
		} catch(ServiceException $e) {
			$this->showErrors($e);
		}
		
		$this->redirect("default");
	}
}
