<?php

// TODO: autoload, one configuration

error_reporting(E_ALL);

define('TEST_DIR', dirname(__FILE__));
define('WWW_DIR', dirname(__FILE__) .'/..');
define('APP_DIR', dirname(__FILE__) . '/../app');
define('LIBS_DIR', dirname(__FILE__) . '/../libs');

// include PHPUnit
// set_include_path(dirname(__FILE__) .'/../libs'. PATH_SEPARATOR . get_include_path());
require_once LIBS_DIR .'/PHPUnit/Framework.php';

// include Nette loader
require_once LIBS_DIR .'/Nette/loader.php';
Debug::enable();
Environment::loadConfig();

date_default_timezone_set('Europe/Prague');
setLocale(LC_ALL, 'cs_CZ');

// Tests
require_once TEST_DIR .'/models/entity/AbstractEntityTest.php';
require_once TEST_DIR .'/models/entity/PageEntityTest.php';
require_once TEST_DIR .'/models/entity/NewsEntityTest.php';
require_once TEST_DIR .'/models/dao/EntityManagerTest.php';
require_once TEST_DIR .'/models/dao/AbstractDAOTest.php';
require_once TEST_DIR .'/models/business/NewsBusinessTest.php';
require_once TEST_DIR .'/models/vo/NewsVOTest.php';
require_once TEST_DIR .'/models/service/ServiceExceptionTest.php';

class AllTests
{
	public static function suite()
	{
		$suite = new PHPUnit_Framework_TestSuite();
		$suite->addTestSuite('AbstractEntityTest');
		$suite->addTestSuite('PageEntityTest');
		$suite->addTestSuite('NewsEntityTest');
		$suite->addTestSuite('EntityManagerTest');
		$suite->addTestSuite('AbstractDAOTest');
		$suite->addTestSuite('NewsBusinessTest');
		$suite->addTestSuite('NewsVOTest');
		$suite->addTestSuite('ServiceExceptionTest');
		
		return $suite;
	}
}

