<?php

class NewsService {
	
	protected $DAO;
	protected $converter;
	protected $validator;
	
	public function __construct() {
		$this->DAO = new NewsDAO();
		$this->converter = new NewsConverter();
		$this->validator = new NewsValidator();
	}
	
	public function getAll() {
		return $this->DAO->findAll();
	}
	
	public function getHomepageNews($limit = 5) {
		$homepageNews = $this->DAO->findVisible($limit);
		$homepageNews = $this->convertToDTO($homepageNews);
		
		return $homepageNews;
	}
	
	public function getNews($limit = null, $offset = null) {
		$news = $this->DAO->findVisible($limit, $offset);
		$news = $news = $this->convertToDTO($news);
		
		return $news;
	}
	
	public function getNewsCount() {
		return $this->DAO->findVisibleCount();
	}
	
	protected function convertToDTO(array $news) {
		$converted = array();
		foreach ($news as $item) {
			$converted[] = new NewsDTO($item);
		}
		
		return $converted;
	}
	
	public function get($id) {
		return $this->DAO->find($id);
	}
	
	public function add($title, $text, $created, $visible) {
		$news = new NewsEntity(null, $title, $text, $created, $visible);
		try {
			$this->converter->convert($news);
			$this->validator->validateAdd($news);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->DAO->insert($news);
		
		return true;
	}
	
	public function edit($id, $title, $text, $created, $visible) {
		if ($this->validator->validateId($id) !== true) {
			throw new ServiceException($this->validator->getLastError());
		}
		
		$news = new NewsEntity($id, $title, $text, $created, $visible);
		try {
			$this->converter->convert($news);
			$this->validator->validate($news);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$this->DAO->update($news);
		
		return true;
	}
	
	public function delete($id) {
		if ($this->validator->validateId($id) !== true) {
			throw new ServiceException($this->validator->getLastError());
		}
		
		$this->DAO->delete($id);
	}
}

