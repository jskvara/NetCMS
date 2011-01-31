<?php

class FileDAO extends AbstractDAO {
	
	protected $dir;
	protected $fileUtil;
	
	public function __construct() {
		$this->dir = WWW_DIR .'/'. Environment::getVariable('uploadDir');
		$this->fileUtil = new FileUtil();
		ini_set("memory_limit","15M");
	}
	
	public function findAll() {
		return $this->findAllFiles();
	}
	
	public function findAllFiles($folder = null) {
		if ($folder !== null) {
			$this->dir = $this->dir .'/'. $folder;
		}
		$files = $this->fileUtil->getFiles($this->dir);
		if (empty($files)) {
			return null;
		}
		
		return $files;
	}
	
	public function findAllImages($folder = null) {
		$dir = $this->dir;
		if ($folder !== null) {
			$dir = $dir .'/'. $folder;
		}
		$files = $this->fileUtil->getFiles($dir, array('.jpg', '.jpeg', '.gif', '.png'));
		if (empty($files)) {
			return null;
		}
		
		return $files;
	}
	
	public function findAllFolders() {
		$folders = $this->fileUtil->getFolders($this->dir);
		if (empty($folders)) {
			return null;
		}
		
		return $folders;
	}
	
	public function save($file, $folder = null, $thumb = false) {
		$filename = String::webalize($file->getName(), '.');
		
		if ($folder !== null) {
			if (!$this->exists($folder)) {
				throw new ServiceException("Složka neexistuje.");
			}
			$filename = $folder .'/'. $filename;
		}
		
		if ($this->exists($filename)) {
			throw new ServiceException("Soubor již existuje.");
		}
		
		if ($file->isImage() && $thumb) {
			$image = $file->getImage();
			$image->resize(100, 100);
			$image->sharpen();
			$thumbname = $this->makeThumbname($filename);
			$image->save($this->getFilename($thumbname));
		}
		
		return $file->move($this->getFilename($filename));
	}
	
	public function find($file) {
		if (!$this->exists($file)) {
			return null;
		}
		
		return $file;
	}
	
	public function isDir($file) {
		return $this->fileUtil->isDir($this->getFilename($file));
	}
	
	public function getDir($file) {
		return $this->fileUtil->getDir($file);
	}
	
	public function createFolder($folder) {
		if ($this->exists($folder)) {
			throw new ServiceException("Složka již existuje.");
		}
		$this->fileUtil->createFolder($this->getFilename($folder));
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
		if( $this->isDir($file) ) {
			return $this->fileUtil->deleteFolder($this->getFilename($file));
		} else {
			return $this->fileUtil->delete($this->getFilename($file));
		}
	}
	
	public function getFilename($name) {
		return $this->dir .'/'. $name;
	}
	
	protected function makeThumbname($filename) {
		return str_replace(".", "-thumb.", $filename);
	}

}

