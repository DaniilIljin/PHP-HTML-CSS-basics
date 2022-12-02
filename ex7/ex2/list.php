<?php
require_once '../vendor/tpl.php';
require_once 'Book.php';
require_once 'Author.php';

$books = [['Head First HTML and CSS', [['Elisabeth', 'Robson'], ['Eric', 'Freeman']], 5],
          ['Learning Web Design', [['Jennifer', 'Robbins']], 4],
          ['Head First Learn to Code', [['Eric', 'Freeman']], 4]];

$book1 = new Book('Head First HTML and CSS', 3, true);
$book1 -> addAuthor(new Author('Elisabeth', 'Robson'));
$book1 -> addAuthor(new Author('Eric', 'Freeman'));

$book2 = new Book('Head First HTML and CSS', 3, true);
$book2 -> addAuthor(new Author('Elisabeth', 'Robson'));

$data = [
    'books' => [$book1, $book2]
];
print renderTemplate('../tpl/list.html', $data);
?>

