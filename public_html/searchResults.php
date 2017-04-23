<?php
session_start();
$userResults = $_SESSION['userResults'];


?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Rent a Book - Search Results</title>
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
    <h6 align="right" style="margin-right: 200px; font-size: medium;"><?php echo $_SESSION['cartSize']; ?> Items <input
                type="image" title="View Cart" src="img/content/cart.png"></h6>
</form>

<table class="genreBooks">

    <?php foreach ($userResults as $results) : ?>

        <tr style=" padding: 10px;">
            <td style="padding: 10px; "><img src="<?= $results['bookImage'] ?>" width="150px" height="200px"></td>
            <td style="vertical-align: top; padding-top: 15px;"><a
                        href="bookInfoRent.php?bookID=<?= $results['bookID'] ?>"><?= $results['bookName'] ?></a>
                by <?= $results['authorName'] ?></td>
        </tr>
    <?php endforeach; ?>
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
