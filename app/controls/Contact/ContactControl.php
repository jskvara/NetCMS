<?php

class ContactControl extends Control {

	public function createComponentContactForm($name) {
		$form = new AppForm($this, $name);
		$form->addText('email', 'E-mail:')
			->addRule(Form::EMAIL, 'Zadejte, prosím, platný email.')
			->setDefaultValue('@');
		
		$form->addTextArea('text', 'Text:')
			->addRule(Form::FILLED, 'Text nesmí být prázdný.');
		
		$form->addSubmit('send', 'Odeslat');

		$form->onSubmit[] = array($this, 'contactFormSubmitted');
		
		return $form;
	}
	
	public function contactFormSubmitted(AppForm $form) {
		$config = Environment::getConfig('contact');
		
		$mail = new Mail();
		$mail->setFrom($form['email']->value);
		$mail->addTo($config->email);
		$mail->setSubject($config->subject);
		$mail->setBody($form['text']->value);
		$mail->send();
		
		$this->flashMessage($config->submitted, "contact");
		$this->getPresenter()->redirect('this');
	}
	
	public function render() {
		$template = parent::createTemplate();
		$templateService = new TemplateService();
		$templateName = $templateService->getTemplateFile('contactControl');
		$template->setFile($templateName);
		
		$template->render();
	}
}

