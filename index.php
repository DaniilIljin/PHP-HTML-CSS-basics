<?php
require_once "hw/functianality/Book.php";
require_once "hw/functianality/functions.php";
session_start();
$message = null;
if (isset($_SESSION["messageb"])){
    if ($_SESSION["messageb"] !== ""){
        $message = showMessage($_SESSION["messageb"]);
        $_SESSION["messageb"] = "";
    }

}
$books = getAllBooks();
if ($books == null){
    $message = showErrorMessage("Kahjuks, raamatuid siin veel pole. :(");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>hw</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body id="book-list-page">
<nav>
    <a href="index.php" id="book-list-link">Raamatud</a> | <a href="book-add.php" id="book-form-link">Lisa raamat</a> | <a href="author-list.php" id="author-list-link">Autorid</a> | <a href="author-add.php" id="author-form-link">Lisa autor</a>
</nav>
<main>
    <table>
        <tr>
            <th class="first_column">Pealkiri</th>
            <th class="second_column">Autorid</th>
            <th class="grade_column">Hinne</th>
        </tr>
    </table>
    <div id="separator"></div>
    <?php
        print $message ?? "";
    ?>
    <table id="table">
        <?php foreach ($books as $book): ?>
            <tr><td class="first_column"><a href="book-add.php?id=<?= $book->id ?>"><?= urldecode($book->title) ?></a></td><td class="second_column"> <?= $book->readed ?> </td>
                <td class="grade_column"><?= numberOfStars($book -> rating) ?></td></tr>
        <?php endforeach; ?>
    </table>
</main>
<footer>ICD0007 Näidisrakendus</footer>
</body>
</html>