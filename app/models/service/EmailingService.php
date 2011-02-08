<?php

class EmailingService {
	
	protected $DAO;
	protected $converter;
	protected $validator;
	
	public function __construct() {
		$this->DAO = new EmailingDAO();
		$this->converter = new EmailingConverter();
		$this->validator = new EmailingValidator();
		$this->validator->setDAO($this->DAO);
	}
	
	public function getEmails() {
		return $this->DAO->findAll();
	}
	
	public function get($id) {
		return $this->DAO->find($id);
	}
	
	public function exists($email) {
		return (bool)$this->DAO->findByEmail($email);
	}
	
	public function add($email) {
		try {
			$entity = $this->converter->toEntity(null, $email);
			$this->validator->validateAdd($entity);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		return $this->DAO->insert($entity);
	}
	
	public function edit($id, $email) {
		$entity = null;
		try {
			$entity = $this->converter->toEntity($id, $email);
			$this->validator->validate($entity);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$oldEntity = $this->DAO->find($id);
		if ($entity === null || $oldEntity === null) {
			throw new ServiceException("E-mail neexistuje.");
		}
		$this->DAO->update($email);
		
		return true;
	}
	
	public function delete($id) {
		if (empty($id) || $id < 0) {
			throw new ServiceException("Id e-mailu nesmí být prázdné.");
		}
		
		$this->DAO->delete($id);
	}
	
	public function deleteByEmail($email) {
		$entity = $this->DAO->findByEmail($email);
		if ($entity === null) {
			throw new ServiceException("Tento e-mail neexistuje.");
		}
		
		$this->DAO->delete($entity->getId());
	}
}
