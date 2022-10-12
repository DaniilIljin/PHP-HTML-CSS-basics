<?php

$title = $_GET['title'] ?? '-';
$isRead = $_GET['isRead'] ?? 'no';
$grade = $_GET['grade'] ?? '0';

const BOOK_FILE = __DIR__."/../data/books.txt";
$content = $title. ';' .$isRead. ';' .$grade . PHP_EOL;
file_put_contents(BOOK_FILE, $content, FILE_APPEND);


$url = "../../index.php";
header('Location: ' . $url);


?>