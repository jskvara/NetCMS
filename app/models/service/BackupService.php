<?php

class BackupService {
	
	protected $DAO;
	
	public function getDatabase() {
		$dbDump = $this->getDbDump();
		
		$filename = $_SERVER["SERVER_NAME"] ."-". date("Ymd") ."-database.sql";
		$file = self::getBackupDir() ."/". $filename;
		file_put_contents($file, $dbDump);
		
		return $file;
	}
	
	public function getUserfiles() {
		$source = WWW_DIR ."/userfiles";
		$filename = $_SERVER["SERVER_NAME"] ."-". date("Ymd") ."-userfiles.zip";
		$destination = self::getBackupDir() ."/". $filename;
		$this->zip($source, $destination);
		
		return $destination;
	}
	
	public function getTemplates() {
		$source = APP_DIR ."/templates";
		$filename = $_SERVER["SERVER_NAME"] ."-". date("Ymd") ."-templates.zip";
		$destination = self::getBackupDir() ."/". $filename;
		$this->zip($source, $destination);
		
		return $destination;
	}
	
	public function getAll() {
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
	}
	
	protected static function getBackupDir() {
		$backup_dir = APP_DIR ."/temp/backup";
		if (file_exists($backup_dir) === FALSE) {
			mkdir($backup_dir);
		}
		
		return $backup_dir;
	}
	
	protected function getDbDump() {
		$file  = "##\n";
		$file .= "## Database dump for server: ". $_SERVER["SERVER_NAME"] ."\n";
		$file .= "##\n";
		$file .= "\n";
		$file .= "# DROP\n";
		$tables = array();
		foreach (dibi::query("SHOW TABLES") as $table) {
			$table = reset($table);
			$tables[] = $table;
			$file .= "DROP TABLE IF EXISTS `$table`;\n";
		}
		$file .= "\n";
		
		foreach ($tables as $table) {
			$file .= "## Table ". $table ."\n";
			$row = dibi::fetch("SHOW CREATE TABLE %n", $table);
			$file .= $row["Create Table"] .";\n";
			$file .= "\n";
			
			$driver = dibi::getConnection()->getDriver();
			//$columns = dibi::query("SHOW COLUMNS FROM %n", $table)->fetchAssoc("Field");
			foreach (dibi::query("SELECT * FROM %n", $table) as $row) {
				$file .= "INSERT INTO `". $table ."` VALUES\n";				
				foreach ($row as $field => $value) {
					$row[$field] = $driver->escape($value, dibi::TEXT);
				}
				$file .= "(". implode(", ", (array)$row). ");\n";
			}
			$file .= "\n";
		}
		
		return $file;
	}
	
	protected function zip($source, $destination) {
		if (!extension_loaded("zip")) {
			throw new ServiceException("Zip extension is not loaded.");
		}
		
		if (!file_exists($source)) {
			throw new ServiceException("Source folder ". $source ." does not exist.");
		}
		
		$zip = new ZipArchive();

		if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
			$source = realpath($source);

			if (is_dir($source)) {
				$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
				foreach ($files as $file) {
					$file = realpath($file);
					if (is_dir($file)) {
						$zip->addEmptyDir(str_replace($source ."/", "", $file ."/"));
					} else if (is_file($file)) {
						$zip->addFromString(str_replace($source ."/", "", $file), file_get_contents($file));
					}
				}
			} else if (is_file($source)) {
				$zip->addFromString(basename($source), file_get_contents($source));
			}
		}

		return $zip->close();
	}
}

