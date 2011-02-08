<?php

class EmailingConverter extends AbstractConverter {
	
	private $entity;
	
	public function convert(IEntity $entity) {
		$this->entity = $entity;
		$this->_convert();
		
		return $entity;
	}
	
	public function toEntity($id, $name) {
		$this->entity = new EmailingEntity($id, $name);
		$this->_convert();
		
		return $this->entity;
	}
	
	protected function _convert() {
		$this->convertId();
		$this->convertEmail();
	}
	
	protected function convertId() {
		$id = $this->entity->getId();
		$id = $this->convertInt($id);
		$this->entity->setId($id);
	}
	
	protected function convertEmail() {
	}
}
