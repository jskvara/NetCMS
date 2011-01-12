<?php

class OrderControl extends Control {

	public function createComponentOrderForm($name) {
		$form = new AppForm($this, $name);
		$form->addText('email', 'E-mail:')
			->addRule(Form::EMAIL, 'Zadejte, prosím, platný email.')
			->setDefaultValue('@');
		
		$form->addText('count', 'Počet:')
			->addRule(Form::FILLED, 'Počet nesmí být prázdný.')
			->addRule(Form::NUMERIC, 'Počet musí být číslo.')
			->setDefaultValue(1);
		
		$form->addSubmit('send', 'Objednat');

		$form->onSubmit[] = array($this, 'orderFormSubmitted');
		
		return $form;
	}
	
	public function orderFormSubmitted(AppForm $form) {
		$config = Environment::getConfig('order');
		
		$mail = new Mail();
		$mail->setFrom($form['email']->value);
		$mail->addTo($config->email);
		$mail->setSubject($config->subject);
		$mail->setBody("Počet: ". $form['count']->value);
		$mail->send();
		
		$this->flashMessage($config->submitted, "order");
		$this->getPresenter()->redirect('this');
	}
	
	public function render() {
		$template = parent::createTemplate();
		$templateService = new TemplateService();
		$templateName = $templateService->getTemplateFile('orderControl');
		$template->setFile($templateName);
		
		$template->render();
	}
}

