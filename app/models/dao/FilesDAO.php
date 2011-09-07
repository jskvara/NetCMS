<?php

abstract class FilesDAO implements IDAO {
	abstract function getAll();
	
	abstract function get($id);
}

