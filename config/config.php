<?php
// ================================
// Load Environment Variables
// ================================
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

// ================================
// Database Connection
// ================================
function getDBConnection() {
    $host = $_ENV['DB_HOST'] ?? 'localhost';
    $user = $_ENV['DB_USER'] ?? 'root';
    $pass = $_ENV['DB_PASS'] ?? '';
    $db   = $_ENV['DB_NAME'] ?? 'astrology_app';

    $con = new mysqli($host, $user, $pass, $db);
    if ($con->connect_error) {
        die("❌ Database Connection failed: " . $con->connect_error);
    }
    return $con;
}

// ================================
// Prokerala API Credentials
// ================================
define('PROKERALA_CLIENT_ID', $_ENV['PROKERALA_CLIENT_ID'] ?? '');
define('PROKERALA_CLIENT_SECRET', $_ENV['PROKERALA_CLIENT_SECRET'] ?? '');
define('PROKERALA_TOKEN_URL', 'https://api.prokerala.com/token'); // ✅ v2 token endpoint

// Astrology Endpoints (all POST)
define('PROKERALA_MATCHMAKING_URL', 'https://api.prokerala.com/v2/astrology/kundli-matching');
define('PROKERALA_KUNDLI_URL', 'https://api.prokerala.com/v2/astrology/basic-chart');
define('PROKERALA_HOROSCOPE_URL', 'https://api.prokerala.com/v2/astrology/horoscope/daily');
define('PROKERALA_HOROSCOPE_ADV_URL', 'https://api.prokerala.com/v2/astrology/horoscope/daily/advanced');

// ================================
// Token Handling (with Cache)
// ================================
function getProkeralaAccessToken() {
    $cacheFile = __DIR__ . '/../cache/prokerala_token.json';

    // Use cached token if valid
    if (file_exists($cacheFile)) {
        $data = json_decode(file_get_contents($cacheFile), true);
        if ($data && isset($data['access_token'], $data['expires_at']) && $data['expires_at'] > time()) {
            return $data['access_token'];
        }
    }

    // Request new token
    $postFields = http_build_query([
        'grant_type' => 'client_credentials',
        'client_id' => PROKERALA_CLIENT_ID,
        'client_secret' => PROKERALA_CLIENT_SECRET
    ]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, PROKERALA_TOKEN_URL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded',
        'Accept: application/json'
    ]);

    $response = curl_exec($ch);
    if ($response === false) {
        throw new Exception("❌ Token request failed: " . curl_error($ch));
    }
    curl_close($ch);

    $result = json_decode($response, true);

    if (isset($result['access_token'], $result['expires_in'])) {
        $result['expires_at'] = time() + $result['expires_in'] - 10;

        if (!is_dir(__DIR__ . '/../cache')) {
            mkdir(__DIR__ . '/../cache', 0755, true);
        }
        file_put_contents($cacheFile, json_encode($result));

        return $result['access_token'];
    }

    throw new Exception("❌ Invalid token response: " . $response);
}

// ================================
// API Caller (Always POST JSON)
// ================================
function callProkeralaAPI($url, $postData = []) {
    $token = getProkeralaAccessToken();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $token",
        "Content-Type: application/json",
        "Accept: application/json"
    ]);

    if (!empty($postData)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    }

    $response = curl_exec($ch);
    if ($response === false) {
        throw new Exception("❌ API Call failed: " . curl_error($ch));
    }
    curl_close($ch);

    $result = json_decode($response, true);

    if (!$result) {
        throw new Exception("❌ Invalid JSON from API: " . $response);
    }

    return $result;
}
