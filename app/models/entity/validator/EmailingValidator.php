<?php

class EmailingValidator implements IValidator {
	
	protected $errors = array();
	protected $DAO;
	
	public function setDAO(IDAO $DAO) {
		$this->DAO = $DAO;
	}
	
	public function validate(IEntity $entity) {
		$this->errors = array();
		
		$this->validateId($entity->getId());
		$this->validateEmail($entity->getEmail());
		
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	public function validateAdd(IEntity $entity) {
		$this->errors = array();
		
		$this->validateEmail($entity->getEmail());
		
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	public function validateId($id) {
		if (empty($id) || $id < 0) {
			$this->errors[] = "Id nesmí být prázdné.";
		}
		
		return true;
	}
	
	protected function validateEmail($email) {
		if ($this->DAO->findByEmail($email) !== null) {
			$this->errors[] = "E-mail s tímto jménem již existuje.";
		}
		
		return true;
	}
	
	public function getLastError() {
		return end($this->errors);
	}
}

