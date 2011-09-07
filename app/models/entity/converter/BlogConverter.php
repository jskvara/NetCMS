<?php

class BlogConverter extends AbstractConverter {
	
	protected function convertFields() {
	}
	
	public function convert(IEntity $entity) {
		$this->entity = $entity;
		
		$this->_convert();
		
		return $entity;
	}
	
	protected function _convert() {
		$this->convertId();
		$this->convertTitle();
		$this->convertText();
		$this->convertCreated();
		$this->convertVisible();
	}
	
	protected function convertId() {
		$id = $this->entity->getId();
		$id = $this->convertInt($id);
		$this->entity->setId($id);
	}
	
	protected function convertTitle() {
	}
	
	protected function convertText() {
	}
	
	protected function convertCreated() {
		$created = $this->entity->getCreated();
		$created = $this->convertDate($created);
		$this->entity->setCreated($created);
	}
	
	protected function convertVisible() {
		$visible = $this->entity->getVisible();
		$visible = $this->convertBool($visible);
		$this->entity->setVisible($visible);
	}
}

