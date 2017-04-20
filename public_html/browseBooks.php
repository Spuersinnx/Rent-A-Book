<?php
session_start();
require_once ('../db/db_config.php');

$getGenre = $_GET['genreID'];

$queryGenre = 'SELECT * FROM books INNER JOIN author ON books.bookID = author.bookID WHERE books.genreID = :genreID';
$statementGenre = $db->prepare($queryGenre);
$statementGenre->bindValue(':genreID', $getGenre);
$statementGenre->execute();
$genreBooks = $statementGenre->fetchAll();



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

<form method="post" action="viewCart.php">
    <h6 align="right" style="margin-right: 200px; font-size: medium;"><?php echo $_SESSION['cartSize'];?> Items <input type="image" title="View Cart" src="img/content/cart.png"></h6>
</form>

<table class="genreBooks">
    <?php
    foreach($genreBooks as $genreBook) {
        echo '
        <tr style=" padding: 10px;">
        <td style="padding: 10px; "><img src="'.$genreBook['bookImage'].'" width="150px" height="200px"></td>
        <td style="vertical-align: top; padding-top: 15px;"><a href="bookInfoRent.php?bookID='.$genreBook['bookID'].'" > '.$genreBook['bookName'].'</a>  by '.$genreBook['authorName'].'</td>
        </tr>
        ';
    }
    ?>
</table>



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
