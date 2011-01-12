<?php

class PageValidator implements IValidator {
	
	protected $errors = array();
	protected $DAO;
	
	public function setDAO(IDAO $DAO) {
		$this->DAO = $DAO;
	}
	
	public function validate(IEntity $entity) {
		$this->errors = array();
		
		$this->validateId($entity->getId());
		$this->validateName($entity->getName());
		$this->validateUrl($entity->getUrl());
		$this->validateTitle($entity->getTitle());
		$this->validateContent($entity->getContent());
		$this->validateVisible($entity->getVisible());
		$this->validatePosition($entity->getPosition());
		$this->validateTemplate($entity->getTemplate());
		$this->validateParentUrl($entity->getParentUrl());
		
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	public function validateAdd(IEntity $entity) {
		$this->errors = array();
		
		$this->validateNameAdd($entity->getName());
		$this->validateUrl($entity->getUrl());
		$this->validateVisible($entity->getVisible());
		$this->validatePosition($entity->getPosition());
		$this->validateTemplate($entity->getTemplate());
		$this->validateParentUrl($entity->getParentUrl());
		
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	public function validatePageContent(IEntity $entity) {
		$this->errors = array();
		
		$this->validateId($entity->getId());
		$this->validateTitle($entity->getTitle());
		$this->validateContent($entity->getContent());
		
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	public function validateId($id) {
		if (empty($id) || $id < 0) {
			$this->errors[] = 'Id stránky nesmí být prázdné.';
		}
		
		return true;
	}
	
	protected function validateName($name) {
		if (mb_strlen($name) > 255) {
			$this->errors[] = "Adresa stránky nesmí být delší než 255 znaků.";
		}
		
		if (!preg_match('/^[a-z0-9-.]*$/', $name)) {
			$this->errors[] = "Adresa stránky smí obsahovat jen znaky: a-z, 0-9, \".\" a \"-\".";
		}
		
		return true;
	}
	
	protected function validateNameAdd($name) {
		if (mb_strlen($name) > 255) {
			$this->errors[] = "Adresa stránky nesmí být delší než 255 znaků.";
		}
		
		if (!preg_match('/^[a-z0-9-.]*$/', $name)) {
			$this->errors[] = "Adresa stránky smí obsahovat jen znaky: a-z, 0-9, \".\" a \"-\".";
		}
		
		if ($this->DAO->findByName($name) !== null) {
			$this->errors[] = "Stránka s tímto jménem již existuje.";
		}
		
		return true;
	}
	
	protected function validateUrl($url) {
		if (mb_strlen($url) > 255) {
			$this->errors[] = "Url stránky nesmí být delší než 255 znaků.";
		}
		
		return true;
	}
	
	protected function validateTitle($title) {
		if (mb_strlen($title) > 255) {
			$this->errors[] = "Titulek stránky nesmí být delší než 255 znaků.";
		}
		
		return true;
	}
	
	protected function validateContent($content) {
		return true;
	}
	
	protected function validateVisible($visited) {
		return true;
	}
	
	protected function validatePosition($position) {
		return true;
	}
	
	protected function validateTemplate($template) {
		return true;
	}
	
	protected function validateParentUrl($parentUrl) {
		return true;
	}
	
	public function getLastError() {
		return end($this->errors);
	}
}

