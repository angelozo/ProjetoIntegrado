<?php

namespace App\Service;

use App\Model\User;
use Lib\Database\DatabaseFactory;
use Lib\Auth\Authentication;
use Lib\Auth\Crypt;

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
			->setPassword($crypt->setHash($data['password']))
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

	public function loginUser($data) {
		try {
			$user = $this->findUserByCpf($data['cpf']);

			$authentication = new Authentication;

			return $authentication->authenticateUser($user, $data['password']);
		} catch(\Exception $e) {
			throw new \Exception($e->getMessage(), -1);
		}
	}

	private function findUserByCpf($cpf) {
		try {
			$userData = $this->db
			->table('usuario')
			->where('cpf', '=', $cpf)
			->first();

			$user = new User;

			$user->setId($userData->id)
			->setName($userData->name)
			->setEmail($userData->email)
			->setTelefone($userData->telefone)
			->setPassword($userData->password)
			->setCidade($userData->cidade)
			->setEstado($userData->estado)
			->setTipoInstituicao($userData->tipoInstituicao)
			->setNomeInstituicao($userData->nomeInstituicao)
			->setCpf($userData->cpf);

			return $user;
		} catch(\Exception $e) {
			throw new \Exception("Usuario não encontrado", -1);
		}
	}
}