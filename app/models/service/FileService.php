<?php

class FileService {
	
	protected $DAO;
	protected $converter;
	protected $validator;
	
	public function __construct() {
		$this->DAO = new FileDAO();
	}
	
	public function getAll() {
		return $this->DAO->findAll();
	}
	
	public function getImages() {
		return $this->DAO->findAllImages();
	}
	
	public function get($file) {
		return $this->DAO->find($file);
	}
	
	public function add($file) {
		try {
			if ($file->isOk()) {				
				$this->DAO->save($file);
			} else {
				throw new ServiceException('Obrázek se nezdařilo nahrát na server.');
			}
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		return true;
	}
	
	public function delete($file) {
		$this->DAO->delete($file);
	}
}

