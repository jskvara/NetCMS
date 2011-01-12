<?php

final class Admin_AuthPresenter extends Admin_BasePresenter {

	/** @persistent */
	public $backlink = '';
	
	protected function createComponentLoginForm($name) {
		$form = new AppForm($this, $name);
		$form->addText('login', 'Email:')
			->addRule(Form::EMAIL, 'Prosím zadejte email.');

		$form->addPassword('password', 'Heslo:')
			->addRule(Form::FILLED, 'Prosím zadajte heslo.');

		$form->addProtection('Prosím odešlete přihlašovací údaje znova (vypršela platnost tzv. bezpečnostního tokenu).');
		$form->addSubmit('send', 'Přihlásit');

		$form->onSubmit[] = array($this, 'loginFormSubmitted');
	}

	public function loginFormSubmitted($form) {
		try {
			$user = Environment::getUser();
			$user->login($form['login']->value, $form['password']->value);
			$this->getApplication()->restoreRequest($this->backlink);
			
			$this->redirect('Default:default');
		} catch (AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}
	
	public function actionLogout() {
		Environment::getUser()->logout();
		$this->flashMessage('Právě jste se odlásili z administrace.');
		$this->redirect('Auth:login');
	}
}
