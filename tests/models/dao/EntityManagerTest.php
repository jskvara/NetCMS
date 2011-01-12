<?php

require_once APP_DIR .'/models/dao/EntityManager.php';

class EntityManagerPublic extends EntityManager {
	public function getTable($entityName) {
		return parent::getTable($entityName);
	}
}

class EntityManagerTest extends PHPUnit_Framework_TestCase {

	private $em;
	
	public function setUp() {
		$this->em = new EntityManagerPublic();
	}
	
	public function test() {
	}
	
	public function tearDown() {
		$this->em = null;
	}
	
}

