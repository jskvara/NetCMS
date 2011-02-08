<?php

final class Admin_EmailingPresenter extends Admin_BasePresenter {

	private $emailingService;
	
	public function __construct() {
		parent::__construct();
		
		$this->emailingService = new EmailingService();
	}

	public function renderDefault() {
		$this->template->emails = $this->emailingService->getEmails();
	}
	
	public function renderSend() {
	}
	
	protected function createComponentSendForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		
		$form->addTextarea("text", "Text:")
			->addRule(Form::FILLED, 'Text nesmí být prázdný.')
			->getControlPrototype()->setClass('largeTextarea');
		
		$form->addSubmit("sendTest", "Poslat testovací")->getControlPrototype()->class("default");
		$form->addSubmit("send", "Poslat všem")->getControlPrototype()->class("default");
		$form->addSubmit("cancel", "Zpět")->setValidationScope(null);
		$form->onSubmit[] = callback($this, "sendFormSubmitted");
		$form->addProtection("Odešlete formulář znovu (bezpečnostní kód vypršel).");
		
		return $form;
	}
	
	public function sendFormSubmitted(AppForm $form)
	{
		if ($form["sendTest"]->isSubmittedBy()) {
			$config = Environment::getConfig("emailing");
			
			$mail = new Mail();
			$mail->setFrom($config->from);
			$mail->addTo($config->to);
			$mail->setSubject($config->subject);
			$mail->setBody($form["text"]->getValue());
			$mail->send();
		
			$this->flashMessage("Testovací e-mail byl odeslán", "success");
			return;
		} else if ($form["send"]->isSubmittedBy()) {
			$config = Environment::getConfig("emailing");
			
			$mail = new Mail();
			$mail->setFrom($config->from);
			// $mail->addTo($config->emailTo); TODO addall
			$mail->setSubject($config->subject);
			$mail->setBody($form["text"]->getValue());
			$mail->send();
		
			$this->flashMessage("E-maily byly odeslány", "success");
		}
		$this->redirect("default");
	}
	
	public function renderAdd() {
	}
	
	protected function createComponentEmailForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		
		$form->addText("email", "Email:")
			->addRule(Form::EMAIL, "Zadejte, prosím, platný email.")
			->setDefaultValue("@");
		
		$form->addSubmit("save", "Přidat")->getControlPrototype()->class("default");
		$form->addSubmit("cancel", "Zpět")->setValidationScope(null);
		$form->onSubmit[] = callback($this, "emailFormSubmitted");
		$form->addProtection("Odešlete formulář znovu (bezpečnostní kód vypršel).");
		
		return $form;
	}

	public function emailFormSubmitted(AppForm $form)
	{
		if ($form["save"]->isSubmittedBy()) {
			$name = $form["email"]->getValue();
			
			try {
				$this->emailingService->add($name);
			} catch(ServiceException $e) {
				$this->showErrors($e);
				return;
			}
			
			$this->flashMessage("Email byl uložen.", "success");
		}

		$this->redirect("default");
	}
	
	public function renderDelete($id = 0) {
		$entity = $this->emailingService->get($id);
		if ($entity == null) {
			$this->flashMessage("E-mail nebyl nalezen.", "error");
			$this->redirect("default");
		}
		
		$this->template->entity = $entity;
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
				$this->emailingService->delete($id);
				$this->flashMessage("E-mail byl smazán.", "success");
			} catch(ServiceException $e) {
				$this->showErrors($e);
			}
		}

		$this->redirect("default");
	}
}
