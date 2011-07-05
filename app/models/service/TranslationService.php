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
	
	public function getLanguage($url) {
		if (strlen($url) < 2) {
			return null;
		}
		
		if (strlen($url > 2) && substr($url, 2, 1) !== "/") {
			return null;
		}
		
		return substr($url, 0, 2);
	}
	
	public function getTranslation($url) {
		$translation = $this->DAO->findTranslation($url);
		if ($translation === false) {
			return null;
		}
		
		if ($translation->getOriginal() === $url) {
			return $translation->getTranslation();
		} else if ($translation->getTranslation() === $url) {
			return $translation->getOriginal();
		} else {
			return null;
		}
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
