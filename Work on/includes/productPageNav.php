<?php
include 'db.php';

if ($_POST){
    $maxResultsPerPage = $_POST['maxResultsPerPage'];
    $pageNumber= $_POST['pageNumber'];
    $searchTearms= $_POST['searchTearms'];
} else { // else exists so i can do a php include on this file to have it actually show me some errors defo a better way :p
    $maxResultsPerPage = 8;
    $pageNumber= 1;
    $searchTearms= "test";
}

// Get number of pages
if ($searchTearms){
    $query1 = "SELECT count(*) FROM Product WHERE ProductName LIKE '%".$searchTearms."%' OR Description LIKE '%".$searchTearms."%'";

} else{
    $query1 = "SELECT count(*) FROM Product";
}
$stmt = $mysql->prepare($query1);
$stmt->execute(); 
$numOfProducts = $stmt->fetch();
$numOfPages = ceil($numOfProducts[0] / $maxResultsPerPage);

// Get results for current page
$offset = ($pageNumber-1) * $maxResultsPerPage;
if ($searchTearms){
    $query2 = "SELECT * FROM Product WHERE ProductName LIKE '%".$searchTearms."%' OR Description LIKE '%".$searchTearms."%' LIMIT $maxResultsPerPage OFFSET $offset;";

} else{
    $query2 = "SELECT * FROM Product LIMIT $maxResultsPerPage OFFSET $offset;";
}
$stmt = $mysql->prepare($query2);
$stmt->execute(); 
$results = $stmt->fetchAll();

echo json_encode(array("products"=>$results, "numberOfPages"=>$numOfPages));   
?>