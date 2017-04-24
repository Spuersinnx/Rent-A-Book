<?php
session_start();
require_once ('../db/db_config.php');

$rentalID = $_POST['rentalID'];

//update availability to yes.
$queryReturn = "UPDATE bookItem set available = 'yes'  WHERE bookItemID = :rentalID ";
$statementReturn = $db->prepare($queryReturn);
$statementReturn->bindValue(':rentalID', $rentalID);
$statementReturn->execute();

//insert rental into archivedRentals table
$queryStatus = "INSERT INTO archivedRentals(userID, startDate, endDate, bookItemID) SELECT userID, startDate, endDate, bookItemID FROM rentals WHERE bookItemID = :rentalID";
$statementStatus = $db->prepare($queryStatus);
$statementStatus->bindValue(':rentalID', $rentalID);
$statementStatus->execute();

//delete from rentals
$queryDelete = "DELETE from rentals WHERE userID = '". $_SESSION['userID']."' AND bookItemID = :rentalID";
$statementDelete = $db->prepare($queryDelete);
$statementDelete->bindValue(':rentalID', $rentalID);
$statementDelete->execute();

header("location:memberPage.php");

?>