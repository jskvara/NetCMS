<?php

class FileUtil {
	
	public function __construct() {
		if (!in_array('safe', stream_get_wrappers())) {
			SafeStream::register();
		}
	}
	
	public function getFiles($dir, array $extensions = array()) {
		$files = array();
		
		if ($handle = opendir($dir)) {
			while (false !== ($filename = readdir($handle))) {
				if (is_file($dir .'/'. $filename) && $filename != '.' && $filename != '..' && $filename[0] != '.') {
					if (!empty($extensions) ) {
						$fileExt = substr($filename, strrpos($filename, '.'));
						if(in_array($fileExt, $extensions)) {
							$files[] = $filename;
						}
					} else {
						$files[] = $filename;
					}
				}
			}
			closedir($handle);
		}
		sort($files);
		
		// $files = glob($dir .'/'. $pattern);
		
		return $files;
	}
	
	public function getFolders($dir) {
		$folders = array();
		
		if ($handle = opendir($dir)) {
			while (false !== ($filename = readdir($handle))) {
				if (is_dir($dir .'/'. $filename) && $filename != '.' && $filename != '..') {
					$folders[] = $filename;
				}
			}
			closedir($handle);
		}
		sort($folders);
		
		return $folders;
	}
	
	public function getContent($filename) {
		$content = file_get_contents('safe://'. $filename);
		if ($content === false) {
			return null;
		}
		
		return $content;
	}
	
	public function exists($filename) {
		return file_exists($filename);
	}
	
	public function isDir($filename) {
		return is_dir($filename);
	}
	
	public function getDir($filename) {
		return dirname($filename);
	}
	
	public function save($filename, $content) {
		return file_put_contents('safe://'. $filename, $content);
	}
	
	public function createFolder($foldername) {
		mkdir($foldername);
	}
	
	public function delete($filename) {
		return unlink('safe://'. $filename);
	}
	
	public function deleteFolder($foldername) {
		return rmdir($foldername);
	}

}
