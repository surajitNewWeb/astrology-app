<?php
require_once __DIR__ . '/../config/config.php';

header('Content-Type: application/json');

try {
    // Accept both ?sign=aries OR ?zodiac=aries
    $zodiac = $_GET['sign'] ?? $_GET['zodiac'] ?? null;
    $date   = $_GET['date'] ?? date('Y-m-d');

    if (!$zodiac) {
        echo json_encode(["error" => "Please select a zodiac sign"]);
        exit;
    }

    $params = [
        "zodiac"   => strtolower($zodiac),
        "date"     => $date,
        "period"   => "daily",
        "timezone" => "Asia/Kolkata",
        "lang"     => "en"
    ];

    $result = callProkeralaAPI(PROKERALA_HOROSCOPE_URL, $params);

    echo json_encode($result, JSON_PRETTY_PRINT);

} catch (Exception $e) {
    $logDir = __DIR__ . '/../logs';
    if (!is_dir($logDir)) mkdir($logDir, 0777, true);
    file_put_contents(
        $logDir . '/horoscope_error.log',
        date('Y-m-d H:i:s') . " | " . $e->getMessage() . PHP_EOL,
        FILE_APPEND
    );

    echo json_encode(["error" => "Failed to fetch horoscope"]);
}
