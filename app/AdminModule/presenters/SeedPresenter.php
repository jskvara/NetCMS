<?php

final class Admin_SeedPresenter extends Admin_BasePresenter {

	private $seedService;
	
	public function __construct() {
		parent::__construct();
		
		$this->seedService = new SeedService();
	}

	public function renderDefault() {
		$this->template->seeds = $this->seedService->getSeeds();
	}
	
	public function renderView($id = 0) {
		if ($id === 0) {
			$this->flashMessage("Teto typ osiva neexistuje.", "error");
			$this->redirect("default");
		}
		$this->template->seed = $this->seedService->get($id);
		$seedItems = $this->seedService->getSeedItems($id);
		/*$seedItemForms = array();
		foreach ($seedItems as $key => $value) {
			$form = $this->createComponentSeedItemEditForm("seedItemEditForm".$key);
			$form->setDefaults($value->toArray());
			$seedItemForms[$key] = $form;
		}*/
		$this->template->seedItems = $seedItems;
		//$this->template->seedItemForms = $seedItemForms;
		$this->template->maxPosition = $this->seedService->getMaxPosition($id);
		$this->template->registerHelper("strip_tags", "strip_tags");
	}
	
	public function renderAddSeedItem($id = null) {
		if ($id === null) {
			$this->flashMessage("Vybrerte osivo.", "error");
			$this->redirect("default");
		}
		$this['seedItemForm']['seedId']->setValue($id);
		$this['seedItemForm']['save']->caption = 'Přidat';
	}
	
	public function renderEditSeedItem($id = 0) {
		$form = $this['seedItemForm'];
		if (!$form->isSubmitted()) {
			$seedItem = $this->seedService->getSeedItem($id);
			if ($seedItem == null) {
				$this->flashMessage('Typ osiva nebyl nalezen.', 'error');
				$this->redirect('default');
			}
			
			$defaults = $seedItem->toArray();
			for ($i = 1; $i <= 52; $i++) {
				if ($defaults["w".$i] & 1) {
					$defaults["w".$i."v"] = true;
				}
				if ($defaults["w".$i] & 2) {
					$defaults["w".$i."s"] = true;
				}
			}
			$form->setDefaults($defaults);
		}
	}
	
	protected function createComponentSeedItemForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		
		$form->addText('name', 'Název:')
			->addRule(Form::MAX_LENGTH, 'Název osiva smí mít maximálně %d znaků', 255);
		
		$form->addText('resistence', 'Rezistence:')
			->addRule(Form::MAX_LENGTH, 'Rezistence smí mít maximálně %d znaků', 255);
		
		for ($i = 1; $i <= 52; $i++) {
			$form->addCheckbox("w".$i."v", "Týden ".$i." výs:");
			$form->addCheckbox("w".$i."s", "Týden ".$i." skl:");
		}
		
		$form->addHidden('seedId', 0);
		$form->addHidden("id", 0);
		
