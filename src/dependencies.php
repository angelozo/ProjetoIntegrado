<?php
// DIC configuration

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;

$capsule->addConnection($container['settings']['db']);

$capsule->setAsGlobal();

$capsule->bootEloquent();

// monolog
$container['logger'] = function ($container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Register component on container
$container['view'] = function ($container) {
	$settings = $container->get('settings')['renderer'];

    $view = new \Slim\Views\Twig($settings['template_path'], [
        //'cache' => $settings['cache_path']
        'cache' => false,
        'debug' => true
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->addExtension(new Twig_Extension_Debug());

    return $view;
};

$container['db'] = function ($container) use ($capsule){
   return $capsule;
};

$container['flash'] = function($container) {
    session_start();
    return new \Slim\Flash\Messages();
};

// create app instance
$app = new \Slim\App($container);