<?php

require_once 'Article.php';
require_once __DIR__.'/../Database.php';

class ArticleMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function saveArticle($title, $content, $authorId) {

        try {
            $stmt = $this->database->connect()->prepare('INSERT INTO `news` VALUES (NULL, :title, :content, :authorId);');
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':authorId', $authorId);
            $stmt->execute();
        }
        catch(PDOException $e) {
            die();
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getArticle(
        $articleId
    ) {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM news WHERE id = :id;');
            $stmt->bindParam(':id', $newsId, PDO::PARAM_INT);
            $stmt->execute();

            $news = $stmt->fetch(PDO::FETCH_ASSOC);
            return new News($news['title'], $news['content'], $news['authorId']);
        }
        catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getArticles()
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM news ORDER BY id DESC;');
            $stmt->execute();

            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $articles;
        }
        catch(PDOException $e) {
            die();
        }
    }

    public function delete(int $id): void
    {
        try {
            $stmt = $this->database->connect()->prepare('DELETE FROM news WHERE id = :id;');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch(PDOException $e) {
            die();
        }
    }
}