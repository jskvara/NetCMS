<?php

class SeedConverter extends AbstractConverter {
	
	private $entity;
	
	public function convert(IEntity $entity) {
		$this->entity = $entity;
		$this->_convert();
		
		return $entity;
	}
	
	public function toEntity($id, $name) {
		$this->entity = new SeedEntity($id, $name);
		$this->_convert();
		
		return $this->entity;
	}
	
	protected function _convert() {
		$this->convertId();
		$this->convertName();
	}
	
	protected function convertId() {
		$id = $this->entity->getId();
		$id = $this->convertInt($id);
		$this->entity->setId($id);
	}
	
	protected function convertName() {
	}
}
