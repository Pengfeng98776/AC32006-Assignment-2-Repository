<?php
$host = "database-assginment2.cubpmaca8dm9.us-east-1.rds.amazonaws.com";
$username = "admin12";
$password = "assignment2";
$database = "DbAssignment";

$mysql = new PDO("mysql:host=".$host.";dbname=".$database,
$username, $password);
?>
