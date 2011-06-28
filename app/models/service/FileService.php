<?php

class FileService {
	
	protected $DAO;
	protected $converter;
	protected $validator;
	
	public function __construct() {
		$this->DAO = new FileDAO();
	}
	
	public function getFiles($folder = null) {
		return $this->DAO->findAllFiles($folder);
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
		$this->DAO->delete($file);
	}
	
	public function addFolder($folder) {
		$this->DAO->createFolder($folder);
	}
}

