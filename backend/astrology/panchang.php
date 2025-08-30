<?php
// backend/astrology/panchang.php
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../database.php';

/**
 * Get Panchang data from Prokerala API and store in DB
 *
 * @param int   $userId
 * @param string $date  Format: YYYY-MM-DD
 * @param array $place  ['location' => 'Mumbai', 'latitude'=>19.0760, 'longitude'=>72.8777]
 * @return array
 */
function getPanchang($userId, $date, array $place) {
    try {
        // ✅ Panchang endpoint (POST only)
        $endpoint = PROKERALA_API_BASE . "/astrology/panchang";

        // ✅ API request params
        $params = [
            "datetime"    => $date . "T06:00:00+05:30",
            "coordinates" => $place['latitude'] . "," . $place['longitude'],
            "la"          => "en",
            "ayanamsa"    => 1   // 🔥 Lahiri ayanamsa (required)
        ];

        // ✅ Call API (force POST)
        $data = prokeralaApiRequest($endpoint, $params, "POST");

        // ✅ Save to DB
        $db = (new Database())->connect();
        $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
        $location = $place['location'] ?? null;

        // Insert into panchang_reports
        $stmt = $db->prepare("
            INSERT INTO panchang_reports (user_id, date, location, panchang_data)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param("isss", $userId, $date, $location, $jsonData);
        $stmt->execute();
        $stmt->close();

        // Insert into reports (unified table)
        $stmt = $db->prepare("
            INSERT INTO reports (user_id, type, report_date, location, report_data)
            VALUES (?, 'panchang', ?, ?, ?)
        ");
        $stmt->bind_param("isss", $userId, $date, $location, $jsonData);
        $stmt->execute();
        $stmt->close();

        return $data;
    } catch (Exception $e) {
        return ["error" => $e->getMessage()];
    }
}
