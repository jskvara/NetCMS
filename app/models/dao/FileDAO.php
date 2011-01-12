<?php

class FileDAO extends AbstractDAO {
	
	protected $dir;
	protected $fileUtil;
	
	public function __construct() {
		$this->dir = WWW_DIR .'/'. Environment::getVariable('uploadDir');
		$this->fileUtil = new FileUtil();
	}
	
	public function findAll() {
		$files = $this->fileUtil->getFiles($this->dir);
		if (empty($files)) {
			return null;
		}
		
		return $files;
	}
	
	public function findAllImages() {
		$files = $this->fileUtil->getFiles($this->dir, array('.jpg', '.jpeg', '.gif', '.png'));
		if (empty($files)) {
			return null;
		}
		
		return $files;
	}
	
	public function save($file) {
		$filename = String::webalize($file->getName(), '.');
		return $file->move($this->dir .'/'. $filename);
	}
	
	public function find($file) {
		if (!$this->exists($file)) {
			return null;
		}
		
		return $file;
	}
	
	public function exists($name) {
		return $this->fileUtil->exists($this->getFilename($name));
	}
	
	public function insert(IEntity $file) {
		throw new NotImplementedException('Method '. __METHOD__ .' cannot be called.');
	}
	
	public function update(IEntity $file) {
		throw new NotImplementedException('Method '. __METHOD__ .' cannot be called.');
	}
		
	public function delete($file) {
		return $this->fileUtil->delete($this->getFilename($file));
	}
	
	public function getFilename($name) {
		return $this->dir .'/'. $name;
	}

}

