<?php

abstract class AbstractDAO implements IDAO {
	
	// protected $em;
	protected $conn;
	
	public function __construct() {
		// $this->em = Environment::getVariable('em');
		$this->conn = dibi::getConnection();
	}
	
}

