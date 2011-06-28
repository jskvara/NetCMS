<?php

abstract class AbstractConverter implements IConverter {
	
	protected function convertInt($int) {
		if ($int === null) {
			return null;
		}
		
		return intval($int);
	}
	
	protected function convertBool($bool) {
		if ($bool === null) {
			return null;
		}
		
		return (bool) $bool;
	}
	
	protected function convertDate($date) {
		if ($date === null) {
			return null;
		}
		
		if (method_exists(new DateTime(), "createFromFormat")) {
			$date = DateTime::createFromFormat('j. n. Y', $date);
		} else {
			$date = str_replace(" ", "", $date);
			$date = strToTime($date);
		}
		if ($date === false) {
			throw new ConverterException("Chybný formát data.");
		}
		
		return $date;
	}
}

