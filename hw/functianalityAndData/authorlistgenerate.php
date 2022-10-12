<?php
require_once "parts.php";
$authorsData = file("../data/authors.txt");
file_put_contents("../author-list.html", authorsListHeader());
$content = '';
if ($authorsData)
{
    foreach ($authorsData as $line) {
        [$firstName, $secondName, $grade] = explode(';', trim($line));
        $content .= '<tr><td class="first_column"><a href="">' . urldecode($firstName) .'</a></td><td class="second_column">' .urldecode($secondName). '</td><td>';
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
file_put_contents("../author-list.html", $content, FILE_APPEND);
file_put_contents("../author-list.html", authorsListFooter(), FILE_APPEND);

$url = "../author-list.html";
header('Location: ' . $url);
?>