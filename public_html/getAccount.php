<?php
session_start();
require_once('../db/db_config.php');
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$_SESSION['accountError'] = array();

if (empty($firstName)) {
    $_SESSION['firstName'] = '';
   $nameError = 'Please fill out your first Name';
    array_push($_SESSION['accountError'],$nameError);

} else {

    unset($_SESSION['accountError']);
    $queryName = "UPDATE userInfo SET firstName = :firstName WHERE userID = '" . $_SESSION['personID'] . "'";
    $statementName = $db->prepare($queryName);
    $statementName->bindValue(':firstName', $firstName);
    $statementName->execute();
    $_SESSION['firstName'] = $_POST['firstName'];
}

if(empty($lastName)) {
    $_SESSION['lastName'] = '';
    $LnameError = 'Please fill out your last Name';
    array_push($_SESSION['accountError'],$LnameError);
}
else {

    unset($_SESSION['accountError']);
    $queryName = "UPDATE userInfo SET lastName = :lastName WHERE userID = '" . $_SESSION['personID'] . "'";
    $statementName = $db->prepare($queryName);
    $statementName->bindValue(':lastName', $lastName);
    $statementName->execute();
    $_SESSION['lastName'] = $_POST['lastName'];
}



header("location:account.php");
?>