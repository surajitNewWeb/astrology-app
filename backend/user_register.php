<?php
session_start();
require_once __DIR__ . '/config.php';  // DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $dob      = $_POST['dob'];
    $tob      = $_POST['tob'] ?? null;
    $place    = trim($_POST['place']);

    // Validate
    if (empty($name) || empty($email) || empty($password)) {
        header("Location: ../pages/register.php?msg=" . urlencode("All required fields must be filled."));
        exit;
    }

    // Check if email already exists
    $stmt = $con->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        header("Location: ../pages/register.php?msg=" . urlencode("Email already registered."));
        exit;
    }
    $stmt->close();

    // Hash password
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Insert user
    $stmt = $con->prepare("INSERT INTO users (name, email, password_hash, dob, tob, place) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $password_hash, $dob, $tob, $place);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['user_name'] = $name;

        header("Location: ../pages/dashboard.php?msg=" . urlencode("Welcome, $name! Your account has been created."));
    } else {
        header("Location: ../pages/register.php?msg=" . urlencode("Error while registering. Try again."));
    }
    $stmt->close();
}
