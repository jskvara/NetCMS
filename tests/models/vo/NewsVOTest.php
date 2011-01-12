<?php

require_once APP_DIR .'/models/entity/NewsEntity.php';
require_once APP_DIR .'/models/vo/NewsVO.php';

class NewsVOTest extends PHPUnit_Framework_TestCase
{
	private $newsVO;
	private $newsEntity;
	
	public function setUp() {
		$this->newsEntity = new NewsEntity();
		$this->newsEntity->setId(1);
		$this->newsEntity->setTitle('title');
		$this->newsEntity->setText('text');
		
		$this->newsVO = new NewsVO($this->newsEntity);
	}
	
	public function testCreate() {
		$newsVO = NewsVO::create($this->newsEntity);
		
		$this->assertEquals($this->newsVO, $newsVO);
	}

	public function testGetId() {
		$this->assertEquals(1, $this->newsVO->getId());
	}
	
	public function testGetTitle() {
		$this->assertEquals('title', $this->newsVO->getTitle());
	}
	
	public function testGetText() {
		$this->assertEquals('text', $this->newsVO->getText());
	}
	
	public function tearDown() {
		$this->newsVO = null;
	}
}

