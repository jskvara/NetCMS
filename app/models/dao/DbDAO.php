<?php

abstract class DbDAO extends AbstractDAO {
	
	abstract protected function getTableName();
	
	abstract protected function getPrimaryKeyName();
	
	abstract protected function setRowClass(DibiResult $result);
	
	public function getAll($limit = NULL, $offset = NULL, $orderBy = NULL, $order = "ASC") {
		$query = $this->conn->select("*")->from($this->getTableName());
		
		if ($orderBy !== NULL) {
			$query->orderBy($orderBy, $order);
		} else {
			$query->orderBy($this->getPrimaryKeyName(), $order);
		}
		if ($limit !== NULL) {
			$query->limit($limit);
		}
		if ($offset !== NULL) {
			$query->offset($offset);
		}
		
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		return $result->fetchAll();
	}
	
	public function get($id) {
		$query = $this->conn->select("*")->from($this->getTableName())->where($this->getPrimaryKeyName()."=%i", $id)->limit(1);
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		return $result->fetch();
	}
	
	public function insert(IEntity $entity) {
		$data = $entity->toArray();
		
		return $this->conn->insert($this->getTableName(), $data)->execute(dibi::IDENTIFIER);
	}
	
	public function update(IEntity $entity) {
		$data = $entity->toArray();
		if (array_key_exists($this->getPrimaryKeyName(), $data)) {
			unset($data[$this->getPrimaryKeyName()]);
		}
		$query = $this->conn->update($this->getTableName(), $data)->where($this->getPrimaryKeyName() ."=%i", $entity->getId());
		
		return $query->execute();
	}
	
	public function delete($id) {
		return $this->conn->delete($this->getTableName())->where($this->getPrimaryKeyName() ."=%i", $id)->execute();
	}
}
