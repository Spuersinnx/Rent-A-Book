<?php
session_start();
require_once('../db/db_config.php');

if (isset($_SESSION['firstName'])) {
    $firstName = $_SESSION['firstName'];
}
if (isset($_SESSION['lastName'])) {
    $lastName = $_SESSION['lastName'];
}

$queryGenres = 'SELECT * FROM genre';
$statementGenre = $db->prepare($queryGenres);
$statementGenre->execute();
$genres = $statementGenre->fetchAll();

$queryRental = "SELECT * FROM rentals INNER JOIN bookItem on bookItem.bookItemID = rentals.bookItemID INNER JOIN books ON books.bookID = bookItem.bookID WHERE rentals.userID = '". $_SESSION['userID']."' ";
$statementRental = $db->prepare($queryRental);
$statementRental->execute();
$rentals = $statementRental->fetchAll();
//print_r($rentals);


if(count($rentals) > 0) {
 $noRental = '';

}
else {
    $noRental = 'You have no rentals at this time';
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
                    <li><a href="faq.php"> Rental Policy </a></button></li>
                    <li><a href="account.php"> My Account</a></li>


                    <li><a href="#" onclick="document.forms[0].submit();"> Log Out</a></li>
                </ul>
            </form>
        </nav>
    </div>
</header>

<!--Main background Image-->
<div id="books-image">
    <h2>Welcome Back</h2>
</div>

<div class="menu-container">
    <img src="img/content/user.png">
    <p><?php echo $firstName . ' ' . $lastName ?></p>
</div>

<div class="menu-container2">
    <h3>My Books</h3>

    <h5 style="margin-left: 600px; color: #777777"><?php echo $noRental?></h5>
    <table id="rentals">
        <th>Book</th>
        <th>ISBN</th>
        <th>Date Rented</th>
        <th>Date Due</th>
        <?php
        foreach ($rentals as $rental) {
            echo '
            <tr>
            <td>'.$rental['bookName'].'</td>
            <td>'.$rental['ISBN'].'</td>
            <td>'.$rental['startDate'].'</td>
            <td>'.$rental['endDate'].'</td>
            <td><button type="submit" class="cartDeleteButton" name="return" style="padding: 5px;" >Return</button></td>
            </tr>
            
            ';
        }
        ?>
    </table>
</div>


<div class="menu-container2">
</div>
<hr>

<div class="menu-container2">
    <h3>Rent a book</h3>
</div>

<div class="menu-container2">
    <?php include 'Search.php' ?>
</div>

<hr>

<div class="menu-container2">
    <h3>Browse Books</h3>

    <table class="browseBooks">
        <?php
        $counter = 0;

        foreach ($genres as $genre) {

            echo '
            <form class="browseBooks" action="browseBooks.php" method="post">
            <td><a href="browseBooks.php?genreID='.$genre['genreID'].'" >'.$genre['genreName'].'</a>  books</td>
            <input type="hidden" name="genreID" value="'.$genre['genreID'].'">
           
            ';
            $counter++;
            if($counter % 2 == 0)
            {
                echo '</tr><tr>';
            }


        } ?>
    </table>

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
