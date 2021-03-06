<?php

namespace App\Controller;

use App\Model\Event;
use App\Model\User;
use Lib\Auth\Authentication;

class EventController extends Controller {

	public function index($request, $response, $args) {
		$events = Event::all();
		$messages = $this->flash->getMessages();

		$this->view->render($response, 'eventos.phtml', [
			'eventos' => $events,
			'messages' => $messages,
			'isLogged' => Authentication::isLogged()
		]);
	}

	public function inscrever($request, $response, $args) {
		$event = Event::find($args['id']);
		$user = User::find(Authentication::getUserId());

		if(!$event->isInscribable()) {
			$this->flash->addMessage('code', -1);
			$this->flash->addMessage('message', 'Este evento não precisa de inscrição.');
			return $response->withRedirect('/eventos');
		}

		if(!$event->haveSlots()) {
			$this->flash->addMessage('code', -1);
			$this->flash->addMessage('message', 'Limite de vagas esgotada.');
			return $response->withRedirect('/eventos');
		}

		if($user->isEnrolledTo($event)) {
			$this->flash->addMessage('code', -1);
			$this->flash->addMessage('message', 'Você já está cadastrado neste evento.');
			return $response->withRedirect('/eventos');
		}

		if($user->isBusyAtTimeOfEvent($event)) {
			$this->flash->addMessage('code', -1);
			$this->flash->addMessage('message', 'Você já está cadastrado em outro evento neste horário.');
			return $response->withRedirect('/eventos');
		}

		$event->spectators()->attach($user->id);

		$this->flash->addMessage('code', 1);
		$this->flash->addMessage('message', 'Inscrito com sucesso');
		return $response->withRedirect('/eventos');
	}

	public function cancelar($request, $response, $args) {
		$event = Event::find($args['id']);
		$user = User::find(Authentication::getUserId());

		$event->spectators()->detach($user->id);

		$this->flash->addMessage('code', 1);
		$this->flash->addMessage('message', 'Inscrição cancelada com sucesso');
		return $response->withRedirect('/eventos');
	}
}
