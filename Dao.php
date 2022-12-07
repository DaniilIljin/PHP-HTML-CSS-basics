<?php
const USERNAME = 'daniililjin';
const PASSWORD = '3bbab3';
require_once "Author.php";
require_once "Book.php";

class Dao
{
    private PDO $pdo;

    public function __construct()
    {
        $host = 'db.mkalmo.eu';
        $address = sprintf('mysql:host=%s;port=3306;dbname=%s',
            $host, USERNAME);
        $this->pdo = new PDO($address, USERNAME, PASSWORD);
    }

    public function saveAuthor(Author $author) : void{
        if ($author->id)
            $stmt = $this->pdo->prepare('update Author set first_name=:fname, last_name=:lname, rating=:rating where author_id='.$author->id);
        else {
            $stmt = $this->pdo->prepare('INSERT INTO Author (first_name, last_name, rating) VALUES (:fname, :lname, :rating)');
        }
        $stmt->bindValue(":fname", urlencode($author->firstName));
        $stmt->bindValue(":lname", urlencode($author->lastName));
        $stmt->bindValue(":rating", $author->rating);
        $stmt->execute();
    }

    public function deleteAuthorsById(string $id) : void {
        $stmt = $this->pdo->prepare('delete from Author where author_id = '.$id);
        $stmt->execute();
    }

    public function getAllAuthors() : array {
        $result = [];
        $stmt = $this->pdo->prepare('select * from Author');
        $stmt->execute();
        foreach ($stmt as $row) {
            $author = new Author(urldecode($row[1]), urldecode($row[2]), $row[3]);
            $author->id = $row[0];
            $result[] = $author;
        }
        return $result;
    }

    public function saveBook(Book $book){
        if ($book->id)
            $stmt = $this->pdo->prepare(
                'update Book set title=:title, author_id=:author_id,isRead=:isRead, rating=:rating where book_id='.$book->id
            );
        else {
            $stmt = $this->pdo->prepare(
                'INSERT INTO Book (title, author_id,isRead, rating) VALUES (:title, :author_id,:isRead, :rating)'
            );
        }
        if($book->author_id === 0){
            $book->author_id = 76;
        }

        if ($book->readed != "yes"){
            $book->readed = "no";
        }
        $stmt->bindValue(":title", urlencode($book->title));
        $stmt->bindValue(":author_id", $book->author_id);
        $stmt->bindValue(":isRead", $book->readed);
        $stmt->bindValue(":rating", $book->rating);
        $stmt->execute();
    }

    public function deleteBooksById(string $id) : void {
        $stmt = $this->pdo->prepare('delete from Book where book_id = '.$id);
        $stmt->execute();
    }

    public function getAllBooks() : array {
        $result = [];
        $stmt = $this->pdo->prepare('select Book.book_id, Book.title, Book.author_id,Book.isRead, Book.rating, Author.first_name, Author.last_name from Book left join Author on Book.author_id = Author.author_id');
        $stmt->execute();
        foreach ($stmt as $row) {
            $book = new Book(urldecode($row[1]), $row[2],$row[3],$row[4]);
            $book->id = $row[0];
            $book->authorsName = urldecode($row[5])." ".urldecode($row[6]);
            $result[] = $book;
        }
        return $result;
    }

    public function finBookById(string $id) : Book {
        $stmt = $this->pdo->prepare('select Book.book_id, Book.title, Book.author_id,Book.isRead, Book.rating, Author.first_name, Author.last_name from Book left join Author on Book.author_id = Author.author_id where book_id = '.$id);
        $stmt->execute();
        foreach ($stmt as $row) {
            $book = new Book(urldecode($row[1]),$row[2],$row[3], $row[4]);
        }
        $book->id = intval($id);
        return $book;
    }

    public function finAuthorById(string $id) : Author {
        $stmt = $this->pdo->prepare('select * from Author where author_id = '.$id);
        $stmt->execute();
        foreach ($stmt as $row) {
            $author = new Author($row[1], $row[2], $row[3]);
        }
        $author->id = intval($id);
        return $author;
    }
}