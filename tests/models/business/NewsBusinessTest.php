<?php

require_once APP_DIR .'/models/business/IBusiness.php';
require_once APP_DIR .'/models/business/NewsBusiness.php';

class NewsDAOMock implements IDAO {

	public function findAll() {
		return null;
	}
	
	public function find($id) {
		$entity = new NewsEntity();
		$entity->setId($id);
		$entity->setTitle('title');
		$entity->setText('text');
		
		return $entity;
	}
	
	public function insert(IEntity $news) {
		return 1;
	}
	
	public function update(IEntity $news) {
		return true;
	}
		
	public function delete($id) {
		return true;
	}
}

class NewsBusinessTest extends PHPUnit_Framework_TestCase {

	private $newsBusiness;
	
	public function setUp() {
		$this->newsBusiness = new NewsBusiness(new NewsDAOMock());
	}

	public function testValidateOk() {
		$return = $this->newsBusiness->validate('title', 'text');
		
		$this->assertTrue($return);
	}
	
	public function testValidateErrors() {
		$errors = $this->newsBusiness->validate('', '');
		$this->assertTrue(count($errors) > 0);
		
		$errors2 = $this->newsBusiness->validate('Too long string greater than 255 characters. aaaaaaaaaaa
		aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
		aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '');
		
		$this->assertTrue(count($errors2) > 0);
	}
	
	public function testAdd() {
		$return = $this->newsBusiness->add('title', 'text', new DateTime());
		
		$this->assertTrue($return);
	}
	
	public function tearDown() {
		$this->newsBusiness = null;
	}
}

