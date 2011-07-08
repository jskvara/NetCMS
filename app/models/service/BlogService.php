<?php

class BlogService {
	
	protected $DAO;
	protected $converter;
	protected $validator;
	
	public function __construct() {
		$this->DAO = new BlogDAO();
		$this->converter = new BlogConverter();
		$this->validator = new BlogValidator();
	}
	
	public function getAll() {
		return $this->DAO->findAll();
	}
	
	public function getVisible($limit = null, $offset = null) {
		return $this->DAO->findVisible($limit, $offset);
	}
	
	public function get($id) {
		return $this->DAO->find($id);
	}
	
	public function add($title, $text, $created, $visible) {
		$entity = new BlogEntity(null, $title, $text, $created, $visible);
		try {
			$this->converter->convert($entity);
			$this->validator->validateAdd($entity);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->DAO->insert($entity);
		
		return true;
	}
	
	public function edit($id, $title, $text, $created, $visible) {
		if ($this->validator->validateId($id) !== true) {
			throw new ServiceException($this->validator->getLastError());
		}
		
		$entity = new BlogEntity($id, $title, $text, $created, $visible);
		try {
			$this->converter->convert($entity);
			$this->validator->validate($entity);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->DAO->update($entity);
		
		return true;
	}
	
	public function delete($id) {
		if ($this->validator->validateId($id) !== true) {
			throw new ServiceException($this->validator->getLastError());
		}
		
		$this->DAO->delete($id);
	}
}

