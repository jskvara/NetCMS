<?php

class SeedDAO extends AbstractDAO {
	
	protected $table = 'seed';
	protected $pk = 'id';
	
	public function findAll($limit = null, $offset = null) {
		$query = $this->conn->select('*')->from($this->table)->orderBy('id', dibi::ASC);
		if ($limit != null) { $query->limit($limit); }
		if ($offset != null) { $query->offset($offset); }
		
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		return $result->fetchAll();
	}
	
	public function find($id) {
		$query = $this->conn->select('*')->from($this->table)->where($this->pk.'=%i', $id)->limit(1);
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		$seed = $result->fetch();
		if ($seed === false) {
			return null;
		}
		
		return $seed;
	}
	
	public function insert(IEntity $news) {
		$data = $news->toArray();
		
		$this->conn->insert($this->table, $data)->execute(dibi::IDENTIFIER);
		
		return $this->conn->insertId();
	}
	
	public function update(IEntity $news) {
		$data = $news->toArray();
		if (array_key_exists($this->pk, $data)) {
			unset($data[$this->pk]);
		}
		
		return $this->conn->update($this->table, $data)->where($this->pk .'=%i', $news->getId())->execute();
	}
		
	public function delete($id) {
		return $this->conn->delete($this->table)->where($this->pk .'=%i', $id)->execute();
	}
	
	protected function setRowClass(DibiResult $result) {
		$result = $result->setRowClass('SeedEntity')->setType('id', dibi::INTEGER);
		
		return $result;
	}
}
