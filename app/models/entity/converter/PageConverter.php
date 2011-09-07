<?php

class PageConverter extends AbstractConverter {
	
	protected function convertFields() {
	}
	
	public function convert(IEntity $entity) {
		$this->entity = $entity;
		
		$this->_convert();
		
		return $entity;
	}
	
	public function toEntity($id, $name, $parentUrl, $title, $content, 
			$visible, $position, $template, $redirect) {
		if ($name === null && $parentUrl === null) {
			$url = null;
		} else {
			$url = UrlUtil::createUrl($parentUrl, $name);
		}
		$this->entity = new PageEntity($id, $name, $url, $title, $content, 
				$visible, $position, $template, $parentUrl, $redirect);
		
		$this->_convert();
		
		return $this->entity;
	}
	
	protected function _convert() {
		$this->convertId();
		$this->convertName();
		$this->convertUrl();
		$this->convertTitle();
		$this->convertContent();
		$this->convertVisible();
		$this->convertPosition();
		$this->convertTemplate();
		$this->convertParentUrl();
	}
	
	protected function convertId() {
		$id = $this->entity->getId();
		$id = $this->convertInt($id);
		$this->entity->setId($id);
	}
	
	protected function convertName() {
		$name = $this->entity->getName();
		if ($name !== null) {
			$name = mb_strtolower($name);
		}
		$this->entity->setName($name);
	}
	
	protected function convertUrl() {
		$url = $this->entity->getUrl();
		if ($url != null) {
			$url = mb_strtolower($url);
		}
		$this->entity->setUrl($url);
	}
	
	protected function convertTitle() {
	}
	
	protected function convertContent() {
	}
	
	protected function convertVisible() {
		$visible = $this->entity->getVisible();
		$visible = $this->convertBool($visible);
		$this->entity->setVisible($visible);
	}
	
	protected function convertPosition() {
		$position = $this->entity->getPosition();
		$position = $this->convertInt($position);
		$this->entity->setPosition($position);
	}
	
	protected function convertTemplate() {
	}
	
	protected function convertParentUrl() {
	}
}

