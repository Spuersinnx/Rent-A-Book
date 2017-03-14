<?php
require_once("../db/db_config.php");


$emailRegex = '/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i';
$containLetter = '/[A-z]/';
$containUppercase = '/[A-Z]/';
$containNumber = '/\d/';
$error[] = '';

if (isset($_POST['signUp'])) {

    $firstName = $_POST['newFirstName'];
    $lastName = $_POST['newLastName'];
    $email = $_POST['newEmail'];
    $password = $_POST['newPsw'];
    $confirmPass = $_POST['confirmPsw'];

    if (!preg_match($emailRegex, $email)) {
        $error[] = 'Please enter a valid email address';
    } else {
        $query = "SELECT email FROM users WHERE email = :newEmail";
        $statement = $db->prepare($query);
        $statement->bindValue(':newEmail', $email);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (!empty($row)) {
            $error[] = 'Email provided already in use';
        }
    }

    if (strlen($firstName) < 2) {
        $error[] = 'First name too short';

    }

    if (strlen($lastName) < 2) {
        $error[] = 'Last name too short';

    }

    if (!(preg_match($containLetter, $password) || preg_match($containUppercase, $password) || preg_match($containNumber, $password))) {
        $error[] = 'Password does not meet minimum requirements';
    }

    if ($password != $confirmPass) {
        $error[] = 'Passwords do not match';
    }

    if (!empty($error)) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $activationCode = md5(uniqid(rand(), true));
        $query = 'INSERT INTO users(userEmail, userPassword) VALUES(:newEmail, :newPsw)';
        $statement = $db->prepare($query);
        $statement->bindValue(':newEmail', $email);
        $statement->bindValue(':newPsw', $hashedPassword);
        $statement->execute();
        
        $userID = $db->lastInsertId();
        $queryInfo = 'INSERT INTO userInfo(userID, firstName, lastName) VALUES('.$userID.', :newFirstName, :newLastName)';
        $statementInfo = $db->prepare($queryInfo);
        $statementInfo->bindValue(':newFirstName', $firstName);
        $statementInfo->bindValue(':newLastName', $lastName);
        $statementInfo->execute();

    }


}


?>