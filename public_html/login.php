<?php
session_start();
require_once ('../db/db_config.php');

$errorMsg[] = '';

    $userEmail = $_POST['email'];
    $password = $_POST['password'];

    //check if password is correct
    $queryUsername = "SELECT userEmail FROM users WHERE userEmail =:userEmail";
    $statementUsername = $db->prepare($queryUsername);
    $statementUsername->bindValue(":userEmail", $userEmail);
    $statementUsername->execute();
    $userName = $statementUsername->fetch();


    $queryPassword = "SELECT userPassword FROM users WHERE userEmail =:userEmail ";
    $statementPassword = $db->prepare($queryPassword);
    $statementPassword->bindValue(":userEmail", $userEmail);
    $statementPassword->execute();
    $userPassword = $statementPassword->fetch();
    $dbPassword = $userPassword[0];

    //verify password
    if (password_verify($password, $dbPassword)) {
       $errorMsg[] = '';
    }

    else {
        $errorMsg[] = 'Invalid Credentials';
    }


    $_SESSION['login.Error'] = array_filter($errorMsg);

    //get user info, and display
    if(empty($_SESSION['login.Error'])) {
        $queryUser = "SELECT * FROM userInfo INNER JOIN users ON userInfo.userID = users.userID";
        $statementUser = $db->prepare($queryUser);
        $statementUser->execute();
        $userInfo = $statementUser->fetch();

        $_SESSION['firstName'] = $userInfo['firstName'];
        $_SESSION['lastName'] = $userInfo['lastName'];
    }


echo json_encode($errorMsg);

?>