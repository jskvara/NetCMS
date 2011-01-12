<?php

abstract class AbstractEntity implements IEntity {
	
	/*public function __construct(array $data = null) {
		$this->fromArray($data);
	}*/
		
	public function fromArray(array $data = null) {
		if ($data != null) {
			foreach ($data as $propertyName => $propertyValue) {
				$propertySetter = array($this, 'set'. UCFirst($propertyName));
				if (!is_callable($propertySetter)) {
					throw new RuntimeException("Entity '". get_class($this) ."' must implement 'set". UCFirst($propertyName) ."' method");
				}
				
				call_user_func($propertySetter, $propertyValue);
			}
		}
	}
	
	public function toArray() {
		$reflection = new ReflectionObject($this);
		$properties = $reflection->getProperties(ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PROTECTED);
		$data = array();
		
		foreach ($properties as $property) {
			$propertyName = $property->getName();
			$propertyGetter = array($this, 'get'. UCFirst($propertyName));
			
			if (!is_callable($propertyGetter)) {
				throw new RuntimeException("Entity '". get_class($this) ."' must implement 'get". UCFirst($propertyName) ."' method");
			}
			$propertyValue = call_user_func($propertyGetter);
			
			if ($propertyValue !== null) {
				$data[$propertyName] = $propertyValue;
			}
		}
		
		return $data;
	}
	
	public function getTable() {
		$class = get_class($this);
		$class = strToLower($class);
		$table = str_replace("entity", "", $class);
		
		return $table;
	}
	
	public function getPrimaryKey() {
		return 'id';
	}
	
	protected function checkInt($param) {
		if (!is_int($param) && !is_null($param)) {
			throw new InvalidArgumentException("Argument must be integer or null");
		}
		
		return true;
	}
	
	protected function checkString($param) {
		if (!is_string($param) && !is_null($param)) {
			throw new InvalidArgumentException("Argument must be string or null");
		}
		
		return true;
	}
	
	protected function checkDate($param) {
		if (!($param instanceof DateTime) && !is_null($param)) {
			throw new InvalidArgumentException("Argument must be date or null");
		}
		
		return true;
	}
	
}
