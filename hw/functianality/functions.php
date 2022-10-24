<?php
require_once "hw/functianality/Author.php";

const ID_FOR_AUTHORS_FILE = 'hw/data/idA.txt';
const AUTHORS_FILE = 'hw/data/authorsFile.txt';
const ID_FOR_BOOKS_FILE = 'hw/data/idB.txt';
const BOOKS_FILE = "hw/data/booksFile.txt";

function getNewIdForAuthor() : string {
    $contents = file_get_contents(ID_FOR_AUTHORS_FILE);
    $id = intval($contents);
    file_put_contents(ID_FOR_AUTHORS_FILE, $id + 1);
    return strval($id);
}
function saveAuthor(Author $author) : string {

    if ($author->id){
        deleteAuthorsById($author->id);
    }else{
        $author->id = getNewIdForAuthor();
    }
    file_put_contents(AUTHORS_FILE, getAuthorAsString($author), FILE_APPEND);
    return $author->id;
}
function getAuthorAsString(Author $author) : string{
    return urlencode($author->id) . ';' .urlencode($author->firstName) . ';' . urlencode($author->lastName). ';' . urlencode($author->rating).PHP_EOL;
}
function deleteAuthorsById(string $id) : void {
    $contents = "";
    foreach (getAllAuthors() as $author) {
        if ($author->id === $id){
            continue;
        }
        $contents .= getAuthorAsString($author);
    }
    file_put_contents(AUTHORS_FILE, $contents);
}
function getAllAuthors() : array {

    $lines = file(AUTHORS_FILE);

    $result = [];
    foreach ($lines as $line) {
        [$id, $firstname, $secondName, $rating] = explode(';', trim($line));
        $author = new Author(urldecode($firstname),urldecode($secondName), $rating);
        $author->id = $id;
        $result[] = $author;
    }
    return $result;
}

function newBook(string $title, string $read, string $rating) : Book {
    return new Book($title, $read, $rating);
}
function getNewIdForBook(string $fileName) : string {
    $contents = file_get_contents($fileName);
    $id = intval($contents);
    file_put_contents($fileName, $id + 1);
    return strval($id);
}
function saveBook(Book $book) : string {

    if ($book->id){
        deleteBooksById($book->id);
    }else{
        $book->id = getNewIdForBook(ID_FOR_BOOKS_FILE);
    }
    file_put_contents(BOOKS_FILE, getBookAsString($book), FILE_APPEND);

    return $book->id;
}
function getBookAsString(Book $book) : string{
    return urlencode($book->id) . ';' .urlencode($book->title) . ';' . urlencode($book->readed). ';' . urlencode($book->rating).PHP_EOL;
}

function deleteBooksById(string $id) : void {
    $contents = "";
    foreach (getAllBooks() as $books) {
        if ($books->id === $id){
            continue;
        }
        $contents .= getBookAsString($books);
    }
    file_put_contents(BOOKS_FILE, $contents);
}

function getAllBooks() : array {
    $lines = file(BOOKS_FILE);
    $result = [];
    foreach ($lines as $line) {
        [$id, $title, $read, $rating] = explode(';', trim($line));
        $book = new Book(urldecode($title),$read,$rating);
        $book->id = $id;
        $result[] = $book;
    }
    return $result;
}

function finBookById(string $id) : Book {
    foreach (getAllBooks() as $book){
        if($book->id === $id){
            $book->title = urldecode($book->title);
            return $book;
        }
    }
    return new Book("", "", "");
}
function finAuthorById(string $id) : Author {
    foreach (getAllAuthors() as $author){
        if($author->id === $id){
            $author->firstName = urldecode($author->firstName);
            $author->lastName = urldecode($author->lastName);
            return $author;
        }
    }
    return new Author("", "", "");
}

function numberOfStars(string $rating) : string {
    $content = "";
    foreach (range(1, 5) as $star) {
        if (intval($rating) >= $star)
            $content .= "<span class='checked-stars' >★</span>\n";
        else {
            $content .= "<span class='unchecked-stars'>★</span>\n";
        }
    }
    return $content;
}

function showErrorMessage(string $message) : string{
    return "<p class='errorMessage' id='error-block'>".$message."</p>";
}
function showMessage(string $message) : string{
    return "<p class='message' id='message-block'>".$message."</p>";
}

