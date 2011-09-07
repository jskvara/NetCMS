<?php

abstract class AbstractConverter implements IConverter {
	
	protected $entity;
	
	public function convert(IEntity $entity) {
		$this->entity = $entity;
		$this->convertFields();
		
		return $this->entity;
	}
	
	abstract protected function convertFields();
	
	protected function convertInt($int) {
		if ($int === NULL) {
			return NULL;
		}
		
		return intval($int);
	}
	
	protected function convertIntField($field) {
		$value = $this->getValue($field);
		$value = $this->convertInt($value);
		$this->setValue($field, $value);
	}
	
	protected function convertString($string) {
		if ($string === NULL) {
			return NULL;
		}
		
		return strval($string);
	}
	
	protected function convertStringField($field) {
		$value = $this->getValue($field);
		$value = $this->convertString($value);
		$this->setValue($field, $value);
	}
	
	protected function convertBool($bool) {
		if ($bool === NULL) {
			return NULL;
		}
		
		return (bool) $bool;
	}
	
	protected function convertBoolField($field) {
		$value = $this->getValue($field);
		$value = $this->convertBool($value);
		$this->setValue($field);
	}
	
	protected function convertDate($date) {
		if ($date === NULL) {
			return NULL;
		}
		
		if (method_exists("DateTime", "createFromFormat")) {
			$date = DateTime::createFromFormat("j. n. Y", $date);
		} else {
			$date = str_replace(" ", "", $date);
			$date = strToTime($date);
		}
		if ($date === false) {
			throw new ConverterException("Chybný formát data.");
		}
		
		return $date;
	}
	
	protected function convertDateField($field) {
		$value = $this->getValue($field);
		$value = $this->convertDate($value);
		$this->setValue($field, $value);
	}
	
	private function getValue($field) {
		$getter = "get".ucfirst($field);
		if (!method_exists($this->entity, $getter)) {
			throw new InvalidStateException("Getter '". $getter ."' does not exist in class ". get_class($this->entity));
		}
		
		return $this->entity->$getter();
	}
	
	private function setValue($field, $value) {
		$setter = "set".ucfirst($field);
		if (!method_exists($this->entity, $setter)) {
			throw new InvalidStateException("Setter '". $setter ."' does not exist in class ". get_class($this->entity));
		}
		
		$this->entity->$setter($value);
	}
}

