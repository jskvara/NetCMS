<?php

class PicassaDAO extends AbstractDAO {
	
	protected $client;
	protected $user;
	
	public function __construct() {
		// load classes
		ini_set("memory_limit","16M");
		Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
		Zend_Loader::loadClass('Zend_Gdata_Photos');
		Zend_Loader::loadClass('Zend_Gdata_Photos_AlbumQuery');
		
		$config = Environment::getConfig('picasa');
		$this->user = $config->user;
		$this->client = Zend_Gdata_ClientLogin::getHttpClient($config->email, $config->password, Zend_Gdata_Photos::AUTH_SERVICE_NAME);
	}
	
	public function getPhotosInAlbum($album) {
		$albumPhotos = array();
		$photos = new Zend_Gdata_Photos($this->client);
		
		
		
		/*$query = new Zend_Gdata_Photos_UserQuery();
		$query->setUser($this->user);
		try {
			$userFeed = $photos->getUserFeed(null, $query);
			var_export($userFeed);
		} catch (Zend_Gdata_App_Exception $e) {
			echo "Error: " . $e->getMessage();
		}exit;*/
		
		
		$query = new Zend_Gdata_Photos_AlbumQuery();
		$query->setUser($this->user);
		$query->setAlbumId($album);
		
		$albumFeed = $photos->getAlbumFeed($query);
		foreach ($albumFeed as $entry) {
			if ($entry instanceof Zend_Gdata_Photos_PhotoEntry) {
				$albumPhotos[] = $entry;
				// $entry->getGphotoId();
				// $entry->getTitle();
				// $thumb = $entry->getMediaGroup()->getThumbnail();
				// $thumb[1]->getUrl();
			}
		}
		
		return $albumPhotos;
	}
	
	public function findAll() {
		throw new NotImplementedException('Method '. __METHOD__ .' is not implemented.');
	}
	
	public function find($id) {
		throw new NotImplementedException('Method '. __METHOD__ .' is not implemented.');
	}
	
	public function insert(IEntity $file) {
		throw new NotImplementedException('Method '. __METHOD__ .' is not implemented.');
	}
	
	public function update(IEntity $file) {
		throw new NotImplementedException('Method '. __METHOD__ .' is not implemented.');
	}
		
	public function delete($file) {
		throw new NotImplementedException('Method '. __METHOD__ .' is not implemented.');
	}

}

