<?php
session_start();
require_once ('../db/db_config.php');


//find books in bookitem with bookID identical to cart books
foreach ($_SESSION['cartCheckOut'] as $cartItem=>$bookID) {

    $queryBooks = "SELECT * FROM bookItem WHERE bookID IN (".implode(',',$_SESSION['cartCheckOut']).")";
    $statementQueryBooks = $db->prepare($queryBooks);
    $statementQueryBooks->execute();
    $matchedBookID = $statementQueryBooks->fetchAll();

}

foreach ($matchedBookID as $matchedID) {
    $IDs[] = $matchedID['bookID'];
}

print_r($IDs);

//make books unavailable
//$querySetAvailability = "UPDATE bookItem SET available = 'no' WHERE bookID IN (".implode(',',$IDs).") ";
//$statementAvailability = $db->prepare($querySetAvailability);
//$statementAvailability->execute();

//charge credit card
$queryCredit = "SELECT * FROM card WHERE userID = '". $_SESSION['userID']."' ";
$statementCredit = $db->prepare($queryCredit);
$statementCredit->execute();
$userCard = $statementCredit->fetchAll();

$date=gmdate('d.m.y h:i:s');



//$insertRentalQuery = "INSERT INTO rentals (userID, startDate, endDate, bookItemID) VALUES('". $_SESSION['userID']."', '".$date."',  )"



?>