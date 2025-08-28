<?php
require_once __DIR__ . '/../config/config.php';

// Only handle POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../public/register.php?error=Invalid request");
    exit;
}

// Collect & sanitize inputs
$full_name     = trim($_POST['full_name'] ?? '');
$email         = trim($_POST['email'] ?? '');
$password      = $_POST['password'] ?? '';
$gender        = $_POST['gender'] ?? 'other';
$date_of_birth = $_POST['date_of_birth'] ?? '';
$time_of_birth = $_POST['time_of_birth'] ?? null;
$place_of_birth= trim($_POST['place_of_birth'] ?? '');

// Basic validation
if (!$full_name || !$email || !$password || !$date_of_birth) {
    header("Location: ../public/register.php?error=Please fill all required fields");
    exit;
}

// Check if email already exists
$stmt = $mysqli->prepare("SELECT user_id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    header("Location: ../public/register.php?error=Email already registered");
    exit;
}
$stmt->close();

// Hash password
$password_hash = password_hash($password, PASSWORD_BCRYPT);

// Insert new user
$stmt = $mysqli->prepare("
    INSERT INTO users (full_name, email, password_hash, gender, date_of_birth, time_of_birth, place_of_birth) 
    VALUES (?, ?, ?, ?, ?, ?, ?)
");
$stmt->bind_param("sssssss", 
    $full_name, 
    $email, 
    $password_hash, 
    $gender, 
    $date_of_birth, 
    $time_of_birth, 
    $place_of_birth
);

if ($stmt->execute()) {
    $stmt->close();
    header("Location: ../public/login.php?registered=1");
    exit;
} else {
    $error = "Database error: " . $stmt->error;
    $stmt->close();
    header("Location: ../public/register.php?error=" . urlencode($error));
    exit;
}
