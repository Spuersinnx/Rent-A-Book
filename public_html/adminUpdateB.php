<?php

require_once ('../db/db_config.php');

$bookName = $_POST['bookName'];
$authorName = $_POST['authorName'];
$ISBN = $_POST['bookISBN'];
$bookDescription = $_POST['bookDescription'];
$bookImage = $_POST['bookImage'];
$genreID = $_POST['genreID'];
$bookID = $_POST['bookID'];



$updateQuery = $db->prepare("UPDATE books
        INNER JOIN author ON (books.bookID = author.bookID)
        SET bookName = :bookName,
            authorName = :authorName,
            genreID = :genreID,
            ISBN = :ISBN,
            bookImage = :bookImage,
            bookDescription = :bookDescription
             
        WHERE bookID = :bookID;");

$updateQuery->execute(array(
    ":bookName" => $bookID,
    ":authorName" => $authorName,
    ":genreID" => $genreID,
    ":ISBN"  => $ISBN,
    ":bookImage" => $bookImage,
    ":bookDescription" => $bookDescription
));

include("adminPage.php");





?>