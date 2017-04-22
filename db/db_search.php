<?php

require_once("db_config.php");

#We assume that the input text box will have the name="userSearch"

#Get Post variables from search form
$userSearch = filter_input(INPUT_POST, "userSearch");

#Set Cookie to save what user searched last
if (isset($userSearch)) {
    $expire = strtotime("+1 year");
    setcookie('userSearch', $userSearch, $expire, '/');
}
#Changes characters in html to their equivalent forms
$userSearch = htmlspecialchars($userSearch);


//#Queries for searching the database for books
//$basicSearchQuery = $db->prepare("SELECT b.bookID, b.bookName, b.ISBN, b.genreID, a.authorID, a.authorName
//                                        FROM books b INNER JOIN author a ON (b.bookID = a.bookID)
//                                        WHERE a.authorName LIKE '% :userSearch %'
//                                        OR b.ISBN LIKE '% :userSearch %'
//                                        OR b.bookname LIKE '% :userSearch %'");
//$basicSearchQuery->execute(array(
//    ":userSearch" => $userSearch
//));
//#Put the user's search results in an array
//$userResults = $basicSearchQuery->fetchAll();
//print_r($userResults);


#Query for bookName
$queryBookName = $db->prepare("SELECT b.bookID, b.bookName, b.ISBN, b.genreID, a.authorID, a.authorName
                                       FROM books b JOIN author a ON (b.bookID = a.bookID)
                                        WHERE b.bookName LIKE '% :bookName %'");
$queryBookName->execute(array(
    ":bookName" => $userSearch
));
$resultsBookName = $queryBookName->fetchAll();
print_r($resultsBookName);


#Query ISBN
$queryBookISBN = $db->prepare("SELECT b.bookID, b.bookName, b.ISBN, b.genreID, a.authorID, a.authorName
                                       FROM books b INNER JOIN author a ON (b.bookID = a.bookID)
                                       WHERE b.ISBN LIKE '%:ISBN%'");
$queryBookISBN->execute(array(
    ":ISBN" => $userSearch
));
$resultsBookISBN = $queryBookISBN->fetchAll();
print_r($resultsBookISBN);

#Query AuthorName
$queryBookAuthor = $db->prepare("SELECT b.bookID, b.bookName, b.ISBN, b.genreID, a.authorID, a.authorName
                                       FROM books b INNER JOIN author a ON (b.bookID = a.bookID)
                                       WHERE a.authorName LIKE '%:authorName%'");
$queryBookAuthor->execute(array(
    ":authorName" => $userSearch
));
$resultsBookAuthor = $queryBookAuthor->fetchAll();
print_r($resultsBookAuthor);



