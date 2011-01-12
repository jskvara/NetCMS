<?php

require_once APP_DIR .'/models/entity/NewsEntity.php';

class NewsEntityTest extends PHPUnit_Framework_TestCase
{
	private $news;
	
	public function setUp() {
		$this->news = new NewsEntity();
	}
	
	public function testConstruct() {
		$created = new DateTime();
		$news = new NewsEntity(1, 'title', 'text', $created, true);
		
		$newsExpected = new NewsEntity();
		$newsExpected->setId(1);
		$newsExpected->setTitle('title');
		$newsExpected->setText('text');
		$newsExpected->setCreated($created);
		$newsExpected->setVisible(true);
		
		$this->assertEquals($newsExpected, $news);
	}

	public function testId() {
		$this->news->setId(1);
		$this->assertEquals(1, $this->news->getId());
	}
	
	public function testIdInvalidArgument() {
		try {
			$this->news->setId('string');
		} catch(InvalidArgumentException $expected) {
			return;
		}
		$this->fail();
	}
	
	public function testTitle() {
		$this->news->setTitle('title');
		$this->assertEquals('title', $this->news->getTitle());
	}
	
	public function testTitleInvalidArgument() {
		try {
			$this->news->setTitle(1);
		} catch(InvalidArgumentException $expected) {
			return;
		}
		$this->fail();
	}
	
	public function testText() {
		$this->news->setText('string');
		$this->assertEquals('string', $this->news->getText());
	}
	
	public function testTextInvalidArgument() {
		try {
			$this->news->setText(1);
		} catch(InvalidArgumentException $expected) {
			return;
		}
		$this->fail();
	}
	
	public function testCreated() {
		$created = new DateTime();
		$this->news->setCreated($created);
		$this->assertEquals($created, $this->news->getCreated());
	}
	
	public function testCreatedInvalidArgument() {
		try {
			$this->news->setCreated('a');
		} catch(InvalidArgumentException $expected) {
			return;
		}
		$this->fail();
	}
	
	public function testGetters() {
		$reflection = new ReflectionObject($this->news);
		$properties = $reflection->getProperties(ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PROTECTED);
		
		foreach ($properties as $property) {
			$propertyName = $property->getName();
			$propertyGetter = array($this->news, 'get'. UCFirst($propertyName));
			
			if (!is_callable($propertyGetter)) {
				$this->fail("Entity '". get_class($this->news) ."' must implement 'get". UCFirst($propertyName) ."' method");
			}
		}
	}
	
	public function testSetters() {
		$reflection = new ReflectionObject($this->news);
		$properties = $reflection->getProperties(ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PROTECTED);
		
		foreach ($properties as $property) {
			$propertyName = $property->getName();
			$propertyGetter = array($this->news, 'set'. UCFirst($propertyName));
			
			if (!is_callable($propertyGetter)) {
				$this->fail("Entity '". get_class($this->news) ."' must implement 'set". UCFirst($propertyName) ."' method");
			}
		}
	}
	
	public function tearDown() {
		$this->news = null;
	}
}

