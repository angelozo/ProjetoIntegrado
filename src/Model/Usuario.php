<?php

use Lib\ORM\Orm;
use Lib\Auth\Crypt;

class Usuario extends Orm {

	protected $id;
	protected $nome;
	protected $email;
	protected $telefone;
	protected $password;
	protected $cidade;
	protected $estado;
	protected $tipoInstituicao;
	protected $nomeInstituicao;
	protected $cpf;

	protected $table = 'usuario';
	protected $fillable = [
		'nome',
		'email',
		'telefone',
		'password',
		'cidade',
		'estado',
		'tipoInstituicao',
		'nomeInstituicao',
		'cpf'
	];

	public function setNome($nome) {
		if(!empty($nome)) {
			$this->nome = $nome;
		} else {
			throw new Exception("O nome não pode ser vazio");
		}
	}

	public function setEmail($email) {
		if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->email = $email;
		} else {
			throw new Exception("E-mail vazio ou inválido");
		}
	}

	public function setTelefone($telefone) {
		if(!empty($telefone)) {
			$this->telefone = $telefone;
		} else {
			throw new Exception("Telefone não pode estar vazio");
		}
	}

	public function setPassword($password) {
		if(!empty($password)) {
			$crypt = new Crypt;

			$this->password = $crypt->setHash($password);
		} else {
			throw new Exception("Senha não pode estar vazia");
		}
	}

	public function setCidade($cidade) {
		if(!empty($cidade)) {
			$this->cidade = $cidade;
		} else {
			throw new Exception("Cidade não pode ser vazia");
		}
	}

	public function setEstado($estado) {
		if(!empty($estado)) {
			$this->estado = $estado;
		} else {
			throw new Exception("Estado não pode ser vazio");
		}
	}

	public function setTipoInstituicao($tipoInstituicao) {
		if(!empty($tipoInstituicao)) {
			$this->tipoInstituicao = $tipoInstituicao;
		} else {
			throw new Exception("Tipo da instituição não pode ser vazio");
		}
	}

	public function setNomeInstituicao($nomeInstituicao) {
		if(!empty($nomeInstituicao)) {
			$this->nomeInstituicao = $nomeInstituicao;
		} else {
			throw new Exception("Nome da instituição não pode ser vazio");
		}
	}

	public function setCpf($cpf) {
		if(!empty($cpf)) {
			$this->cpf = $cpf;
		} else {
			throw new Exception("Cpf não pode ser vazio");
		}
	}
}