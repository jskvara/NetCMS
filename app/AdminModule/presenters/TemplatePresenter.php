<?php

final class Admin_TemplatePresenter extends Admin_BasePresenter {

	private $templateService;

	public function __construct() {
		parent::__construct();
		
		$this->templateService = new TemplateService();
	}

	public function renderDefault() {
		$this->template->files = $this->templateService->getAll();
	}
	
	public function renderAdd() {
		$this['templateForm']['save']->caption = 'Přidat';
	}
	
	public function renderEdit($id = '') {
		$name = $id;
		$form = $this['templateForm'];
		if (!$form->isSubmitted()) {
			$template = $this->templateService->get($name);
			if ($template === null) {
				$this->flashMessage('Šablona nebyla nalezena.', 'error');
				$this->redirect('default');
			}
			
			$values = $template->toArray();
			$form->setDefaults($values);
			$form['name']->getControlPrototype()->readonly = true;
			$form['name']->getControlPrototype()->setClass('readonly');
		}
	}
	
	protected function createComponentTemplateForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		
		$form->addText('name', 'Jméno:')
			->addRule(Form::FILLED, 'Jméno šablony nesmí být prázdné')
			->addRule(Form::REGEXP, 'Jméno šablony smí obsahovat pouze: písmena, číslice, "_" a "-". Nahraďte mezery pomlčkou', '/^[a-zA-Z0-9-_@]+$/')
			->addRule(Form::MAX_LENGTH, 'Jméno šablony smí mít maximálně %d znaků', 30);
		
		$form->addTextarea('content', 'Obsah')
			->getControlPrototype()->setClass('largeTextarea');
		
		$form->addSubmit('save', 'Uložit')->getControlPrototype()->class('default');
		$form->addSubmit('cancel', 'Zpět')->setValidationScope(null);
		$form->onSubmit[] = callback($this, 'templateFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}

	public function templateFormSubmitted(AppForm $form)
	{
		if ($form['save']->isSubmittedBy()) {
			$name = $this->getParam('id');
			$content = $form['content']->getValue();
			
			if ($name !== null) { // edit
				try {
					$this->templateService->edit($name, $content);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage('Šablona byla upravena.', 'success');
			} else { // add
				try {
					$name = $form['name']->getValue();
					$this->templateService->add($name, $content);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage('Šablona byla uložena.', 'success');
			}
		}

		$this->redirect('default');
	}
	
	public function renderDelete($id = null) {
		$name = $id;
		$template = $this->templateService->get($name);
		if ($template == null) {
			$this->flashMessage('Šablona nebyla nalezena.', 'error');
			$this->redirect('default');
		}
		
		$this->template->templateEntity = $template;
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
			$name = $this->getParam('id');
			
			try {
				$this->templateService->delete($name);
				$this->flashMessage('Šablona byla smazána.', 'success');
			} catch(ServiceException $e) {
				$this->showErrors($e);
			}
			
		}

		$this->redirect('default');
	}
	
	public function renderCss() {
		$this->template->files = $this->templateService->getCssAll();
	}
	
	public function renderAddCss() {
		$this['cssForm']['save']->caption = 'Přidat';
	}
	
	public function renderEditCss($id = '') {
		$name = $id;
		$form = $this['cssForm'];
		if (!$form->isSubmitted()) {
			$css = $this->templateService->getCss($name);
			if ($css === null) {
				$this->flashMessage('Css soubor nebyl nalezen.', 'error');
				$this->redirect('css');
			}
			
			$values = $css->toArray();
			$form->setDefaults($values);
			$form['name']->getControlPrototype()->readonly = true;
			$form['name']->getControlPrototype()->setClass('readonly');
		}
	}
	
	protected function createComponentCssForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		
		$form->addText('name', 'Jméno:')
			->addRule(Form::FILLED, 'Jméno css souboru nesmí být prázdné')
			->addRule(Form::REGEXP, 'Jméno css souboru smí obsahovat pouze: písmena, číslice, "_" a "-". Nahraďte mezery pomlčkou', '/^[a-zA-Z0-9-_@]+$/')
			->addRule(Form::MAX_LENGTH, 'Jméno css souboru smí mít maximálně %d znaků', 30);
		
		$form->addTextarea('content', 'Obsah')
			->getControlPrototype()->setClass('largeTextarea');
		
		$form->addSubmit('save', 'Uložit')->getControlPrototype()->class('default');
		$form->addSubmit('cancel', 'Zpět')->setValidationScope(null);
		$form->onSubmit[] = callback($this, 'cssFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}

	public function cssFormSubmitted(AppForm $form)
	{
		if ($form['save']->isSubmittedBy()) {
			$name = $this->getParam('id');
			$content = $form['content']->getValue();
			
			if ($name !== null) { // edit
				try {
					$this->templateService->editCss($name, $content);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage('Css soubor byl upraven.', 'success');
			} else { // add
				try {
					$name = $form['name']->getValue();
					$this->templateService->addCss($name, $content);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage('Css soubor byl uložen.', 'success');
			}
		}

		$this->redirect('css');
	}
	
	public function renderDeleteCss($id = null) {
		$name = $id;
		$template = $this->templateService->getCss($name);
		if ($template == null) {
			$this->flashMessage('Css soubor nebyl nalezen.', 'error');
			$this->redirect('default');
		}
		
		$this->template->templateEntity = $template;
	}
	
	protected function createComponentDeleteCssForm() {
		$form = new AppForm();
		$form->addSubmit('delete', 'Smazat')->getControlPrototype()->class('default');
		$form->addSubmit('cancel', 'Zpět');
		$form->onSubmit[] = callback($this, 'deleteCssFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}
	
	public function deleteCssFormSubmitted(AppForm $form) {
		if ($form['delete']->isSubmittedBy()) {
			$name = $this->getParam('id');
			
			try {
				$this->templateService->deleteCss($name);
				$this->flashMessage('Css soubor byl smazán.', 'success');
			} catch(ServiceException $e) {
				$this->showErrors($e);
			}
			
		}

		$this->redirect('css');
	}
}
