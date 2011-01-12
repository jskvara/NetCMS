<?php

require_once APP_DIR .'/models/entity/PageEntity.php';

class PageEntityTest extends PHPUnit_Framework_TestCase
{
	private $page;
	
	public function setUp() {
		$this->page = new PageEntity();
	}
	
	public function testConstruct() {
		$page = new PageEntity('url');
		
		$pageExpected = new PageEntity();
		$pageExpected->setUrl('url');
		
		$this->assertEquals($pageExpected, $page);
	}

	public function testId() {
		$this->page->setId(1);
		$this->assertEquals(1, $this->page->getId());
	}
	
	public function testIdInvalidArgument() {
		try {
			$this->page->setId('1');
		} catch(InvalidArgumentException $expected) {
			return;
		}
		$this->fail();
	}
	
	public function testUrl() {
		$this->page->setUrl('url');
		$this->assertEquals('url', $this->page->getUrl());
	}
	
	public function testUrlInvalidArgument() {
		try {
			$this->page->setUrl(1);
		} catch(InvalidArgumentException $expected) {
			return;
		}
		$this->fail();
	}
	
	public function testGetters() {
		$reflection = new ReflectionObject($this->page);
		$properties = $reflection->getProperties(ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PROTECTED);
		
		foreach ($properties as $property) {
			$propertyName = $property->getName();
			$propertyGetter = array($this->page, 'get'. UCFirst($propertyName));
			
			if (!is_callable($propertyGetter)) {
				$this->fail("Entity '". get_class($this->page) ."' must implement 'get". UCFirst($propertyName) ."' method");
			}
		}
	}
	
	public function testSetters() {
		$reflection = new ReflectionObject($this->page);
		$properties = $reflection->getProperties(ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PROTECTED);
		
		foreach ($properties as $property) {
			$propertyName = $property->getName();
			$propertyGetter = array($this->page, 'set'. UCFirst($propertyName));
			
			if (!is_callable($propertyGetter)) {
				$this->fail("Entity '". get_class($this->page) ."' must implement 'set". UCFirst($propertyName) ."' method");
			}
		}
	}
	
	public function tearDown() {
		$this->page = null;
	}
}

