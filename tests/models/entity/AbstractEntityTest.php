<?php

require_once APP_DIR .'/models/entity/IEntity.php';
require_once APP_DIR .'/models/entity/AbstractEntity.php';

class AbstractImplEntity extends AbstractEntity {
	protected $id;
	
	public function __construct(array $data = null) {
		parent::fromArray($data);
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}

	public function checkInt($param) {
		return parent::checkInt($param);
	}
	
	public function checkString($param) {
		return parent::checkString($param);
	}
}

class MissingGetterEntity extends AbstractEntity {
	protected $id;
	
	public function setId($id) {
		$this->id = $id;
	}
}

class AbstractEntityTest extends PHPUnit_Framework_TestCase
{
	public function setUp() {
		$this->entity = new AbstractImplEntity();
	}
	
	public function testFromArray() {
		$entity = new AbstractImplEntity();
		$entity->fromArray(array('id' => 1));
		
		$entityExpected = new AbstractImplEntity();
		$entityExpected->setId(1);
		
		$this->assertEquals($entityExpected, $entity);
	}
	
	public function testFromArrayException() {
		try {
			$entity = new AbstractImplEntity();
			$entity->fromArray(array('a' => 1));
		} catch(RuntimeException $expected) {
			return;
		}
		$this->fail();
	}
	
	public function testToArray() {
		$entity = new AbstractImplEntity();
		$entity->setId(1);
		
		$expectedArray = array(
			'id' => 1,
		);
		
		$this->assertEquals($expectedArray, $entity->toArray());
	}
	
	public function testToArrayException() {
		try {
			$missingGetterEntity = new MissingGetterEntity();
			$missingGetterEntity->setId(1);
			$missingGetterEntity->toArray();
		} catch(RuntimeException $expected) {
			return;
		}
		$this->fail();
	}
	
	public function testGetTable() {
		$table = $this->entity->getTable();
		
		$this->assertEquals('abstractimpl', $table);
	}
	
	public function testPrimaryKey() {
		$pk = $this->entity->getPrimaryKey();
		
		$this->assertEquals('id', $pk);
	}
	
	public function testCheckIntOK() {
		$result = $this->entity->checkInt(1);
		
		$this->assertTrue($result);
	}
	
	public function testCheckIntException() {
		try {
			$this->entity->checkInt('1');
		} catch(InvalidArgumentException $expected) {
			return;
		}
		$this->fail();
	}
	
	public function testCheckStringOK() {
		$result = $this->entity->checkString('string');
		
		$this->assertTrue($result);
	}
	
	public function testCheckStringException() {
		try {
			$this->entity->checkString(1);
		} catch(InvalidArgumentException $expected) {
			return;
		}
		$this->fail();
	}
	
	public function tearDown() {
		$this->entity = null;
	}
}

