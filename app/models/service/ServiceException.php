<?php

class ServiceException extends Exception {
	
	protected $validationErrors;
	
	public function __construct($message = null, $code = null) {
		if ($message instanceof ValidatorException) {
			$this->setValidatoinErrors($message->getValidationErrors());
			$this->code = $message->getCode();
		} else if ($message instanceof Exception) {
			$this->message = $message->getMessage();
			$this->code = $message->getCode();
		} else if (is_array($message)) {
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

