<?php

class Author
{
    public int $id = 0;
    public string $firstName;
    public string $lastName;
    public int $rating;

    public function __construct(string $firstName, string $lastName, int $rating) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->rating = $rating;
    }
}
