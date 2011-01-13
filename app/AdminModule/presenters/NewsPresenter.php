<?php

final class Admin_NewsPresenter extends Admin_BasePresenter {

	private $newsService;

	public function __construct() {
		parent::__construct();
		
		$this->newsService = new NewsService();
	}

	public function renderDefault() {
		$this->template->newsCollection = $this->newsService->getAll();
	}
	
	public function renderAdd() {
		$this['newsForm']['save']->caption = 'Přidat';
	}
	
	public function renderEdit($id = 0) {
		$form = $this['newsForm'];
		if (!$form->isSubmitted()) {
			$news = $this->newsService->get($id);
			if ($news == null) {
				$this->flashMessage('Novinka nebyla nalezena.', 'error');
				$this->redirect('default');
			}
			
			$values = $news->toArray();
			$values['created'] = $values['created']->format('j. n. Y');
			$form->setDefaults($values);
		}
	}
	
	protected function createComponentNewsForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		$form->addText('title', 'Nadpis:')
			->addRule(Form::FILLED, 'Musíte vyplnit nadpis novinky.');

		$form->addTextarea('text', 'Text:');
		
		$form->addText('created', 'Vytvořeno:')
			->setValue(date('j. n. Y'));
		
		$form->addCheckbox('visible', 'Zobrazit')
			->setValue(true);
		
		$form->addSubmit('save', 'Uložit')->getControlPrototype()->class('default');
		$form->addSubmit('cancel', 'Zpět')->setValidationScope(null);
		$form->onSubmit[] = callback($this, 'newsFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}

	public function newsFormSubmitted(AppForm $form)
	{
		if ($form['save']->isSubmittedBy()) {
			$id = (int) $this->getParam('id');
			$title = $form['title']->getValue();
			$text = $form['text']->getValue();
			$created = $form['created']->getValue();
			$visible = $form['visible']->getValue();
			
			if ($id > 0) {
				try {
					$this->newsService->edit($id, $title, $text, $created, $visible);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage('Novinka byla upravena.', 'success');
			} else {
				try {
					$this->newsService->add($title, $text, $created, $visible);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage('Novinka byla uložena.', 'success');
			}
		}

		$this->redirect('default');
	}
	
	public function renderDelete($id = 0) {
		$news = $this->newsService->get($id);
		if ($news == null) {
			$this->flashMessage('Novinka nebyla nalezena.', 'error');
			$this->redirect('default');
		}
		
		$this->template->news = $news;
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
				$this->newsService->delete($id);
				$this->flashMessage('Novinka byla smazána.', 'success');
			} catch(ServiceException $e) {
				$this->showErrors($e);
				$this->redirect('default');
			}
		}

		$this->redirect('default');
	}
}