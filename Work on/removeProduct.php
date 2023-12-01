<?php
header('Location: /test/manager.php');
include 'includes/db.php';

if (isset($_POST['submitDel'])) {
    $delID = $_POST['delID'];
    $stmt = $mysql->prepare("DELETE FROM Product WHERE ProductID=$delID");


    $stmt->execute();
} else {
    //ERROR HANDLING
}

?>