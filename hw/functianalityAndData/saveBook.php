<?php

$title = $_POST['title'] ?? '-';
$isRead = $_POST['isRead'] ?? 'no';
$grade = $_POST['grade'] ?? '0';

const BOOK_FILE = __DIR__."/../data/books.txt";
$content = $title. ';' .$isRead. ';' .$grade . PHP_EOL;
file_put_contents(BOOK_FILE, $content, FILE_APPEND);


$url = "../../index.php";
header('Location: ' . $url);


?>