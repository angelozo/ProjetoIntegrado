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
		return $this->db
			->table($this->table)
			->get();
	}

	public function load($id) {
		return $this->db
			->table($this->table)
			->where('id', '=', $id)
			->get();
	}

	public function save() {
		$fillableFields = $this->fillable;

		foreach ($fillableFields as $field) {
			# code...
		}
	}

	private function instanceDatabase() {
		$databaseFactory = new DatabaseFactory;

		$this->db = $databaseFactory->newDatabase();
	}

	public function getDatabase() {
		return $this->db;
	}
}
