<?php
session_start();
require_once ('../db/db_config.php');

//get book Information
$bookID = $_GET['bookID'];
$queryBookInfo = 'SELECT * FROM books INNER JOIN author ON books.bookID = author.bookID  WHERE books.bookID = :bookID ';
$statementBookID = $db->prepare($queryBookInfo);
$statementBookID->bindValue(':bookID', $bookID);
$statementBookID->execute();
$bookInfo = $statementBookID->fetch();

$_SESSION['cart']=isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

#Check subTotal
$_SESSION['subTotal'] = (isset($_SESSION['subTotal']) ? $_SESSION['subTotal'] : 0);

//if user clicked rent
if(isset($_POST['rent'])) {

    $bookItem = array (
        'bookID' => $bookInfo['bookID'],
        'bookName' => $bookInfo['bookName'],
        'bookAuthor' => $bookInfo['authorName'],
        'bookImage' =>$bookInfo['bookImage']
    );


    //checks if item is already in cart, allows user to rent one of each book only
    if(in_array($bookItem, $_SESSION['cart'])) {
            $cartError = 'Item already in cart';
    }

    else {
            $cartError = '';
            $_SESSION['cart'][] = $bookItem;
            $_SESSION['subTotal'] += 10;
            $_SESSION['taxes'] = (0.07 * $_SESSION['subTotal']);
            $_SESSION['total'] = ($_SESSION['subTotal'] + $_SESSION['taxes']);
    }





}

//cart size
$_SESSION['cartSize'] = sizeof($_SESSION['cart']);


#Check if Error variable is set
$cartError = (isset($cartError) ? $cartError : null);


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

            <ul>
                <li><a href="memberPage.php"> Home </a></button></li>
                <li>
                    <form id="logout" action="logout.php" method="post" style="cursor: pointer"><a
                            onclick="document.getElementById('logout').submit();">Log Out</a></form>

                </li>

            </ul>

        </nav>
    </div>
</header>
<hr>

<form method="post" action="viewCart.php">
    <h6 align="right" style="margin-right: 200px; font-size: medium;"><?php echo $_SESSION['cartSize'];?> Items <input type="image" title="View Cart" src="img/content/cart.png"></h6>
    <input type="hidden" name="viewCart" value="1">
</form>


<div id="bookInfo">
    <img src="<?php echo $bookInfo['bookImage']?> " width="200px" height="300px">
    <h4 style="margin-right: 80px;"><?php echo $bookInfo['bookName']?></h4>
    <h5>by <?php echo $bookInfo['authorName']?></h5>
    <p> <?php echo nl2br($bookInfo['bookDescription'])?></p>
    <form action="" method="post">
        <button type="submit" class="rentButton" name="rent">Rent</button>
    </form>
    <?php echo '<p style="color: red"> '.$cartError.'</p>';?>

</div>






<footer>
    <div class="wrapper">
        <div id="footer-info">
            <p><a href="#">Terms of Service</a> I <a href="#">Privacy</a></p>
            <p>Icons made by <a href="http://www.flaticon.com/authors/pixel-perfect" title="Pixel perfect">Pixel
                    perfect</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed
                by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0"
                      target="_blank">CC 3.0 BY</a></p>
        </div>
    </div>
</footer>
