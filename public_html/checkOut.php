<?php
session_start();
require_once ('../db/db_config.php');


//find books in bookitem with bookID identical to cart books
foreach ($_SESSION['cartCheckOut'] as $cartItem=>$bookID) {

    $queryBooks = "SELECT bookID FROM bookItem WHERE bookID IN (".implode(',',$_SESSION['cartCheckOut']).")";
    $statementQueryBooks = $db->prepare($queryBooks);
    $statementQueryBooks->execute();
    $matchedBookID = $statementQueryBooks->fetchAll();

}

foreach ($matchedBookID as $matchedID) {
    $IDs[] = $matchedID['bookID'];
}

$matchedArray = implode(',', $IDs);
echo $matchedArray;


$querySetAvailability = "UPDATE bookItem SET available = 'no' WHERE available IN( SELECT TOP 1 FROM bookItem WHERE bookID IN (".implode(',',$IDs).") )  ";


//WHERE bookID IN (".implode(',',$IDs).")";
$statementAvailability = $db->prepare($querySetAvailability);
$statementAvailability->execute();



?>