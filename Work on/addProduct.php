<?php
include 'db.php';

if ($_POST){
    $maxResultsPerPage = $_POST['maxResultsPerPage'];
    $pageNumber= $_POST['pageNumber'];
    $searchTearms= $_POST['searchTearms'];
} else { // else exists so i can do a php include on this file to have it actually show me some errors defo a better way :p
    $maxResultsPerPage = 8;
    $pageNumber= 1;
    $searchTearms= null;
}

// Get number of pages
$query = "SELECT count(*) FROM Product";
$stmt = $mysql->prepare($query);
$stmt->execute(); 
$numOfProducts = $stmt->fetch();
$numOfPages = ceil($numOfProducts[0] / $maxResultsPerPage);

// Get results for current page
$offset = ($pageNumber-1) * $maxResultsPerPage;
$query = "SELECT * FROM Product LIMIT $maxResultsPerPage OFFSET $offset;";
$stmt = $mysql->prepare($query);
$stmt->execute(); 
$results = $stmt->fetchAll();

echo json_encode(array("products"=>$results));   
?>