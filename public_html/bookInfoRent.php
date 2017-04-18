<?php
session_start();
require_once ('../db/db_config.php');

$bookID = $_GET['bookID'];
$queryBookInfo = 'SELECT * FROM books INNER JOIN author ON books.bookID = author.bookID  WHERE books.bookID = :bookID ';
$statementBookID = $db->prepare($queryBookInfo);
$statementBookID->bindValue(':bookID', $bookID);
$statementBookID->execute();
$bookInfo = $statementBookID->fetch();


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

<form>
    <h6 align="right" style="margin-right: 200px; font-size: medium;"><?php echo $_SESSION['cartSize'];?> Items <img src="img/content/cart.png"></h6>
</form>


<div id="bookInfo">
    <img src="<?php echo $bookInfo['bookImage']?> " width="200px" height="300px">
    <h4><?php echo $bookInfo['bookName']?></h4>
    <h5>by <?php echo $bookInfo['authorName']?></h5>
    <p> <?php echo nl2br($bookInfo['bookDescription'])?></p>
    
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
