<?php
session_start();
require_once ('../db/db_config.php');


$queryRental = "SELECT * FROM rentals INNER JOIN bookItem on bookItem.bookItemID = rentals.bookItemID INNER JOIN books ON books.bookID = bookItem.bookID WHERE rentals.userID = '". $_SESSION['userID']."' ";
$statementRental = $db->prepare($queryRental);
$statementRental->execute();
$rentals = $statementRental->fetchAll();
//print_r($rentals);


if(count($rentals) > 0) {
    $noRental = '';

}
else {
    $noRental = '';
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
                    <li><a href="memberPage.php" > Home </a></button></li>
                    <li><a href="account.php"> <?php echo $_SESSION['firstName']?>'s Account</a></li>


                    <li><a href="#" onclick="document.forms[0].submit();"> Log Out</a></li>
                </ul>
            </form>
        </nav>
    </div>
</header>

<body>
<div class="menu-container2">
    <h3 style="margin-right: 680px;">My Rentals</h3>

    <table id="rentals">
        <tr>
        <th>Book</th>
        <th></th>
        <th>Date Due</th>
            <th></th>
        </tr>

        <?php
        foreach ($rentals as $rental) {
            echo '
            <form action="returnRental.php" method="post">
            <tr>
            <td style="width: 80px;"><img src=" ' . $rental['bookImage']. '" width="75px" height="112px"></td>
            <td style=" vertical-align:top; ">'.$rental['bookName'].'</td>
            <td style="vertical-align:top; ">'.$rental['endDate'].'</td>
            <input type="hidden" name="rentalID" value="'.$rental['bookItemID'].'">
           
            <td style="vertical-align:top;"><button type="submit" class="cartDeleteButton" name="return" style="padding: 10px; " >Return</button></td>
            
            </tr>
            </form>
            
            ';
        }
        ?>
    </table>
</div>

   </body>
</html>

