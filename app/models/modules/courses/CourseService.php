<?php

class CourseService {
	
	protected $courseDAO;
	protected $courseConverter;
	protected $courseValidator;
	
	public function __construct() {
		$this->courseDAO = new DbCourseDAO();
		$this->courseConverter = new CourseConverter();
		$this->courseValidator = new CourseValidator();
	}
	
	public function getAll() {
		return $this->courseDAO->getAll();
	}
	
	public function get($id) {
		return $this->DAO->find($id);
	}
	
/*	public function add($date, $text) {
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
	}*/
}
