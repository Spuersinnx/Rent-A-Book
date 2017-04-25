<?php
session_start();
require_once ('../db/db_config.php');


//find books in bookitem with bookID identical to cart books
foreach ($_SESSION['cartCheckOut'] as $cartItem=>$bookID) {

    $queryBooks = "SELECT * FROM bookItem WHERE bookID IN (".implode(',',$_SESSION['cartCheckOut']).")";
    $statementQueryBooks = $db->prepare($queryBooks);
    $statementQueryBooks->execute();
    $matchedBookID = $statementQueryBooks->fetchAll();

}

foreach ($matchedBookID as $matchedID) {
    $IDs[] = $matchedID['bookID'];
}



//print_r($IDs);

//charge credit card and check that user has credit card in db
$queryCredit = "SELECT * FROM card WHERE userID = '". $_SESSION['userID']."' ";
$statementCredit = $db->prepare($queryCredit);
$statementCredit->execute();
$userCard = $statementCredit->fetch();

$lastFour = substr($userCard['cardNumber'], -4);

if($userCard < 0) {
    $_SESSION['cardError'] = 'You have no credit card on record. Please update your credit information before checking out';
}

else {
    $_SESSION['cardError'] = '';
//make books unavailable
    $querySetAvailability = "UPDATE bookItem SET available = 'no' WHERE bookID IN (" . implode(',', $IDs) . ") ";
    $statementAvailability = $db->prepare($querySetAvailability);
    $statementAvailability->execute();


//rental period for user
//get current year
    $currentYear = date("Y");

//current date and UTC time
    $date = gmdate('' . $currentYear . '-m-d');
    $dateTime = strtotime($date);

//end date for user
    $endDate = date('Y-m-d', strtotime($date . ' + 90 days'));

    foreach ($matchedBookID as $matched) {
        $bookItemIDs[] = $matched['bookItemID'];
    }


//insert rental into table for user per book rented
    foreach ($bookItemIDs as $bookItemID) {
        $insertRentalQuery = "INSERT INTO rentals (userID, startDate, endDate, bookItemID) VALUES('" . $_SESSION['userID'] . "', '" . $date . "', '" . $endDate . "', '" . $bookItemID . "'  )";
        $statementRent = $db->prepare($insertRentalQuery);
        $statementRent->execute();
    }

}




?>

<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Rent a Book</title>
    <link type="text/css" rel="stylesheet" href="css/mainstyle.css">
    <link type="text/css" rel="stylesheet" href="css/style.css">
</head>

<body>
<header>
    <div class="wrapper">
        <h1>Rent a Book<span class="color">.</span></h1>
        <nav>
            <form action="logout.php" method="POST">
                <ul>
                    <li><a href="memberPage.php"> Home </a></button></li>
                    <li><a href="account.php"> My Account</a></li>
                    <li><a href="#" onclick="document.forms[0].submit();"> Log Out</a></li>
                </ul>
            </form>
        </nav>
    </div>

</header>
<hr>

<h4 align="center">Thank you, <?php  echo $_SESSION['firstName']?> </h4>
<p align="center">Your credit card ending with <strong><?php echo $lastFour;?></strong> , has been charged with a total of $<?php $_SESSION['total']?></p>
<p align="center">To view your due date for this rental, please check your home page under the My Books Section.</p>
</body>
</html>



<?php
foreach ($_SESSION['cart'] as $cartItem=>$book) {
    unset($_SESSION['cart'][$cartItem]);
    $_SESSION['cartSize'] = 0;
    $_SESSION['subTotal'] = 0;
    $_SESSION['taxes'] = (0.07 * $_SESSION['subTotal']);
    $_SESSION['total'] = ($_SESSION['subTotal'] + $_SESSION['taxes']);
}

?>