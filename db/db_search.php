<?php
session_start();
require_once("db_config.php");

#We assume that the input text box will have the name="userSearch"

#Get Post variables from search form
$userSearch = filter_input(INPUT_POST, "userSearch");
$genreFilter = filter_input(INPUT_POST, "genreFilter");


#Use Genre ID to get GenreName
$genreNameQuery = $db->prepare("SELECT genreName
                                        FROM genre
                                        WHERE genreID = :genreID");
$genreNameQuery->execute(array(
    ":genreID" => $genreFilter
));
$genreName = $genreNameQuery->fetch();


#Set Cookie to save what user searched last
if (isset($userSearch)) {
    $expire = strtotime("+1 year");
    setcookie('userSearch', $userSearch, $expire, '/');
}
#Changes characters in html to their equivalent forms
#$userSearch = htmlspecialchars($userSearch);


#IF Genre Filter is not Selected
if($genreFilter == null) {
#Queries for searching the database for books
    $searchQuery = $db->prepare("SELECT b.bookID, b.bookName, b.ISBN, b.genreID, b.bookImage, a.authorID, a.authorName
                                        FROM books b INNER JOIN author a ON (b.bookID = a.bookID)
                                        WHERE b.bookname LIKE '%$userSearch%'
                                        OR b.ISBN LIKE '%$userSearch%'
                                        OR a.authorName LIKE '%$userSearch%'");
    $searchQuery->execute();

#Put the user's search results in an array
    $userResults = $searchQuery->fetchAll();
    print_r($userResults);

    if($userResults == 0){

        echo "No results were found that matched your search...";
    }
    #Create SESSION variable for userResults to move to next page
    $_SESSION['userResults'] = $userResults;
}

#If Genre Filter is Selected
if($genreFilter != null){

    $genre = $genreName[0];
   $filterSearchQuery = $db->prepare("SELECT b.bookID, b.bookName, b.ISBN, b.genreID, b.bookImage, a.authorID, a.authorName
                                                FROM books b INNER JOIN author a ON (b.bookID = a.bookID)
                                                            INNER JOIN genre g ON (b.genreID = g.genreID)
                                                WHERE g.genreName = '$genre'
                                                AND (
                                                      b.bookname LIKE '%$userSearch%'
                                                      OR a.authorName LIKE '%$userSearch%'
                                                    )");

   $filterSearchQuery->execute();
    $userResults = $filterSearchQuery->fetchAll();
   print_r($userResults);

    if($userResults == 0){

        echo "No results were found that matched your search...";
    }

    #Create SESSION variable for userResults to move to next page
    $_SESSION['userResults'] = $userResults;

}

header("Location:../public_html/searchResults.php");

?>















