<?php
session_start();


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
<div class="menu-container2" style="float: left; margin-left: 180px; width: 100%; text-align: left;">
    <h4> My Account Information</h4>

</div>

<div class="menu-container2" style="float: left; margin-left: 180px; width: 100%; text-align: left;">
    <h5 >Profile Information</h5>
    <form class="accountForm" method="post">

        <label>First Name: </label><input type="text" value="<?php echo $_SESSION['firstName'];?>">
        <br>
        <label>Last Name: </label><input type="text" value="<?php echo $_SESSION['lastName'];?>">
        <br>
        <label>Email: </label><input type="text" value="<?php echo $_SESSION['userEmail'];?>">
    </form>
</div>

<div class="menu-container2" style="float: left; margin-left: 180px; width: 100%; text-align: left;">
    <h5>Billing Information</h5>
    <p>test</p>
</div>





</body>

</html>
