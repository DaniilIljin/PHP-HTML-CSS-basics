<?php
require_once "hw/functianality/Book.php";
require_once "hw/functianality/functions.php";
$book = null;
$message = null;
$url = "index.php";
session_start();
if (isset($_POST["deleteButton"])){
    if($_POST["id"] !== ""){
        deleteBooksById($_POST["id"]);
        $_SESSION["messageb"] = "Raamat on edukalt kustutatud. :)";
        header('Location: ' . $url);
    } else {
        $message = showErrorMessage("See raamat puudub nimekirjas, ei saa kustutada seda. :(");
        $readed = $_POST['isRead'] ?? "no";
        $rating = $_POST["grade"] ?? "0";
        $book = new Book($_POST['title'], $readed, $rating);
    }
}
if (isset($_POST["submitButton"])){
    $readed = $_POST['isRead'] ?? "no";
    $rating = $_POST["grade"] ?? "0";
    $book = new Book($_POST['title'], $readed, $rating);
    if($_POST["id"] !== ""){
        $book->id = $_POST["id"];
    }
    if(3 <= strlen($_POST['title']) && strlen($_POST['title']) <= 23) {
        saveBook($book);
        $_SESSION["messageb"] = "Raamat on edukalt salvestatud. :)";
        header('Location: ' . $url);
    }
    else
    {
        $message = showErrorMessage("Raamatu nimetus peab sisalduma vähemalt 3 tähte ja maksimaalselt 23. :(");
    }
}
if (isset($_GET["id"])){
    $book = finBookById($_GET["id"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>hw</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body id="book-form-page">
<nav>
    <a href="index.php" id="book-list-link">Raamatud</a> | <a href="book-add.php" id="book-form-link">Lisa raamat</a> | <a href="author-list.php" id="author-list-link">Autorid</a> | <a href="author-add.php" id="author-form-link">Lisa autor</a>
</nav>
<main id="special-main" >
    <?php
        print $message ?? "";
    ?>
    <form method="post" action="book-add.php">
        <input type="hidden" name="id" value=<?php echo $book->id ?? ""; ?>>
        <div class="flex-container">
            <div class="field_name"><label for="fn">Pealkiri:</label></div>
            <div><input name="title" type="text" id="fn" value="<?php
                        print $book->title ?? "";
                ?>"
                    ></div>
        </div>
        <div class="flex-container">
            <div class="field_name"><label for="author-select1">Author1</label>:</div>
            <div>
                <select id="author-select1">
                    <option>Name</option>
                    <option>Option 1</option>
                    <option>Option 2</option>
                </select>
            </div>
        </div>
        <div class="flex-container">
            <div class="field_name"><label for="author-select2">Author2</label>:</div>
            <div>
                <select id="author-select2">
                    <option>Name</option>
                    <option>Option 1</option>
                    <option>Option 2</option>
                </select>
            </div>
        </div>
        <table>
            <tr>
                <td class="field_name">Hinne:</td>
                <td class="special-margin">
                    <input type="radio" name="grade" id="1" value="1" <?php
                    if (isset($book)){
                        if($book->rating === "1")
                            print "checked";
                    }
                    ?>>
                    <label for="1">1</label>
                    <input type="radio" name="grade" id="2" value="2" <?php
                    if (isset($book)){
                        if($book->rating === "2")
                            print "checked";
                    }
                    ?>>
                    <label for="2">2</label>
                    <input type="radio" name="grade" id="3" value="3" <?php
                    if (isset($book)){
                        if($book->rating === "3")
                            print "checked";
                    }
                    ?>>
                    <label for="3">3</label>
                    <input type="radio" name="grade" id="4" value="4" <?php
                    if (isset($book)){
                        if($book->rating === "4")
                            print "checked";
                    }
                    ?>>
                    <label for="4">4</label>
                    <input type="radio" name="grade" id="5" value="5" <?php
                    if (isset($book)){
                        if($book->rating === "5")
                            print "checked";
                    }
                    ?>>
                    <label for="5">5</label>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="field_name">Loetud:</td>
                <?php
                if (isset($book))
                {
                    if ($book->readed === "yes") {
                        print '<td class="special-margin"><input type="checkbox" name="isRead"  value="yes" checked></td>';
                    }else{
                        print '<td class="special-margin"><input type="checkbox" name="isRead"  value="yes"></td>';
                    }
                }else{
                    print '<td class="special-margin"><input type="checkbox" name="isRead"  value="yes"></td>';
                }
                ?>
            </tr>
        </table>
        <br>
        <input type="submit" name="submitButton" value="Salvesta">
        <?php
        if (isset($book)){
            echo '<input type="submit" id="deleteButton" name="deleteButton" value="Kustuta">';
        }
        ?>    </form>
</main>
<footer>ICD0007 Näidisrakendus</footer>
</body>
</html>
