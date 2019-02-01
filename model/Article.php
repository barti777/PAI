<?php

class Article
{
    public $id;
    public $title;
    public $content;
    public $authorId;

    public function __construct($title, $content, $authorId)
    {
        $this->title = $title;
        $this->content = $content;
        $this->authorId = $authorId;
    }
}