<?php

final class Admin_BackupPresenter extends Admin_BasePresenter {

	protected $backupService;

	public function __construct() {
		parent::__construct();
		$this->backupService = new BackupService();
	}

	public function renderDefault() {
		$this->template->items = $this->backupService->getFiles();
	}
	
	public function renderDownload($id = "") {
		try {
			$path = $this->backupService->get($id);
		} catch (ServiceException $e) {
			$this->showErrors($e);
			return;
		}
		
		$this->terminate(new DownloadResponse($path));
	}
	
	public function renderDelete($id = "") {
		try {
			$item = $this->backupService->get($id);
			if ($item === NULL) {
				$this->flashMessage("Záloha nebyla nalezena.", "error");
				$this->redirect("default");
			}
		} catch (ServiceException $e) {
			$this->showErrors($e);
			return;
		}	
		
		$this->template->item = $id;
	}
	
	protected function createComponentDeleteForm() {
		$form = new AppForm();
		$form->addSubmit("delete", "Smazat")->getControlPrototype()->class("default");
		$form->addSubmit("cancel", "Zpět");
		$form->onSubmit[] = callback($this, "deleteFormSubmitted");
		$form->addProtection("Odešlete formulář znovu (bezpečnostní kód vypršel).");
		
		return $form;
	}
	
	public function deleteFormSubmitted(AppForm $form) {
		if ($form["delete"]->isSubmittedBy()) {
			$id = $this->getParam("id");
			
			try {
				$this->backupService->delete($id);
				$this->flashMessage("Záloha byla smazána.", "success");
			} catch(ServiceException $e) {
				$this->showErrors($e);
			}
		}

		$this->redirect("default");
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
