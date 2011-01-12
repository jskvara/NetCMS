<?php

require_once APP_DIR .'/models/dao/IDAO.php';
require_once APP_DIR .'/models/dao/AbstractDAO.php';

class AbstractDAOImpl extends AbstractDAO {
	public function findAll() {}
	public function find($id) {}
	public function insert(IEntity $entity) {}
	public function update(IEntity $entity) {}
	public function delete($id) {}
}

class AbstractDAOTest extends PHPUnit_Framework_TestCase {
	
	public function testConstruct() {
	}
}

