<?php

namespace App\Model;

use Lib\Auth\Crypt;

class User {

	protected $id;
	protected $name;
	protected $email;
	protected $telefone;
	protected $password;
	protected $cidade;
	protected $estado;
	protected $tipoInstituicao;
	protected $nomeInstituicao;
	protected $cpf;

	public function getId() {
		return $this->id;
	}
	public function getName() {
		return $this->name;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getTelefone() {
		return $this->telefone;
	}
	public function getPassword() {
		return $this->password;
	}
	public function getIdade() {
		return $this->cidade;
	}
	public function getEstado() {
		return $this->estado;
	}
	public function getTipoInstituicao() {
		return $this->tipoInstituicao;
	}
	public function getNomeInstituicao() {
		return $this->nomeInstituicao;
	}
	public function getCpf() {
		return $this->cpf;
	}

	public function setName($name) {
		if(!empty($name)) {
			$this->name = $name;

			return $this;
		} else {
			throw new \Exception("O nome não pode ser vazio");
		}
	}

	public function setEmail($email) {
		if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->email = $email;

			return $this;
		} else {
			throw new \Exception("E-mail vazio ou inválido");
		}
	}

	public function setTelefone($telefone) {
		if(!empty($telefone)) {
			$this->telefone = $telefone;

			return $this;
		} else {
			throw new \Exception("Telefone não pode estar vazio");
		}
	}

	public function setPassword($password) {
		if(!empty($password)) {
			$crypt = new Crypt;

			$this->password = $crypt->setHash($password);

			return $this;
		} else {
			throw new \Exception("Senha não pode estar vazia");
		}
	}

	public function setCidade($cidade) {
		if(!empty($cidade)) {
			$this->cidade = $cidade;

			return $this;
		} else {
			throw new \Exception("Cidade não pode ser vazia");
		}
	}

	public function setEstado($estado) {
		if(!empty($estado)) {
			$this->estado = $estado;

			return $this;
		} else {
			throw new \Exception("Estado não pode ser vazio");
		}
	}

	public function setTipoInstituicao($tipoInstituicao) {
		if(!empty($tipoInstituicao)) {

			$this->tipoInstituicao = $tipoInstituicao;

			return $this;
		} else {
			throw new \Exception("Tipo da instituição não pode ser vazio");
		}
	}

	public function setNomeInstituicao($nomeInstituicao) {
		if(!empty($nomeInstituicao)) {
			$this->nomeInstituicao = $nomeInstituicao;

			return $this;
		} else {
			throw new \Exception("Nome da instituição não pode ser vazio");
		}
	}

	public function setCpf($cpf) {
		if(!empty($cpf)) {
			$this->cpf = $cpf;

			return $this;
		} else {
			throw new \Exception("Cpf não pode ser vazio");
		}
	}
}