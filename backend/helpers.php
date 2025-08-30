<?php
require_once __DIR__ . '/../config/config.php';

/**
 * Get Access Token from Prokerala API
 */
function getProkeralaAccessToken() {
    $clientId = PROKERALA_CLIENT_ID;
    $clientSecret = PROKERALA_CLIENT_SECRET;
    $tokenUrl = PROKERALA_TOKEN_URL;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $tokenUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        "grant_type" => "client_credentials",
        "client_id" => $clientId,
        "client_secret" => $clientSecret
    ]));

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        throw new Exception("cURL error: " . curl_error($ch));
    }
    curl_close($ch);

    $data = json_decode($response, true);
    if (!isset($data['access_token'])) {
        throw new Exception("Failed to retrieve access token: " . $response);
    }
    return $data['access_token'];
}

/**
 * Generic API request to Prokerala
 */
function prokeralaApiRequest($endpoint, $params = []) {
    $token = getProkeralaAccessToken();

    $url = $endpoint . '?' . http_build_query($params);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $token"
    ]);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        throw new Exception("cURL error: " . curl_error($ch));
    }
    curl_close($ch);

    return $response;
}
