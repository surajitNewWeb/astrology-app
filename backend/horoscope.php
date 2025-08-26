<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sign = $_POST["sign"] ?? "aries";
    $day = $_POST["day"] ?? "today";

    $params = [
        "sign" => $sign,
        "day" => $day
    ];

    $response = callAstroAPI("horoscope/daily", $params);

    header("Content-Type: application/json");
    echo $response;
}
?>
