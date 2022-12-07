<?php
require_once "vendor/tpl.php";
require_once "Book.php";
require_once "Author.php";
require_once "Dao.php";


$dao = new Dao();
$cmd = $_REQUEST['cmd'] ?? 'book_list';

if ($cmd === 'book_list'){

    $books = $dao->getAllBooks();

    $data = [
        "title" => "Raamatud",
        "pageId" => "book-list-page",
        "books" => $books,
        "template" => "book-list.html"
    ];

    if(empty($books)){
        $error = "Kahjuks, raamatuid siin veel pole. :(";
        $data["error"] = $error;
    }

    if (isset($_GET["message"])){
        $data["message"] = urldecode($_GET["message"]);
    }

    print renderTemplate('tpl/main.html', $data);
}
 else if ($cmd === 'book_form'){
     $authors = $dao->getAllAuthors();

     $data = [
         "title" => "Lisa raamat",
         "pageId" => "book-form-page",
         "authors" => $authors,
         "template" => "book-add.html"
     ];

     if(isset($_GET["id"])){
         $book = $dao->finBookById($_GET["id"]);
         $data["book"] = $book;
     }

     print renderTemplate('tpl/main.html', $data);
}
else if ($cmd === 'saveBook'){

    $book = new Book($_POST['title'], intval($_POST['author1']), $_POST['isRead'] ?? "no", intval($_POST['grade'] ?? 0));

    if (isset($_POST["id"])){
        $book->id = intval($_POST["id"]);
    }

    if (3 <= strlen(strval($_POST["title"])) && strlen(strval($_POST["title"])) <= 23){


        $dao->saveBook($book);

        $message = "Raamat on edukalt salvestatud. :)";

        header('Location: index.php?cmd=book_list&message='.urlencode($message));

    } else {

        $error = "Raamatu nimetus peab sisalduma vähemalt 3 tähte ja maksimaalselt 23. :(";

        $authors = $dao->getAllAuthors();

        $data = [
            "title" => "Lisa raamat",
            "pageId" => "book-form-page",
            "book" => $book,
            "error" => $error,
            "authors" => $authors,
            "template" => "book-add.html"
        ];

        print renderTemplate('tpl/main.html', $data);
    }
}
 else if ($cmd === 'deleteBook'){

     $dao -> deleteBooksById($_POST["id"]);

     $message = "Raamat on edukalt kustutatud. :)";

     header('Location: index.php?cmd=book_list&message='.urlencode($message));
}
 else if ($cmd === 'author_list'){
     $authors = $dao->getAllAuthors();

     $data = [
         "title" => "Autorid",
         "pageId" => "author-list-page",
         "authors" => $authors,
         "template" => "author-list.html"
     ];

     if(empty($authors)){
         $error = "Kahjuks, autoreid siin veel pole. :(";
         $data["error"] = $error;

     }
     if (isset($_GET["message"])){
         $data["message"] = urldecode($_GET["message"]);
     }

     print renderTemplate('tpl/main.html', $data);
}
 else if ($cmd === 'author_form'){

     $data = [
         "title" => "Lisa autor",
         "pageId" => "author-form-page",
         "template" => "author-add.html"
     ];

     if(isset($_GET["id"])){
         $author = $dao->finAuthorById($_GET["id"]);
         $data["author"] = $author;
     }

     print renderTemplate('tpl/main.html', $data);
}
 else if ($cmd === 'saveAuthor'){

     $author = new Author($_POST['firstName'], $_POST['lastName'], intval($_POST['grade'] ?? 0));

     if (isset($_POST["id"])){
         $author->id = intval($_POST["id"]);
     }

     if (1 <= strlen($_POST['firstName']) && strlen($_POST['firstName']) <= 21 &&
         2 <= strlen($_POST['lastName']) && strlen($_POST['lastName']) <= 22){

         $dao->saveAuthor($author);

         $message = "Autor on edukalt salvestatud. :)";

         header('Location: index.php?cmd=author_list&message='.urlencode($message));

     } else {

         $error = "Raamatu nimetus peab sisalduma vähemalt 3 tähte ja maksimaalselt 23. :(";

         $authors = $dao->getAllAuthors();

         $data = [
             "title" => "Lisa autor",
             "pageId" => "author-form-page",
             "author" => $author,
             "error" => $error,
             "template" => "author-add.html"
         ];

         print renderTemplate('tpl/main.html', $data);
     }
}
 else if ($cmd === 'deleteAuthor'){
     $dao -> deleteAuthorsById($_POST["id"]);

     $message = "Autor on edukalt kustutatud. :)";

     header('Location: index.php?cmd=author_list&message='.urldecode($message));
}
?>