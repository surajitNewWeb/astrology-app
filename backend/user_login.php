<?php
require_once __DIR__ . '/../config/config.php';
session_start();

// Only handle POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../public/login.php?error=Invalid request");
    exit;
}

$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    header("Location: ../public/login.php?error=Please fill all fields");
    exit;
}

// Fetch user
$stmt = $mysqli->prepare("SELECT user_id, full_name, email, password_hash FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $stmt->close();
    header("Location: ../public/login.php?error=Invalid email or password");
    exit;
}

$user = $result->fetch_assoc();
$stmt->close();

// Verify password
if (!password_verify($password, $user['password_hash'])) {
    header("Location: ../public/login.php?error=Invalid email or password");
    exit;
}

// Success → set session
$_SESSION['user_id']   = $user['user_id'];
$_SESSION['user_name'] = $user['full_name'];
$_SESSION['email']     = $user['email'];

// Redirect to home/dashboard
header("Location: ../index.php");
exit;
