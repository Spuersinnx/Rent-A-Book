<?php
session_start();
require_once ('../db/db_config.php');
?>


<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Rent a Book Rental Policies</title>
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





<h4 style="margin-left: 220px;">General Questions</h4>
<h5>Do I have to provide my credit card information?</h5>
<p class="paragraphFAQ">Yes, your credit card information is required for annual membership fees and rental fees.</p>

<h4 style="margin-left: 220px;">Pricing</h4>
<h5>Will I be charged for membership?</h5>
<p class="paragraphFAQ">Yes, the standard fee for membership annually is $20 per subscription.</p>

<h5>How much will I be charged per rental?</h5>
<p class="paragraphFAQ">The standard price to rent each book, regardless of its category or market price, is $10.</p>

<h5>Will I be taxed when renting?</h5>
<p class="paragraphFAQ">Yes, the tax rate for the total purchase will be at 7%</p>

<h5>Will I have to pay for shipping?</h5>
<p class="paragraphFAQ">No, shipping is free.</p>

<h4 style="margin-left: 220px;">Rentals and Returns</h4>
<h5>How long will I be able to rent out the books?</h5>
<p class="paragraphFAQ">As this is a service built mainly for students, all rentals will be allotted a period of 5 months for rental. </p>

</body>
</html>