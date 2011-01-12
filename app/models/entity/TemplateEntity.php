<?php

/** @entity */
class TemplateEntity extends AbstractEntity {

	private $name;

	private $content;
	
	public function __construct($name = null, $content = null) {
		if (is_array($name)) {
			$this->fromArray($name);
		} else {
			$this->setName($name);
			$this->setContent($content);
		}
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getContent() {
		return $this->content;
	}
	
	public function setContent($content) {
		$this->content = $content;
	}
	
	public function __toString() {
		return $this->getName();
	}
}

