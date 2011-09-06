<?php

class BackupService implements IService {
	
	protected $backupDao;
	
	public function __construct($backupDao = NULL) {
		$this->backupDao = (!empty($backupDao)) ? $backupDao : new FileBackupDao();
	}
	
	public function getFiles() {
		return $this->backupDao->getAll();
	}
	
	public function get($file) {
		return $this->backupDao->get($file); 
	}
	
	public function delete($file) {
		return $this->backupDao->delete($file);
	}
	
	public function getDatabase() {
		$dbDump = $this->backupDao->getDbDump();
		$filename = $this->backupDao->getFilename("database", "sql");
		$path = $this->backupDao->getDir() ."/". $filename;
		
		file_put_contents($path, $dbDump);
		
		return $path;
	}
	
	public function getUserfiles() {
		$source = WWW_DIR ."/userfiles";
		$filename = $this->backupDao->getFilename("userfiles");
		$path = $this->backupDao->getDir() ."/". $filename;
		$this->backupService->createZip($source, $path);
		
		return $path;
	}
	
	public function getTemplates() {
		$source = APP_DIR ."/templates";
		$filename = $this->backupDao->getFilename("templates");
		$path = $this->backupDao->getDir() ."/". $filename;
		$this->backupService->createZip($source, $path);
		
		return $path;
	}
	
	/*public function getAll() {
		$this->clear();
		$database = $this->getDatabase();
		$userfiles = $this->getUserfiles();
		$templates = $this->getTemplates();
		
		$filename = $_SERVER["SERVER_NAME"] ."-". date("Ymd") .".zip";
		$destination = self::getBackupDir() ."/". $filename;
		$this->zip($this->getBackupDir(), $destination);
		
		return $destination;
	}
	
	public function clear() {
		$backup_dir = self::getBackupDir();
		
		$files = scandir($backup_dir);
		foreach ($files as $file) {
			if ($file !== "." && $file !== "..") {
				unlink($backup_dir ."/". $file); 
			}
		}
	}*/
}

