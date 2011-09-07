<?php

class TranslationConverter extends AbstractConverter {
	
	protected function convertFields() {
	}
	
	public function convert(IEntity $entity) {
		$this->entity = $entity;
		
		$this->_convert();
		
		return $entity;
	}
	
	protected function _convert() {
		$this->convertId();
		$this->convertOriginal();
		$this->convertTranslation();
	}
	
	protected function convertId() {
		$id = $this->entity->getId();
		$id = $this->convertInt($id);
		$this->entity->setId($id);
	}
	
	protected function convertOriginal() {
	}
		
	protected function convertTranslation() {
	}
}

