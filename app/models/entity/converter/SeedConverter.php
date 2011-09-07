<?php

class SeedConverter extends AbstractConverter {
	
	protected function convertFields() {
	}
	
	public function convert(IEntity $entity) {
		$this->entity = $entity;
		$this->_convert();
		
		return $entity;
	}
	
	public function toEntity($id, $name, $description, $harvest, $text) {
		$this->entity = new SeedEntity($id, $name, $description, $harvest, $text);
		$this->_convert();
		
		return $this->entity;
	}
	
	protected function _convert() {
		$this->convertId();
		$this->convertName();
		$this->convertDescription();
		$this->convertHarvest();
		$this->convertText();
	}
	
	protected function convertId() {
		$id = $this->entity->getId();
		$id = $this->convertInt($id);
		$this->entity->setId($id);
	}
	
	protected function convertName() {
	}
	
	protected function convertDescription() {
	}

	protected function convertHarvest() {
	}
	
	protected function convertText() {
	}
}
