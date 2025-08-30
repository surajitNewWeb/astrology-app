<?php
// backend/astrology/dosha.php
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../database.php';

function analyzeDosha($userId, $doshaType, array $birth) {
    $supported = ['mangal-dosha'];  
    if (!in_array($doshaType, $supported)) {
        return ['error' => "Dosha type '{$doshaType}' is not supported by Prokerala API."];
    }

    try {
        // ✅ Build correct ISO8601 datetime
        $dt = new DateTime("{$birth['dob']} {$birth['tob']}", new DateTimeZone('Asia/Kolkata'));
        $datetime = $dt->format("Y-m-d\TH:i:sP");

        $endpoint = PROKERALA_API_BASE . "astrology/{$doshaType}";
        $response = prokeralaApiRequest($endpoint, [
            'datetime'    => $datetime,
            'coordinates' => $birth['latitude'] . ',' . $birth['longitude'],
            'ayanamsa'    => $birth['ayanamsa'] ?? 1,
            'la'          => 'en'
        ], 'POST');

        $data = is_string($response) ? json_decode($response, true) : $response;

        $db = (new Database())->connect();
        $remedies = $data['data']['remedies'] ?? null;

        // ✅ JSON for saving into DB
        $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);

        // Save dosha_reports (with remedies separately)
        $stmt = $db->prepare("
            INSERT INTO dosha_reports (user_id, dosha_type, dosha_data, remedies)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param("isss", $userId, $doshaType, $jsonData, $remedies);
        $stmt->execute();
        $stmt->close();

        // ✅ Prepare reports JSON with remedies explicitly included
        $reportPayload = [
            'doshaType' => $doshaType,
            'result'    => $data,
            'remedies'  => $remedies
        ];
        $reportJson = json_encode($reportPayload, JSON_UNESCAPED_UNICODE);

        // Save reports (unified)
        $stmt = $db->prepare("
            INSERT INTO reports (user_id, type, report_date, report_data)
            VALUES (?, 'dosha', NOW(), ?)
        ");
        $stmt->bind_param("is", $userId, $reportJson);
        $stmt->execute();
        $stmt->close();

        return $data;
    } catch (\Exception $e) {
        return ['error' => $e->getMessage()];
    }
}
