<?php

namespace Lib\Auth;

class Authentication {

	private $user;

	public function __construct() {
		$this->session = new Session;
	}

	public function isLogged() {
		return ($this->session->compareField('status', 'logged'));
	}

	public function authenticateUser($user, $password) {
		$crypt = new Crypt();
		$session = new Session();

		var_dump($user);

		if($crypt->compareHash($password, $user->getPassword())) {
			$session->setSession('status', 'logged');
			$session->setSession('username', $user->getName());

			return true;
		}

		throw new \Exception("Senha incorreta", -1);
	}
}
