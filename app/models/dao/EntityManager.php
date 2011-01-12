<?php

class EntityManager {
	
	protected $conn;
	
	public function __construct($conn = null) {
		$this->conn = $conn;
	}
	
	public function persist($entity) {
		$table = $entity->getTable();
		$data = $entity->toArray();
		
		return $this->conn->insert($table, $data)->execute(dibi::IDENTIFIER);
	}
	
	public function merge($entity) {
		$table = $entity->getTable();
		$data = $entity->toArray();
		if (empty($data)) {
			throw new IllegalStateException("Entity '". get_class($entity) ."' has no data");
		}
		$pk = $entity->getPrimaryKey();
		if (!array_key_exists($pk, $data)) {
			throw new LogicException("Entity '". get_class($entity) ."' has not set primary key");
		}
		$id = $data[$pk];
		$data[$pk] = null;
		$where = $this->buildWhere($pk, $id);
		
		return $this->conn->update($table, $data)->where($where, $id)->execute();
	}
	
	public function find($entity, $id) {
		$table = $entity->getTable();
		$pk = $entity->getPrimaryKey();
		$where = $this->buildWhere($pk, $id);
		
		return $this->conn->select('*')->from($table)->where($where, $id)->fetch();
	}
	
	public function remove($entity, $id) {
		$table = $entity->getTable();
		$pk = $entity->getPrimaryKey();
		$where = $this->buildWhere($pk, $id);
		
		return $this->conn->delete($table)->where($where, $id)->execute();
	}
	
	protected function buildWhere($idColumn, $id) {
		if (is_int($id)) {
			$where = $idColumn.'=%i';
		} else {
			$where = $idColumn.'=%s';
		}
		
		return $where;
	}
}
