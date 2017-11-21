<?php

use Lib\Auth\Authentication;

// Application middleware
$auth = function ($request, $response, $next) {
	$authentication = new Authentication();

	if($authentication->isLogged()) {
		return $next($request, $response);
	}

	return $response->withRedirect('/login');
};