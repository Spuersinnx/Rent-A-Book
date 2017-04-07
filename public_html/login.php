<?php
session_start();
require_once ('../db/db_config.php');

if (isset($_POST['logIn'])) {
    $userEmail = $_POST['email'];
    $password = $_POST['password'];
    $queryPassword = "SELECT userPassword FROM users WHERE userEmail =:userEmail ";
    $statementPassword = $db->prepare($queryPassword);
    $statementPassword->bindValue(":userEmail", $userEmail);
    $statementPassword->execute();
    $userPassword = $statementPassword->fetch();
    $dbPassword = $userPassword[0];

    if (password_verify($password, $dbPassword)) {
        header("location:memberPage.php");
    }

    $queryUser = "SELECT * FROM userInfo INNER JOIN users ON users.userID= userInfo=userID";

}

?>