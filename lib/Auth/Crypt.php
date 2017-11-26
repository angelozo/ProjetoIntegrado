<?php

namespace Lib\Auth;

class Crypt {
	private $cost;

	public function __construct() {
		$this->cost = 12;
	}

	public function setHash($password) {
		return password_hash($password, PASSWORD_DEFAULT, ['cost' => $this->cost]);
	}

	public function compareHash($password, $hash) {
		return password_verify($password, $hash);
	}
}
