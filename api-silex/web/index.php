<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;

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

$app->get('/', function (Application $app) {
    $response = [
        'date' => (new \DateTime)->format(\DateTime::W3C),
        'info' => [
            'create_article' => [
                'action' => 'Create an Article',
                'method' => 'POST',
                'url' => '/articles'
            ],
            'list_article' => [
                'action' => 'List all Articles',
                'method' => 'GET',
                'url' => '/articles'
            ],
            'get_article' => [
                'action' => 'Get all info about an Article',
                'method' => 'GET',
                'url' => '/articles/{id}'
            ],
            'update_article' => [
                'action' => 'Update an Article',
                'method' => 'PUT',
                'url' => '/articles/{id}'
            ],
            'delete_article' => [
                'action' => 'Delete an Article',
                'method' => 'DELETE',
                'url' => '/articles/{id}'
            ],
        ],
    ];
    return $app->json($response);
});

$app->get('/articles', function (Application $app) {
    $articles = $app['db']->fetchAll('SELECT * FROM article');
    return $app->json($articles);
});

$app->get('/articles/{id}', function (Application $app, $id) {
    $articles = $app['db']->fetchAll('SELECT * FROM article WHERE id = ?', [(int)$id]);
    if (empty($articles)) {
        return $app->json(null, 404);
    }
    return $app->json($articles[0]);
});

$app->delete('/articles/{id}', function (Application $app, $id) {
    $articles = $app['db']->fetchAll('SELECT * FROM article WHERE id = ?', [(int)$id]);
    if (empty($articles)) {
        return $app->json(null, 404);
    }
    $rowsDeleted = $app['db']->delete('article', ['id'=>(int)$id]);
    return $app->json(null, 204);
});

$app->post('/articles', function (Application $app, Symfony\Component\HttpFoundation\Request $req) {

    $data = json_decode($req->getContent(), true);

    $article = new BlogMV\Silex\Entity\Article();
    $article->setTitle($data['title'])
            ->setContent($data['content']);

    $app['db']->executeUpdate(
        'INSERT INTO article (title, content) VALUES (?, ?)',
        [
            $article->getTitle(),
            $article->getContent()
        ]
    );

    $article->setId($app['db']->lastInsertId());

    return $app->json($article);
});

$app->put('/articles/{id}', function (Application $app, Symfony\Component\HttpFoundation\Request $req, $id) {

    $data = json_decode($req->getContent(), true);

    $articles = $app['db']->fetchAll('SELECT * FROM article WHERE id = ?', [(int)$id]);
    if (empty($articles)) {
        return $app->json(null, 404);
    }
    $article = new BlogMV\Silex\Entity\Article();
    $article
        ->setId($articles[0]['id'])
        ->setTitle($articles[0]['title'])
        ->setContent($articles[0]['content']);

    if (isset($data['title']) && !empty($data['title'])) {
        $article->setTitle($data['title']);
    }

    if (isset($data['content']) && !empty($data['content'])) {
        $article->setContent($data['content']);
    }

    $app['db']->executeUpdate(
        'UPDATE article SET title = ?, content = ? WHERE id = ?',
        [
            $article->getTitle(),
            $article->getContent(),
            $article->getId()
        ]
    );

    return $app->json($article);
});

$app->run();
