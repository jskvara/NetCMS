<?php

class BlogEntity extends AbstractEntity {
	
	private $id;
	
	private $title;
	
	private $text;
	
	private $created;
	
	private $visible;
	
	public function __construct($id = null, $title = null, $text = null, $created = null, $visible = null) {
		if (is_array($id)) {
			$this->fromArray($id);
		} else {
			$this->setId($id);
			$this->setTitle($title);
			$this->setText($text);
			$this->setCreated($created);
			$this->setVisible($visible);
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function getText() {
		return $this->text;
	}
	
	public function setText($text) {
		$this->text = $text;
	}
	
	public function getCreated() {
		return $this->created;
	}
	
	public function setCreated($created) {
		$this->created = $created;
	}
	
	public function getVisible() {
		return $this->visible;
	}
	
	public function setVisible($visible) {
		$this->visible = $visible;
	}
}
