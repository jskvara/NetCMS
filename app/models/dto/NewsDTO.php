<?php

class NewsDTO {
	private $entity;
	
	public function __construct(NewsEntity $entity = null) {
		$this->entity = $entity;
	}
		
	public function getId() {
		return $this->entity->getId();
	}
		
	public function getTitle() {
		return $this->entity->getTitle();
	}
	
	public function getText() {
		return $this->entity->getText();
	}
	
	public function getCreated() {
		if (is_object($this->entity->getCreated())) {
			return $this->entity->getCreated()->format('j. n. Y');
		}
		
		return $this->entity->getCreated();
	}
	
	public function getVisible() {
		return $this->entity->getVisible();
	}
}
