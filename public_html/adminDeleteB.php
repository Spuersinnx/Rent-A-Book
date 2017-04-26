<?php
session_start();
require_once ('../db/db_config.php');
$bookID = $_POST['bookID'];

$queryDelete = 'DELETE FROM books WHERE bookID = :bookID';
$statementDelete = $db->prepare($queryDelete);
$statementDelete->bindValue(':bookID', $bookID);
$statementDelete->execute();

$queryDelete2 = 'DELETE FROM bookItem WHERE bookID = :bookID';
$statementDelete2 = $db->prepare($queryDelete2);
$statementDelete2->bindValue(':bookID', $bookID);
$statementDelete2->execute();

$queryDelete3 = 'DELETE FROM author WHERE bookID = :bookID';
$statementDelete3 = $db->prepare($queryDelete3);
$statementDelete3->bindValue(':bookID', $bookID);
$statementDelete3->execute();


header("location:adminPage.php");
?>