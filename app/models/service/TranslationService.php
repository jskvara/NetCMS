<?php

class TranslationService {
	
	protected $DAO;
	protected $converter;
	protected $validator;
	
	public function __construct() {
		$this->DAO = new TranslationDAO();
		$this->converter = new TranslationConverter();
		$this->validator = new TranslationValidator();
	}
	
	public function getAll() {
		return $this->DAO->findAll();
	}
	
	public function get($id) {
		return $this->DAO->find($id);
	}
	
	public function add($original, $translation) {
		$translation = new TranslationEntity(null, $original, $translation);
		try {
			$this->converter->convert($translation);
			$this->validator->validateAdd($translation);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->DAO->insert($translation);
		
		return true;
	}
	
	public function edit($id, $original, $translation) {
		if ($this->validator->validateId($id) !== true) {
			throw new ServiceException($this->validator->getLastError());
		}
		
		$translation = new TranslationEntity($id, $original, $translation);
		try {
			$this->converter->convert($translation);
			$this->validator->validate($translation);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->DAO->update($translation);
		
		return true;
	}
	
	public function delete($id) {
		if ($this->validator->validateId($id) !== true) {
			throw new ServiceException($this->validator->getLastError());
		}
		
		$this->DAO->delete($id);
	}
}
