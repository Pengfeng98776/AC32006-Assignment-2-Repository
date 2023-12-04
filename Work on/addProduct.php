<?php
header('Location: /test/manager.php');
include 'includes/db.php';

if (isset($_POST['submit'])) {
    $stmt = $mysql->prepare("INSERT INTO Product (Name, Description, PurchaseCost, SellingPrice, StockQuantity)
    VALUES (:Name, :Description, :PurchaseCost, :SellingPrice, :StockQuantity)");

    $stmt->bindParam(':Name', $name);
    $stmt->bindParam(':Description', $description);
    $stmt->bindParam(':PurchaseCost', $purchaseCost);
    $stmt->bindParam(':SellingPrice', $sellingPrice);
    $stmt->bindParam(':StockQuantity', $stockQuantity);

    $name = $_POST['name'];
    $description = $_POST['description'];
    $purchaseCost = $_POST['purchaseCost'];
    $sellingPrice = $_POST['sellingPrice'];
    $stockQuantity = $_POST['stockQuantity'];

    $stmt->execute();
} else {
    //ERROR HANDLING
}
?>