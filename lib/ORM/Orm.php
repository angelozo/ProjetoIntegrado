<?php

namespace Lib\ORM;

use Lib\Database\DatabaseFactory;

class Orm {

	private $connection;
	private $db;

	function __construct() {
		$this->instanceDatabase();
	}

	public function loadAll() {
		return $this->db->table('eventos')->get();
	}

	private function instanceDatabase() {
		$databaseFactory = new DatabaseFactory;

		$this->db = $databaseFactory->newDatabase();
	}
}
