<?php

class PhotoVO {
	private $content;
	private $thumbnail;
	private $summary;
	
	public function __construct($content = null, $thumbnail = null, $summary = null) {
		$this->setContent($content);
		$this->setThumbnail($thumbnail);
		$this->setSummary($summary);
	}
	
	public function getContent() {
		return $this->content;
	}
	
	public function setContent($content) {
		$this->content = $content;
	}
	
	public function getThumbnail() {
		return $this->thumbnail;
	}
	
	public function setThumbnail($thumbnail) {
		$this->thumbnail = $thumbnail;
	}
	
	public function getSummary() {
		return $this->summary;
	}
	
	public function setSummary($summary) {
		$this->summary = $summary;
	}
}

