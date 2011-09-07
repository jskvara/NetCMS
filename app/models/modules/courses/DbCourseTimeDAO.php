<?php

class DbCourseTimeDAO extends DbDAO {
		
	protected function getTableName() {
		return "courseTimes";
	}
	
	protected function getPrimaryKeyName() {
		return "id";
	}
	
	public function getAll($courseId = NULL, $limit = NULL, $offset = NULL, $orderBy = NULL, $order = "ASC") {
		$query = $this->conn->select("*")->from($this->getTableName());
		
		if($courseId !== NULL) {
			$query->where("[courseId] = %i", $courseId);
		}
		
		if ($orderBy !== NULL) {
			$query->orderBy($orderBy, $order);
		} else {
			$query->orderBy($this->getPrimaryKeyName(), $order);
		}
		
		if ($limit !== NULL) {
			$query->limit($limit);
		}
		if ($offset !== NULL) {
			$query->offset($offset);
		}
		
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		return $result->fetchAll();
	}
	
	protected function setRowClass(DibiResult $result) {
		$result = $result->setRowClass("CourseTimeEntity")->setType("id", dibi::INTEGER);
		$result = $result->setRowClass("CourseTimeEntity")->setType("date", dibi::DATETIME);
		
		return $result;
	}
}
