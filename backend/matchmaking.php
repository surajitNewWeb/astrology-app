<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $boy = [
        "name" => $_POST["boy_name"],
        "date" => $_POST["boy_dob"], // YYYY-MM-DD
        "time" => $_POST["boy_tob"], // HH:MM
        "lat" => $_POST["boy_lat"],
        "lon" => $_POST["boy_lon"],
        "tz" => 5.5
    ];

    $girl = [
        "name" => $_POST["girl_name"],
        "date" => $_POST["girl_dob"],
        "time" => $_POST["girl_tob"],
        "lat" => $_POST["girl_lat"],
        "lon" => $_POST["girl_lon"],
        "tz" => 5.5
    ];

    $params = [
        "male" => $boy,
        "female" => $girl
    ];

    $response = callAstroAPI("matchmaking/ashtakoot", $params);

    header("Content-Type: application/json");
    echo $response;
}
?>
