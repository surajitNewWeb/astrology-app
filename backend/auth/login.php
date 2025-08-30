<?php
// backend/auth/login.php

session_start();
require_once __DIR__ . '/../database.php';

// DB connect
$db = new Database();
$conn = $db->connect();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        die("⚠ Please enter both email and password.");
    }

$stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name']; // ✅ Important
    header("Location: ../../public/dashboard.php");
    exit();
}else {
        die("❌ Invalid password.");
    }
} else {
    die("⚠ No account found with that email.");
}
}
