<?php

class PhotogalleryService {
	
	protected $DAO;
	
	public function __construct() {
		$this->DAO = new PicassaDAO();
	}
	
	public function getPhotos($album) {
		return $this->DAO->getPhotosInAlbum($album);
	}
	
	public function regenerate() {
		$this->DAO->regenerate();
	}
	
}

