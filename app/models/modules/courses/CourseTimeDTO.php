<?php

class CourseTimeDTO extends CourseTimeEntity implements IDTO {
	
	protected $entity;
	
	public function __construct($entity) {
		$this->entity = $entity;
	}
	
	public function getDate() {
		if (is_object($this->entity->getDate())) {
			return $this->entity->getDate()->format("j. n. Y");
		} else {
			return date("j, n. Y", $this->entity->getDate());
		}
	}
}
