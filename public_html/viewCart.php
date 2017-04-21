<?php
session_start();
require_once('../db/db_config.php');

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

<h5 style="margin-left: 100px;">Shopping Cart</h5>
<table id="cartBooks" ">
    <?php
    foreach ($_SESSION['cart'] as $cartItem) {

        echo ' 
 
   <tr>
   <td style="width: 80px;"><img src=" ' . $cartItem['bookImage'] . '" width="75px" height="112px"></td>
   <td style="vertical-align: top; padding-top: 5px;">' . $cartItem['bookName'] . ' by ' . $cartItem['bookAuthor'] . '</td>
   
<!--delete from cart-->
   <form method="post" action="cartDelete.php">
   <input type="hidden" name="bookID" value="' . $cartItem['bookID'] . '">
    <td><button type="submit" class="cartDeleteButton" name="rent" >Delete</button></td>
    </form>
 <!--save for later-->
    <td><button type="submit" class="cartDeleteButton" name="save" >Save for Later</button></td>
   </tr>
    
   

   
   ';}

   echo'
   <table id="cartCheckOut">
   <tr>
   <td>Subtotal('.$_SESSION['cartSize'].' Items): </td>
   <td style="padding-left: 10px;"> $'.$_SESSION['subTotal'].' </td>
   </tr>
   
   <tr>
   <td>Taxes: </td>
   <td style="padding-left: 10px;"> $'.$_SESSION['taxes'].' </td>
   </tr>
   
   <tr>
   <td>Total: </td>
   <td style="padding-left: 10px;"> $'.$_SESSION['total'].' </td>
   </tr>
   </table>
   
   
   ';
?>




</table>


</body>




</html>
