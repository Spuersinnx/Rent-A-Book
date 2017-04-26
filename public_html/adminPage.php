<?php
session_start();
require_once ('../db/db_config.php');

$queryBookInfo = 'SELECT * FROM books INNER JOIN author ON books.bookID = author.bookID INNER Join genre ON genre.genreID = books.genreID';
$statementBooks = $db->prepare($queryBookInfo);
$statementBooks->execute();
$bookEntry = $statementBooks->fetchAll();


$queryUserInfo = $db->prepare("SELECT userinfo.firstName, userinfo.lastName, userinfo.userID, userinfo.personID, users.userPassword, users.userEmail
                  FROM userinfo INNER JOIN users ON (userinfo.userID = users.userID)");
$queryUserInfo->execute();
$users = $queryUserInfo->fetchAll();


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

<h3><b>Administrator Dashboard</b></h3>
<br />


<table class="admin1">
    <tr>
        <th>Book Image</th>
    <th>Book Name</th>
    <th>ISBN</th>

        <th>Author Name</th>
        <th>Genre</th>

    <th></th>
    </tr>

<?php
foreach ($bookEntry as $book) {
    echo '
    <tr>
    <td><img src="'.$book['bookImage'].'" width="75px" height="112px"</td>
    <td>'.$book['bookName'].'</td>
    <td>'.$book['ISBN'].'</td>
    <td>'.$book['authorName'].'</td>
    <td>'.$book['genreName'].'</td>
    
    <form action="adminBookInfo.php" method="post">
    <input type="hidden" name="bookID" value="'.$book['bookID'].'">
    <input type="hidden" name="genreID" value="'.$book['genreID'].'">
    <td><button type="submit" class="cartDeleteButton" name="update" style="background-color:#02b8dd ">Update</button></td>
     </form>
     
     <form action="adminDeleteB.php" method="post">
     <input type="hidden" name="bookID" value="'.$book['bookID'].'">
     <td><button type="submit" class="cartDeleteButton" name="delete" >Delete</button></td>
     </form>
     
    </tr>';

}

?>

</table> <br/>


<form action='adminNewBook_Form.php' method="post">
    <button type="submit" class="cartDeleteButton" name="add" style="margin-left: 78.5%; background-color: #02b8dd;">Add New Book</button>
</form>
</body>
</html>