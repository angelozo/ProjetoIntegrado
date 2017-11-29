<?php

namespace App\Controller;

use App\Model\User;
use Lib\Auth\Authentication;

class AuthController extends Controller {

	public function signup($request, $response, $args) {
		$this->view->render($response, 'auth/signup.phtml');
	}

	public function signupPost($request, $response, $args) {
		try {
			$params = $request->getParams();

			if(!$params['action']) {
				return $response->withRedirect('/');
			}

			$data = [
				'name' => $params['nome'],
				'email' => $params['email'],
				'telefone' => $params['telefone'],
				'password' => $params['password'],
				'cidade' => $params['cidade'],
				'estado' => $params['estado'],
				'tipoInstituicao' => $params['tipo_instituicao'],
				'nomeInstituicao' => $params['nome_instituicao'],
				'cpf' => $params['cpf']
			];

			$user = User::create($data);

			return $response->withRedirect('/login');
		} catch(\Exception $e) {
			$errorMessage = 'Erro ao cadastrar usuário.';

			if($e->getCode() == 23000) {
				$errorMessage = 'Usuário já cadastrado.';
			}

			$this->view->render($response, 'auth/signup.phtml', [
				'error' => $errorMessage,
				'actualFields' => $params
			]);
		}
	}

	public function login($request, $response, $args) {
		$this->view->render($response, 'auth/login.phtml');
	}

	public function loginPost($request, $response, $args) {
		$params = $request->getParams();

		if(!$params['action']) {
			return $response->withRedirect('/');
		}

		$user = User::where('cpf', $params['cpf'])->first();

		if(!$user->id) {
			return $this->view->render($response, 'auth/login.phtml', [
				'error' => 'Usuário não encontrado.',
				'actualFields' => $params
			]);
		}

		if(!Authentication::authenticateUser($user, $params['password'])) {
			return $this->view->render($response, 'auth/login.phtml', [
				'error' => 'Senha incorreta.',
				'actualFields' => $params
			]);
		}

		return $response->withRedirect('/eventos');
	}

	public function logout() {
		Authentication::logout();

		return $response->withRedirect('/login');
	}
}
