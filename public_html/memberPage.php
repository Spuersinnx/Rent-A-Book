<?php
session_start();
require_once ('../db/db_config.php');

if(isset($_SESSION['firstName'])) {
    $firstName = $_SESSION['firstName'];
}
if(isset($_SESSION['lastName'])) {
    $lastName = $_SESSION['lastName'];
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
            <ul>
                <li><button class="dropdownbtn"><a href="account.php"> My Account</a></button></li>
                <li><button class="dropdownbtn"><a href="index.php"> Log Out</a></button></li>
            </ul>
        </nav>
    </div>
</header>

<!--Main background Image-->
<div id="books-image">
    <h2>Welcome Back</h2>
</div>

<div id="menu-container">
    <img src="img/content/user.png"><p><?php echo $firstName.' '. $lastName; ?></p>
</div>

<div id="menu-container2">
    <h3>My Books</h3>
</div>
<hr>
<div id="menu-container2">
</div>
<hr>

<div id="menu-container2">
    <h3>Rent a book</h3>
</div>

<div id="menu-container2">
<?php include 'Search.php' ?>
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
</body>
</html>
