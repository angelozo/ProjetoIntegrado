<?php

namespace Lib\Auth;

class Crypt {

	public static function setHash($password) {
		return password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
	}

	public static function compareHash($password, $hash) {
		return password_verify($password, $hash);
	}
}
