<?php

class CalendarService {
	
	protected $DAO;
	protected $converter;
	protected $validator;
	
	public function __construct() {
		$this->DAO = new CalendarDAO();
		$this->converter = new CalendarConverter();
		$this->validator = new CalendarValidator();
	}
	
	public function getAll() {
		return $this->DAO->findAll();
	}
	
	public function getAllOrderByDate() {
		return $this->DAO->findAll(null, null, 'date', 'DESC');
	}
	
	public function get($id) {
		return $this->DAO->find($id);
	}
	
	public function add($date, $text) {
		$calendar = new CalendarEntity(null, $date, $text);
		try {
			$this->converter->convert($calendar);
			$this->validator->validateAdd($calendar);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->DAO->insert($calendar);
		
		return true;
	}
	
	public function edit($id, $date, $text) {
		if ($this->validator->validateId($id) !== true) {
			throw new ServiceException($this->validator->getLastError());
		}
		
		$calendar = new CalendarEntity($id, $date, $text);
		try {
			$this->converter->convert($calendar);
			$this->validator->validate($calendar);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->DAO->update($calendar);
		
		return true;
	}
	
	public function delete($id) {
		if ($this->validator->validateId($id) !== true) {
			throw new ServiceException($this->validator->getLastError());
		}
		
		$this->DAO->delete($id);
	}
	
	public function getHomepageNews() {
		return $this->DAO->findAll(5);
	}	
}
