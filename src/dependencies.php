<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($container) {
    $settings = $container->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

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
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

// create app instance
$app = new \Slim\App($container);