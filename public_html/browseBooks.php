<?php
session_start();
require_once ('../db/db_config.php');

$queryDbBooks = 'SELECT * FROM books, author WHERE author.bookID = books.bookID';
$statementDbBooks = $db->prepare($queryDbBooks);
$statementDbBooks->execute();
$dbBooks = $statementDbBooks->fetchAll();

$_SESSION['cart']=isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$cartSize = 0;

if(isset($_POST['isSubmitted'])) {
    $bookID = $_POST['bookID'];
    $queryBookItem = 'SELECT * FROM bookItem WHERE bookID = :bookID LIMIT 1';
    $statementBookItem = $db->prepare($queryBookItem);
    $statementBookItem->bindValue(':bookID', $bookID);
    $statementBookItem->execute();
    $bookItem = $statementBookItem->fetch();

    if ($bookItem > 0) {
        $_SESSION['cart'][] = array ('bookID'=>$bookItem['bookID']);
        $cartSize = sizeof($_SESSION['cart']);
    }

    else {
        echo 'none';
    }

print_r($_SESSION['cart']);

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
                    <li><a href="account.php"> My Account</a></li>

                    <li><a href="#" onclick="document.forms[0].submit();"> Log Out</a></li>
                </ul>
            </form>
        </nav>
    </div>

</header>
<hr>

<form>
   <h6 align="right" style="margin-right: 200px; font-size: medium;"><?php echo $cartSize?> Items <img src="img/content/cart.png"></h6>
</form>


<table class="browseBooks">

    <?php
    foreach($dbBooks as $dbBook) {
        echo '
        <form action="" method="post">
        
        <tr style=" padding: 10px;border: 1px solid;border-collapse: collapse;">
        <td style=" padding: 10px;border: 1px solid;border-collapse: collapse;"><img src="img/content/bookIcon.png"></td>
        <td style="padding: 10px; border: 1px solid;border-collapse: collapse;">'.$dbBook['bookName'].' by '.$dbBook['authorName'].'</td>
        
        <input type="hidden" name="bookID" value='.$dbBook['bookID'].'>
        
        <td style=" padding: 10px;border: 1px solid;border-collapse: collapse;"><input type="image" src="img/content/info.png" name="description" title="View Description"></td>
        <input type="hidden" name="isSubmitted" value="1">
        <td style=" padding: 10px;border: 1px solid;border-collapse: collapse;"><input type="image" src="img/content/cart-plus.png" name="addCart" title="Add to Cart"></td>
        </tr>
        
        </form>
        ';
    }
    ?>
</table>






</body>
</html>
