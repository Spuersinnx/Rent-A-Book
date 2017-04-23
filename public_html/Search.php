<?php

require_once("../db/db_config.php");

#Check if cookie is set
if (isset($_COOKIE['userSearch'])) {

    $userSearch = $_COOKIE['userSearch'];
} else {

    $userSearch = null;
}

$genreSelect = $db->prepare("SELECT *
                                      FROM genre");
$genreSelect->execute();
$genres = $genreSelect->fetchAll();
print_r($genres);

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

        <label><b>Search:</b>
            <input type="text" name="userSearch" value="<?= $userSearch ?>"></label>
        <label><b>Filter by Genre: </b>
        <select>
            <option value="<?=null?>" selected="selected">None</option>
            <?php foreach($genres as $genre) : ?>
            <option value="<?= $genre['genreName']?>"><?=$genre['genreName']?></option>

        </select></label><br />
        <input type="hidden" name="genreID" value="<?=$genre['genreID']?>">
        <?php endforeach; ?>
        <button type="submit" id="search-button" class="searchButton">Search</button>
    </form>

</div>


</body>
</html>

