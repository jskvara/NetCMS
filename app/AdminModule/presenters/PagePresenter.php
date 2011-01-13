<?php

final class Admin_PagePresenter extends Admin_BasePresenter {

	private $pageService;
	private $templateService;

	public function __construct() {
		parent::__construct();
		
		$this->pageService = new PageService();
		$this->templateService = new TemplateService();
	}

	public function renderDefault() {
		$this->template->maxPosition = $this->pageService->getMaxPosition();
		$this->template->pages = $this->pageService->getAll();
	}
	
	public function renderAdd() {
		$this['pageForm']['save']->caption = 'Přidat';
		$this->addParentUrl($this->getParam('parentUrl'));
	}
	
	public function renderEdit($id = 0) {
		$form = $this['pageForm'];
		if (!$form->isSubmitted()) {
			$page = $this->pageService->get($id);
			if ($page == null) {
				$this->flashMessage('Stránka nebyla nalezena.', 'error');
				$this->redirect('default');
			}
			
			$values = $page->toArray();
			$form->setDefaults($values);
			$parentUrl = UrlUtil::getParentUrl($values['url']);
			$this->addParentUrl($parentUrl);
			$this->template->page = $page;
		}
	}
	
	protected function createComponentPageForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		
		$form->addText('name', 'Adresa:')
			->addRule(Form::REGEXP, 'Název smí obsahovat pouze: písmena, číslice, "." a "-". Nahraďte mezery pomlčkou', '/^[a-z0-9-.]*$/')
			->addRule(Form::MAX_LENGTH, 'Adresa smí mít maximálně %d znaků', 255)
			->setOption('predescription', '/');
		
		$form->addCheckbox('visible', 'Zobrazit')
			->setValue(true);
		
		
		$templates = $this->templateService->getSelect();
		$form->addSelect('template', 'Šablona', $templates)->setDefaultValue('default');
		
		$pages = $this->pageService->getSelect();
		$form->addSelect('positionUrl', 'Zařadit za:', $pages);
		
		$form->addHidden('parentUrl')->setValue('');
		
		$form->addSubmit('save', 'Uložit')->getControlPrototype()->class('default');
		$form->addSubmit('cancel', 'Zpět')->setValidationScope(null);
		$form->onSubmit[] = callback($this, 'pageFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}
	
	protected function addParentUrl($parentUrl) {
		if ($parentUrl !== null) {
			$parentUrl = trim($parentUrl, '/');
			if ($parentUrl !== '') {
				$this['pageForm']['parentUrl']->setValue($parentUrl);
				$this['pageForm']['name']->setOption('predescription', '/'. $parentUrl .'/');
			}
		}
	}

	public function pageFormSubmitted(AppForm $form)
	{
		if ($form['save']->isSubmittedBy()) {
			$id = (int) $this->getParam('id');
			$name = $form['name']->getValue();
			$parentUrl = $form['parentUrl']->getValue();
			$visible = $form['visible']->getValue();
			$template = $form['template']->getValue();
			$positionUrl = $form['positionUrl']->getValue();
			
			if ($id > 0) {
				try {
					$this->pageService->edit($id, $name, $parentUrl, $visible, $template);
					if ($positionUrl !== "") {
						$pageUrl = UrlUtil::createUrl($parentUrl, $name);
						$this->pageService->move($pageUrl, $positionUrl);
					}
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$link = $this->link('edit', $id);
				$this->flashMessage("<a href=\"".$link."\">Stránka</a> byla upravena.", "success");
			} else {
				try {
					$this->pageService->add($name, $parentUrl, $visible, $template);
					if ($positionUrl !== "") {
						$pageUrl = UrlUtil::createUrl($parentUrl, $name);
						$this->pageService->move($pageUrl, $positionUrl);
					}
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage('Stránka byla uložena.', 'success');
			}
		}

		$this->redirect('default');
	}
	
	public function renderEditContent($id = 0) {
		$form = $this['pageContentForm'];
		if (!$form->isSubmitted()) {
			$page = $this->pageService->get($id);
			if ($page == null) {
				$this->flashMessage('Stránka nebyla nalezena.', 'error');
				$this->redirect('default');
			}
			
			$values = $page->toArray();
			$form->setDefaults($values);
		}
	}
	
	protected function createComponentPageContentForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		$form->addText('title', 'Titulek:')
			->addRule(Form::MAX_LENGTH, 'Titulek smí mít maximálně %d znaků', 255);
		
		$form->addTextarea('content', 'Obsah:')
			->setHtmlId('pageContent');
		
		$form->addSubmit('save', 'Uložit')->getControlPrototype()->class('default');
		$form->addSubmit('cancel', 'Zpět')->setValidationScope(null);
		$form->onSubmit[] = callback($this, 'pageContentFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}

	public function pageContentFormSubmitted(AppForm $form)
	{
		if ($form['save']->isSubmittedBy()) {
			$id = (int) $this->getParam('id');
			$title = $form['title']->getValue();
			$content = $form['content']->getValue();
			
			if ($id > 0) {
				try {
					$this->pageService->editContent($id, $title, $content);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage('Stránka byla upravena.', 'success');
			} else {
				$this->flashMessage('Stránka nebyla nalezena', 'error');
			}
		}
		
		$this->redirect('default');
	}
	
	public function renderDelete($id = 0) {
		$page = $this->pageService->get($id);
		if ($page == null) {
			$this->flashMessage('Stránka nebyla nalezena.', 'error');
			$this->redirect('default');
		}
		
		$this->template->page = $page;
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
				$this->pageService->delete($id);
				$this->flashMessage('Stránka byla smazána.', 'success');
			} catch(ServiceException $e) {
				$this->showErrors($e);
				$this->redirect('default');
			}
			
		}

		$this->redirect('default');
	}
	
	public function actionMoveUp($id) {
		try {
			$this->pageService->moveUp($id);
		} catch (ServiceException $e) {
			$this->flashMessage($e->getMessage(), 'error');
		}
		
		$this->redirect('default');
	}
	
	public function actionMoveDown($id) {
		try {
			$this->pageService->moveDown($id);
		} catch (ServiceException $e) {
			$this->flashMessage($e->getMessage(), 'error');
		}
		
		$this->redirect('default');
	}
}
