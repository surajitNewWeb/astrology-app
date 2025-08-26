<?php
session_start();
require __DIR__ . '/../config/db.php'; // database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($email) || empty($password)) {
        header("Location: login.php?error=All fields are required");
        exit;
    }

    // Check if user exists
    $stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Valid login
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        header("Location: dashboard.php");
        exit;
    } else {
        header("Location: login.php?error=Invalid email or password");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
