<?php

abstract class AbstractDAO implements IDAO {
	
	protected $conn;
	
	public function __construct() {
		$this->conn = dibi::getConnection();
	}
	
}

