<?php
session_start();
require_once ('../db/db_config.php');

$queryDbBooks = 'SELECT * FROM books, author WHERE author.bookID = books.bookID';
$statementDbBooks = $db->prepare($queryDbBooks);
$statementDbBooks->execute();
$dbBooks = $statementDbBooks->fetchAll();

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
                    <li><a href="account.php"> My Account</a></li>

                    <li><a href="#" onclick="document.forms[0].submit();"> Log Out</a></li>
                </ul>
            </form>
        </nav>
    </div>

</header>
<hr>

<h5 align="right" style="margin-right: 200px;">View Cart</h5>

<table class="browseBooks">
    <?php
    foreach($dbBooks as $dbBook) {
        echo '
        <tr style=" padding: 10px;border: 1px solid;border-collapse: collapse;">
        <td style=" padding: 10px;border: 1px solid;border-collapse: collapse;"><img src="img/content/bookIcon.png"></td>
        <td style="padding: 10px; border: 1px solid;border-collapse: collapse;">'.$dbBook['bookName'].' by '.$dbBook['authorName'].'</td>
        <input type="hidden" value='.$dbBook['bookID'].'>
        <td style=" padding: 10px;border: 1px solid;border-collapse: collapse;"><input type="image" src="img/content/info.png" title="View Description"></td>
        <td style=" padding: 10px;border: 1px solid;border-collapse: collapse;"><input type="image" src="img/content/cart-plus.png" title="Add to Cart"></td>
        </tr>
        ';
    }
    ?>
</table>






</body>
</html>
