<?php

namespace Lib\Auth;

class Authentication {

	public function __construct() {
		$this->session = new Session;
	}

	public function isLogged() {
		return ($this->session->compareField('status', 'logged'));
	}
}
