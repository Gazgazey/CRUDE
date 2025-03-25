<?php
session_start();

// Enable error reporting for debugging (Remove this in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Prevent session fixation attacks
if (!isset($_SESSION["initiated"])) {
    session_regenerate_id(true);
    $_SESSION["initiated"] = true;
}

// Check if user is authenticated
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>
