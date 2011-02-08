<?php

class EmailingDAO extends AbstractDAO {
	
	protected $table = "emailing";
	protected $pk = "id";
	
	public function findAll() {
		$query = $this->conn->select("*")->from($this->table)->orderBy("id", dibi::ASC);
		
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		return $result->fetchAll();
	}
	
	public function find($id) {
		$query = $this->conn->select("*")->from($this->table)->where($this->pk."=%i", $id)->limit(1);
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		$entity = $result->fetch();
		if ($entity === false) {
			return null;
		}
		
		return $entity;
	}
	
	public function findByEmail($email) {
		$query = $this->conn->select("*")->from($this->table)->where("email=%s", $email)->limit(1);
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		$entity = $result->fetch();
		if ($entity === false) {
			return null;
		}
		
		return $entity;
	}
	
	public function insert(IEntity $entity) {
		$data = $entity->toArray();
		
		$this->conn->insert($this->table, $data)->execute(dibi::IDENTIFIER);
		
		return $this->conn->insertId();
	}
	
	public function update(IEntity $entity) {
		throw new NotImplementedException("Method ". __METHOD__ ." cannot be called.");
	}
		
	public function delete($id) {
		return $this->conn->delete($this->table)->where($this->pk ."=%i", $id)->execute();
	}
	
	protected function setRowClass(DibiResult $result) {
		$result = $result->setRowClass("EmailingEntity")->setType("id", dibi::INTEGER);
		
		return $result;
	}
}
