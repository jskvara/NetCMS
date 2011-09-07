<?php

class CourseService {
	
	protected $DAO;
	protected $converter;
	protected $validator;
	
	public function __construct() {
		$this->DAO = new DbCourseDAO();
		$this->converter = new CourseConverter();
		$this->validator = new CourseValidator();
	}
	
	public function getAll() {
		return $this->DAO->getAll();
	}
	
	public function get($id) {
		return $this->DAO->get($id);
	}
	
	public function add($name) {
		$entity = new CourseEntity(NULL, $name);

		try {
			$entity = $this->converter->convert($entity);
			$this->validator->validate($entity, IValidator::ADD);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->DAO->insert($entity);
		
		return TRUE;
	}
	
	public function edit($id, $name) {
		$entity = new CourseEntity($id, $name);
		try {
			$this->converter->convert($entity);
			$this->validator->validate($entity);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->DAO->update($entity);
		
		return TRUE;
	}
	
	public function delete($id) {
		$this->DAO->delete($id);
	}
}
