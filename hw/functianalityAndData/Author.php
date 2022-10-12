<?php

class Author
{
    public string $firstName;
    public string $lastName;
    public string $rating;

    public function __construct(string $firstName, string $lastName, string $rating) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->rating = $rating;
    }

    public function __toString() : string {
        return sprintf('%s;%s;%s' . PHP_EOL,
            $this->firstName, $this->lastName, $this->rating);
    }
}
