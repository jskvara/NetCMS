<?php

class FileService {
	
	protected $DAO;
	protected $converter;
	protected $validator;
	
	public function __construct() {
		$this->DAO = new FileDAO();
	}
	
	public function getFiles($folder = null) {
		$files = $this->DAO->findAllFiles($folder);
		
		$items = array();
		foreach ($files as $file) {
			if ($this->isThumb($file)) {
				continue;
			}
			$items[] = $file;
		}
		
		return $items;
	}
	
	protected function isThumb($name) {
		return strpos($name, "-thumb.") !== false;
	}
	
	public function getImages($folder = null) {
		return $this->DAO->findAllImages($folder);
	}
	
	public function getFolders() {
		return $this->DAO->findAllFolders();
	}
	
	public function get($file) {
		return $this->DAO->find($file);
	}
	
	public function isDir($file) {
		return $this->DAO->isDir($file);
	}
	
	public function getDir($file) {
		return $this->DAO->getDir($file);
	}
	
	public function add($file, $folder = null, $thumb = false) {
		try {
			if ($file->isOk()) {
				$this->DAO->save($file, $folder, $thumb);
			} else {
				throw new ServiceException('Soubor se nezdařilo nahrát na server.');
			}
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		return true;
	}
	
	public function delete($file) {
		try {
			$this->DAO->delete($file);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
	}
	
	public function addFolder($folder) {
		try {
			$this->DAO->createFolder($folder);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
	}
}

