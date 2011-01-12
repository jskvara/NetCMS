<?php

class CalendarConverter extends AbstractConverter {
	
	private $entity;
	
	public function convert(IEntity $entity) {
		$this->entity = $entity;
		
		$this->_convert();
		
		return $entity;
	}
	
	protected function _convert() {
		$this->convertId();
		$this->convertDateField();
		$this->convertText();
	}
	
	protected function convertId() {
		$id = $this->entity->getId();
		$id = $this->convertInt($id);
		$this->entity->setId($id);
	}
	
	protected function convertDateField() {
		$date = $this->entity->getDate();
		$date = $this->convertDate($date);
		$this->entity->setDate($date);
	}
		
	protected function convertText() {
	}
}

