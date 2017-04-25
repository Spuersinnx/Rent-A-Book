<?php
require_once ('../db/db_config.php');
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
                    <li><a href="#" onclick="document.forms[0].submit();"> Log Out</a></li>
                </ul>
            </form>
        </nav>
    </div>
</header>

