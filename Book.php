<?php

class Book
{
    public int $id = 0;
    public string $title;
    public int $author_id;
    public string $readed;
    public int $rating;

    public function __construct(string $title, int $author_id, string $readed, int $rating) {
        $this->title = $title;
        $this->readed = $readed;
        $this->rating = $rating;
        $this->author_id = $author_id;
    }
}