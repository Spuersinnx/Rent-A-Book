<?php
session_start();
require_once ('../db/db_config.php');
$bookID = $_POST['bookID'];

$queryDisplay = 'SELECT * FROM books INNER JOIN author ON books.bookID = author.bookID WHERE books.bookID = :bookID';
$statementDisplay = $db->prepare($queryDisplay);
$statementDisplay->bindValue(':bookID', $bookID);
$statementDisplay->execute();
$displayBook = $statementDisplay->fetch();


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
                    <li><a href="adminPage.php">Admin Dashboard</a></li>
                    <li><a href="#" onclick="document.forms[0].submit();"> Log Out</a></li>

                </ul>
            </form>
        </nav>
    </div>
</header>

<form action="" method="post">
    <div id="bookInfo" style="margin-bottom: 0%; margin-left: 15%">
        <img src="<?php echo $displayBook['bookImage']?> " width="200px" height="300px">
        <input name="bookName" type="text" style="width: 40%; margin-left: 3%;" value="<?php echo $displayBook['bookName']?>">
        <h5>by</h5><input name="authorName" type="text" style="width: 40%; margin-left: 3%;" value="<?php echo $displayBook['authorName']?>">

    </div>
    <h5 style="margin-left: 32%">Description</h5>
    <textarea cols="65" rows="5" style="margin-left: 32%; margin-top: 0px;"><?php echo $displayBook['bookDescription']?></textarea>

    <td><button type="submit" class="cartDeleteButton" name="delete" style="margin-left: 32%; margin-top: 5%; background-color: #02b8dd;">Update</button></td>
</form>


</body>
</html>