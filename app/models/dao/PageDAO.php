<?php

class PageDAO extends AbstractDAO {
	
	protected $table = 'page';
	protected $pk = 'id';
	
	public function findAll($limit = null, $offset = null) {
		$query = $this->conn->select('*')->from($this->table)->orderBy('position', dibi::ASC);
		if ($limit != null) { $query->limit($limit); }
		if ($offset != null) { $query->offset($offset); }
		
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		return $result->fetchAll();
	}
	
	public function findAllVisible($limit = null, $offset = null) {
		$query = $this->conn->select('*')->from($this->table)->where('visible=%i', 1)->orderBy('position', dibi::ASC);
		if ($limit != null) { $query->limit($limit); }
		if ($offset != null) { $query->offset($offset); }
		
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		return $result->fetchAll();
	}
	
	public function findMenu() {
		$query = $this->conn->select('url, title')->from($this->table)->where('visible=%i', 1)->orderBy('position', dibi::ASC);
		
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		return $result->fetchAll();
	}
	
	public function find($id) {
		$query = $this->conn->select('*')->from($this->table)->where($this->pk.'=%i', $id)->limit(1);
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		$page = $result->fetch();
		if ($page === false) {
			return null;
		}
		
		return $page;
	}
	
	public function findByUrl($url) {
		$query = $this->conn->select('*')->from($this->table)->where('url=%s', $url)->limit(1);
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		$page = $result->fetch();
		if ($page === false) {
			return null;
		}
		
		return $page;
	}
	
	public function findByName($name) {
		$query = $this->conn->select('*')->from($this->table)->where('name=%s', $name)->limit(1);
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		$page = $result->fetch();
		if ($page === false) {
			return null;
		}
		
		return $page;
	}
	
	public function getMaxPosition() {
		$query = $this->conn->select('MAX([position])')->from($this->table);
		$result = $query->execute();
		$position = $result->fetchSingle();
		if ($position === false) {
			return null;
		}
		
		return $position;
	}
	
	public function swapPosition($position1, $position2) {
		return dibi::query('UPDATE ['. $this->table .'] 
			SET [position] = IF([position] = '.$position1.','.$position2.','.$position1.')
			WHERE [position] IN ('.$position1.','.$position2.')');
	}
	
	public function moveAllDown($positionFrom, $positionTo) {
		return dibi::query('UPDATE ['. $this->table .']
			SET [position] = [position] + 1
			WHERE [position] >= '.$positionFrom.' AND [position] <= '.$positionTo.'
		');
	}
	
	public function moveAllUp($positionFrom, $positionTo) {
		if ($positionFrom === $positionTo) {
			return true;
		}
		
		return dibi::query('UPDATE ['. $this->table .']
			SET [position] = [position] - 1
			WHERE [position] >= '.$positionFrom.' AND [position] <= '.$positionTo.'
		');
	}
	
	public function moveToPosition($url, $position) {
		return dibi::query('UPDATE ['. $this->table .']
			SET [position] = '.$position.'
			WHERE [url] = %s', $url);
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
		
		return $this->conn->update($this->table, $data)->where($this->pk .'=%i', $news->getId())->execute();
	}
		
	public function delete($id) {
		return $this->conn->delete($this->table)->where($this->pk .'=%i', $id)->execute();
	}
	
	protected function setRowClass(DibiResult $result) {
		$result = $result->setRowClass('PageEntity')->setType('id', dibi::INTEGER);
		
		return $result;
	}

}

