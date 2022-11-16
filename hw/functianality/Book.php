<?php

class Book
{
    public string $id = '';
    public string $title;
    public string $author_id;
    public string $readed;
    public string $rating;
    public string $authorsName;

    public function __construct(string $title, string $author_id, string $readed, string $rating) {
        $this->title = $title;
        $this->readed = $readed;
        $this->rating = $rating;
        $this->author_id = $author_id;
    }

    public function __toString() : string {
        return sprintf('%s;%s;%s' . PHP_EOL,
            $this->title,$this->author_id, $this->readed, $this->rating);
    }

}