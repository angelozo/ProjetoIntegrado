<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class Controller {
	protected $view;

	public function __invoke() {

	}

	public function __construct($container) {
		$this->view = $container['view'];
	}

}