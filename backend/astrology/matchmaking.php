<?php
// backend/astrology/matchmaking.php
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../database.php';

/**
 * Example:
 * $boy = ['dob'=>'1992-06-10','tob'=>'10:20:00','latitude'=>19.0760,'longitude'=>72.8777];
 * $girl= ['dob'=>'1994-08-22','tob'=>'16:05:00','latitude'=>28.7041,'longitude'=>77.1025];
 */
function getMatchmaking($boyUserId, $girlUserId, array $boy, array $girl) {
    $db = (new Database())->connect();

    try {
        // ✅ Correct endpoint
        $endpoint = PROKERALA_API_BASE . "astrology/kundli-matching";

        // Convert to ISO8601 datetime
        $boyDobIso  = date("c", strtotime($boy['dob'] . " " . $boy['tob'])); 
        $girlDobIso = date("c", strtotime($girl['dob'] . " " . $girl['tob'])); 

        // Params for API
        $params = [
            "boy_dob"          => $boyDobIso,
            "boy_coordinates"  => $boy['latitude'] . "," . $boy['longitude'],
            "girl_dob"         => $girlDobIso,
            "girl_coordinates" => $girl['latitude'] . "," . $girl['longitude'],
            "ayanamsa"         => 1
        ];

        // Call Prokerala API
        $response = prokeralaApiRequest($endpoint, $params);
        $data     = json_decode($response, true);

        // Store full JSON as string
        $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
        $score    = $data['data']['score'] ?? null;

        // ✅ Save in matchmaking_reports
        $stmt = $db->prepare("
            INSERT INTO matchmaking_reports (boy_user_id, girl_user_id, matchmaking_data, score)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param("iisi", $boyUserId, $girlUserId, $jsonData, $score);
        $stmt->execute();
        $stmt->close();

        // ✅ Save unified reports for boy
        $stmt = $db->prepare("
            INSERT INTO reports (user_id, partner_user_id, type, score, report_data,report_date)
            VALUES (?, ?, 'matchmaking', ?, ?, NOW())
        ");
        $stmt->bind_param("iiis", $boyUserId, $girlUserId, $score, $jsonData);
        $stmt->execute();
        $stmt->close();

        // ✅ Also save for girl (if exists)
        if (!empty($girlUserId)) {
            $stmt = $db->prepare("
                INSERT INTO reports (user_id, partner_user_id, type, score, report_data,report_date)
                VALUES (?, ?, 'matchmaking', ?, ?, NOW())
            ");
            $stmt->bind_param("iiis", $girlUserId, $boyUserId, $score, $jsonData);
            $stmt->execute();
            $stmt->close();
        }

        return $data;
    } catch (Exception $e) {
        return ['error' => $e->getMessage()];
    }
}
