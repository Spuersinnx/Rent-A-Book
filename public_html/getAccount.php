<?php
session_start();
require_once('../db/db_config.php');
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$creditCard = $_POST['cardNumber'];
$cardDate = $_POST['cardDate'];
$_SESSION['accountError'] = array();

if (empty($firstName)) {
    $_SESSION['firstName'] = $_POST['firstName'];
    $_SESSION['nameError'] = 'Please fill out your first Name';


} else {

    unset($_SESSION['nameError']);
    $queryName = "UPDATE userInfo SET firstName = :firstName WHERE userID = '" . $_SESSION['personID'] . "'";
    $statementName = $db->prepare($queryName);
    $statementName->bindValue(':firstName', $firstName);
    $statementName->execute();
    $_SESSION['firstName'] = $_POST['firstName'];
}

if(empty($lastName)) {
    $_SESSION['lastName'] = $_POST['lastName'];
    $_SESSION['lNameError'] = 'Please fill out your last Name';
}
else {

    unset($_SESSION['lNameError']);
    $queryName = "UPDATE userInfo SET lastName = :lastName WHERE userID = '" . $_SESSION['personID'] . "'";
    $statementName = $db->prepare($queryName);
    $statementName->bindValue(':lastName', $lastName);
    $statementName->execute();
    $_SESSION['lastName'] = $_POST['lastName'];
}

if(empty($creditCard) || strlen($creditCard) < 15) {
    $_SESSION['cardNumber'] = $_POST['cardNumber'];
    $_SESSION['cardError'] = 'Please fill out your credit card number';
}
else {

    unset($_SESSION['cardError']);
    $queryName = "UPDATE card SET cardNumber = :cardNumber WHERE userID = '" . $_SESSION['userID'] . "'";
    $statementName = $db->prepare($queryName);
    $statementName->bindValue(':cardNumber', $creditCard);
    $statementName->execute();
    $_SESSION['cardNumber'] = $_POST['cardNumber'];
}

$cardReg = '/(0[1-9]|10|11|12)/20[0-9]{2}$/';

if(empty($cardDate)){
    $_SESSION['cardDate'] = $_POST['cardDate'];
    $_SESSION['cardDateError'] = 'Please fill out your credit card expiration date';
}
else {

    unset($_SESSION['cardDateError']);
    $queryName = "UPDATE card SET cardDate = :cardDate WHERE userID = '" . $_SESSION['userID'] . "'";
    $statementName = $db->prepare($queryName);
    $statementName->bindValue(':cardDate', $cardDate);
    $statementName->execute();
    $_SESSION['cardDate'] = $_POST['cardDate'];
}



header("location:account.php");
?>