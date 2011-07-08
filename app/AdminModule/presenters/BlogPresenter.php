<?php

final class Admin_BlogPresenter extends Admin_BasePresenter {

	private $blogService;

	public function __construct() {
		parent::__construct();
		
		$this->blogService = new BlogService();
	}

	public function renderDefault() {
		$this->template->items = $this->blogService->getAll();
	}
	
	public function renderAdd() {
		$this['blogForm']['save']->caption = 'Přidat';
	}
	
	public function renderEdit($id = 0) {
		$form = $this['blogForm'];
		if (!$form->isSubmitted()) {
			$blog = $this->blogService->get($id);
			if ($blog == null) {
				$this->flashMessage('Příspěvek nebyl nalezen.', 'error');
				$this->redirect('default');
			}
			
			$values = $blog->toArray();
			if (is_object($values['created'])) {
				$values['created'] = $values['created']->format('j. n. Y');
			} else {
				$values['created'] = date("j. n. Y", $values['created']);
			}
			$form->setDefaults($values);
		}
	}
	
	protected function createComponentBlogForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		$form->addText('title', 'Nadpis:')
			->addRule(Form::FILLED, 'Musíte vyplnit nadpis příspěvku.');

		$form->addTextarea('text', 'Text:')
			->setHtmlId('pageContent');
		
		$form->addText('created', 'Vytvořeno:')
			->setValue(date('j. n. Y'))
			->getControlPrototype()->setClass('datepicker');
		
		$form->addCheckbox('visible', 'Zobrazit')
			->setValue(true);
		
		$form->addSubmit('save', 'Uložit')->getControlPrototype()->class('default');
		$form->addSubmit('cancel', 'Zpět')->setValidationScope(null);
		$form->onSubmit[] = callback($this, 'blogFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}

	public function blogFormSubmitted(AppForm $form)
	{
		if ($form['save']->isSubmittedBy()) {
			$id = (int) $this->getParam('id');
			$title = $form['title']->getValue();
			$text = $form['text']->getValue();
			$created = $form['created']->getValue();
			$visible = $form['visible']->getValue();
			
			if ($id > 0) {
				try {
					$this->blogService->edit($id, $title, $text, $created, $visible);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage('Příspěvek byl upraven.', 'success');
			} else {
				try {
					$this->blogService->add($title, $text, $created, $visible);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage('Příspěvek byl uložen.', 'success');
			}
		}

		$this->redirect('default');
	}
	
	public function renderDelete($id = 0) {
		$blog = $this->blogService->get($id);
		if ($blog == null) {
			$this->flashMessage('Příspěvek nebyl nalezen.', 'error');
			$this->redirect('default');
		}
		
		$this->template->blog = $blog;
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
				$this->blogService->delete($id);
				$this->flashMessage('Příspěvek byl smazán.', 'success');
			} catch(ServiceException $e) {
				$this->showErrors($e);
				$this->redirect('default');
			}
		}

		$this->redirect('default');
	}
}
