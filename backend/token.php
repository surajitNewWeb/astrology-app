<?php
require_once __DIR__ . '/../config/config.php';
header('Content-Type: application/json');

try {
    $token = getProkeralaAccessToken();

    echo json_encode([
        'status' => 'success',
        'access_token' => $token
    ], JSON_PRETTY_PRINT);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch token',
        'details' => $e->getMessage()
    ], JSON_PRETTY_PRINT);
}
