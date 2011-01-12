<?php

/**
 * Users authenticator.
 */
class UsersAuthenticator implements IAuthenticator {

	public function authenticate(array $credentials) {
		$config = Environment::getConfig('security');
		
		$username = strtolower($credentials[self::USERNAME]);
		$password = strtolower($credentials[self::PASSWORD]);

		
		if ($username !== $config->username) {
			throw new AuthenticationException("Uživatel '". $username ."' nebyl nalezen.", self::IDENTITY_NOT_FOUND);
		}

		$password = sha1($password . $config->salt);
		if ($password !== $config->password) {
			throw new AuthenticationException("Zadali jste nesprávné heslo.", self::INVALID_CREDENTIAL);
		}

		return new Identity($username);
	}

}
