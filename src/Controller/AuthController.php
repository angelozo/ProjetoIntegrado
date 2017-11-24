<?php

namespace App\Controller;

use App\Model\Usuario;

class AuthController extends Controller {

	public function signup($request, $response, $args) {
		$this->view->render($response, 'auth/signup.phtml');
	}

	public function signupPost($request, $response, $args) {
		$params = $request->getParams();

		$usuario = new Usuario;
		$usuario->setNome($params['nome'])
			->setEmail($params['email'])
			->setTelefone($params['telefone'])
			->setPassword($params['password'])
			->setCidade($params['cidade'])
			->setEstado($params['estado'])
			->setTipoInstituicao($params['tipoInstituicao'])
			->setNomeInstituicao($params['nomeInstituicao'])
			->setCpf($params['cpf']);
		$usuario->save();
	}

	public function login($request, $response, $args) {
		$this->view->render($response, 'auth/login.phtml');
	}

	public function loginPost($request, $response, $args) {
		var_dump($request->getParams());
	}
}
