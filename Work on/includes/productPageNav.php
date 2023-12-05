<?php
include 'db.php';

if ($_POST){
    $maxResultsPerPage = $_POST['maxResultsPerPage'];
    $pageNumber= (int)$_POST['pageNumber'];
    if ($pageNumber == 0 || $pageNumber == "Npn") {
        //echo ("in if\n");
        $pageNumber = 1;
    }
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
//echo($numOfPages."\n");

// Get results for current page
$offset = ($pageNumber-1) * $maxResultsPerPage;
if ($searchTearms){
    $query2 = "SELECT ProductID, ProductName, CategoryID, PurchaseCost, SellingPrice, Description, Quantity, WarehouseID FROM Product WHERE ProductName LIKE '%".$searchTearms."%' OR Description LIKE '%".$searchTearms."%' LIMIT $maxResultsPerPage OFFSET $offset;";

} else{
    $query2 = "SELECT ProductID, ProductName, CategoryID, PurchaseCost, SellingPrice, Description, Quantity, WarehouseID FROM Product LIMIT $maxResultsPerPage OFFSET $offset;\n";
}
$stmt = $mysql->prepare($query2);
//echo($query2);
$stmt->execute(); 
$results = $stmt->fetchAll();

/*
for ($i = 0; $i < count($results); $i++) {
    if ($results[$i]['Image']) {
        $results[$i]['Image'] = base64_encode($results[$i]['Image']);
    } else {
        $results[$i]['Image'] = null;
    }
    //echo $results[$i]["Image"]."\n";
}*/

header('Content-Type: application/json; charset=utf-8');
$json = json_encode(array("products" => $results, "numberOfPages" => $numOfPages), JSON_UNESCAPED_UNICODE);
if ($json) {
    echo $json;
} else {
    echo json_last_error_msg();
} 
?>