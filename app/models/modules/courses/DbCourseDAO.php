<?php

class DbCourseDAO extends DbDAO {
		
	protected function getTableName() {
		return "courses";
	}
	
	protected function getPrimaryKeyName() {
		return "id";
	}
	
	protected function setRowClass(DibiResult $result) {
		$result = $result->setRowClass("CourseEntity")->setType("id", dibi::INTEGER);
		
		return $result;
	}
}
