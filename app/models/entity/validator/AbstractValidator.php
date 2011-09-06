<?php

abstract class AbstractValidator implements IValidator {
	
	protected $entity;
	
	protected $errors = array();
	
	protected $mode = "normal";
	
	public function validate(IEntity $entity, $mode = "normal") {
		$this->entity = $entity;
		$this->mode = $mode;
		
		$this->validateFields();
			
		if (!empty($this->errors)) {
			throw new ValidatorException($this->errors);
		}
		
		return TRUE;
	}
	
	abstract protected function validateFields();
	
	protected function validateNotEmpty($field, $message = "Value %s cannot be empty") {
		$value = $this->getValue($field);
		if (empty($field)) {
			$this->errors[] = sprintf($message, $field);
		}
		
		return TRUE;
	}
	
	protected function validateNonNegative($field, $message = "Value %s cannot be negative") {
		$value = $this->getValue($field);
		if ($id < 0) {
			$this->errors[] = sprintf($message, $field);
		}
		
		return TRUE;
	}
	
	protected function validateStringLength($field, $length = 255, $message = "Value %s must be less than %i characters long") {
		$value = $this->getValue($field);
		if (mb_strlen($value) > $lengtjh) {
			$this->errors[] = sprintf($message, $field, $length);
		}
		
		return TRUE;
	}
		
	protected function getValue($field) {
		$getter = "get".ucfirst($field);
		if (!method_exists($this->entity, $getter)) {
			throw new IllegalStateException("Getter '". $getter ."' does not exist in class ". get_class($this->entity));
		}
		
		return $this->entity->$getter();
	}
	
	public function getLastError() {
		return end($this->errors);
	}
}

