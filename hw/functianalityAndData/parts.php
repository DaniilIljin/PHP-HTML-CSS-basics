<?php

function booksListHeader() : string{
    return '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>hw</title>
    <link href="hw/styles.css" rel="stylesheet">
</head>
<body id="book-list-page">
<nav>
    <a href="index.html" id="book-list-link">Raamatud</a> | <a href="hw/book-add.html" id="book-form-link">Lisa raamat</a> | <a href="hw/author-list.html" id="author-list-link">Autorid</a> | <a href="hw/author-add.html" id="author-form-link">Lisa autor</a>
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
    <table>';
}

function booksListFooter() : string{
    return "</table>

</main>
<footer>ICD0007 Näidisrakendus</footer>
</body>
</html>";
}

function authorsListHeader() : string{
    return '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>hw</title>
  <link href="styles.css" rel="stylesheet">
</head>
<body id="author-list-page">
<nav>
  <a href="../index.html" id="book-list-link">Raamatud</a> | <a href="book-add.html" id="book-form-link">Lisa raamat</a> | <a href="author-list.html" id="author-list-link">Autorid</a> | <a href="author-add.html" id="author-form-link">Lisa autor</a>
</nav>
<main>
  <table>
    <tr>
      <th class="first_column">Eesnimi</th>
      <th class="second_column">Perekonnanimi</th>
      <th class="grade_column">Hinne</th>
    </tr>
  </table>
  <div id="separator">
  </div>
  <table>';
}

function authorsListFooter() : string{
    return "</table>

</main>
<footer>ICD0007 Näidisrakendus</footer>
</body>
</html>

";
}
?>
