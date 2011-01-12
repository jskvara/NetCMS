<?php

class ValidatorException extends Exception {
	protected $validationErrors;
	
	public function __construct($message = null, $code = null) {
		if (is_array($message)) {
			$this->validationErrors = $message;
		} else {
			parent::__construct($message, $code);
		}
	}
	
	public function setValidatoinErrors(array $errors) {
		$this->validationErrors = $errors;
	}
	
	public function getValidationErrors() {
		return $this->validationErrors;
	}
}

