<?php

class SeedItemConverter extends AbstractConverter {
	
	private $entity;
	
	public function convert(IEntity $entity) {
		$this->entity = $entity;
		$this->_convert();
		
		return $entity;
	}
	
	public function toEntity($id, $seedId, $name, $resistence, $color, $position) {
		$this->entity = new SeedItemEntity($id, $seedId, $name, $resistence, $color, $position);
		$this->_convert();
		
		return $this->entity;
	}
	
	protected function _convert() {
		$this->convertId();
		$this->convertSeedId();
		$this->convertName();
		$this->convertResistence();
		$this->convertColor();
		$this->convertPosition();
	}
	
	protected function convertId() {
		$id = $this->entity->getId();
		$id = $this->convertInt($id);
		$this->entity->setId($id);
	}
	
	protected function convertSeedId() {
		$seedId = $this->entity->getSeedId();
		$seedId = $this->convertInt($seedId);
		$this->entity->setSeedId($seedId);
	}
	
	protected function convertName() {
	}
	
	protected function convertResistence() {
	}
	
	protected function convertColor() {
	}
	
	protected function convertPosition() {
	}
}
