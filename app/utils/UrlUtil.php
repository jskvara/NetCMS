<?php

class UrlUtil {
	public static function createUrl($parentUrl, $name) {
		$parentUrl = trim($parentUrl, '/');
		// $name = trim($name, '/');
		if ($parentUrl !== '') {
			$parentUrl = $parentUrl .'/';
		}
		
		return $parentUrl . $name;
	}
	
	public static function getParentUrl($url) {
		$url = trim($url, '/');
		$parentUrl = substr($url, 0, strrpos($url, '/'));
		if ($parentUrl === false) {
			return '';
		}
		
		return $parentUrl;
	}
}
