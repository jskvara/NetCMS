<?php

class SeedEntity extends AbstractEntity {
	protected $id;
	protected $name;
	protected $description;
	protected $harvest;
	protected $text;
	
	public function __construct($id = null, $name = null, $description = null, $harvest = null, $text = null) {
		if (is_array($id)) {
			$this->fromArray($id);
		} else {
			$this->setId($id);
			$this->setName($name);
			$this->setDescription($description);
			$this->setHarvest($harvest);
			$this->setText($text);
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
	
	public function getDescription() {
		return $this->description;
	}
	
	public function setDescription($description) {
		$this->description = $description;
	}
	
	public function getHarvest() {
		return $this->harvest;
	}
	
	public function setHarvest($harvest) {
		$this->harvest = $harvest;
	}
	
	public function getText() {
		return $this->text;
	}
	
	public function setText($text) {
		$this->text = $text;
	}
}
