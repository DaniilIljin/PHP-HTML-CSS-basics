<?php

$firstName = $_POST['firstName'] ?? 'default first name';
$lastName = $_POST['lastName'] ?? 'default second name';
$grade = $_POST['grade'] ?? '0';

const AUTHOR_FILE = __DIR__."/../data/authors.txt";
$content = $firstName. ';' .$lastName. ';' .$grade . PHP_EOL;
file_put_contents(AUTHOR_FILE, $content, FILE_APPEND);


$url = "authorlistgenerate.php";
header('Location: ' . $url);

?>