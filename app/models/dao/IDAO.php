<?php

interface IDAO {
	//public function findAll();
	//public function find($id);
	public function insert(IEntity $entity);
	public function update(IEntity $entity);
	public function delete($id);
}

