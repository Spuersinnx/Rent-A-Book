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
    <script src="js/formValidation.js"></script>
    <script>
        $(document).ready(function () {
            $('#signUp').click(function () {
                var newFirstName = $('#newFirstName').val();
                var newLastName = $('#newLastName').val();
                var newEmail = $('#newEmail').val();
                var newPsw = $('#newPsw').val();
                var confirmPsw = $('#confirmPsw').val();
                var emailRegex = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

                if (newFirstName == "" || newFirstName.length < 2 || newLastName == "" || newLastName.length < 2 || newEmail == '' || !newEmail.match(emailRegex) || newPsw == '' || newPsw.length < 8 || !newPsw.match(/[A-z]/) || !newPsw.match(/[A-Z]/) || !newPsw.match(/\d/ || confirmPsw != newPsw)) {
                    alert('There were errors encountered with your form, please review the fields');
                    return false;
                }

                else {
                    $.post("register.php", {
                        newFirstName1: newFirstName,
                        newLastName1: newLastName,
                        newEmail1: newEmail,
                        newPsw1: newPsw,
                        confirmPsw1: confirmPsw
                    });

                }

            });

        });
    </script>

</head>

<body>
<header>
    <div class="wrapper">
        <h1>Rent a Book - Search<span class="color">.</span></h1>
        <nav>
            <ul>
                <li><a href="#" onclick="document.getElementById('modalLogin').style.display='block'">Log In</a></li>
                <li><a href="#" onclick="document.getElementById('modalSignup').style.display='block'">Sign Up</a></li>
            </ul>
        </nav>
    </div>
</header>

<!--Main Search Form Content Image-->
<div id="search-Main">
    <h3>Search Books by...</h3>

    <!-- May move to external db_search.php -->
    <form id="search-form" action="../db/db_search.php" method="post">

        <label><b>Book Title</b>
        <input type="text" name="bookName"></label>

        <label><b>Book ISBN</b>
        <input type="text" name="ISBN"></label>

        <button type="submit" class="searchButton">Search</button><span id="search-img"><img class=search-img src="img/content/search64.png"></span>

        <button type="button" class="clearButton" onclick="reset();">Clear</button>

    </form>


</div>


<!--Modal Login Box-->
<div id="modalLogin" class="modal">

    <!--Modal Content-->
    <form class="modal-content animate">
        <div class="container">
            <span class="close" onclick="document.getElementById('modalLogin').style.display='none'">x</span>

            <label><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>


            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button type="submit" class="loginButton">Login</button>

            <button type="button" class="cancelButton"
                    onclick="document.getElementById('modalLogin').style.display='none'">Cancel
            </button>

        </div>
    </form>
</div>


<!--Modal Sign Up Box-->
<div id="modalSignup" class="modal">

    <!--Modal Content -->
    <form id="registerForm" name="registerForm" class="modal-content animate" method="post">
        <div id="register" class="container">
            <span class="close" onclick="document.getElementById('modalSignup').style.display='none'">x</span>


            <label><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" id="newFirstName" name="newFirstName" required>
            <div id="errFirstN">
                <ul>
                    <li id="errFirstNInfo" class="invalid">Please enter your first name</li>
                </ul>
            </div>

            <label><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" id="newLastName" name="newLastName" required>
            <div id="errLastN">
                <ul>
                    <li id="errLastNInfo" class="invalid">Please enter your last name</li>
                </ul>
            </div>

            <label><b>Email</b></label>
            <input type="text" placeholder="Enter Email" id="newEmail" name="newEmail" required>

            <div id="errorEmailDiv">
                <ul>
                    <li id="errorEmail" class="invalid">Email Valid</li>
                </ul>
            </div>

            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" id="newPsw" name="newPsw" required>

            <div id="pswdInfo">
                <h5>Password must meet the following requirements:</h5>
                <ul>
                    <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                    <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                    <li id="number" class="invalid">At least <strong>one number</strong></li>
                    <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>

                </ul>
            </div>

            <label><b>Confirm Password</b></label>
            <input type="password" placeholder="Confirm Password" id="confirmPsw" name="confirmPsw" required>
            <div id="confirmPswdDiv">
                <ul>
                    <li id="match" class="invalid">Password must <strong>match</strong></li>
                </ul>
            </div>

            <input type="submit" name="signUp" id="signUp" class="loginButton">
            <button type="button" class="cancelButton"
                    onclick="document.getElementById('modalSignup').style.display='none'">Cancel
            </button>
        </div>
    </form>
</div>

<!--Script to close modal when clicking outside of modal-->
<script>
    //Get the modal
    var modal = document.getElementById('modalLogin');
    var modalS = document.getElementById('modalSignup');

    //user clicks anywhere outside of the modal, close modal
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        if (event.target == modalS) {
            modalS.style.display = "none";
        }
    }
</script>


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

