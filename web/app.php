<?php

// @link http://silex.sensiolabs.org/doc/web_servers.html#php-5-4
$filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

// Load all libraries.
require_once __DIR__ . '/../vendor/autoload.php';

// Create new Application.
$app = new Silex\Application();

// Enable all required service provider.
$app->register(new Silex\Provider\TwigServiceProvider());

// Configuration.
$app['debug'] = true;
$app['twig.path'] = __DIR__ . '/../views';

// Routers.
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
});

$app->get('/hello/{name}', function ($name) use ($app) {
    #return 'Hello ' . $app->escape($name);

    return $app['twig']->render('hello.twig', array(
        'name' => $name,
    ));
});

// Run Application.
$app->run();
