<?php

class TranslationEntity extends AbstractEntity {
	/** @id @generatedValue @column(type="integer") */
	private $id;
	
	private $original;
	
	private $translation;
		
	public function __construct($id = null, $original = null, $translation = null) {
		if (is_array($id)) {
			$this->fromArray($id);
		} else {
			$this->setId($id);
			$this->setOriginal($original);
			$this->setTranslation($translation);
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getOriginal() {
		return $this->original;
	}
	
	public function setOriginal($original) {
		$this->original = $original;
	}
	
	public function getTranslation() {
		return $this->translation;
	}
	
	public function setTranslation($translation) {
		$this->translation = $translation;
	}
}
