<?php

class NewsDAO extends AbstractDAO {
	
	protected $table = 'news';
	protected $pk = 'id';
	
	public function findAll($limit = null, $offset = null) {
		/*return dibi::query(
            'SELECT * FROM [tasks]',
            '%if', isset($where), 'WHERE %and', isset($where) ? $where : array(), '%end',
            '%if', isset($order), 'ORDER BY %by', $order, '%end',
            '%if', isset($limit), 'LIMIT %i %end', $limit,
            '%if', isset($offset), 'OFFSET %i %end', $offset
        )->setRowClass('Todo');*/
		
		$query = $this->conn->select('*')->from($this->table)->orderBy('id', dibi::ASC);
		// where
		// orderBy
		if ($limit != null) { $query->limit($limit); }
		if ($offset != null) { $query->offset($offset); }
		
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		return $result->fetchAll();
	}
	
	public function find($id) {
		// return $this->em->find(new NewsEntity(), $id);
		
		$query = $this->conn->select('*')->from($this->table)->where($this->pk.'=%i', $id)->limit(1);
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		return $result->fetch();
	}
	
	public function insert(IEntity $news) {
		// return $this->em->persist($news);
		$data = $news->toArray();
		
		return $this->conn->insert($this->table, $data)->execute(dibi::IDENTIFIER);
	}
	
	public function update(IEntity $news) {
		// return $this->em->merge($news);
		$data = $news->toArray();
		if (array_key_exists($this->pk, $data)) {
			unset($data[$this->pk]);
		}
		
		$query = $this->conn->update($this->table, $data)->where($this->pk .'=%i', $news->getId());
		return $query->execute();
	}
		
	public function delete($id) {
		// return $this->em->remove(new NewsEntity(), $id);
		return $this->conn->delete($this->table)->where($this->pk .'=%i', $id)->execute();
	}
	
	protected function setRowClass(DibiResult $result) {
		$result = $result->setRowClass('NewsEntity')->setType('id', dibi::INTEGER);
		$result = $result->setRowClass('NewsEntity')->setType('created', dibi::DATETIME);
		$result = $result->setRowClass('NewsEntity')->setType('visible', dibi::BOOL);
		
		return $result;
	}

}

