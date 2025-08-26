<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "astrology_app";

$con = new mysqli($host, $user, $pass, $dbname);

if ($con->connect_error) {
    die("Database Connection Failed: " . $con->connect_error);
}

// FreeAstrologyAPI Key
$ASTRO_API_KEY = "SFJJf2cOla1MVaqY421L86YygMlWl26O4gAcVXmY";  // Replace with your key

// Function for making API requests
function callAstroAPI($endpoint, $params = []) {
    global $ASTRO_API_KEY;

    $url = "https://api.freeastrologyapi.com/v1/" . $endpoint;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer $ASTRO_API_KEY"
    ]);

    if (!empty($params)) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    }

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        return json_encode(["error" => curl_error($ch)]);
    }
    curl_close($ch);

    return $response;
}
?>
