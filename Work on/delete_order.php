<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['orderItemID'])) {
        $orderItemID = $_POST['orderItemID'];

        // Delete the order item from the database
        $deleteStmt = $mysql->prepare("DELETE FROM OrderItem WHERE OrderItemID = ?");
        $deleteStmt->execute([$orderItemID]);

        // Redirects back to the staff
        header("Location: staff.php");
        exit;
    }
}

// If accessed directly without a POST request, redirects to the staff
header("Location: staff.php");
exit;
?>