<?php

class EmailingControl extends Control {
	
	public function createComponentEmailingForm($name) {
		$form = new AppForm($this, $name);
		$form->addText("email", "E-mail:")
			->addRule(Form::EMAIL, "Zadejte, prosím, platný email.")
			->setDefaultValue("@");
		
		$form->addSubmit("send", "Přidat");

		$form->onSubmit[] = array($this, "emailingFormSubmitted");
		
		return $form;
	}
	
	public function emailingFormSubmitted(AppForm $form) {
		$emailingService = new EmailingService();
		$email = $form["email"]->getValue();
		if ($emailingService->exists($email)) {
			$this->flashMessage("Tento e-mail již exstuje.", "error");
		} else {
			$emailingService->add($email);
			$this->flashMessage("E-mail byl přidán.", "success");
		}
		
		$this->getPresenter()->redirect("this");
	}
	
	public function render() {
		// TODO find GET variable
		$removeEmail = $this->getParam("remove-email");
		echo $removeEmail; exit;
		if ($removeEmail) {
			$emailingService = new EmailingService();
			$emailingService->deleteByName($removeEmail);
		}
		
		$template = parent::createTemplate();
		$templateService = new TemplateService();
		$templateName = $templateService->getTemplateFile("emailingControl");
		$template->setFile($templateName);
		$template->render();
	}
}
