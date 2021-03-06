<?php

class TemplateService {
	
	protected $DAO;
	protected $converter;
	protected $validator;
	
	public function __construct() {
		$this->DAO = new TemplateDAO();
		$this->cssDAO = new CssDAO();
		$this->converter = new TemplateConverter();
		$this->validator = new TemplateValidator();
		$this->validator->setDAO($this->DAO);
	}
	
	public function getTemplateFile($name) {
		return $this->DAO->getFilename($name);
	}
	
	public function getAll() {
		return $this->DAO->findAll();
	}
	
	public function getSelect() {
		$templates = $this->DAO->findAll();
		$select = array();
		foreach ($templates as $key => $template) {
			$name = $template->getName();
			if (!$this->isLayout($name) && !$this->isControl($name)) {
				$select[$name] = $name;
			}
		}
		
		return $select;
	}
	
	protected function isLayout($name) {
		return String::startsWith($name, '@');
	}
	
	protected function isControl($name) {
		return String::endsWith($name, 'Control');
	}
	
	public function get($name) {
		return $this->DAO->find($name);
	}
	
	public function add($name, $content) {
		try {
			$template = $this->converter->toEntity($name, $content);
			$this->validator->validateAdd($template);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->DAO->insert($template);
		
		return true;
	}
	
	public function edit($name, $content) {
		try {
			$template = $this->converter->toEntity($name, $content);
			$this->validator->validate($template);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->DAO->update($template);
		
		return true;
	}
	
	public function delete($name) {
		$this->DAO->delete($name);
		
		return true;
	}
	
	public function getCssAll() {
		return $this->cssDAO->findAll();
	}
	
	public function getCss($name) {
		return $this->cssDAO->find($name);
	}
	
	public function addCss($name, $content) {
		try {
			$template = $this->converter->toEntity($name, $content);
			$this->validator->validateAdd($template);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->cssDAO->insert($template);
		
		return true;
	}
	
	public function editCss($name, $content) {
		try {
			$template = $this->converter->toEntity($name, $content);
			$this->validator->validate($template);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->cssDAO->update($template);
		
		return true;
	}
	
	public function deleteCss($name) {
		$this->cssDAO->delete($name);
		
		return true;
	}
}
