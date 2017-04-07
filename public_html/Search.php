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


<!--Main Search Form Content Image-->
<div id="search-Main">


    <!-- May move to external db_search.php -->
    <form id="search-form" action="../db/db_search.php" method="post">

        <select class="dropdown">

                <option value="1" selected>Book Title</option>
                <option value="2">ISBN</option>

            </select><br/><br />

        <label><b>Book Title</b>
            <input type="text" name="bookName"></label>

        <label><b>Book ISBN</b>
            <input type="text" name="ISBN"></label>

        <button type="submit" id="search-button" class="searchButton">Search</button>


        <button type="button" class="clearButton" onclick="reset();">Clear</button>

    </form>


</div>




</body>
</html>

