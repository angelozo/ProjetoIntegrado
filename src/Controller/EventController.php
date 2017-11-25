<?php

namespace App\Controller;

use App\Service\EventService;

class EventController extends Controller {

	public function index($request, $response, $args) {
		$eventService = new EventService;

		$events = $eventService->loadAll();

		$this->view->render($response, 'eventos.phtml', [
			'eventos' => $events
		]);
	}

	public function inscrever($request, $response, $args) {
		var_dump($args);
	}
}
