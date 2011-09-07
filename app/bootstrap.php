<?php

// Step 1: Load Nette Framework
// this allows load Nette Framework classes automatically so that
// you don't have to litter your code with 'require' statements
require LIBS_DIR . '/Nette/loader.php';

// Load Zend
// set_include_path(dirname(__FILE__) .'/../libs/:'. get_include_path());
// require_once 'Zend/Loader.php';


// Step 2: Configure environment
// 2a) enable Debug for better exception and error visualisation
Debug::enable(Debug::DEVELOPMENT, null, 'jskvara@gmail.com');Debug::$strictMode = true;Debug::enableProfiler();

// 2b) load configuration from config.ini file
Environment::loadConfig();


// Step 3: Configure application
$application = Environment::getApplication();

// Step 3a: Configure database connection
dibi::connect(Environment::getConfig('database'));

// Step 3b: Set debug
Debug::$counters['Last SQL query'] = & dibi::$sql;

// Step 3c: Service Locator
//$sl = Environment::getServiceLocator();
//$sl->addService('pageDAO', new PageDAO());

// Step 4: Setup application router
$router = $application->getRouter();

// mod_rewrite detection
//if (function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules())) {
	// AdminModule routes
	$router[] = new Route('admin/<presenter>/<action>/<id>', array(
	    'module'    => 'Admin',
	    'presenter' => 'Default',
	    'action'    => 'default',
	    'id'        => null,
	));
	
	/*$router[] = new Route('index.php', array(
		'module'    => 'Front',
		'presenter' => 'Default',
	), Route::ONE_WAY);*/

	Route::$styles['url'] = array(
		Route::PATTERN => '.*?',
	);
	
	$router[] = new Route('<url>/', array(// <url>.html
		'module'    => 'Front',
		'presenter' => 'Default',
		'action'    => 'default',
		'url'        => '',
	));

//} else {
//	$router[] = new SimpleRouter('Front:Default:default');
//}

// Step 5: Run the application!
$application->run();

