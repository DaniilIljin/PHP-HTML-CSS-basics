<?php
require_once "hw/functianalityAndData/parts.php";
$booksData = file("hw/data/books.txt");
file_put_contents("index.html", booksListHeader());
$content = '';
if ($booksData)
{
    foreach ($booksData as $line) {
        [$title, $isRead, $grade] = explode(';', trim($line));
        $content .= '<tr><td class="first_column"><a href="">' . $title .'</a></td><td class="second_column">' . $isRead . '</td><td>';
        foreach (range(1, 5) as $star) {
            if (intval($grade) >= $star)
                $content .= "<span class='checked-stars' >★</span>\n";
            else {
                $content .= "<span class='unchecked-stars'>★</span>\n";
            }
        }
        $content .= "</td></tr>\n";
    }
}
file_put_contents("index.html", $content, FILE_APPEND);
file_put_contents("index.html", booksListFooter(), FILE_APPEND);

$url = "index.html";
header('Location: ' . $url);
?>