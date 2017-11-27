<?php

// Routes
$app->get('/', 'App\Controller\EventController:index');

$app->get('/eventos', 'App\Controller\EventController:index')->setName('eventos');

$app->get('/evento/{id}/inscrever', 'App\Controller\EventController:inscrever')->setName('eventos.inscrever')->add($auth);

$app->get('/evento/{id}/cancelar', 'App\Controller\EventController:cancelar')->setName('eventos.cancelar')->add($auth);

$app->get('/account', 'App\Controller\AccountController:update')->setName('account.update')->add($auth);

$app->post('/account', 'App\Controller\AccountController:updatePost')->setName('account.update.post')->add($auth);

// Certification pdf routes
$app->get('/gerar-comprovante-inscricao', 'App\Controller\ReceiptController:receiptEnrollmentPdf')->setName('receipt.get.enrollment')->add($auth);

// Authentication Routes
$app->get('/cadastrar', 'App\Controller\AuthController:signup')->setName('auth.signup')->add($authLogin);

$app->post('/cadastrar', 'App\Controller\AuthController:signupPost')->setName('auth.signup.post')->add($authLogin);

$app->get('/login', 'App\Controller\AuthController:login')->setName('auth.login')->add($authLogin);

$app->post('/login', 'App\Controller\AuthController:loginPost')->setName('auth.login.post')->add($authLogin);
