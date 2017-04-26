<?php
session_start();
require_once ('../db/db_config.php');

$queryStates = "SELECT * FROM state";
$statementStates = $db->prepare($queryStates);
$statementStates->execute();
$states = $statementStates->fetchAll();

#Check if error variables are set
$_SESSION['nameError'] = (isset($_SESSION['nameError']) ? $_SESSION['nameError'] : null);
$_SESSION['lNameError'] = (isset($_SESSION['lNameError']) ? $_SESSION['lNameError'] : null);
$_SESSION['cardError'] = (isset($_SESSION['cardError']) ? $_SESSION['cardError'] : null);
$_SESSION['cardDateError'] = (isset($_SESSION['cardDateError']) ? $_SESSION['cardDateError'] : null);

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
                <li><a href="myRentals.php"> My Rentals </a></button></li>
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
    <h5 style="margin-left: 0px;" >Profile Information</h5>
<form class="accountForm" action="getAccount.php" method="post">

    <table>
       <tr>
           <td>First Name:</td>
           <td><input type="text" name="firstName" value="<?php echo $_SESSION['firstName'];?>"></td>
           <td>Last Name:</td>
           <td><input type="text" name="lastName" value="<?php echo $_SESSION['lastName'];?>"></td>

       </tr>


        <tr>

        </tr>

</div>

<div class="menu-container2" style="float: left; margin-left: 180px; width: 100%; text-align: left;">

    <tr><td></td></tr>
    <tr><td><h5 style="margin-left: 0px;">Billing Information</h5></td></tr>
    <tr>
                <td>Name: </td>
                <td><input type="text" name="cardName" value="<?php echo $_SESSION['cardName'];?>"></td>
                <td>Credit Card Number: </td>
                <td><input type="text" name="cardNumber" value="<?php echo $_SESSION['cardNumber'];?>"></td>
                <td>Expiration Date: </td>
                <td><input type="text" name="cardDate" value="<?php echo $_SESSION['cardDate'];?>"></td>

            </tr>

</div>

<div class="menu-container2" style="float: left; margin-left: 180px; width: 100%; text-align: left;">

    <tr><td></td></tr>
    <tr><td><h5 style="margin-left: 0px;">Address Information</h5></td></tr>
    <tr>
        <td>Address:</td>
        <td><input type="text" name="address" value="<?php echo $_SESSION['address']; ?>"></td>
        <td>City: </td>
        <td><input type="text" name="city" value="<?php echo $_SESSION['cityName'] ?>"></td>
        <td>State: </td>
        <td>
            <select name="state">
            <?php
            foreach ($states as $state) {

                if ($state['stateName'] == $_SESSION['stateName']) {
                    echo '
                    <option selected="selected">'.$_SESSION['stateName'].'</option>
                    ';
                }
                else {
                    echo '<option>'.$state['stateName'].'</option>';
                }
            }

            ?>
            </select>
        </td>


    </tr>
    </table>
</div>
<?php

echo '<p style="color: red; margin-left: 180px;"> '.$_SESSION['nameError'].'</p>';
echo '<p style="color: red; margin-left: 180px;"> '.$_SESSION['lNameError'].'</p>';
echo '<p style="color: red; margin-left: 180px;"> '.$_SESSION['cardError'].'</p>';
echo '<p style="color: red; margin-left: 180px;"> '.$_SESSION['cardDateError'].'</p>';

?>
<button type="submit" class="cartDeleteButton" name="checkOut" style="background-color: #02b8dd; margin-left: 180px; padding: 14px 30px; ">Save</button>
</form>







</body>

</html>
