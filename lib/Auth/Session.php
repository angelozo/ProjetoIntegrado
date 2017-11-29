<?php

namespace Lib\Auth;

class Session {
	public function __construct() {
		if(!$this->sessionExists()) {
			$this->sessionStart();
		}
	}

	private function sessionExists() {
		return isset($_SESSION);
	}

	public function specificSessionExists($field) {
		return isset($_SESSION[$field]);
	}

	private function sessionStart() {
		session_start();
	}

	public function sessionDestroy() {
		session_destroy();
	}

	public function setSession($field, $value) {
		$_SESSION[$field] = $value;
	}

	public function compareField($field, $value) {
		return ($_SESSION[$field] == $value);
	}

	public function getField($field) {
		return $_SESSION[$field];
	}
}