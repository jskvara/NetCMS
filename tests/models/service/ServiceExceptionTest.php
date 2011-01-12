<?php

require_once APP_DIR .'/models/service/ServiceException.php';

class ServiceExceptionTest extends PHPUnit_Framework_TestCase
{
	
	public function setUp() {
	}
	
	public function testConstructArray() {
		$errors = array('error1', 'error2');
		try {
			throw new ServiceException($errors);
		} catch(ServiceException $e) {
			$this->assertEquals($errors, $e->getValidationErrors());
			return;
		}
		$this->fail();
	}
	
	public function testConstructString() {
		$error = 'error';
		try {
			throw new ServiceException($error);
		} catch(ServiceException $e) {
			$this->assertEquals(null, $e->getValidationErrors());
			return;
		}
		$this->fail();
	}
	
	public function tearDown() {
	}
}

