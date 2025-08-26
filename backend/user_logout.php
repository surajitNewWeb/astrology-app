<?php
// backend/user_logout.php
session_start();

// Destroy session
$_SESSION = [];
session_unset();
session_destroy();

// Redirect to homepage
header("Location: ../pages/index.php");
exit();
