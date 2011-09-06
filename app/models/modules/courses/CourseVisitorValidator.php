<?php

class CourseVisitorValidator extends AbstractValidator {
	
	protected function validateFields() {
		if ($this->mode !== "add") {
			$this->validateNotEmpty("id", "Id nesmí být prázdné.");
			$this->validateNonNegative("id", "Id nesmí být záporné.");
		}
		$this->validateNotEmpty("courseTimeId", "Id termínu kurzu nesmí být prázdné.");
		$this->validateNonNegative("courseTimeId", "Id termínu kurzu nesmí být záporné.");
		$this->validateStringLength("email");
	}
}

