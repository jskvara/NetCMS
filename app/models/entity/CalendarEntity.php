<?php

class CalendarEntity extends AbstractEntity {
	/** @id @generatedValue @column(type="integer") */
	private $id;
	
	private $date;
	
	private $text;
		
	public function __construct($id = null, $date = null, $text = null) {
		if (is_array($id)) {
			$this->fromArray($id);
		} else {
			$this->setId($id);
			$this->setDate($date);
			$this->setText($text);
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getDate() {
		return $this->date;
	}
	
	public function setDate($date) {
		$this->date = $date;
	}
	
	public function getText() {
		return $this->text;
	}
	
	public function setText($text) {
		$this->text = $text;
	}
}
