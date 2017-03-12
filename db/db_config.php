<?php
$dsn = 'mysql:host=localhost;dbname=rent-a-book';
$username = 'root';
$password = 'root';


try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('db_error.php');
    exit();
}

?>