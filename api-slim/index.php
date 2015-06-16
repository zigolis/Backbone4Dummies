<?php
require '../vendor/slim/slim/Slim/Slim.php';

$app = new Slim();

//#/articles/
$app->get('/articles', 'getArticles');
$app->get('/articles/:id', 'getArticle');
$app->post('/articles', 'addArticle');
$app->put('/articles/:id', 'updateArticle');
$app->delete('/articles/:id', 'deleteArticle');
$app->run();

function getArticles()
{
  $sql = "select * FROM articles ORDER BY title LIMIT 10";

  try {
    $db   = getConnection();
    $stmt = $db->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db   = null;

    echo '{"articles": ' . json_encode($data) . '}';
  } catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

function getArticle($id)
{
  $sql = "SELECT * FROM articles WHERE id=:id";

  try {
    $db = getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();
    $data = $stmt->fetchObject();
    $db = null;

    echo json_encode($data);
  } catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

function updateArticle($id)
{
  $request = Slim::getInstance()->request();
  $body    = $request->getBody();
  $article = json_decode($body);
  $sql     = "UPDATE `articles` SET title=:title, content=:content WHERE id=:id";

  try {
    $db   = getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindParam("title", $article->title);
    $stmt->bindParam("content", $article->content);
    $stmt->bindParam("id", $id);
    $stmt->execute();
    $db   = null;

    echo json_encode($article);
  } catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

function addArticle()
{
  error_log('addArticle\n', 3, '/var/tmp/php.log');
  $request = Slim::getInstance()->request();
  $data = json_decode($request->getBody());
  $sql = "INSERT INTO articles (title, content) VALUES (:title, :content)";

  try {
    $db = getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindParam("title", $data->title);
    $stmt->bindParam("content", $data->content);
    $stmt->execute();
    $data->id = $db->lastInsertId();
    $db = null;

    echo json_encode($data);
  } catch(PDOException $e) {
    error_log($e->getMessage(), 3, '/var/tmp/php.log');
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

function deleteArticle($id)
{
  $sql = "DELETE FROM articles WHERE id=:id";
  try {
    $db = getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();
    $db = null;

    // $app->status(204);
    echo json_encode('Success!');
  } catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

function getConnection()
{
  $dbhost="localhost";
  $dbuser="root";
  $dbpass="";
  $dbname="backbone";

  if (isset($dbh)) {
    return $dbh;
  }

  $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  return $dbh;
}
