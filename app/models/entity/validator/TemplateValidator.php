<?php

class TemplateValidator implements IValidator {
	
	protected $errors = array();
	protected $DAO;
	
	public function setDAO(IDAO $DAO) {
		$this->DAO = $DAO;
	}
	
	public function validate(IEntity $entity) {
		$this->errors = array();
		
		$this->validateContent($entity->getContent());
		
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	public function validateAdd(IEntity $entity) {
		$this->errors = array();
		
		$this->validateName($entity->getName());
		$this->validateContent($entity->getContent());
		
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	protected function validateName($name) {
		if (mb_strlen($name) > 30) {
			$this->errors[] = "Jméno šablony smí mít maximálně %d znaků.";
		}
		
		if (!preg_match('/^[a-zA-Z0-9-_@]+$/', $name)) {
			$this->errors[] = "Jméno šablony smí obsahovat jen znaky: a-z, A-Z, 0-9, _, - a @.";
		}
		
		if ($this->DAO->exists($name)) {
			$this->errors[] = "Šablona s tímto jménem již existuje.";
		}
		
		return true;
	}
	
	protected function validateContent($content) {
		return true;
	}
	
	public function getLastError() {
		return end($this->errors);
	}
}

