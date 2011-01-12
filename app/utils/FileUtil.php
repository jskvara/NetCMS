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
				if ($filename != '.' && $filename != '..' && $filename[0] != '.') {
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
	
	public function save($filename, $content) {
		return file_put_contents('safe://'. $filename, $content);
	}
	
	public function delete($filename) {
		return unlink('safe://'. $filename);
	}

}
