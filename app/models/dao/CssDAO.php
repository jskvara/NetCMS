<?php

class CssDAO extends AbstractDAO {
	
	protected $dir;
	protected $extension;
	protected $fileUtil;
	protected $exclude;
	
	public function __construct() {
		$this->dir = WWW_DIR .'/css';
		$this->extension = '.css';
		$this->fileUtil = new FileUtil();
		$this->exclude = array("admin", "login");
	}
		
	public function findAll() {
		$fileEntities = array();
		
		$files = $this->fileUtil->getFiles($this->dir);
		if (empty($files)) {
			return null;
		}
		
		foreach ($files as $key => $file) {
			$filename = str_replace($this->extension, '', $file);
			if ($this->isExcluded($filename)) {
				continue;
			}
			$fileEntities[] = new TemplateEntity($filename);
		}
		
		return $fileEntities;
	}
	
	public function find($name) {
		if ($this->isExcluded($name)) {
			return null;
		}
		
		if (!$this->exists($name)) {
			return null;
		}
		
		$content = $this->fileUtil->getContent($this->getFilename($name));
		$template = new TemplateEntity($name, $content);
		
		return $template;
	}
	
	public function exists($name) {
		if ($this->isExcluded($name)) {
			return false;
		}
		
		return $this->fileUtil->exists($this->getFilename($name));
	}
	
	public function insert(IEntity $template) {
		try {
			return $this->fileUtil->save($this->getFilename($template->getName()), $template->getContent());
		} catch (IOException $e) {
			throw new ServiceException($e->getMessage());
		}
	}
	
	public function update(IEntity $template) {
		try {
			return $this->fileUtil->save($this->getFilename($template->getName()), $template->getContent());
		} catch (IOException $e) {
			throw new ServiceException($e->getMessage());
		}
	}
		
	public function delete($name) {
		try {
			return $this->fileUtil->delete($this->getFilename($name));
		} catch (IOException $e) {
			throw new ServiceException($e->getMessage());
		}
	}
	
	public function getFilename($name) {
		return $this->dir .'/'. $name . $this->extension;
	}
	
	protected function isExcluded($name) {
		return in_array($name, $this->exclude);
	}
}

