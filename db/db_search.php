<?php

require_once("db_config.php");

#We assume that the input text box will have the name="userSearch"

#Get Post variables from search form
$userSearch = filter_input(INPUT_POST, "userSearch");
#$userSearch = $_POST['userSearch'];


#Set Cookie to save what user searched last
if (isset($userSearch)) {
    $expire = strtotime("+1 year");
    setcookie('userSearch', $userSearch, $expire, '/');
}
#Changes characters in html to their equivalent forms
#$userSearch = htmlspecialchars($userSearch);


#Queries for searching the database for books
$searchQuery = $db->prepare("SELECT b.bookID, b.bookName, b.ISBN, b.genreID, a.authorID, a.authorName
                                        FROM books b INNER JOIN author a ON (b.bookID = a.bookID)
                                        WHERE b.bookname LIKE '%$userSearch%'
                                        OR b.ISBN LIKE '%$userSearch%'
                                        OR a.authorName LIKE '%$userSearch%'");
$searchQuery->execute();

#Put the user's search results in an array
$userResults = $searchQuery->fetchAll();
print_r($userResults);








