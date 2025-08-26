<?php
// backend/db.php
$config = require __DIR__ . '/config.php';
$db = $config['db'];

$mysqli = new mysqli($db['host'], $db['user'], $db['pass'], $db['name']);
if ($mysqli->connect_errno) {
    http_response_code(500);
    echo json_encode(['error' => 'DB connect error: ' . $mysqli->connect_error]);
    exit;
}
$mysqli->set_charset($db['charset']);
return $mysqli;
