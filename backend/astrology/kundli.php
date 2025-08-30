<?php
// backend/astrology/kundli.php
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../database.php';

/**
 * Save Kundli JSON + SVG in DB
 */
function generateKundli($userId, array $details) {
    $db = (new Database())->connect();

    try {
        // --- Prepare datetime ---
        $dob = $details['dob'];   // yyyy-mm-dd
        $tob = $details['tob'];   // hh:mm or hh:mm:ss
        if (strlen($tob) === 5) $tob .= ":00"; 
        $datetime = $dob . "T" . $tob . "+05:30";

        // --- Get JSON Kundli Data ---
        $endpointData = PROKERALA_API_BASE . "astrology/kundli";
        $paramsData = [
            "datetime"    => $datetime,
            "coordinates" => $details['latitude'] . "," . $details['longitude'],
            "ayanamsa"    => 1
        ];
        $respData = prokeralaApiRequest($endpointData, $paramsData);
        $dataArr  = json_decode($respData, true);
        $jsonData = $dataArr ? json_encode($dataArr, JSON_UNESCAPED_UNICODE) : null;

        // --- Get SVG Chart ---
        $endpointChart = PROKERALA_API_BASE . "astrology/chart";
        $paramsChart = [
            "datetime"    => $datetime,
            "coordinates" => $details['latitude'] . "," . $details['longitude'],
            "ayanamsa"    => 1,
            "chart_type"  => strtolower($details['chart_type']),   // rasi, navamsa, etc.
            "chart_style" => strtolower(str_replace(" ", "-", $details['chart_style'])) // north-indian, south-indian
        ];
        $respChart = prokeralaApiRequest($endpointChart, $paramsChart); // raw SVG
        $svgChart  = $respChart ?: null;

        // --- Save into kundli_reports (detailed storage) ---
        $stmt = $db->prepare("INSERT INTO kundli_reports (user_id, kundli_data, kundli_chart) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $userId, $jsonData, $svgChart);
        $stmt->execute();
        $stmt->close();

        // --- Wrap JSON + chart for reports (unified history) ---
        $reportPayload = [
            "dob"        => $dob,
            "tob"        => $tob,
            "latitude"   => $details['latitude'],
            "longitude"  => $details['longitude'],
            "chartType"  => $details['chart_type'],
            "chartStyle" => $details['chart_style'],
            "result"     => $dataArr,
            "chartSvg"   => $svgChart
        ];
        $reportJson = json_encode($reportPayload, JSON_UNESCAPED_UNICODE);

        // --- Save into reports table ---
        $stmt = $db->prepare("INSERT INTO reports (user_id, type, report_date, report_data) VALUES (?, 'kundli', NOW(), ?)");
        $stmt->bind_param("is", $userId, $reportJson);
        $stmt->execute();
        $stmt->close();

        return [
            "json"  => $dataArr,
            "chart" => $svgChart
        ];
    } catch (Exception $e) {
        return ["error" => $e->getMessage()];
    }
}
