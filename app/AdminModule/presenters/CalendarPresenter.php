<?php

final class Admin_CalendarPresenter extends Admin_BasePresenter {

	private $calendarService;

	public function __construct() {
		parent::__construct();
		$this->calendarService = new CalendarService();
	}

	public function renderDefault() {
		$this->template->itemsCollection = $this->calendarService->getAllOrderByDate();
	}
	
	public function renderAdd() {
		$this['calendarForm']['save']->caption = 'Přidat';
	}
	
	public function renderEdit($id = 0) {
		$form = $this['calendarForm'];
		if (!$form->isSubmitted()) {
			$item = $this->calendarService->get($id);
			if ($item == null) {
				$this->flashMessage('Záznam nebyl nalezen.', 'error');
				$this->redirect('default');
			}
			
			$values = $item->toArray();
			$values['date'] = $values['date']->format('j. n. Y');
			$form->setDefaults($values);
		}
	}
	
	protected function createComponentCalendarForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		
		$form->addText('date', 'Datum:')
			->setValue(date('j. n. Y'))
			->getControlPrototype()->setClass('datepicker');
			
		$form->addTextarea('text', 'Text:');
		
		$form->addSubmit('save', 'Uložit')->getControlPrototype()->class('default');
		$form->addSubmit('cancel', 'Zpět')->setValidationScope(null);
		$form->onSubmit[] = callback($this, 'calendarFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}

	public function calendarFormSubmitted(AppForm $form)
	{
		if ($form['save']->isSubmittedBy()) {
			$id = (int) $this->getParam('id');
			$date = $form['date']->getValue();
			$text = $form['text']->getValue();
			
			if ($id > 0) {
				try {
					$this->calendarService->edit($id, $date, $text);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage('Záznam byl upraven.', 'success');
			} else {
				try {
					$this->calendarService->add($date, $text);
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
		$item = $this->calendarService->get($id);
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
				$this->calendarService->delete($id);
				$this->flashMessage('Záznam byl smazán.', 'success');
			} catch(ServiceException $e) {
				$this->showErrors($e);
				$this->redirect('default');
			}
		}

		$this->redirect('default');
	}
}
