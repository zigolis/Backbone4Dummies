<?php

namespace BlogMV\Silex\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class Articles
{
    protected $app;
    /**
    * @param Silex\Application $app
    */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    public function index(Application $app)
    {
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
    }

    public function all(Application $app)
    {
        $articles = $app['db']->fetchAll('SELECT * FROM article');
        return $app->json($articles);
    }

    public function get(Application $app, $id)
    {
        $articles = $app['db']->fetchAll('SELECT * FROM article WHERE id = ?', [(int) $id]);
        if (empty($articles)) {
            return $app->json(null, 404);
        }
        return $app->json($articles[0]);
    }

    public function delete(Application $app, $id)
    {
        $articles = $app['db']->fetchAll('SELECT * FROM article WHERE id = ?', [(int) $id]);
        if (empty($articles)) {
            return $app->json(null, 404);
        }
        $rowsDeleted = $app['db']->delete('article', ['id' => (int) $id]);
        return $app->json(null, 204);
    }

    public function insert(Application $app, Symfony\Component\HttpFoundation\Request $req)
    {

        $data = json_decode($req->getContent(), true);

        $article = new BlogMV\Silex\Entity\Article();
        $article
            ->setTitle($data['title'])
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
    }

    public function put(Application $app, Symfony\Component\HttpFoundation\Request $req, $id)
    {

        $data = json_decode($req->getContent(), true);

        $articles = $app['db']->fetchAll('SELECT * FROM article WHERE id = ?', [(int) $id]);
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
    }
}
