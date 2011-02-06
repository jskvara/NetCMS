<?php

class SeedItemValidator implements IValidator {
	
	protected $errors = array();
	
	public function validate(IEntity $entity) {
		$this->errors = array();
		
		$this->validateId($entity->getId());
		$this->validateSeedId($entity->getSeedId());
		$this->validateName($entity->getName());
		$this->validateResistence($entity->getResistence());
		$this->validateColor($entity->getColor());
		$this->validatePosition($entity->getPosition());
		
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	public function validateAdd(IEntity $entity) {
		$this->errors = array();
		
		$this->validateSeedId($entity->getSeedId());
		$this->validateName($entity->getName());
		$this->validateResistence($entity->getResistence());
		$this->validateColor($entity->getColor());
		$this->validatePosition($entity->getPosition());
		
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return true;
	}
	
	public function validateId($id) {
		if (empty($id) || $id < 0) {
			$this->errors[] = "Id typ osiva nesmí být prázdné.";
		}
		
		return true;
	}
	
	protected function validateSeedId($seedId) {
		return true;
	}
	
	protected function validateName($name) {
		return true;
	}
	
	protected function validateResistence($resistence) {
		return true;
	}
	
	protected function validateColor($color) {
		return true;
	}
	
	protected function validatePosition($position) {
		return true;
	}
	
	public function getLastError() {
		return end($this->errors);
	}
}

