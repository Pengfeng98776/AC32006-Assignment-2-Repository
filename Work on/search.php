<?php
// search.php

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    // Check if the referring page is index.php
    if (strpos($_SERVER['HTTP_REFERER'], 'index.php') !== false) {
        // Redirect to customer.php with the search term
        header("Location: customer.php?search=$searchTerm");
    } else {
        // Stay on manager.php with the search term
        header("Location: manager.php?search=$searchTerm");
    }
    exit;
}
