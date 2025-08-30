
<?php
// backend/auth/register.php

session_start();
require_once dirname(__DIR__) . '/database.php';
// Connect to DB
$db = new Database();
$conn = $db->connect();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name       = trim($_POST['name'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $password   = $_POST['password'] ?? '';
    $dob        = $_POST['dob'] ?? '';
    $tob        = $_POST['tob'] ?? '';
    $birth_place= trim($_POST['birth_place'] ?? '');
    $latitude   = $_POST['latitude'] ?? null;
    $longitude  = $_POST['longitude'] ?? null;

    // Basic validation
    if (empty($name) || empty($email) || empty($password) || empty($dob) || empty($tob)) {
        die("⚠ Please fill all required fields.");
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        die("⚠ Email already registered.");
    }
    $stmt->close();

    // Insert user
    $stmt = $conn->prepare("
        INSERT INTO users (name, email, password, dob, tob, birth_place, latitude, longitude) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("ssssssdd", 
        $name, 
        $email, 
        $hashedPassword, 
        $dob, 
        $tob, 
        $birth_place, 
        $latitude, 
        $longitude
    );

if ($stmt->execute()) {
    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['user_name'] = $name; // ✅ This is important
    header("Location: ../../public/dashboard.php");
    exit();
} else {
    die("❌ Registration failed: " . $stmt->error);
}
}
