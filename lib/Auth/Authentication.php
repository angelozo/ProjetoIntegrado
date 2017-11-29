<?php

namespace Lib\Auth;

class Authentication {

	public static function isLogged() {
		$session = new Session();

		return ($session->compareField('status', 'logged'));
	}

	public static function authenticateUser($user, $password) {
		$crypt = new Crypt();
		$session = new Session();

		if($crypt->compareHash($password, $user->password)) {
			$session->setSession('status', 'logged');
			$session->setSession('username', $user->name);
			$session->setSession('id', $user->id);

			return true;
		}

		return false;
	}

	public static function logout() {
		$session = new Session();

		$session->setSession('status', null);
		$session->setSession('username', null);
		$session->setSession('id', null);

		$session->sessionDestroy();
	}

	public static function getUserId() {
		$session = new Session();

		return $session->getField('id');
	}
}
