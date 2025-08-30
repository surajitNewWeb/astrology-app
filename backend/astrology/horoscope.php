<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../helpers.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    session_start();
    if (!isset($_SESSION['user_id'])) {
        die(json_encode(["error" => "You must be logged in."]));
    }

    $user_id = $_SESSION['user_id'];

    $sign = strtolower(trim($_POST['sign'] ?? ''));
    $period = strtolower(trim($_POST['period'] ?? 'daily')); // daily, weekly, monthly, etc.

    if (empty($sign)) {
        die(json_encode(["error" => "Please select a zodiac sign."]));
    }

    $datetime = date('c'); // ISO 8601 datetime
    $endpoint = PROKERALA_API_BASE . "horoscope/$period";

    $params = [
        "sign"     => $sign,
        "datetime" => $datetime,
        "timezone" => "5.5"
    ];

    // Call Prokerala API
    $response = prokeralaApiRequest($endpoint, $params);

    // Decode API response so we can store in DB
    $horoscopeData = json_decode($response, true);

    if ($horoscopeData) {
        // Store in database
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        if ($conn->connect_error) {
            die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
        }

        // ✅ Insert into horoscope_reports (raw)
        $stmt = $conn->prepare("INSERT INTO horoscope_reports (user_id, zodiac_sign, period, horoscope_data) VALUES (?, ?, ?, ?)");
        $jsonData = json_encode($horoscopeData, JSON_UNESCAPED_UNICODE);
        $stmt->bind_param("isss", $user_id, $sign, $period, $jsonData);
        $stmt->execute();
        $stmt->close();

        // ✅ Wrap data for reports table
        $reportPayload = [
            'zodiacSign' => $sign,
            'period'     => $period,
            'result'     => $horoscopeData
        ];
        $reportJson = json_encode($reportPayload, JSON_UNESCAPED_UNICODE);

        // ✅ Insert into reports (unified)
        $stmt = $conn->prepare("INSERT INTO reports (user_id, type, report_date, report_data) VALUES (?, 'horoscope', NOW(), ?)");
        $stmt->bind_param("is", $user_id, $reportJson);
        $stmt->execute();
        $stmt->close();

        $conn->close();
    }

    header("Content-Type: application/json");
    echo $response; // Return API response to frontend
}
