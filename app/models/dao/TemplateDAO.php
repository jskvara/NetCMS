<?php

class TemplateDAO extends AbstractDAO {
	
	protected $dir;
	protected $extension;
	
	public function __construct() {
		$this->dir = APP_DIR .'/templates';
		$this->extension = '.phtml';
		$this->fileUtil = new FileUtil();
	}
		
	public function findAll() {
		$fileEntities = array();
		
		$files = $this->fileUtil->getFiles($this->dir);
		if (empty($files)) {
			return null;
		}
		
		foreach ($files as $key => $file) {
			$filename = str_replace($this->extension, '', $file);
			$fileEntities[] = new TemplateEntity($filename);
		}
		
		return $fileEntities;
	}
	
	public function find($name) {
		if (!$this->exists($name)) {
			return null;
		}
		
		$content = $this->fileUtil->getContent($this->getFilename($name));
		$template = new TemplateEntity($name, $content);
		
		return $template;
	}
	
	public function exists($name) {
		return $this->fileUtil->exists($this->getFilename($name));
	}
	
	public function insert(IEntity $template) {
		return $this->fileUtil->save($this->getFilename($template->getName()), $template->getContent());
	}
	
	public function update(IEntity $template) {
		return $this->fileUtil->save($this->getFilename($template->getName()), $template->getContent());
	}
		
	public function delete($name) {
		return $this->fileUtil->delete($this->getFilename($name));
	}
	
	public function getFilename($name) {
		return $this->dir .'/'. $name . $this->extension;
	}

}

