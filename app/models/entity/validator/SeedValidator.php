<?php

class SeedValidator implements IValidator {
	
	protected $errors = array();
	
	public function validate(IEntity $entity) {
		$this->errors = array();
		
		$this->validateId($entity->getId());
		$this->validateName($entity->getName());
		$this->validateDescription($entity->getDescription());
		$this->validateHarvest($entity->getHarvest());
		$this->validateText($entity->getText());
		
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	public function validateAdd(IEntity $entity) {
		$this->errors = array();
		
		$this->validateName($entity->getName());
		$this->validateDescription($entity->getDescription());
		$this->validateHarvest($entity->getHarvest());
		$this->validateText($entity->getText());
		
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	public function validateId($id) {
		if (empty($id) || $id < 0) {
			$this->errors[] = "Id osiva nesmí být prázdné.";
		}
		
		return true;
	}
	
	protected function validateName($name) {
		return true;
	}
	
	protected function validateDescription($description) {
		return true;
	}
	
	protected function validateHarvest($harvest) {
		return true;
	}
	
	protected function validateText($text) {
		return true;
	}
	
	public function getLastError() {
		return end($this->errors);
	}
}

