<?php
session_start();
require_once ('../db/db_config.php');

$bookID = $_POST['bookID'];

foreach ($_SESSION['cart'] as $cartItem=>$book) {
    if($book['bookID'] == $bookID) {
        unset($_SESSION['cart'][$cartItem]);
        $_SESSION['cartSize'] = sizeof($_SESSION['cart']);
    }
}
header("location:viewCart.php");


?>