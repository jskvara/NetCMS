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
		
		$date = DateTime::createFromFormat('j. n. Y', $date);
		if ($date === false) {
			throw new ConverterException(array('Chybný formát data.'));
		}
		
		return $date;
	}
}

