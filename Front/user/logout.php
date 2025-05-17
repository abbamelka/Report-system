<?php
session_start(); // Start the session

// Destroy the session
session_unset();  // Unset all session variables
session_destroy();  // Destroy the session

// Prevent page caching after logout
header('Cache-Control: no-store, no-cache, must-revalidate');  // Prevent caching
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');  // Disable caching
header('Location: login.php');  // Redirect to login page
exit;
?>
