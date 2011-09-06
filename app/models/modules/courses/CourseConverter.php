<?php

class CourseConverter extends AbstractConverter {
	
	protected function convertFields() {
		$this->convertIntField("id");
		$this->convertStringField("name");
	}
}

