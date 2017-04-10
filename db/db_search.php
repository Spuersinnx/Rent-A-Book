<?php

require_once("db_config.php");

#We assume that the input text box will have the name="userSearch"

#Get Post variables from search form
$userSearch = filter_input(INPUT_POST, "userSearch");



#Queries for searching the database for books
$basicSearchQuery = $db->prepare("SELECT ");