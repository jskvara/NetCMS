<?php

class PageService {
	
	protected $DAO;
	protected $converter;
	protected $validator;
	
	public function __construct() {
		$this->DAO = new PageDAO();
		$this->converter = new PageConverter();
		$this->validator = new PageValidator();
		$this->validator->setDAO($this->DAO);
	}
	
	public function getAll() {
		return $this->DAO->findAll();
	}
	
	public function getMenu() {
		return $this->DAO->findMenu();
	}
	
	public function getSelect() {
		$pages = $this->DAO->findMenu();
		$select = array();
		foreach ($pages as $key => $page) {
			$url = $page->getUrl();
			$select[$url] = $url;
		}
		
		return $select;
	}
	
	public function get($id) {
		return $this->DAO->find($id);
	}
	
	public function getByUrl($url) {
		return $this->DAO->findByUrl($url);
	}
	
	public function add($name, $parentUrl, $visible, $template) {
		try {
			$position = $this->DAO->getMaxPosition();
			if ($position == null) {
				$position = 1;
			} else {
				$position = $position + 1;
			}
			$page = $this->converter->toEntity(null, $name, $parentUrl, null, null, $visible, $position, $template);
			$this->validator->validateAdd($page);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->DAO->insert($page);
		
		return true;
	}
	
	public function edit($id, $name, $parentUrl, $visible, $template) {
		$this->validateId($id);
		
		try {
			$page = $this->converter->toEntity($id, $name, $parentUrl, null, null, $visible, null, $template);
			$this->validator->validate($page);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->DAO->update($page);
		
		return true;
	}
	
	public function editContent($id, $title, $content) {
		$this->validateId($id);
		
		try {
			$page = $this->converter->toEntity($id, null, null, $title, $content, null, null, null);
			$this->validator->validatePageContent($page);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->DAO->update($page);
		
		return true;
	}
	
	public function moveUp($id) {
		$this->validateId($id);
		
		$page = $this->DAO->find($id);
		if ($page === null) {
			throw new ServiceException('Stránka neexistuje.');
		}
		
		$position = $page->getPosition();
		if ($position < 2) {
			throw new ServiceException('Stránku nelze posunout.');
		}
		
		$this->DAO->swapPosition($position - 1, $position);
	}
	
	public function moveDown($id) {
		$this->validateId($id);
		
		$page = $this->DAO->find($id);
		if ($page === null) {
			throw new ServiceException('Stránka neexistuje.');
		}
		
		$position = $page->getPosition();
		$maxPosition = $this->DAO->getMaxPosition();
		if ($position > ($maxPosition - 1)) {
			throw new ServiceException('Stránku nelze posunout.');
		}
		
		$this->DAO->swapPosition($position, $position + 1);
	}
	
	public function getMaxPosition() {
		return $this->DAO->getMaxPosition();
	}
	
	public function delete($id) {
		if (empty($id) || $id < 0) {
			throw new ServiceException('Id stránky nesmí být prázdné.');
		}
		
		$this->DAO->delete($id);
	}
	
	protected function validateId($id) {
		if ($this->validator->validateId($id) !== true) {
			throw new ServiceException($this->validator->getLastError());
		}
	}
}

