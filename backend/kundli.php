<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"] ?? "User";
    $dob = $_POST["dob"];    // YYYY-MM-DD
    $tob = $_POST["tob"];    // HH:MM
    $lat = $_POST["lat"];    // Latitude
    $lon = $_POST["lon"];    // Longitude

    $params = [
        "name" => $name,
        "date" => $dob,
        "time" => $tob,
        "lat" => $lat,
        "lon" => $lon,
        "tz" => 5.5  // IST timezone offset
    ];

    $response = callAstroAPI("kundli/basic", $params);

    header("Content-Type: application/json");
    echo $response;
}
?>
