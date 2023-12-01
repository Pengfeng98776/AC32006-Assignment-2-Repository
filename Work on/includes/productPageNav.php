<?php
$maxResultsPerPage = 8;

// Get number of pages
$query = "SELECT count(*) FROM Product";
$stmt = $mysql->prepare($query);
$stmt->execute(); 
$numOfProducts = $stmt->fetch();
$numOfPages = ceil($numOfProducts[0] / $maxResultsPerPage);

// Get current page
$currentPage = @$_GET['currentPage']; 
if ($currentPage == $numOfPages){
    $currentPage = $numOfPages;
} else if ($currentPage < 1){
    $currentPage = 1;
} else if(!$currentPage) { 
$currentPage = 1;
}

// Get results for current page
$offset = ($currentPage-1) * $maxResultsPerPage;
$query = "SELECT * FROM Product LIMIT $maxResultsPerPage OFFSET $offset;";
$stmt = $mysql->prepare($query);
$stmt->execute(); 
$result = $stmt->fetch();
?>