<?php

namespace App\Controller;

class AuthController extends Controller {

	public function signup($request, $response, $args) {
		$this->view->render($response, 'auth/signup.phtml');
	}

	public function signupPost($request, $response, $args) {
		var_dump($request->getParams());
	}

	public function login($request, $response, $args) {
		$this->view->render($response, 'auth/login.phtml');
	}

	public function loginPost($request, $response, $args) {
		var_dump($request->getParams());
	}
}
