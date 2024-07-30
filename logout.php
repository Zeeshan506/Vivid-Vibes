<?php
// Start session
session_start();

// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Unset and destroy session
    $_SESSION = array();
    session_destroy();

    // Redirect to the login page
    header("location: login.php");
    exit;
} else {
    // If the user is not logged in, redirect them to the login page
    header("location: login.php");
    exit;
}
