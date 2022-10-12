<?php

class Book
{
    public string $title;
    public string $readed;
    public string $rating;

    public function __construct(string $firstName, string $lastName, string $rating) {
        $this->title = $firstName;
        $this->readed = $lastName;
        $this->rating = $rating;
    }

    public function __toString() : string {
        return sprintf('%s;%s;%s' . PHP_EOL,
            $this->title, $this->readed, $this->rating);
    }

}