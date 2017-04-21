<?php
session_start();
require_once ('../db/db_config.php');

$bookID = $_POST['bookID'];

foreach ($_SESSION['cart'] as $cartItem=>$book) {
    if($book['bookID'] == $bookID) {
        unset($_SESSION['cart'][$cartItem]);
        $_SESSION['cartSize'] = sizeof($_SESSION['cart']);
        $_SESSION['subTotal'] -= 15;

    }
    $_SESSION['taxes'] = (0.07 * $_SESSION['subTotal']);
    $_SESSION['total'] = ($_SESSION['subTotal'] + $_SESSION['taxes']);
}
header("location:viewCart.php");


?>