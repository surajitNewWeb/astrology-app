<?php
// backend/birth-chart.php
session_start();
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/ProkeralaClient.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php?error=Please+login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../public/birth-chart.php");
    exit;
}

$userId = (int)$_SESSION['user_id'];

$dob  = $_POST['dob'] ?? '';
$lat  = $_POST['lat'] ?? '22.5726';
$lng  = $_POST['lng'] ?? '88.3639';

if ($dob === '') {
    header("Location: ../public/birth-chart.php?error=Invalid+input");
    exit;
}

try {
    // ✅ Correctly load from .env
    $client = new ProkeralaClient(
        $mysqli,
        $_ENV['PROKERALA_CLIENT_ID'],
        $_ENV['PROKERALA_CLIENT_SECRET'],
        $_ENV['PROKERALA_AUTH_URL'],
        $_ENV['PROKERALA_API_URL']
    );

    // Call API for birth chart
    $api = $client->get("/astrology/chart", [
        "datetime" => $dob . "T00:00:00+05:30",
        "coordinates" => $lat . "," . $lng,
    ], $userId);

    $content = $api['data'] ?? '(No birth chart data found)';

    // Show result
    include_once __DIR__ . '/../includes/navbar.php';

    echo "<div class='container py-4'>";
    echo "<div class='card shadow-lg border-0'>";
    echo "<div class='card-body'>";
    echo "<h3 class='text-center mb-3'>🪐 Birth Chart</h3>";

    if (is_array($content)) {
        echo "<pre class='text-dark'>" . htmlspecialchars(print_r($content, true)) . "</pre>";
    } else {
        echo "<p class='lead text-dark'>" . htmlspecialchars($content) . "</p>";
    }

    echo "<div class='text-center mt-3'><a href='../public/birth-chart.php' class='btn btn-outline-primary'>&larr; Back</a></div>";
    echo "</div></div></div>";

    include_once __DIR__ . '/../includes/footer.php';

} catch (Exception $e) {
    header("Location: ../public/birth-chart.php?error=" . urlencode($e->getMessage()));
    exit;
}
