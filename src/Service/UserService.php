<?php

namespace App\Service;

use App\Model\User;
use Lib\Database\DatabaseFactory;

class UserService {

	private $db;

	public function __construct() {
		$factory = new DatabaseFactory;
		$this->db = $factory->newDatabase();
	}

	public function createNewUser($data) {
		$user = new User;

		$user->setName($data['nome'])
			->setEmail($data['email'])
			->setTelefone($data['telefone'])
			->setPassword($data['password'])
			->setCidade($data['cidade'])
			->setEstado($data['estado'])
			->setTipoInstituicao($data['tipo_instituicao'])
			->setNomeInstituicao($data['nome_instituicao'])
			->setCpf($data['cpf']);

		$this->insertUserInDatabase($user);
	}

	private function insertUserInDatabase(User $user) {
		try {
			$data = [
				'name' => $user->getName(),
				'email' => $user->getEmail(),
				'telefone' => $user->getTelefone(),
				'password' => $user->getPassword(),
				'cidade' => $user->getIdade(),
				'estado' => $user->getEstado(),
				'tipoInstituicao' => $user->getTipoInstituicao(),
				'nomeInstituicao' => $user->getNomeInstituicao(),
				'cpf' => $user->getCpf()
			];

			$this->db->table('usuario')
			->insert($data);
		} catch(\Exception $e) {
			$error = 'Erro ao cadastrar usuário.';

			if($e->getCode() == 23000) {
				$error = 'Usuario já cadastrado';
			}

			throw new \Exception($error, -1);
		}
	}
}