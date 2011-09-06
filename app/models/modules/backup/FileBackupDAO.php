<?php

class FileBackupDAO extends FilesDAO {
	
	protected $dir;
	protected $fileUtil;
	
	public function __construct() {
		$this->fileUtil = new FileUtil();
		$this->dir = APP_DIR ."/temp/backup";
		$this->createDirIfNotExists();
	}
	
	protected function createDirIfNotExists() {
		if (file_exists($this->dir) === FALSE) {
			mkdir($this->dir);
		}
	}
	
	public function getAll() {
		return $this->fileUtil->getFiles($this->dir);
	}
	
	public function get($filename) {
		$path = $this->dir ."/". $filename;
		if (!file_exists($path)) {
			return NULL;
		}
		
		return $path;
	}
	
	public function getDir() {
		return $this->dir;
	}
	
	public function getFilename($type, $suffix = 'zip') {
		return $_SERVER["SERVER_NAME"] ."-". date("Y-m-d-H-i-s") ."-". $type .".". $suffix;
	}
	
	public function getDbDump() {
		$dbDump  = "##\n";
		$dbDump .= "## Database dump for server: ". $_SERVER["SERVER_NAME"] ."\n";
		$dbDump .= "##\n";
		$dbDump .= "\n";
		$dbDump .= "# DROP\n";
		
		$tables = array();
		foreach (dibi::query("SHOW TABLES") as $table) {
			$table = reset($table);
			$tables[] = $table;
			$dbDump .= "DROP TABLE IF EXISTS `$table`;\n";
		}
		$dbDump .= "\n";
		
		foreach ($tables as $table) {
			$dbDump .= "## Table ". $table ."\n";
			$row = dibi::fetch("SHOW CREATE TABLE %n", $table);
			$dbDump .= $row["Create Table"] .";\n";
			$dbDump .= "\n";
			
			$driver = dibi::getConnection()->getDriver();
			//$columns = dibi::query("SHOW COLUMNS FROM %n", $table)->fetchAssoc("Field");
			foreach (dibi::query("SELECT * FROM %n", $table) as $row) {
				$dbDump .= "INSERT INTO `". $table ."` VALUES\n";				
				foreach ($row as $field => $value) {
					$row[$field] = $driver->escape($value, dibi::TEXT);
				}
				$dbDump .= "(". implode(", ", (array)$row). ");\n";
			}
			$dbDump .= "\n";
		}
		
		return $dbDump;
	}
	
	public function createZip($source, $destination) {
		if (!extension_loaded("zip")) {
			throw new ModelException("Zip extension is not loaded.");
		}
		
		if (!file_exists($source)) {
			throw new ModelException("Source folder ". $source ." does not exist.");
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
	
	
	
	public function findAll() {
		throw new InvalidStateException("Method ". __METHOD__ ." is deprecated.");
	}
	
	public function find($id) {
		throw new InvalidStateException("Method ". __METHOD__ ." is deprecated.");
	}
		
	public function insert(IEntity $file) {
		throw new NotImplementedException('Method '. __METHOD__ .' is not implemented.');
	}
	
	public function update(IEntity $file) {
		throw new NotImplementedException('Method '. __METHOD__ .' is not implemented.');
	}
		
	public function delete($filename) {
		$path = $this->get($filename);
		if ($path === NULL) {
			throw new ServiceException('Soubor neexistuje.');
		}
		
		return $this->fileUtil->delete($path);
	}
}

