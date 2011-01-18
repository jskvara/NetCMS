<?php

class PicassaDAO extends AbstractDAO {
	
	public function getPhotosInAlbum($album) {
		$config = Environment::getConfig('picasa');
		
		if (!file_exists($config->cache)) {
			$url = $config->proxyUrl ."?user=". $config->user ."&password=". $config->password;
			$file = file_get_contents($url);
			$file = rtrim($file);
			if (substr($file, -1) !== "}") {
				throw new ServiceException("Soubor není kompletní.");
			}
			$file = "<?php\n\n". $file;
			file_put_contents($config->cache, $file);
		}
		require_once $config->cache;
		
		$albums = new Albums();
		$method = "getAlbum". $album;
		if (!method_exists($albums, $method)) {
			throw new ServiceException("Album neexistuje.");
		}
		
		$photos = call_user_func(array($albums, $method));
		return $photos;
	}
	
	public function regenerate() {
		$config = Environment::getConfig('picasa');
		
		if (file_exists($config->cache)) {
			unlink($config->cache);
		}
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

