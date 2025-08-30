<?php
// backend/astrology/birthchart.php
session_start();
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../auth/auth_check.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dob        = $_POST['dob'];
    $tob        = $_POST['tob'];
    $latitude   = $_POST['latitude'];
    $longitude  = $_POST['longitude'];
    $chart_type = $_POST['chart_type'] ?? 'rasi';
    $chart_style= $_POST['chart_style'] ?? 'north-indian';

    // Ensure time format hh:mm:ss
    if (strlen($tob) === 5) {
        $tob .= ":00";
    }
    $datetime = $dob . "T" . $tob . "+05:30";

    // === API Calls ===

    // Chart
    $chartEndpoint = PROKERALA_API_BASE . "astrology/chart";
    $chartParams = [
        "datetime"    => $datetime,
        "coordinates" => $latitude . "," . $longitude,
        "ayanamsa"    => 1,
        "chart_type"  => $chart_type,
        "chart_style" => $chart_style
    ];
    $chartResponse = prokeralaApiRequest($chartEndpoint, $chartParams);

    // Planets
    $planetEndpoint = PROKERALA_API_BASE . "astrology/planet-position";
    $planetParams = [
        "datetime"    => $datetime,
        "coordinates" => $latitude . "," . $longitude,
        "ayanamsa"    => 1
    ];
    $planetResponse = prokeralaApiRequest($planetEndpoint, $planetParams);
    $planetData = json_decode($planetResponse, true);

    // Houses
    $houseEndpoint = PROKERALA_API_BASE . "astrology/house-cusps";
    $houseResponse = prokeralaApiRequest($houseEndpoint, $planetParams);
    $houseData = json_decode($houseResponse, true);

    // === Save to Database ===
    $conn = (new Database())->connect();
    $userId = $_SESSION['user_id'];

    // ✅ Save in reports table
    $jsonData = json_encode([
        "chart_svg" => $chartResponse,
        "planets"   => $planetData['data'] ?? [],
        "houses"    => $houseData['data'] ?? []
    ], JSON_UNESCAPED_UNICODE);

    $stmt = $conn->prepare("
        INSERT INTO reports (user_id, type, report_date, report_data)
        VALUES (?, ?, NOW(), ?)
    ");
    $type = "birthchart"; 
    $stmt->bind_param("iss", $userId, $type, $jsonData);
    $stmt->execute();   // ✅ FIXED
    $stmt->close();

    // ✅ Save in birth_charts table
    $chartData = json_encode([
        "chart"   => $chartResponse,
        "planets" => $planetData['data'] ?? [],
        "houses"  => $houseData['data'] ?? []
    ], JSON_UNESCAPED_UNICODE);

    $stmt = $conn->prepare("
        INSERT INTO birth_charts (user_id, chart_data, created_at)
        VALUES (?, ?, NOW())
    ");
    $stmt->bind_param("is", $userId, $chartData);
    $stmt->execute();
    $stmt->close();

    $conn->close();

    // ✅ Store in session for UI
    $_SESSION['birth_data'] = [
        "chart" => $chartResponse,
        "json"  => [
            "status" => (strpos($chartResponse, '<svg') !== false ? "ok" : "error"),
            "data"   => [
                "planets" => $planetData['data']['planets'] ?? [],
                "houses"  => $houseData['data']['houses'] ?? []
            ],
            "errors" => $planetData['errors'] ?? []
        ]
    ];

    // Redirect back to UI
    header("Location: ../../public/birthchart.php");
    exit;
}
