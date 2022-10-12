<?php

$firstName = $_GET['firstName'] ?? 'default first name';
$lastName = $_GET['lastName'] ?? 'default second name';
$grade = $_GET['grade'] ?? '0';

const AUTHOR_FILE = __DIR__."/../data/authors.txt";
$content = urlencode($firstName). ';' .urlencode($lastName). ';' .$grade . PHP_EOL;
file_put_contents(AUTHOR_FILE, $content, FILE_APPEND);


$url = "authorlistgenerate.php";
header('Location: ' . $url);

?>