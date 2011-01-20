<?php

final class Admin_ContactPresenter extends Admin_BasePresenter {

	public function __construct() {
		parent::__construct();
	}

	public function renderDefault() {
	}
	
	protected function createComponentContactForm() {
		$config = Environment::getConfig('admin');
		
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		
		$form->addTextArea('text', 'Text:')
			->addRule(Form::FILLED, 'Text nesmí být prázdný.')
			->getControlPrototype()->setClass('largeTextarea');
		
		$form->addText('email', 'Odpověď poslat na e-mail:')
			->addRule(Form::EMAIL, 'Zadejte, prosím, platný email.')
			->setDefaultValue($config->email)
			->setOption('oneLine', true);
				
		$form->addSubmit('save', 'Odeslat')->getControlPrototype()->class('default');
		$form->addSubmit('cancel', 'Zpět')->setValidationScope(null);
		$form->onSubmit[] = callback($this, 'contactFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}

	public function contactFormSubmitted(AppForm $form)
	{
		if ($form['save']->isSubmittedBy()) {
			$config = Environment::getConfig('admin');
			
			$mail = new Mail();
			$mail->setFrom($form['email']->getValue());
			$mail->addTo($config->adminEmail);
			$mail->setSubject("Administrace webu: ". $config->email);
			$mail->setBody($form['text']->getValue());
			$mail->send();
		
			$this->flashMessage("Text byl odeslán", "success");
		}
		$this->redirect('default');
	}
}
