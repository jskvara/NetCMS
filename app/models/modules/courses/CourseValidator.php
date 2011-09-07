<?php

class CourseValidator extends AbstractValidator {
	
	protected function validateFields() {
		if ($this->mode !== IValidator::ADD) {
			$this->validateNotEmpty("id", "Id nesmí být prázdné.");
			$this->validateNonNegative("id", "Id nesmí být záporné.");
		}
		$this->validateStringLength("name", "Název kurzu nesmí být delší než %2\$d znaků");
	}
}

