<?php
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../auth/auth_check.php';

function calculateNumerology($user_id, $input) {
    global $con;

    $name = $input['name'];
    $dob  = $input['dob'];

    // 1. Get Access Token
    $token = getProkeralaAccessToken(); // must be defined in helpers.php
    if (!$token) {
        return ['error' => 'Missing access token.'];
    }

    // 2. Call Prokerala API
    $url = "https://api.prokerala.com/v2/numerology/numero-table";
    $payload = [
        'name' => $name,
        'dob'  => $dob,
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $token"
    ]);
    $response = curl_exec($ch);
    curl_close($ch);

    if (!$response) {
        return ['error' => 'API request failed.'];
    }

    $result = json_decode($response, true);
    if (!isset($result['data'])) {
        return ['error' => 'Invalid response from API'];
    }

    $numerologyData = $result['data'];

    // 3. Store in horoscope table
    $stmt = $con->prepare("INSERT INTO horoscope (user_id, type, name, dob, result_json, created_at) VALUES (?, 'numerology', ?, ?, ?, NOW())");
    $jsonResult = json_encode($numerologyData, JSON_UNESCAPED_UNICODE);
    $stmt->bind_param("isss", $user_id, $name, $dob, $jsonResult);
    $stmt->execute();
    $stmt->close();

    // 4. Store also in reports table
    $stmt2 = $con->prepare("INSERT INTO reports (user_id, report_type, input_data, result_data, created_at) VALUES (?, 'numerology', ?, ?, NOW())");
    $inputJson = json_encode(['name' => $name, 'dob' => $dob], JSON_UNESCAPED_UNICODE);
    $stmt2->bind_param("isss", $user_id, $inputJson, $jsonResult,);
    $stmt2->execute();
    $stmt2->close();

    // 5. Return structured data for frontend
    return [
        'life_path'   => $numerologyData['life_path']   ?? null,
        'chaldean'    => $numerologyData['chaldean']    ?? null,
        'pythagorean' => $numerologyData['pythagorean'] ?? null,
        'destiny'     => $numerologyData['destiny']     ?? null,
        'soul_urge'   => $numerologyData['soul_urge']   ?? null,
        'personality' => $numerologyData['personality'] ?? null,
    ];
}
