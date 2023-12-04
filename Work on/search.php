<?php
// search.php

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    // Check if the referring page is index.php
    if (strpos($_SERVER['HTTP_REFERER'], 'index.php') !== false) {
        // Redirect to customer.php with the search term
        header("Location: customer.php?search=$searchTerm");
    } elseif (strpos($_SERVER['HTTP_REFERER'], 'customer.php') !== false) {
        // Stay on customer.php with the search term
        header("Location: customer.php?search=$searchTerm");
    } else {
        // Redirect to manager.php with the search term
        header("Location: manager.php?search=$searchTerm");
    }
    exit;
}
