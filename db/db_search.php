<?php

require_once("db_config.php");

#We assume that the input text box will have the name="userSearch"

#Get Post variables from search form
$userSearch = filter_input(INPUT_POST, "userSearch");

#Changes characters in html to their equivalent forms
#$userSearch = htmlspecialchars($userSearch);


#Queries for searching the database for books
$basicSearchQuery = $db->prepare("SELECT *
                                      FROM book b
                                      WHERE  b.BookID IN (
                                        SELECT books.BookID, author.authorName 
                                            FROM books INNER JOIN author
                                            ON ( books.bookID = author.bookID)
                                            WHERE author.authorName LIKE '%:userSearch%')
                                        OR b.ISBN LIKE '%:userSearch%'
                                        OR b.bookname LIKE '%:userSearch%'");

$basicSearchQuery->execute(array(
    ":userSearch" => $userSearch
));
$userResults = $basicSearchQuery->fetchAll();