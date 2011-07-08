<?php

class BlogDAO extends AbstractDAO {
	
	protected $table = 'blog';
	protected $pk = 'id';
	
	public function findAll($limit = null, $offset = null) {
		$query = $this->conn->select('*')->from($this->table)->orderBy('created', dibi::DESC);
		if ($limit != null) { $query->limit($limit); }
		if ($offset != null) { $query->offset($offset); }
		
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		return $result->fetchAll();
	}
	
	public function findVisible($limit = null, $offset = null) {
		$query = $this->conn->select('*')->from($this->table)->where('visible=%i', 1)->orderBy('created', dibi::DESC);
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
		
		return $result->fetch();
	}
	
	public function insert(IEntity $news) {
		$data = $news->toArray();
		$data = $this->convertDate($data);
		
		return $this->conn->insert($this->table, $data)->execute(dibi::IDENTIFIER);
	}
	
	public function update(IEntity $news) {
		$data = $news->toArray();
		if (array_key_exists($this->pk, $data)) {
			unset($data[$this->pk]);
		}
		$data = $this->convertDate($data);
		
		$query = $this->conn->update($this->table, $data)->where($this->pk .'=%i', $news->getId());
		return $query->execute();
	}
		
	public function delete($id) {
		return $this->conn->delete($this->table)->where($this->pk .'=%i', $id)->execute();
	}
	
	protected function setRowClass(DibiResult $result) {
		$result = $result->setRowClass('BlogEntity')->setType('id', dibi::INTEGER);
		$result = $result->setRowClass('BlogEntity')->setType('created', dibi::DATETIME);
		$result = $result->setRowClass('BlogEntity')->setType('visible', dibi::BOOL);
		
		return $result;
	}
	
	protected function convertDate($data) {
		if (!is_object($data['created'])) { // PHP 5.2 compatibility
			$data['created'] = date("Y-m-d H:i:s", $data['created']);
		}
		
		return $data;
	}

}

