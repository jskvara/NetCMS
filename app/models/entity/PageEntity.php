<?php

/** @entity */
class PageEntity extends AbstractEntity {
	/** @id @generatedValue @column(type="integer") */
	protected $id;
	
	protected $name;
	
	/** @column(length=255) */
	protected $url;
	
	protected $title;
	
	protected $content;
	
	protected $visible;
	
	protected $position;
	
	protected $template;
	
	protected $parentUrl;
	
	protected $redirect;
	
	public function __construct($id = null, $name = null, $url = null, $title = null, $content = null, 
		$visible = null, $position = null, $template = null, $parentUrl = null, $redirect = null) {
		if (is_array($id)) {
			$this->fromArray($id);
		} else {
			$this->setId($id);
			$this->setName($name);
			$this->setUrl($url);
			$this->setTitle($title);
			$this->setContent($content);
			$this->setVisible($visible);
			$this->setPosition($position);
			$this->setTemplate($template);
			$this->setParentUrl($parentUrl);
			$this->setRedirect($redirect);
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		// $this->checkInt($id);

		$this->id = $id;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getUrl() {
		return $this->url;
	}
	
	public function setUrl($url) {
		// $this->checkString($title);
		
		$this->url = $url;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function getContent() {
		return $this->content;
	}
	
	public function setContent($content) {
		$this->content = $content;
	}
	
	public function getVisible() {
		return $this->visible;
	}
	
	public function setVisible($visible) {
		$this->visible = $visible;
	}
	
	public function getPosition() {
		return $this->position;
	}
	
	public function setPosition($position) {
		$this->position = $position;
	}
	
	public function getTemplate() {
		return $this->template;
	}
	
	public function setTemplate($template) {
		$this->template = $template;
	}
	
	public function getParentUrl() {
		return $this->parentUrl;
	}
	
	public function setParentUrl($parentUrl) {
		$this->parentUrl = $parentUrl;
	}
	
	public function getRedirect() {
		return $this->redirect;
	}
	
	public function setRedirect($redirect) {
		$this->redirect = $redirect;
	}
}
