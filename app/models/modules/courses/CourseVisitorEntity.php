<?php

class CourseVisitorEntity extends AbstractEntity {
	/** @var int */
	protected $id;
	
	/** @var int */
	protected $courseTimeId;
	
	/** @var string */
	protected $email;
	
	public function __construct($id = null, $courseTimeId = null, $email = null) {
		if (is_array($id)) {
			$this->fromArray($id);
		} else {
			$this->setId($id);
			$this->setCourseTimeId($courseTimeId);
			$this->setEmail($email);
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getCourseTimeId() {
		return $this->courseTimeId;
	}
	
	public function setCourseTimeId($courseTimeId) {
		$this->courseTimeId = $courseTimeId;
	}
	
	public function getEmail() {
		return $this->email;
	}
	
	public function setEmail($email) {
		$this->email = $email;
	}
}
