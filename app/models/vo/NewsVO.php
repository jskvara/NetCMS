<?php

class NewsVO {
	private $newsEntity;
	
	public function __construct(NewsEntity $newsEntity = null) {
		$this->newsEntity = $newsEntity;
	}
	
	public static function create(NewsEntity $newsEntity) {
		return new NewsVO($newsEntity);
	}
		
	public function getId() {
		return $this->newsEntity->getId();
	}
		
	public function getTitle() {
		return $this->newsEntity->getTitle();
	}
	
	public function getText() {
		return $this->newsEntity->getText();
	}
}

