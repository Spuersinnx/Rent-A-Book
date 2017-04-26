<?php
/**
 * Created by PhpStorm.
 * User: EpistemicPolymath
 * Date: 4/26/2017
 * Time: 2:03 AM
 */


include_once("../db/db_config.php");

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

<form action="adminBook_Insert.php" method="post">
    <div id="bookInfo" style="margin-bottom: 0%; margin-left: 15%">
        <h5>Book Name:</h5>
        <input name="bookName" type="text" style="width: 40%; margin-left: 20%;">

        <h5>by</h5><input name="authorName" type="text" style="width: 40%; margin-left: 20%;"> <br/>

        <h5>ISBN:</h5><input name="bookISBN" type="text" style="width: 40%; margin-left: 20%;">

        <h5>Genre:</h5><select name="genreID" style="margin-left: 20%;">
            <?php foreach ($genres as $genre) : ?>
                <?php if ($genre['genreID'] == $genreID) : ?>
                    <option selected="selected" value="<?= $genre['genreID'] ?>"><?= $genre['genreName'] ?></option>
                <?php else : ?>
                    <option value="<?= $genre['genreID'] ?>"><?= $genre['genreName'] ?></option>
                <?php endif; endforeach; ?>
        </select><br/><br />

        <h5>BookImage URL:</h5>
        <input name="bookImage" type="text" style="width: 40%; margin-left: 20%;">

    </div>


    <h5 style="margin-left: 33%">Description: </h5>
    <textarea name="bookDescription" cols="66" rows="5"
              style="margin-left: 32%; margin-top: 0px;">Enter Book Description here</textarea>
    <br/>

        <button type="submit" class="cartDeleteButton" name="delete"
                style="margin-left: 32%; margin-top: 5%; background-color: #02b8dd;">Add
        </button>

</form>


</body>
</html>
