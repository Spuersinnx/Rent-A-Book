<?php
session_start();
require_once('../db/db_config.php');
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$creditCard = $_POST['cardNumber'];
$cardName = $_POST['cardName'];
$cardDate = $_POST['cardDate'];
$state = $_POST['state'];
$city = $_POST['city'];
$address = $_POST['address'];

$_SESSION['accountError'] = array();

$queryRecords = "SELECT * FROM address WHERE address.personID = '". $_SESSION['personID']."'";
$statementRecords = $db->prepare($queryRecords);
$statementRecords->execute();
$records = $statementRecords->fetchAll();

if(count($records) > 0) {
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

    if(empty($cardName)){
        $_SESSION['cardName'] = $_POST['cardName'];
        $_SESSION['cardNameError'] = "Please add your Card Name";


    }else{
        unset($_SESSION['cardNameError']);
        $queryCardName = $db->prepare("UPDATE card
                                                SET cardName = :cardName
                                                WHERE userID = '" . $_SESSION['userID'] . "'");
        $queryCardName->execute(array(
            ":cardName" => $cardName
        ));
        $_SESSION['cardName'] = $_POST['cardName'];


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

    if(empty($address)){

        $_SESSION['address'] = $_POST['address'];
        $_SESSION['addressError'] = 'Please add your Address';

    }else{

        unset($_SESSION['addressError']);
        $queryAddress = $db->prepare("UPDATE address 
                                               SET address = :address
                                               WHERE personID = '" . $_SESSION['personID'] . "'");
        $queryAddress->execute(array(
            ":address" => $address
        ));
        $_SESSION['address'] = $address;

    }

    if(empty($city)){
        $_SESSION['cityName'] = $_POST['city'];
        $_SESSION['cityError'] = 'Please add your City';

    }else{

        unset($_SESSION['cityError']);
        $queryCity = $db->prepare("UPDATE city c
                                            INNER JOIN address a ON c.cityID = a.cityID
                                            SET c.cityName = :city 
                                            WHERE a.personID = '" . $_SESSION['personID'] . "'");
        $queryCity->execute(array(
            ":city" => $city
        ));
        $_SESSION['cityName'] = $city;


    }
}

else {

    $queryCard = "INSERT INTO card(cardName, cardNumber, cardDate, userID) VALUES(:cardName, :cardNumber, :cardDate, '" . $_SESSION['userID'] . "') ";
    $statementCard = $db->prepare($queryCard);
    $statementCard->bindValue(':cardName', $cardName);
    $statementCard->bindValue(':cardNumber', $creditCard);
    $statementCard->bindValue(':cardDate', $cardDate);
    $statementCard->execute();

    $_SESSION['cardDate'] = $_POST['cardDate'];
    $_SESSION['cardNumber'] = $_POST['cardNumber'];
    $_SESSION['cardName'] = $_POST['cardName'];

    $queryAddress2 = 'INSERT INTO city(cityName, stateID) VALUES(:cityName, (SELECT stateID from state where stateName =:stateName))';
    $statementAddress2 = $db->prepare($queryAddress2);
    $statementAddress2->bindValue(':cityName', $city);
    $statementAddress2->bindValue(':stateName', $state);
    $statementAddress2->execute();

    $_SESSION['cityName'] = $_POST['city'];
    $_SESSION['stateName'] = $_POST['state'];


    $queryStateID = "SELECT stateID from state WHERE stateName = '" . $_SESSION['state'] . "'";
    $statementID = $db->prepare($queryStateID);
    $stateID = $statementID->execute();

    $queryAddress3 = "INSERT INTO address(personID, address, cityID, stateID) VALUES('" . $_SESSION['personID'] . "', :address,(SELECT cityID from city WHERE cityName =:cityName) , (SELECT stateID FROM state WHERE stateName = :stateName) )";
    $statementAddress3 = $db->prepare($queryAddress3);
    $statementAddress3->bindValue(':cityName', $city);
    $statementAddress3->bindValue(':address',$address );
    $statementAddress3->bindValue(':stateName', $state);
    $statementAddress3->execute();


    $_SESSION['address'] = $_POST['address'];




}





header("location:account.php");
?>