<?php

class CourseVisitorConverter extends AbstractConverter {
	
	protected function convertFields() {
		$this->convertIntField("id");
		$this->convertIntField("courseTimeId");
		$this->convertStringField("email");
	}
}

