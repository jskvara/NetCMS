<?php

class SeedItemDAO extends AbstractDAO {
	
	protected $table = 'seedItem';
	protected $pk = 'id';
	
	public function findAll($id = null) {
		if ($id === null) {
			throw new BadParameterException('Method '. __METHOD__ .' has required parameter.');
		}
		$query = $this->conn->select('*')->from($this->table)->where('seedId=%i', $id)->orderBy('position', dibi::ASC);
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		return $result->fetchAll();
	}
	
	public function find($id) {
		$query = $this->conn->select('*')->from($this->table)->where($this->pk.'=%i', $id)->limit(1);
		$result = $query->execute();
		$result = $this->setRowClass($result);
		
		$entity = $result->fetch();
		if ($entity === false) {
			return null;
		}
		
		return $entity;
	}
	
	public function getMaxPosition($seedId) {
		$query = $this->conn->select('MAX([position])')->from($this->table)->where('[seedId] = %i', $seedId);
		$result = $query->execute();
		$position = $result->fetchSingle();
		if ($position === false) {
			return null;
		}
		
		return $position;
	}
	
	public function swapPosition($position1, $position2, $seedId) {
		return dibi::query('UPDATE ['.$this->table.'] 
			SET [position] = IF([position] = '.$position1.','.$position2.','.$position1.')
			WHERE [position] IN ('.$position1.','.$position2.') AND [seedId] = %i', $seedId);
	}
	
	public function moveAllUp($positionFrom, $positionTo = 9999, $seedId) {
		if ($positionFrom === $positionTo) {
			return true;
		}
		
		return dibi::query('UPDATE ['.$this->table.']
			SET [position] = [position] - 1
			WHERE [position] >= '.$positionFrom.' AND [position] <= '.$positionTo.' AND [seedId] = %i', $seedId);
	}
	
	public function insert(IEntity $entity) {
		$data = $entity->toArray();
		$this->conn->insert($this->table, $data)->execute(dibi::IDENTIFIER);
		
		return $this->conn->insertId();
	}
	
	public function update(IEntity $entity) {
		$data = $entity->toArray();
		if (array_key_exists($this->pk, $data)) {
			unset($data[$this->pk]);
		}
		
		return $this->conn->update($this->table, $data)->where($this->pk .'=%i', $entity->getId())->execute();
	}
		
	public function delete($id) {
		return $this->conn->delete($this->table)->where($this->pk .'=%i', $id)->execute();
	}
	
	protected function setRowClass(DibiResult $result) {
		$result = $result->setRowClass('SeedItemEntity')->setType('id', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w1', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w2', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w3', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w4', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w5', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w6', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w7', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w8', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w9', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w10', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w11', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w12', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w13', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w14', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w15', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w16', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w17', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w18', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w19', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w20', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w21', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w22', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w23', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w24', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w25', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w26', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w27', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w28', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w29', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w30', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w31', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w32', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w33', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w34', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w35', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w36', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w37', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w38', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w39', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w40', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w41', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w42', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w43', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w44', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w45', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w46', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w47', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w48', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w49', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w50', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w51', dibi::INTEGER);
		$result = $result->setRowClass('SeedItemEntity')->setType('w52', dibi::INTEGER);
		
		return $result;
	}
}
