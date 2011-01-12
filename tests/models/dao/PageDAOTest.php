<?php

require_once $PROJECT_DIR .'/models/dao/PageDAO.php';

class PageDAOTest extends PHPUnit_Framework_TestCase
{
	private $pageDAO;
	
	public function setUp() {
		$this->pageDAO = new PageDAO();
	}

/*	public function testId() {
		$this->page->setId(1);
		$this->assertEquals(1, $this->page->getId());
	}*/
	
	public function tearDown() {
		$this->pageDAO = null;
	}
}

