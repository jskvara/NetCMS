<?php

final class Admin_FilePresenter extends Admin_BasePresenter {

	private $fileService;

	public function __construct() {
		parent::__construct();
		
		$this->fileService = new FileService();
	}

	public function renderDefault() {
		$this->template->uploadDir = Environment::getVariable('uploadDir');
		$this->template->files = $this->fileService->getAll();
	}
	
	public function renderAdd() {
		$this['fileForm']['save']->caption = 'Přidat';
	}
	
	protected function createComponentFileForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		
		$form->addFile("file", "Soubor:")
			->addRule(Form::MIME_TYPE, 'Soubor musí být obrázek nebo PDF.', 'image/*,application/pdf')
			->addRule(Form::MAX_FILE_SIZE, 'Mmaximální velikost souboru je 10 MB.', 10 * 1024 * 1024);
		
		$form->addSubmit('save', 'Uložit')->getControlPrototype()->class('default');
		$form->addSubmit('cancel', 'Zpět')->setValidationScope(null);
		$form->onSubmit[] = callback($this, 'fileFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}


	public function fileFormSubmitted(AppForm $form) {
		if ($form['save']->isSubmittedBy()) {
			try {
				$file = $form['file']->getValue();
				$this->fileService->add($file);
			} catch(ServiceException $e) {
				$this->showErrors($e);
				return;
			}
			
			$this->flashMessage('Soubor byl uložen.', 'success');
		}
		
		$this->redirect('default');
	}
	
	public function renderDelete($file = null) {
		$file = $this->fileService->get($file);
		if ($file == null) {
			$this->flashMessage('Soubor nebyl nalezen.', 'error');
			$this->redirect('default');
		}
		
		$this->template->file = $file;
	}
	
	protected function createComponentDeleteForm() {
		$form = new AppForm();
		$form->addSubmit('delete', 'Smazat')->getControlPrototype()->class('default');
		$form->addSubmit('cancel', 'Zpět');
		$form->onSubmit[] = callback($this, 'deleteFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}
	
	public function deleteFormSubmitted(AppForm $form) {
		if ($form['delete']->isSubmittedBy()) {
			$file = $this->getParam('file');
			
			try {
				$this->fileService->delete($file);
				$this->flashMessage('Soubor byl smazán.', 'success');
			} catch(ServiceException $e) {
				$this->showErrors($e);
			}
		}

		$this->redirect('default');
	}
	
}
