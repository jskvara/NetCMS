<?php

require_once $PROJECT_DIR .'/models/dao/NewsDAO.php';

class NewsDAOTest extends PHPUnit_Framework_TestCase
{
	private $newsDAO;
	
	public function setUp() {
		$this->newsDAO = new NewsDAO();
	}

/*	public function testId() {
		$this->page->setId(1);
		$this->assertEquals(1, $this->page->getId());
	}*/
	
	public function tearDown() {
		$this->newsDAO = null;
	}
}