		$form->addSubmit('save', 'Uložit')->getControlPrototype()->class('default');
		$form->addSubmit('cancel', 'Zpět')->setValidationScope(null);
		$form->onSubmit[] = callback($this, 'seedItemFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}
	
	/*protected function createComponentSeedItemEditForm($name) {
		$form = new AppForm($this, $name);
		
		$form->addText('name', 'Název:')
			->addRule(Form::MAX_LENGTH, 'Název osiva smí mít maximálně %d znaků', 255);
		
		$form->addText('resistence', 'Rezistence:')
			->addRule(Form::MAX_LENGTH, 'Rezistence smí mít maximálně %d znaků', 255);
		
		$form->addHidden('id', 0);
		
		$form->addSubmit('save', 'Uložit')->getControlPrototype()->class('default');
		$form->onSubmit[] = callback($this, 'seedItemEditFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}
	
	public function seedItemEditFormSubmitted(AppForm $form)
	{
		dump($form->getValues());exit;
		$seedId = (int) $this->getParam("id");
		echo $seedId;exit;
		if ($form["save"]->isSubmittedBy()) {
			$id = $form["id"]->getValue();
			$name = $form["name"]->getValue();
			$resistence = $form["resistence"]->getValue();
			
			echo $id ." ". $seedId;exit;
			try {
				//$this->seedService->edit($id, $name, $resistence);
			} catch(ServiceException $e) {
				$this->showErrors($e);
				return;
			}
			
			$this->flashMessage("Typ osiva byl upraven.", "success");
		}
		
		//$this->redirect("view", array("id" => $seedId));
	}*/
	
	public function seedItemFormSubmitted(AppForm $form)
	{
		$seedId = $form["seedId"]->getValue();
		if ($form["save"]->isSubmittedBy()) {
			$name = $form["name"]->getValue();
			$resistence = $form["resistence"]->getValue();
			$id = $form["id"]->getValue();
			$weeks = array();
			for ($i = 1; $i <= 52; $i++) {
				$weeks[$i] = $form["w".$i."v"]->getValue() ^ (2 * $form["w".$i."s"]->getValue());
			}
			
			if ($id > 0) {
				try {
					$this->seedService->editSeedItem($id, $seedId, $name, $resistence, $weeks);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
			} else {
				try {
					$id = $this->seedService->addSeedItem($seedId, $name, $resistence, $weeks);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
			}
			$this->flashMessage("Typ osiva byl uložen.", 'success');
		}
		$this->redirect("view", array("id" => $seedId));
	}
	
	public function renderAdd() {
		$this['seedForm']['save']->caption = 'Přidat';
	}
	
	public function renderEdit($id = 0) {
		$form = $this['seedForm'];
		if (!$form->isSubmitted()) {
			$page = $this->seedService->get($id);
			if ($page == null) {
				$this->flashMessage('Osivo nebylo nalezeno.', 'error');
				$this->redirect('default');
			}
			
			$values = $page->toArray();
			$form->setDefaults($values);
		}
	}
	
	protected function createComponentSeedForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		
		$form->addText('name', 'Název osiva:')
			->addRule(Form::MAX_LENGTH, 'Název osiva smí mít maximálně %d znaků', 255);
		
		$form->addText("description", "Popis:")
			->addRule(Form::MAX_LENGTH, "Popis osiva smí mít maximálně %d znaků", 255);
		
		$form->addText('harvest', 'Sklizeň:')
			->addRule(Form::MAX_LENGTH, 'Sklizeň smí mít maximálně %d znaků', 255);
		
		$form->addTextarea('text', 'Text:')
			->setHtmlId('pageContent');
		
		$form->addSubmit('save', 'Uložit')->getControlPrototype()->class('default');
		$form->addSubmit('cancel', 'Zpět')->setValidationScope(null);
		$form->onSubmit[] = callback($this, 'seedFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}

	public function seedFormSubmitted(AppForm $form)
	{
		if ($form['save']->isSubmittedBy()) {
			$id = (int) $this->getParam('id');
			$name = $form['name']->getValue();
			$harvest = $form["harvest"]->getValue();
			$text = $form["text"]->getValue();
			$description = $form["description"]->getValue();
			
			if ($id > 0) {
				try {
					$this->seedService->edit($id, $name, $description, $harvest, $text);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$link = $this->link('edit', $id);
				$this->flashMessage("<a href=\"".$link."\">Osivo</a> bylo upraveno.", "success");
			} else {
				try {
					$id = $this->seedService->add($name, $description, $harvest, $text);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$link = $this->link('edit', $id);
				$this->flashMessage("<a href=\"".$link."\">Osivo</a> bylo uloženo.", 'success');
			}
		}

		$this->redirect('default');
	}
	
	public function renderDelete($id = 0) {
		$seed = $this->seedService->get($id);
		if ($seed == null) {
			$this->flashMessage('Osivo nebylo nalezeno.', 'error');
			$this->redirect('default');
		}
		
		$this->template->seed = $seed;
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
				$this->seedService->delete($id);
				$this->flashMessage('Osivo bylo smazáno.', 'success');
			} catch(ServiceException $e) {
				$this->showErrors($e);
				$this->redirect('default');
			}
			
		}

		$this->redirect('default');
	}
	
	public function renderDeleteSeedItem($id = 0) {
		$seed = $this->seedService->getSeedItem($id);
		if ($seed == null) {
			$this->flashMessage('Osivo nebylo nalezeno.', 'error');
			$this->redirect('default');
		}
		
		$this->template->seed = $seed;
	}
	
	protected function createComponentDeleteItemForm() {
		$form = new AppForm();
		$seedId = (int) $this->getParam("seedId");
		$form->addHidden("seedId", $seedId);
		$form->addSubmit("delete", "Smazat")->getControlPrototype()->class("default");
		$form->addSubmit("cancel", "Zpět");
		$form->onSubmit[] = callback($this, "deleteItemFormSubmitted");
		$form->addProtection("Odešlete formulář znovu (bezpečnostní kód vypršel).");
		
		return $form;
	}
	
	public function deleteItemFormSubmitted(AppForm $form) {
		$seedId = $form["seedId"]->getValue("seedId");
		if ($form["delete"]->isSubmittedBy()) {
			$id = (int) $this->getParam("id");
			
			try {
				$this->seedService->deleteSeedItem($id, $seedId);
				$this->flashMessage("Typ osiva byl smazán.", "success");
			} catch(ServiceException $e) {
				$this->showErrors($e);
			}
			
		}
		
		$this->redirect("view", array("id" => $seedId));
	}
	
	public function actionMoveUp($id, $seedId) {
		try {
			$this->seedService->moveUp($id, $seedId);
		} catch (ServiceException $e) {
			$this->flashMessage($e->getMessage(), "error");
		}
		
		$this->redirect("view", array("id" => $seedId));
	}
	
	public function actionMoveDown($id, $seedId) {
		try {
			$this->seedService->moveDown($id, $seedId);
		} catch (ServiceException $e) {
			$this->flashMessage($e->getMessage(), "error");
		}
		
		$this->redirect("view", array("id" => $seedId));
	}
}
