<?php

use Lib\Auth\Authentication;

// Routes
$app->get('/', 'App\Controller\EventController:index');

$app->get('/eventos', 'App\Controller\EventController:index')->setName('eventos');


// Authentication Routes
$app->get('/cadastrar', 'App\Controller\AuthController:signup')->setName('auth.signup');

$app->post('/cadastrar', 'App\Controller\AuthController:signupPost')->setName('auth.signup.post');

$app->get('/login', 'App\Controller\AuthController:login')->setName('auth.login');

$app->post('/login', 'App\Controller\AuthController:loginPost')->setName('auth.login.post');
