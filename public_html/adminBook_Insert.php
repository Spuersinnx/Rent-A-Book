<?php
/**
 * Created by PhpStorm.
 * User: EpistemicPolymath
 * Date: 4/26/2017
 * Time: 2:16 AM
 */

include_once("../db/db_config.php");

$bookName = $_POST['bookName'];
$authorName = $_POST['authorName'];
$ISBN = $_POST['bookISBN'];
$bookDescription = $_POST['bookDescription'];
$bookImage = $_POST['bookImage'];
$genreID = $_POST['genreID'];

$insertQuery = $db->prepare("INSERT INTO books (bookName, genreID, ISBN, bookImage, bookDescription)
        VALUES
        (:bookName, :genreID, :ISBN, :bookImage, :bookDescription);");
$insertQuery->execute(array(

    ":bookName" => $bookName,
    ":genreID" => $genreID,
    ":ISBN"  => $ISBN,
    ":bookImage" => $bookImage,
    ":bookDescription" => $bookDescription
));

$selectBookID = $db->prepare("SELECT bookID
                                       FROM books
                                       WHERE bookName = :bookName");
$selectBookID->execute(array(

    ":bookName" => $bookName
));
$findBookID = $selectBookID->fetch();
$authorBookID = $findBookID[0];



$insertAuthorQuery = $db->prepare("INSERT INTO author (authorName, bookID)
                                            VALUES (:authorName, :bookID)");
$insertAuthorQuery->execute(array(
    ":authorName" => $authorName,
    ":bookID" => $authorBookID
));

$supplier = 'default';
$available = 'yes';

$insertBookItemQuery = "INSERT INTO bookItem (supplier, available, bookID) VALUES(:supplier, :available, :bookID)";
$statementInsert = $db->prepare($insertBookItemQuery);
$statementInsert->bindValue(':supplier', $supplier);
$statementInsert->bindValue(':available',$available );
$statementInsert->bindValue(':bookID', $authorBookID);
$statementInsert->execute();


header('Location:adminPage.php');
exit();
