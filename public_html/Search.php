<?php

#Check if cookie is set
if(isset($_COOKIE['userSearch'])){

    $userSearch = $_COOKIE['userSearch'];
}

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


    <!-- May move to external db_search.php -->
    <form id="search-form" action="../db/db_search.php" method="post">

        <label><b>Search:</b>
            <input type="text" name="userSearch" value="<?= $userSearch?>"></label>
        <button type="submit" id="search-button" class="searchButton">Search</button>
    </form>

</div>


</body>
</html>

