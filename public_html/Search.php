<?php

require_once("../db/db_config.php");


$genreSelect = $db->prepare("SELECT *
                                      FROM genre");
$genreSelect->execute();
$genres = $genreSelect->fetchAll();

?>

<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Rent a Book - Search</title>
    <link type="text/css" rel="stylesheet" href="css/mainstyle.css">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>

<body>

<!--Main Search Form Content Image-->
<div id="search-Main">
    <br/>
    <!-- Content -->
    <form id="search-form" action="../db/db_search.php" method="post">


        <input type="text" placeholder="Search by ISBN, author, or title" name="userSearch" value="<?= $userSearch ?>" required style="font-size: large; width: 50%; margin-left: 350px;">
        <select name="genreFilter">
            <option value="<?=null?>" selected="selected">None</option>
            <?php foreach($genres as $genre) : ?>
                <option value="<?= $genre['genreID']?>"><?=$genre['genreName']?></option>
            <?php endforeach; ?>
        </select></label><br />


        <button type="submit" id="search-button" class="searchButton" style="margin-left: 520px;">Search</button>
    </form>

</div>


</body>
</html>

