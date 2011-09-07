<?php

class CourseEntity extends AbstractEntity {
	/** @var int */
	protected $id;
	
	/** @var string */
	protected $name;
	
	public function __construct($id = null, $name = null) {
		if (is_array($id)) {
			$this->fromArray($id);
		} else {
			$this->setId($id);
			$this->setName($name);
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
}
