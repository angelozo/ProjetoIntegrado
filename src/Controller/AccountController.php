<?php

namespace App\Controller;

use App\Model\User;
use Lib\Auth\Authentication;

class AccountController extends Controller {

	public function update($request, $response, $args) {
		$this->view->render($response, 'account/update.phtml');
	}
}
