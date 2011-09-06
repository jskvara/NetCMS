<?php

abstract class DbDAO extends AbstractDAO {
	
	abstract function getAll();
	
	abstract function get($id);
	
	// TODO common functions
}
