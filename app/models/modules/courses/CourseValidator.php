<?php

class CourseValidator extends AbstractValidator {
	
	protected function validateFields() {
		if ($this->mode !== "add") {
			$this->validateNotEmpty("id", "Id nesmí být prázdné.");
			$this->validateNonNegative("id", "Id nesmí být záporné.");
		}
		$this->validateStringLength("name");
	}
}

