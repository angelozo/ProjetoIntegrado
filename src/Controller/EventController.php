<?php

namespace App\Controller;

use App\Model\Evento;

class EventController extends Controller {

	public function index($request, $response, $args) {
		$evento = new Evento;

		$eventos = $evento->loadAll();

		$this->view->render($response, 'eventos.phtml', [
			'eventos' => $eventos
		]);
	}

	public function inscrever($request, $response, $args) {
		var_dump($request->getParams());
	}
}
