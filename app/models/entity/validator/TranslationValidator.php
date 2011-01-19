<?php

class TranslationValidator implements IValidator {
	
	protected $errors = array();
	
	public function validate(IEntity $entity) {
		$this->errors = array();
		$this->validateId($entity->getId());
		$this->validateOriginal($entity->getOriginal());
		$this->validateTranslation($entity->getTranslation());
			
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	public function validateAdd(IEntity $entity) {
		$this->errors = array();
		$this->validateOriginal($entity->getOriginal());
		$this->validateTranslation($entity->getTranslation());
		
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
	
	protected function validateOriginal($original) {
		return true;
	}
	
	protected function validateTranslation($translation) {
		return true;
	}
	
	public function getLastError() {
		return end($this->errors);
	}
}

