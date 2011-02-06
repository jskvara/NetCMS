<?php

class SeedValidator implements IValidator {
	
	protected $errors = array();
	
	public function validate(IEntity $entity) {
		$this->errors = array();
		
		$this->validateId($entity->getId());
		$this->validateName($entity->getName());
		
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	public function validateAdd(IEntity $entity) {
		$this->errors = array();
		
		$this->validateName($entity->getName());
		
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
	
	public function getLastError() {
		return end($this->errors);
	}
}

