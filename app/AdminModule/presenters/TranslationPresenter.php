<?php

final class Admin_TranslationPresenter extends Admin_BasePresenter {

	private $translationService;
	private $pageService;

	public function __construct() {
		parent::__construct();
		
		$this->translationService = new TranslationService();
		$this->pageService = new PageService();
	}

	public function renderDefault() {
		$this->template->itemsCollection = $this->translationService->getAll();
	}
	
	public function renderAdd() {
		$this['translationForm']['save']->caption = 'Přidat';
	}
	
	public function renderEdit($id = 0) {
		$form = $this['translationForm'];
		if (!$form->isSubmitted()) {
			$item = $this->translationService->get($id);
			if ($item == null) {
				$this->flashMessage('Záznam nebyl nalezen.', 'error');
				$this->redirect('default');
			}
			
			$values = $item->toArray();
			$form->setDefaults($values);
		}
	}
	
	protected function createComponentTranslationForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		
		$csPages = $this->pageService->getLanguageSelect('cs');
		$form->addSelect('original', 'Originál:', $csPages);
		
		$enPages = $this->pageService->getLanguageSelect('en');
		$form->addSelect('translation', 'Překlad:', $enPages);
		
		$form->addSubmit('save', 'Uložit')->getControlPrototype()->class('default');
		$form->addSubmit('cancel', 'Zpět')->setValidationScope(null);
		$form->onSubmit[] = callback($this, 'translationFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}

	public function translationFormSubmitted(AppForm $form)
	{
		if ($form['save']->isSubmittedBy()) {
			$id = (int) $this->getParam('id');
			$original = $form['original']->getValue();
			$translation = $form['translation']->getValue();
			
			if ($id > 0) {
				try {
					$this->translationService->edit($id, $original, $translation);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage('Záznam byl upraven.', 'success');
			} else {
				try {
					$this->translationService->add($original, $translation);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage('Záznam byl uložen.', 'success');
			}
		}

		$this->redirect('default');
	}
	
	public function renderDelete($id = 0) {
		$item = $this->translationService->get($id);
		if ($item == null) {
			$this->flashMessage('Záznam nebyl nalezen.', 'error');
			$this->redirect('default');
		}
		
		$this->template->item = $item;
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
			$id = (int) $this->getParam('id');
			
			try {
				$this->translationService->delete($id);
				$this->flashMessage('Záznam byl smazán.', 'success');
			} catch(ServiceException $e) {
				$this->showErrors($e);
				$this->redirect('default');
			}
		}

		$this->redirect('default');
	}
}
