<?php

class TranslationDAO extends AbstractDAO {
	
	protected $table = 'translation';
	protected $pk = 'id';
	
	public function findAll($limit = null, $offset = null, $orderBy = null, $order = 'ASC') {
		$query = $this->conn->select('*')->from($this->table);
		if ($orderBy !== null) { $query->orderBy($orderBy, $order); }
		else { $query->orderBy('id', dibi::ASC); }
		if ($limit !== null) { $query->limit($limit); }
		if ($offset !== null) { $query->offset($offset); }
		
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
	
	public function findTranslation($url) {
		$query = $this->conn->select('*')->from($this->table)->where('original=%s', $url)->or('translation=%s', $url)->limit(1);
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		return $result->fetch();
	}
	
	public function insert(IEntity $news) {
		$data = $news->toArray();
		
		return $this->conn->insert($this->table, $data)->execute(dibi::IDENTIFIER);
	}
	
	public function update(IEntity $news) {
		$data = $news->toArray();
		if (array_key_exists($this->pk, $data)) {
			unset($data[$this->pk]);
		}
		
		$query = $this->conn->update($this->table, $data)->where($this->pk .'=%i', $news->getId());
		return $query->execute();
	}
		
	public function delete($id) {
		return $this->conn->delete($this->table)->where($this->pk .'=%i', $id)->execute();
	}
	
	protected function setRowClass(DibiResult $result) {
		$result = $result->setRowClass('TranslationEntity')->setType('id', dibi::INTEGER);
		
		return $result;
	}

}

