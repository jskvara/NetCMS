<?php

class TemplateConverter extends AbstractConverter {
	
	private $entity;
	
	public function convert(IEntity $entity) {
		$this->entity = $entity;
		
		$this->_convert();
		
		return $entity;
	}
	
	public function toEntity($name, $content) {
		$this->entity = new TemplateEntity($name, $content);
		
		$this->_convert();
		
		return $this->entity;
	}
	
	protected function _convert() {
		$this->convertName();
		$this->convertContent();
	}
	
	protected function convertName() {
		$name = $this->entity->getName();
		$this->entity->setName($name);
	}
	
	protected function convertContent() {
	}
}
