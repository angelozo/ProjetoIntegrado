<?php

namespace Lib\Database;

use Illuminate\Database\Capsule\Manager as Database;

class DatabaseFactory {

	private $config;

	public function __construct() {
		$this->config = [
			'driver' => 'mysql',
			'host' => 'localhost',
			'database' => 'inter',
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
			'collation' => 'utf8_bin',
			'prefix' => '',
		];
	}

	public function newDatabase() {
		$database = new Database;

		$database->addConnection($this->config);

		$database->setAsGlobal();

		return $database;
	}
}