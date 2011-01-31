<?php

final class Admin_FilePresenter extends Admin_BasePresenter {

	private $fileService;

	public function __construct() {
		parent::__construct();
		
		$this->fileService = new FileService();
	}

	public function renderDefault($folder = null) {
		// $this->template->uploadDir = Environment::getVariable('uploadDir');
		$this->template->folders = $this->fileService->getFolders();
		$this->template->current_folder = $folder;
		$this->template->files = $this->fileService->getFiles($folder);
	}
	
	public function renderAdd($folder = null) {
		$this->template->folder = $folder;
		$this['fileForm']['folder']->setValue($folder);
		$this['fileForm']['save']->caption = 'Přidat';
	}
	
	protected function createComponentFileForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		
		$form->addFile("file", "Soubor:")
			->addRule(Form::MIME_TYPE, 'Soubor musí být obrázek nebo PDF.', 'image/*,application/pdf')
			->addRule(Form::MAX_FILE_SIZE, 'Maximální velikost souboru je 10 MB.', 10 * 1024 * 1024);
		
		$form->addCheckbox("thumb", "Náhled obrázku:");
		
		$form->addHidden("folder");
		
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
				$folder = $form['folder']->getValue();
				$thumb = $form['thumb']->getValue();
				$this->fileService->add($file, $folder, $thumb);
			} catch(ServiceException $e) {
				$this->showErrors($e);
				return;
			}
			
			$this->flashMessage('Soubor byl uložen.', 'success');
		}
		
		$folder = $form['folder']->getValue();
		$this->redirect('default', array('folder' => $folder));
	}
	
	public function renderAddFolder() {
	}
	
	protected function createComponentFolderForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		
		$form->addText("folder", "Složka:")
			->addRule(Form::REGEXP, 'Název smí obsahovat pouze: písmena, číslice a "-". Nahraďte mezery pomlčkou', '/^[a-z0-9-]*$/');
		
		$form->addSubmit('save', 'Přidat')->getControlPrototype()->class('default');
		$form->addSubmit('cancel', 'Zpět')->setValidationScope(null);
		$form->onSubmit[] = callback($this, 'folderFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}
	
	public function folderFormSubmitted(AppForm $form) {
		if ($form['save']->isSubmittedBy()) {
			try {
				$file = $form['folder']->getValue();
				$this->fileService->addFolder($file);
			} catch(ServiceException $e) {
				$this->showErrors($e);
				return;
			}
			
			$this->flashMessage("Složka byla vytvořena.", "success");
		}
		
		$this->redirect("default");
	}
	
	public function renderDelete($file = null) {
		$file = $this->fileService->get($file);
		$isDir = $this->fileService->isDir($file);
		if ($file === null) {
			if ($isDir) {
				$this->flashMessage('Složka nebyla nalezena.', 'error');
			} else {
				$this->flashMessage('Soubor nebyl nalezen.', 'error');
			}
			$this->redirect('default', array("folder" => $folder));
		}
		
		$this->template->file = $file;
		$this->template->isDir = $isDir;
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
			$isDir = $this->fileService->isDir($file);
			$folder = $this->fileService->getDir($file);
			
			try {
				$this->fileService->delete($file);
				if ($isDir) {
					$this->flashMessage('Složka byla smazána.', 'success');
				} else {
					$this->flashMessage('Soubor byl smazán.', 'success');
				}
			} catch(ServiceException $e) {
				$this->showErrors($e);
			}
		}
		
		$this->redirect('default', array("folder" => $folder));
	}

}
