<?php
// includes/auth_check.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    // Redirect to login if not logged in
    header("Location: ../public/login.php?error=Please+login+first");
    exit();
}
