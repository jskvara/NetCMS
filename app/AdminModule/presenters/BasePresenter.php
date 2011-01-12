<?php

abstract class Admin_BasePresenter extends BasePresenter {
	
	public function startup() {
	
		if ($this->presenter->getRequest()->getPresenterName() !== 'Admin:Auth') {
			// user authentication
			$user = Environment::getUser();
			if (!$user->isLoggedIn()) {
				if ($user->getLogoutReason() === User::INACTIVITY) {
					$this->flashMessage('Uplynula doba neaktivity! Systém vás z bezpečnostních důvodů odhlásil.', 'error');
				}
	
				$backlink = $this->getApplication()->storeRequest();
				$this->redirect('Auth:login', array('backlink' => $backlink));
			}
			/* // acl - access control list
			else {
				if (!$user->isAllowed($this->reflection->name, $this->getAction())) {
					$this->flashMessage('Na vstup do této sekce nemáte dostatečné oprávnění!', 'error');
					$this->redirect('Auth:login');
				}
			}*/
		}
		
		parent::startup();
	}

	protected function beforeRender() {
		$user = Environment::getUser();
		$this->template->user = ($user->isLoggedIn()) ? $user->getIdentity() : NULL;
		$this->template->newsService = new NewsService();
	}
	
	protected function showErrors(Exception $e) {
		if ($e->getValidationErrors() !== null) {
			foreach ($e->getValidationErrors() as $error) {
				$this->flashMessage($error, 'error');
			}
		} else {
			$this->flashMessage($e->getMessage());
		}
	}
	
}

