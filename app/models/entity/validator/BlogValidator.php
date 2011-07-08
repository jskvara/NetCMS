<?php

class BlogValidator implements IValidator {
	
	protected $errors = array();
	
	public function validate(IEntity $entity) {
		$this->errors = array();
		$this->validateId($entity->getId());
		$this->validateTitle($entity->getTitle());
		$this->validateText($entity->getText());
		$this->validateCreated($entity->getCreated());
		$this->validateVisible($entity->getVisible());
		
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	public function validateAdd(IEntity $entity) {
		$this->errors = array();
		$this->validateTitle($entity->getTitle());
		$this->validateText($entity->getText());
		$this->validateCreated($entity->getCreated());
		$this->validateVisible($entity->getVisible());
		
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	public function validateId($id) {
		if (empty($id) || $id < 0) {
			$this->errors[] = 'Id novinky nesmí být prázdné.';
		}
		
		return true;
	}
	
	protected function validateTitle($title) {
		if ($title === null) {
			$this->errors[] = 'Název příspěvku nesmí být prázdný.';
		}
		
		if (mb_strlen($title) > 255) {
			// $errors[] = "Title cannot be longer than 255";
			$this->errors[] = "Název příspěvku nesmí být delší než 255 znaků.";
		}
		
		return true;
	}
	
	protected function validateText($text) {
		return true;
	}
	
	protected function validateCreated($created) {
		return true;
	}
	
	protected function validateVisible($visited) {
		return true;
	}
	
	public function getLastError() {
		return end($this->errors);
	}
}

