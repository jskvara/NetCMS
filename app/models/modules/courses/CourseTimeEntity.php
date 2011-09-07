<?php

class CourseTimeEntity extends AbstractEntity {
	/** @var int */
	protected $id;
	
	/** @var int */
	protected $courseId;
	
	/** @var DateTime */
	protected $date;
	
	public function __construct($id = null, $courseId = null, $date = null) {
		if (is_array($id)) {
			$this->fromArray($id);
		} else {
			$this->setId($id);
			$this->setCourseId($courseId);
			$this->setDate($date);
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getCourseId() {
		return $this->courseId;
	}
	
	public function setCourseId($courseId) {
		$this->courseId = $courseId;
	}
	
	public function getDate() {
		return $this->date;
	}
	
	public function setDate($date) {
		$this->date = $date;
	}
}
