<?php


?>


<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Rent a Book - Search</title>
    <link type="text/css" rel="stylesheet" href="css/mainstyle.css">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <!-- Bootstrap
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/journal/bootstrap.min.css" rel="stylesheet" integrity="sha384-1L94saFXWAvEw88RkpRz8r28eQMvt7kG9ux3DdCqya/P3CfLNtgqzMnyaUa49Pl2" crossorigin="anonymous">
     /Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        /* $(document).ready(function () {
         $('#search-button').click(function (e) {

         e.preventDefault();

         var bookName = $("[name='bookName']").val();
         var ISBN = $("[name='ISBN']").val();


         if (bookName == "" || bookName.length < 2 || bookName == " " || ISBN == " " || ISBN == "" || !(ISBN.length >= 10)) {
         alert('There were errors encountered with your form, please review the fields');
         return false;
         }


         }

         }); */
    </script>

</head>

<body>
<header>
    <div class="wrapper">
        <h1>Rent a Book - Search<span class="color">.</span></h1>
        <nav>
            <ul>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
        </nav>
    </div>
</header>

<!--Main Search Form Content Image-->
<div id="search-Main">
    <h3>Search Books by...</h3>

    <!-- May move to external db_search.php -->
    <form id="search-form" action="../db/db_search.php" method="post">

        <label>Select an Option:<select class="dropdown">

                <option value="1" selected>Book Title</option>
                <option value="2">ISBN</option>

            </select></label><br/><br />

        <label><b>Book Title</b>
            <input type="text" name="bookName"></label>

        <label><b>Book ISBN</b>
            <input type="text" name="ISBN"></label>

        <button type="submit" id="search-button" class="searchButton">Search</button>
        <span id="search-img"><img class=search-img src="img/content/search64.png"></span>

        <button type="button" class="clearButton" onclick="reset();">Clear</button>

    </form>


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

    <!-- Bootstrap
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    /Bootstrap -->
</footer>


</body>
</html>

