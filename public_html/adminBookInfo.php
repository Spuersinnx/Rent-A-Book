<?php
session_start();
require_once('../db/db_config.php');
$bookID = $_POST['bookID'];
$genreID = $_POST['genreID'];

$queryDisplay = 'SELECT * FROM books INNER JOIN author ON books.bookID = author.bookID WHERE books.bookID = :bookID';
$statementDisplay = $db->prepare($queryDisplay);
$statementDisplay->bindValue(':bookID', $bookID);
$statementDisplay->execute();
$displayBook = $statementDisplay->fetch();


$genreSelect = $db->prepare("SELECT *
                                      FROM genre");
$genreSelect->execute();
$genres = $genreSelect->fetchAll();


?>

<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Rent a Book</title>
    <link type="text/css" rel="stylesheet" href="css/mainstyle.css">
    <link type="text/css" rel="stylesheet" href="css/style.css">
</head>

<body>
<header>
    <div class="wrapper">
        <h1>Rent a Book<span class="color">.</span></h1>
        <nav>
            <form action="logout.php" method="POST">
                <ul>
                    <li><a href="adminPage.php">Admin Dashboard</a></li>
                    <li><a href="#" onclick="document.forms[0].submit();"> Log Out</a></li>

                </ul>
            </form>
        </nav>
    </div>
</header>

<form action="adminUpdateB.php" method="post">
    <div id="bookInfo" style="margin-bottom: 0%; margin-left: 15%">
        <img src="<?php echo $displayBook['bookImage'] ?> " width="200px" height="300px">
        <input name="bookName" type="text" style="width: 40%; margin-left: 3%;"
               value="<?php echo $displayBook['bookName'] ?>">
        <h5>by</h5><input name="authorName" type="text" style="width: 40%; margin-left: 3%;"
                          value="<?php echo $displayBook['authorName'] ?>"> <br/>

        <h5>ISBN:</h5><input name="bookISBN" type="text" style="width: 40%; margin-left: 3%;"
                             value="<?php echo $displayBook['ISBN'] ?>">

        <h5>Genre:</h5><select name="genreID" style="margin-left: 20%;">
            <?php foreach ($genres as $genre) : ?>
                <?php if ($genre['genreID'] == $genreID) : ?>
                    <option selected="selected" value="<?= $genre['genreID'] ?>"><?= $genre['genreName'] ?></option>
                <?php else : ?>
                    <option value="<?= $genre['genreID'] ?>"><?= $genre['genreName'] ?></option>
                <?php endif; endforeach; ?>
        </select><br/><br />

        <h5>BookImage URL:</h5>
        <input name="bookImage" type="text" style="width: 40%; margin-left: 20%;"
               value="<?php echo $displayBook['bookImage'] ?>">

    </div>


    <h5 style="margin-left: 32%">Description</h5>
    <textarea name="bookDescription" cols="66" rows="5"
              style="margin-left: 32%; margin-top: 0px;"><?php echo $displayBook['bookDescription'] ?></textarea>
    <br/>


    <input type="hidden" name="bookID" value="<?= $displayBook['bookID'] ?>">

    <td>
        <button type="submit" class="cartDeleteButton" name="delete"
                style="margin-left: 32%; margin-top: 5%; background-color: #02b8dd;">Update
        </button>
    </td>
</form>


</body>
</html>