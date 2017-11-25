<?php

namespace App\Service;

use App\Model\Event;
use Lib\Database\DatabaseFactory;

class EventService {

	private $db;

	public function __construct() {
		$factory = new DatabaseFactory;
		$this->db = $factory->newDatabase();
	}

	public function loadAll() {
		return $this->db
		->table('evento')
		->get();
	}
}