<?php

final class Admin_NewsPresenter extends Admin_BasePresenter {

	private $newsService;

	public function __construct() {
		parent::__construct();
		
		$this->newsService = new NewsService();
	}

	public function renderDefault() {
		$newsCollection = $this->newsService->getAll();
		
		$items = array();
		foreach ($newsCollection as $news) {
			$items[] = new NewsDTO($news);
		}
		
		$this->template->items = $items;
	}
	
	public function actionPdf($id = 0) {
		$news = $this->newsService->get($id);
		if ($news == null) {
			$this->flashMessage('Novinka nebyla nalezena.', 'error');
			$this->redirect('default');
		}
		
		$template = $this->createTemplate()->setFile(APP_DIR ."/templates/newsPdf.phtml");
		$template->item = new NewsDTO($news);
		
		$pdf = new PDFResponse($template);
		$pdf->documentTitle = $news->getTitle();
		$pdf->outputName = WWW_DIR ."/userfiles/pdf/". String::webalize($pdf->documentTitle).".pdf";
		$pdf->outputDestination = PDFResponse::OUTPUT_FILE;
		$pdf->send();
		
		$this->flashMessage('PDF bylo vygenerováno.', 'success');

		$this->redirect('default');
	}
	
	public function renderAdd() {
		$this['newsForm']['save']->caption = 'Přidat';
	}
	
	public function renderEdit($id = 0) {
		$form = $this['newsForm'];
		if (!$form->isSubmitted()) {
			$news = $this->newsService->get($id);
			if ($news == null) {
				$this->flashMessage('Novinka nebyla nalezena.', 'error');
				$this->redirect('default');
			}
			
			$values = $news->toArray();
			if (is_object($values['created'])) {
				$values['created'] = $values['created']->format('j. n. Y');
			} else {
				$values['created'] = date("j. n. Y", $values['created']);
			}
			$form->setDefaults($values);
		}
	}
	
	protected function createComponentNewsForm() {
		$form = new AppForm();
		$form->setRenderer(new ExtendedRenderer());
		$form->addText('title', 'Nadpis:')
			->addRule(Form::FILLED, 'Musíte vyplnit nadpis novinky.');

		$form->addTextarea('text', 'Text:')
			->setHtmlId('pageContent');
		
		$form->addText('created', 'Vytvořeno:')
			->setValue(date('j. n. Y'))
			->getControlPrototype()->setClass('datepicker');
		
		$form->addCheckbox('visible', 'Zobrazit')
			->setValue(true);
		
		$form->addSubmit('save', 'Uložit')->getControlPrototype()->class('default');
		$form->addSubmit('cancel', 'Zpět')->setValidationScope(null);
		$form->onSubmit[] = callback($this, 'newsFormSubmitted');
		$form->addProtection('Odešlete formulář znovu (bezpečnostní kód vypršel).');
		
		return $form;
	}

	public function newsFormSubmitted(AppForm $form)
	{
		if ($form['save']->isSubmittedBy()) {
			$id = (int) $this->getParam('id');
			$title = $form['title']->getValue();
			$text = $form['text']->getValue();
			$created = $form['created']->getValue();
			$visible = $form['visible']->getValue();
			
			if ($id > 0) {
				try {
					$this->newsService->edit($id, $title, $text, $created, $visible);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage('Novinka byla upravena.', 'success');
			} else {
				try {
					$this->newsService->add($title, $text, $created, $visible);
				} catch(ServiceException $e) {
					$this->showErrors($e);
					return;
				}
				
				$this->flashMessage('Novinka byla uložena.', 'success');
			}
		}

		$this->redirect('default');
	}
	
	public function renderDelete($id = 0) {
		$news = $this->newsService->get($id);
		if ($news == null) {
			$this->flashMessage('Novinka nebyla nalezena.', 'error');
			$this->redirect('default');
		}
		
		$this->template->news = $news;
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
				$this->newsService->delete($id);
				$this->flashMessage('Novinka byla smazána.', 'success');
			} catch(ServiceException $e) {
				$this->showErrors($e);
				$this->redirect('default');
			}
		}

		$this->redirect('default');
	}
}
