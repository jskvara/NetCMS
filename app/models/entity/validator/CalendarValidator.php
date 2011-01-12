<?php

class CalendarValidator implements IValidator {
	
	protected $errors = array();
	
	public function validate(IEntity $entity) {
		$this->errors = array();
		$this->validateId($entity->getId());
		$this->validateDate($entity->getDate());
		$this->validateText($entity->getText());
			
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	public function validateAdd(IEntity $entity) {
		$this->errors = array();
		$this->validateDate($entity->getDate());
		$this->validateText($entity->getText());
		
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	public function validateId($id) {
		if (empty($id) || $id < 0) {
			$this->errors[] = 'Id nesmí být prázdné.';
		}
		
		return true;
	}
	
	protected function validateDate($date) {
		return true;
	}
	
	protected function validateText($text) {
		return true;
	}
	
	public function getLastError() {
		return end($this->errors);
	}
}

