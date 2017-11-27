<?php

namespace App\Controller;

use App\Model\User;
use Lib\Auth\Authentication;

class AccountController extends Controller {

	public function update($request, $response, $args) {
		$user = User::find(Authentication::getUserId());

		$this->view->render($response, 'account/update.phtml', [
			'data' => $user
		]);
	}

	public function updatePost($request, $response, $args) {
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


			$user = User::find(Authentication::getUserId());

			foreach ($data as $field => $value) {
				$user->{$field} = $value;
			}

			$user->save();

			$this->flash->addMessage('success', 'Dados atualizados com sucesso.');
			return $response->withRedirect('/account');
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
}
