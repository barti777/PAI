<?php

require_once "AppController.php";

require_once __DIR__.'/../model/Article.php';
require_once __DIR__.'/../model/ArticleMapper.php';


class ArticleController extends AppController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $this->render('index', []);
    }

    public function add() {
        $this->render('add', []);
    }

    public function save() {

        $mapper = new ArticleMapper();

        $mapper->saveArticle($_POST['title'], $_POST['content'], $_POST['authorId']);

        header('Location: ?page=news');
    }

    public function articles()
    {
        $article = new ArticleMapper();

        header('Content-type: application/json');
        http_response_code(200);

        echo $article->getArticles() ? json_encode($article->getArticles()) : 'Coś poszło nie tak';
    }

    public function delete()
    {
        if (!isset($_POST['id'])) {
            http_response_code(404);
            return;
        }

        $article = new ArticleMapper();
        $article->delete((int)$_POST['id']);

        http_response_code(200);
    }
}