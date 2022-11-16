<?php
require_once "hw/functianality/Author.php";
require_once "ex5/connection.php";
//include "../../ex5/connection.php";
//include "../functianality/Author.php";
//include "../functianality/Book.php";

//FOR FILE PART
//const ID_FOR_AUTHORS_FILE = 'hw/data/idA.txt';
//const AUTHORS_FILE = 'hw/data/authorsFile.txt';
//const ID_FOR_BOOKS_FILE = 'hw/data/idB.txt';
//const BOOKS_FILE = "hw/data/booksFile.txt";

//function getNewIdForAuthor() : string {
//    $contents = file_get_contents(ID_FOR_AUTHORS_FILE);
//    $id = intval($contents);
//    file_put_contents(ID_FOR_AUTHORS_FILE, $id + 1);
//    return strval($id);
//}

function saveAuthor(Author $author) : string {
//    if ($author->id){
//        deleteAuthorsById($author->id);
//    }else{
//        $author->id = getNewIdForAuthor();
//    }
//    file_put_contents(AUTHORS_FILE, getAuthorAsString($author), FILE_APPEND);

//    DATABASE PART
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
//    $contents = "";
//    foreach (getAllAuthors() as $author) {
//        if ($author->id === $id){
//            continue;
//        }
//        $contents .= getAuthorAsString($author);
//    }
//    file_put_contents(AUTHORS_FILE, $contents);
    $conn = getConnection();
    $stmt = $conn->prepare('delete from Author where author_id = '.$id);
    $stmt->execute();
}
function getAllAuthors() : array {

//    $lines = file(AUTHORS_FILE);
//
//    $result = [];
//    foreach ($lines as $line) {
//        [$id, $firstname, $secondName, $rating] = explode(';', trim($line));
//        $author = new Author(urldecode($firstname),urldecode($secondName), $rating);
//        $author->id = $id;
//        $result[] = $author;
//    }

    //DATABASE PART
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

//function getNewIdForBook(string $fileName) : string {
//    $contents = file_get_contents($fileName);
//    $id = intval($contents);
//    file_put_contents($fileName, $id + 1);
//    return strval($id);
//}


function saveBook(Book $book) : string {
//    if ($book->id){
//        deleteBooksById($book->id);
//    }else{
//        $book->id = getNewIdForBook(ID_FOR_BOOKS_FILE);
//    }
//    file_put_contents(BOOKS_FILE, getBookAsString($book), FILE_APPEND);
//
//    return $book->id;
    //DATABASE PART
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
//    $contents = "";
//    foreach (getAllBooks() as $books) {
//        if ($books->id === $id){
//            continue;
//        }
//        $contents .= getBookAsString($books);
//    }
//    file_put_contents(BOOKS_FILE, $contents);

    //DATABASE PART
    $conn = getConnection();
    $stmt = $conn->prepare('delete from Book where book_id = '.$id);
    $stmt->execute();
}
function getAllBooks() : array {
//    $lines = file(BOOKS_FILE);
//    $result = [];
//    foreach ($lines as $line) {
//        [$id, $title, $read, $rating] = explode(';', trim($line));
//        $book = new Book(urldecode($title),$read,$rating);
//        $book->id = $id;
//        $result[] = $book;
//    }
//    return $result;
    //DATABASE PART
    //DATABASE PART
    $result = [];
    $conn = getConnection();
    $stmt = $conn->prepare('select * from Book');
    $stmt->execute();
    foreach ($stmt as $row) {
        $book = new Book($row[1], (string)$row[2],$row[3],(string)$row[4]);
        $book->id = (string)$row[0];
        $result[] = $book;
    }
    return $result;
}
function finBookById(string $id) : Book {
//    foreach (getAllBooks() as $book){
//        if($book->id === $id){
//            $book->title = urldecode($book->title);
//            return $book;
//        }
//    }
    $conn = getConnection();
    $stmt = $conn->prepare('select * from Book where book_id = '.$id);
    $stmt->execute();
    foreach ($stmt as $row) {
        $book = new Book($row[1],(string)$row[2],$row[3], (string)$row[4]);
    }
    $book->id = $id;
    return $book;
}
function finAuthorById(string $id) : Author {
//    foreach (getAllAuthors() as $author){
//        if($author->id === $id){
//            $author->firstName = urldecode($author->firstName);
//            $author->lastName = urldecode($author->lastName);
//            return $author;
//        }
//    }
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

