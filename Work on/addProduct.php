<?php
include 'includes/db.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $purchaseCost = $_POST['purchaseCost'];
    $sellingPrice = $_POST['sellingPrice'];
    $quantity = $_POST['quantity'];
    $catagoryID = $_POST['catagoryID'];
    $warehouseID = $_POST['warehouseID'];

    // Image magic form w3schools: https://www.w3schools.com/php/php_file_upload.asp
    $imagePath = $_FILES['imageToUpload']['tmp_name'];
    $imageData = file_get_contents($imagePath);
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["imageToUpload"]["name"]);
    move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file);

    $stmt = $mysql->prepare("INSERT INTO Product (ProductName, Description, PurchaseCost, SellingPrice, quantity, Image, CategoryID, WarehouseID)
    VALUES (:Name, :Description, :PurchaseCost, :SellingPrice, :StockQuantity, :image, :catagoryID, :warehouseID)");

    $stmt->bindParam(':Name', $name);
    $stmt->bindParam(':Description', $description);
    $stmt->bindParam(':PurchaseCost', $purchaseCost);
    $stmt->bindParam(':SellingPrice', $sellingPrice);
    $stmt->bindParam(':StockQuantity', $quantity);
    $stmt->bindParam(':image', $imageData, PDO::PARAM_LOB);
    $stmt->bindParam(':catagoryID', $catagoryID);
    $stmt->bindParam(':warehouseID', $warehouseID);

    $stmt->execute();
} else {
    // ERROR HANDLING
}
?>
