<?php

class Book
{
    public string $id = '';
    public string $title;
    public string $readed;
    public string $rating;

    public function __construct(string $title, string $readed, string $rating) {
        $this->title = $title;
        $this->readed = $readed;
        $this->rating = $rating;
    }

    public function __toString() : string {
        return sprintf('%s;%s;%s' . PHP_EOL,
            $this->title, $this->readed, $this->rating);
    }

}