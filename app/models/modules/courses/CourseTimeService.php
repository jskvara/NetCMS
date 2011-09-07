<?php

class CourseTimeService {
	
	protected $DAO;
	protected $converter;
	protected $validator;
	
	public function __construct() {
		$this->DAO = new DbCourseTimeDAO();
		$this->converter = new CourseTimeConverter();
		$this->validator = new CourseTimeValidator();
	}
	
	public function getAll($courseId) {
		return $this->DAO->getAll($courseId);
	}
	
	public function get($id) {
		return $this->DAO->get($id);
	}
	
	public function add($courseId, $date) {
		$entity = new CourseTimeEntity(NULL, $courseId, $date);

		try {
			$entity = $this->converter->convert($entity);
			$this->validator->validate($entity, IValidator::ADD);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->DAO->insert($entity);
		
		return TRUE;
	}
	
	public function edit($id, $courseId, $date) {
		$entity = new CourseTimeEntity($id, $courseId, $date);
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
