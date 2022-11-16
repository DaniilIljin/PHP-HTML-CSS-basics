<?php
require_once "hw/functianality/Author.php";
require_once "ex5/connection.php";

function saveAuthor(Author $author) : string {
    $conn = getConnection();
    if ($author->id)
        $stmt = $conn->prepare('update Author set first_name=:fname, last_name=:lname, rating=:rating where author_id='.$author->id);
    else {
        $stmt = $conn->prepare('INSERT INTO Author (first_name, last_name, rating) VALUES (:fname, :lname, :rating)');
    }
    $stmt->bindValue(":fname", $author->firstName);
    $stmt->bindValue(":lname", $author->lastName);
    $stmt->bindValue(":rating", (int)$author->rating);
    $stmt->execute();
    return $author->id;
}
function getAuthorAsString(Author $author) : string{
    return urlencode($author->id) . ';' .urlencode($author->firstName) . ';' . urlencode($author->lastName). ';' . urlencode($author->rating).PHP_EOL;
}
function deleteAuthorsById(string $id) : void {
    $conn = getConnection();
    $stmt = $conn->prepare('delete from Author where author_id = '.$id);
    $stmt->execute();
}
function getAllAuthors() : array {
    $result = [];
    $conn = getConnection();
    $stmt = $conn->prepare('select * from Author');
    $stmt->execute();
    foreach ($stmt as $row) {
        $author = new Author($row[1], $row[2], (string)$row[3]);
        $author->id = (string)$row[0];
        $result[] = $author;
    }
    return $result;
}

function saveBook(Book $book) : string {
    $conn = getConnection();
    if ($book->id)
        $stmt = $conn->prepare('update Book set title=:title, author_id=:author_id,isRead=:isRead, rating=:rating where book_id='.$book->id);
    else {
        $stmt = $conn->prepare('INSERT INTO Book (title, author_id,isRead, rating) VALUES (:title, :author_id,:isRead, :rating)');
    }
    $stmt->bindValue(":title", $book->title);
    $stmt->bindValue(":author_id", (int)$book->author_id);
    $stmt->bindValue(":isRead", $book->readed);
    $stmt->bindValue(":rating", (int)$book->rating);
    $stmt->execute();
    return $book->id;
}
function getBookAsString(Book $book) : string{
    return urlencode($book->id) . ';' .urlencode($book->title) . ';' . urlencode($book->readed). ';' . urlencode($book->rating);
}
function deleteBooksById(string $id) : void {
    $conn = getConnection();
    $stmt = $conn->prepare('delete from Book where book_id = '.$id);
    $stmt->execute();
}
function getAllBooks() : array {
    //DATABASE PART
    $result = [];
    $conn = getConnection();
    $stmt = $conn->prepare('select Book.book_id, Book.title, Book.author_id,Book.isRead, Book.rating, Author.first_name, Author.last_name from Book left join Author on Book.author_id = Author.author_id');
    $stmt->execute();
    foreach ($stmt as $row) {
        $book = new Book($row[1], (string)$row[2],$row[3],(string)$row[4]);
        $book->id = (string)$row[0];
        $book->authorsName = $row[5]." ".$row[6];
        $result[] = $book;
    }
    return $result;
}
function finBookById(string $id) : Book {
    $conn = getConnection();
    $stmt = $conn->prepare('select Book.book_id, Book.title, Book.author_id,Book.isRead, Book.rating, Author.first_name, Author.last_name from Book left join Author on Book.author_id = Author.author_id where book_id = '.$id);
    $stmt->execute();
    foreach ($stmt as $row) {
        $book = new Book($row[1],(string)$row[2],$row[3], (string)$row[4]);
    }
    $book->id = $id;
    $book->authorsName = $row[5]." ".$row[6];
    return $book;
}
function finAuthorById(string $id) : Author {
    $conn = getConnection();
    $stmt = $conn->prepare('select * from Author where author_id = '.$id);
    $stmt->execute();
    foreach ($stmt as $row) {
        $author = new Author($row[1], $row[2], (string)$row[3]);
    }
    $author->id = $id;
    return $author;
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

