<?php
require_once "hw/functianality/Book.php";
require_once "hw/functianality/functions.php";
session_start();
$message = null;
if (isset($_SESSION["messagea"])){
    if ($_SESSION["messagea"] !== ""){
        $message = showMessage($_SESSION["messagea"]);
        $_SESSION["messagea"] = "";
    }

}
$authors = getAllAuthors();
if ($authors == null){
    $message = showErrorMessage("Kahjuks, autoreid siin veel pole. :(");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>hw</title>
  <link href="styles.css" rel="stylesheet">
</head>
<body id="author-list-page">
<nav>
    <a href="index.php" id="book-list-link">Raamatud</a> | <a href="book-add.php" id="book-form-link">Lisa raamat</a> | <a href="author-list.php" id="author-list-link">Autorid</a> | <a href="author-add.php" id="author-form-link">Lisa autor</a>
</nav>
<main>
  <table>
    <tr>
      <th class="first_column">Eesnimi</th>
      <th class="second_column">Perekonnanimi</th>
      <th class="grade_column">Hinne</th>
    </tr>
  </table>
  <div id="separator"></div>
      <?php
          print $message ?? "";
      ?>
    <table id="table">
    <?php foreach ($authors as $author): ?>
    <?php if ($author->firstName !="Autor" && $author->lastName !="puudub"){
        echo '<tr><td class="first_column"><a href="author-add.php?id='.$author->id.'">'.$author->firstName.'</a></td><td class="second_column">'.$author->lastName.'</td>
        <td class="grade_column">'.numberOfStars($author->rating).'</td></tr>';
        }?>
    <?php endforeach; ?>
</table>

</main>
<footer>ICD0007 Näidisrakendus</footer>
</body>
</html>

