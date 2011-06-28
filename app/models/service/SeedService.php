<?php

class SeedService {
	
	protected $DAO;
	protected $converter;
	protected $validator;
	protected $itemsDAO;
	protected $itemConverter;
	protected $itemValidator;
	
	public function __construct() {
		$this->DAO = new SeedDAO();
		$this->converter = new SeedConverter();
		$this->validator = new SeedValidator();
		$this->itemDAO = new SeedItemDAO();
		$this->itemConverter = new SeedItemConverter();
		$this->itemValidator = new SeedItemValidator();
	}
		
	public function getSeeds() {
		return $this->DAO->findAll();
	}
	
	public function getSeedItems($id) {
		return $this->itemDAO->findAll($id);
	}
	
	public function get($id) {
		return $this->DAO->find($id);
	}
	
	public function getSeedItem($id) {
		return $this->itemDAO->find($id);
	}
	
	public function getMaxPosition($seedId) {
		return $this->itemDAO->getMaxPosition($seedId);
	}
	
	public function add($name, $description, $harvest, $text) {
		try {
			$seed = $this->converter->toEntity(null, $name, $description, $harvest, $text);
			$this->validator->validateAdd($seed);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		return $this->DAO->insert($seed);
	}
	
	public function edit($id, $name, $description, $harvest, $text) {
		$seed = null;
		try {
			$seed = $this->converter->toEntity($id, $name, $description, $harvest, $text);
			$this->validator->validate($seed);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$oldSeed = $this->DAO->find($id);
		if ($seed === null || $oldSeed === null) {
			throw new ServiceException('Osivo neexistuje.');
		}
		$this->DAO->update($seed);
		
		return true;
	}
	
	public function delete($id) {
		if (empty($id) || $id < 0) {
			throw new ServiceException('Id osiva nesmí být prázdné.');
		}
		
		$this->DAO->delete($id);
	}
	
	public function addSeedItem($seedId, $name, $resistence, $weeks) {
		$return = false;
		try {
			$color = "";
			$position = $this->itemDAO->getMaxPosition($seedId);
			if ($position == null) {
				$position = 1;
			} else {
				$position = $position + 1;
			}
			$seedItem = $this->itemConverter->toEntity(null, $seedId, $name, $resistence, $color, $position, $weeks);
			$this->itemValidator->validateAdd($seedItem);
			$return = $this->itemDAO->insert($seedItem);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		return $return;
	}
	
	public function editSeedItem($id, $seedId, $name, $resistence, $weeks) {
		try {
			$color = "";
			$position = null;
			$seedItem = $this->itemConverter->toEntity($id, $seedId, $name, $resistence, $color, $position, $weeks);
			$this->itemValidator->validate($seedItem);
		} catch (Exception $e) {
			throw new ServiceException($e);
		}
		
		$oldSeedItem = $this->itemDAO->find($id);
		if ($seedItem === null || $oldSeedItem === null) {
			throw new ServiceException("Typ osiva neexistuje.");
		}
		$this->itemDAO->update($seedItem);
		
		return true;
	}
	
	public function deleteSeedItem($id, $seedId) {
		if (empty($id) || $id < 0) {
			throw new ServiceException("Id typu osiva nesmí být prázdné.");
		}
		
		$seedItem = $this->itemDAO->find($id);
		if ($seedItem === null) {
			throw new ServiceException("Typ osiva neexistuje");
		}
		$this->itemDAO->delete($id);
		$this->itemDAO->moveAllUp($seedItem->getPosition()+1, 99999, $seedId);
	}
	
	public function moveUp($id, $seedId) {
		$seedItem = $this->itemDAO->find($id);
		if ($seedItem === null) {
			throw new ServiceException("Typ osiva neexistuje.");
		}
		
		$position = $seedItem->getPosition();
		if ($position < 2) {
			throw new ServiceException("Typ osiva nelze posunout.");
		}
		
		$this->itemDAO->swapPosition($position - 1, $position, $seedId);
	}
	
	public function moveDown($id, $seedId) {
		$seedItem = $this->itemDAO->find($id);
		if ($seedItem === null) {
			throw new ServiceException("Typ osiva neexistuje.");
		}
		
		$position = $seedItem->getPosition();
		$maxPosition = $this->itemDAO->getMaxPosition($seedId);
		if ($position > ($maxPosition - 1)) {
			throw new ServiceException("Typ osiva nelze posunout.");
		}
		
		$this->itemDAO->swapPosition($position, $position + 1, $seedId);
	}
}

