<?php

class CourseTimeConverter extends AbstractConverter {
	
	protected function convertFields() {
		$this->convertIntField("id");
		$this->convertIntField("courseId");
		$this->convertDateField("date");
	}
}

