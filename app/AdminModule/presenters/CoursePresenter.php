<?php

final class Admin_CoursePresenter extends Admin_BasePresenter {

	protected $courseService;
	
	protected $courseTimeService;

	public function __construct() {
		parent::__construct();
		$this->courseService = new CourseService();
		$this->courseTimeService = new CourseTimeService();
	}

	public function renderDefault() {
		$this->template->items = $this->courseService->getAll();
	}
	
	public function renderAdd() {
		$this['form']['save']->caption = "Přidat";
	}
	
	public function renderEdit($id = 0) {
		$form = $this['form'];
		if (!$form->isSubmitted()) {
			$item = $this->courseService->get($id);
			if ($item == NULL) {
				$this->flashMessage("Položka nebyla nalezena.", "error");
				$this->redirect("default");
			}
			
			$values = $item->toArray();
			$form->setDefaults($values);
		}
	}
	
	protected function createComponentForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		
		$form->addText("name", "Název:");
				
		$form->addSubmit("save", "Uložit")->getControlPrototype()->class("default");
		$form->addSubmit("cancel", "Zpět")->setValidationScope(NULL);
		$form->onSubmit[] = callback($this, "formSubmitted");
		$form->addProtection("Odešlete formulář znovu (bezpečnostní kód vypršel).");
		
		return $form;
	}

	public function formSubmitted(AppForm $form)
	{
		if ($form["save"]->isSubmittedBy()) {
			$id = (int) $this->getParam("id");
			$name = $form["name"]->getValue();
			
			if ($id > 0) {
				try {
					$this->courseService->edit($id, $name);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage("Položka byla upravena.", "success");
			} else {
				try {
					$this->courseService->add($name);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage("Položka byla uložena.", "success");
			}
		}

		$this->redirect("default");
	}
	
	public function renderDelete($id = 0) {
		$item = $this->courseService->get($id);
		if ($item == NULL) {
			$this->flashMessage("Položka nebyla nalezena.", "error");
			$this->redirect("default");
		}
		
		$this->template->item = $item;
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
			$id = (int) $this->getParam("id");
			
			try {
				$this->courseService->delete($id);
				$this->flashMessage("Položka byla smazána.", "success");
			} catch(ServiceException $e) {
				$this->showErrors($e);
				return;
			}
		}

		$this->redirect("default");
	}
	
	public function renderTimes($id = 0) {
		$course = $this->courseService->get($id);
		if ($course === FALSE) {
			$this->flashMessage("Kurz nebyl nalezen.", "error");
			$this->redirect("default");
		}
		$this->template->course = $course;
		
		$times = $this->courseTimeService->getAll($id);
		foreach ($times as $key => $time) {
			$times[$key] = new CourseTimeDTO($time);
		}
		$this->template->items = $times;
	}
	
	public function renderAddTime($id = NULL) {
		if ($id === NULL) {
			$this->flashMessage("Kurz nebyl nalezen.", "error");
			$this->redirect("default");
		}
		$this['timeForm']['courseId']->setValue($id);
		$this['timeForm']['save']->caption = "Přidat";
	}
	
	public function renderEditTime($id = 0) {
		$form = $this['timeForm'];
		if (!$form->isSubmitted()) {
			$item = $this->courseTimeService->get($id);
			if ($item == NULL) {
				$this->flashMessage("Položka nebyla nalezena.", "error");
				$this->redirect("default");
			}
			
			$values = $item->toArray();
			$form->setDefaults($values);
		}
	}
	
	protected function createComponentTimeForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		
		$form->addText('date', 'Datum:')
			->setValue(date("j. n. Y"))
			->getControlPrototype()->setClass("datepicker");
		
		$form->addHidden('courseId', 0);
		$form->addHidden("id", 0);
		
		$form->addSubmit("save", "Uložit")->getControlPrototype()->class("default");
		$form->addSubmit("cancel", "Zpět")->setValidationScope(NULL);
		$form->onSubmit[] = callback($this, "timeformSubmitted");
		$form->addProtection("Odešlete formulář znovu (bezpečnostní kód vypršel).");
		
		return $form;
	}

	public function timeFormSubmitted(AppForm $form)
	{
		if ($form["save"]->isSubmittedBy()) {
			//$id = (int) $this->getParam("id");
			$id = $form["id"]->getValue();
			$date = $form["date"]->getValue();
			$courseId = $form["courseId"]->getValue();
			
			if ($id > 0) {
				try {
					$this->courseTimeService->edit($id, $courseId, $date);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage("Položka byla upravena.", "success");
			} else {
				try {
					$this->courseTimeService->add($courseId, $date);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage("Položka byla uložena.", "success");
			}
		}
		
		if (!isset($courseId)) {
			$this->flashMessage("Položka nebyla nalezena.", "error");
			$this->redirect("default");
		}
		$this->redirect("times", array("id" => $courseId));
	}
	
	public function renderDeleteTime($id = 0) {
		$item = $this->courseService->get($id);
		if ($item == NULL) {
			$this->flashMessage("Položka nebyla nalezena.", "error");
			$this->redirect("default");
		}
		
		$this->template->item = $item;
	}
	
	protected function createComponentDeleteTimeForm() {
		$form = new AppForm();
		$form->addSubmit("delete", "Smazat")->getControlPrototype()->class("default");
		$form->addSubmit("cancel", "Zpět");
		$form->onSubmit[] = callback($this, "deleteTimeFormSubmitted");
		$form->addProtection("Odešlete formulář znovu (bezpečnostní kód vypršel).");
		
		return $form;
	}
	
	public function deleteTimeFormSubmitted(AppForm $form) {
		if ($form["delete"]->isSubmittedBy()) {
			$id = (int) $this->getParam("id");
			
			try {
				$this->courseService->delete($id);
				$this->flashMessage("Položka byla smazána.", "success");
			} catch(ServiceException $e) {
				$this->showErrors($e);
				return;
			}
		}

		$this->redirect("default");
	}
}
