<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use BlogMV\Silex\Controller\Articles;
use Silex\Provider\ServiceControllerServiceProvider;

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Application();

$app['debug'] = true;

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
        'driver'   => 'pdo_sqlite',
        'path'     => __DIR__.'/../data/app.db',
    ],
]);

$app->register(new ServiceControllerServiceProvider());

$app['articles'] = $app->share(function () use ($app) {
    return new Articles($app);
});

$app->get('/', 'articles:index');
$app->get('/articles', 'articles:all');
$app->get('/articles/{id}', 'articles:get');
$app->delete('/articles/{id}', 'articles:delete');
$app->post('/articles', 'articles:insert');
$app->put('/articles/{id}', 'articles:put');

$app->run();
