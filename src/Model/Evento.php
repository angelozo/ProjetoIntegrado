<?php

namespace App\Model;

use Lib\ORM\Orm;

class Evento extends Orm {

	protected $id;
	protected $nome;
	protected $data;
	protected $local;
	protected $disponivelParaAlunos;
	protected $disponivelParaExterno;
	protected $palestrante;
	protected $descricao;
	protected $limiteUsuarios;

	protected $table = 'evento';
}
