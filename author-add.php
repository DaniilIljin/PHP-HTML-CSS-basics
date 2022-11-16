<?php
require_once "hw/functianality/Book.php";
require_once "hw/functianality/functions.php";
require_once "ex5/connection.php";

$author = null;
$message = null;
$url = "author-list.php";
session_start();
if (isset($_POST["deleteButton"])){
    if($_POST["id"] !== ""){
        deleteAuthorsById($_POST["id"]);
        $_SESSION["messagea"] = "Autor on edukalt kustutatud. :)";
        header('Location: ' . $url);
    } else {
        $message = showErrorMessage("See autor puudub nimekirjas, ei saa kustutada teda. :(");
        $firstName = $_POST['firstName'];
        $secondName = $_POST['lastName'];
        $rating = $_POST["grade"] ?? "0";
        $author = new Author($firstName, $secondName, $rating);
    }
}
if (isset($_POST["submitButton"])){
    $firstName = $_POST['firstName'];
    $secondName = $_POST['lastName'];
    $rating = $_POST["grade"] ?? "0";
    try {
        (int)$rating;
    }catch (Exception){
        $rating = "0";
    }
    $author = new Author($firstName, $secondName, $rating);
    if($_POST["id"] !== ""){
        $author->id = $_POST["id"];
    }
    if(1 <= strlen($_POST['firstName']) && strlen($_POST['firstName']) <= 21 && 2 <= strlen($_POST['lastName']) && strlen($_POST['lastName']) <= 22) {
        saveAuthor($author);
        $_SESSION["messagea"] = "Author on edukalt salvestatud. :)";
        header('Location: ' . $url);
    }
    else
    {
        $message = showErrorMessage("Authori eesnimi peab sisalduma vähemalt 1 täht ja maksimaalselt 21.\nAuthori perekonnanimi peab peab sisalduma vähemalt 2 tähte ja maksimaalselt 22. :(");
    }
}
if (isset($_GET["id"])){
    $author = finAuthorById($_GET["id"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>hw</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body id="author-form-page">
<nav>
    <a href="index.php" id="book-list-link">Raamatud</a> | <a href="book-add.php" id="book-form-link">Lisa raamat</a> | <a href="author-list.php" id="author-list-link">Autorid</a> | <a href="author-add.php" id="author-form-link">Lisa autor</a>
</nav>
<main id="special-main">
    <?php
        print $message ?? "";
    ?>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $author->id ?? ""; ?>">
        <div class="flex-container">
            <div class="field_name">
                <label for="fn">Eesnimi:</label>
            </div>
            <div>
                <input type="text" name="firstName" id="fn" value="<?php print $author->firstName ?? ""; ?>">
            </div>
        </div>
        <div class="flex-container">
            <div class="field_name">
                <label for="ln">Perekonnanimi:</label>
            </div>
            <div>
                <input type="text" name="lastName" id="ln" value="<?php print $author->lastName ?? ""; ?>" >
            </div>
        </div>
        <table>
            <tr>
                <td class="field_name">Hinne:</td>
                <td class="special-margin">
                    <input type="radio" name="grade" id="1" value="1" <?php
                    if (isset($author)){
                        if($author->rating === "1")
                            print "checked";
                    }
                    ?>>
                    <label for="1">1</label>
                    <input type="radio" name="grade" id="2" value="2" <?php
                    if (isset($author)){
                        if($author->rating === "2")
                            print "checked";
                    }
                    ?>>
                    <label for="2">2</label>
                    <input type="radio" name="grade" id="3" value="3" <?php
                    if (isset($author)){
                        if($author->rating === "3")
                            print "checked";
                    }
                    ?>>
                    <label for="3">3</label>
                    <input type="radio" name="grade" id="4" value="4" <?php
                    if (isset($author)){
                        if($author->rating === "4")
                            print "checked";
                    }
                    ?>>
                    <label for="4">4</label>
                    <input type="radio" name="grade" id="5" value="5" <?php
                    if (isset($author)){
                        if($author->rating === "5")
                            print "checked";
                    }
                    ?>>
                    <label for="5">5</label>
                </td>
            </tr>
        </table>
        <br>
        <input type="submit" name="submitButton" value="Salvesta">
        <?php
        if (isset($author)){
            echo '<input type="submit" id="deleteButton" name="deleteButton" value="Kustuta">';
        }
        ?>
    </form>
</main>
<footer>ICD0007 Näidisrakendus</footer>
</body>
</html>