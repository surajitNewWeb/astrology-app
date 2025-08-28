<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/token.php';
include_once __DIR__ . '/../includes/navbar.php';

// API Call Function
function performMatchmaking($boy_details, $girl_details) {
    $access_token = getAccessToken();
    if (!$access_token) {
        die("❌ Failed to get access token. Check your Client ID/Secret.");
    }

    // Payload (POST body)
    $payload = [
        "m_day"   => $boy_details['dob']['day'],
        "m_month" => $boy_details['dob']['month'],
        "m_year"  => $boy_details['dob']['year'],
        "m_hour"  => $boy_details['tob']['hour'],
        "m_min"   => $boy_details['tob']['minute'],
        "m_lat"   => $boy_details['coordinates']['lat'],
        "m_lng"   => $boy_details['coordinates']['lon'],
        "m_tz"    => 5.5,

        "f_day"   => $girl_details['dob']['day'],
        "f_month" => $girl_details['dob']['month'],
        "f_year"  => $girl_details['dob']['year'],
        "f_hour"  => $girl_details['tob']['hour'],
        "f_min"   => $girl_details['tob']['minute'],
        "f_lat"   => $girl_details['coordinates']['lat'],
        "f_lng"   => $girl_details['coordinates']['lon'],
        "f_tz"    => 5.5
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, PROKERALA_MATCHMAKING_URL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $access_token",
        "Content-Type: application/x-www-form-urlencoded"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    if ($response === false) {
        die("cURL error: " . curl_error($ch));
    }
    curl_close($ch);

    // 🔍 Safe logging
    $logDir = __DIR__ . "/../logs";
    if (!is_dir($logDir)) {
        mkdir($logDir, 0777, true); // create folder recursively
    }
    $logFile = $logDir . "/matchmaking_debug.log";
    file_put_contents($logFile, date('Y-m-d H:i:s') . " => " . $response . PHP_EOL, FILE_APPEND);

    return json_decode($response, true);
}



// Handle POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $con = getDBConnection();

    // Boy
    list($boy_lat, $boy_lon) = explode(',', $_POST['boy_city']);
    $boy_details = [
        'dob' => [
            'day' => (int)date('d', strtotime($_POST['boy_dob'])),
            'month' => (int)date('m', strtotime($_POST['boy_dob'])),
            'year' => (int)date('Y', strtotime($_POST['boy_dob']))
        ],
        'tob' => [
            'hour' => (int)date('H', strtotime($_POST['boy_tob'])),
            'minute' => (int)date('i', strtotime($_POST['boy_tob']))
        ],
        'coordinates' => ['lat' => (float)$boy_lat, 'lon' => (float)$boy_lon]
    ];

    // Girl
    list($girl_lat, $girl_lon) = explode(',', $_POST['girl_city']);
    $girl_details = [
        'dob' => [
            'day' => (int)date('d', strtotime($_POST['girl_dob'])),
            'month' => (int)date('m', strtotime($_POST['girl_dob'])),
            'year' => (int)date('Y', strtotime($_POST['girl_dob']))
        ],
        'tob' => [
            'hour' => (int)date('H', strtotime($_POST['girl_tob'])),
            'minute' => (int)date('i', strtotime($_POST['girl_tob']))
        ],
        'coordinates' => ['lat' => (float)$girl_lat, 'lon' => (float)$girl_lon]
    ];

    // Call API
    $match_result = performMatchmaking($boy_details, $girl_details);

    // Save DB
    $stmt = $con->prepare("INSERT INTO matchmaking 
        (boy_name, boy_dob, boy_tob, boy_lat, boy_lon, girl_name, girl_dob, girl_tob, girl_lat, girl_lon, compatibility) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $json_result = json_encode($match_result, JSON_UNESCAPED_UNICODE);

   $stmt->bind_param(
    "sssddsssdds",  // 11 letters for 11 variables
    $_POST['boy_name'], $_POST['boy_dob'], $_POST['boy_tob'], $boy_lat, $boy_lon,
    $_POST['girl_name'], $_POST['girl_dob'], $_POST['girl_tob'], $girl_lat, $girl_lon,
    $json_result
);
    $stmt->execute();
    $stmt->close();
}
?>

<!-- Result UI -->
<div class="container py-5 text-light">
  <div class="card shadow-lg border-0 rounded-4"
       style="background:linear-gradient(135deg,#3b2d6e,#1b1430);">
    <div class="card-body p-5">
      <h2 class="text-center mb-4">💞 Matchmaking Result</h2>

      <?php if (!empty($match_result['data'])): ?>
        <h4 class="text-center">
          <?= htmlspecialchars($_POST['boy_name']) ?> ❤️ <?= htmlspecialchars($_POST['girl_name']) ?>
        </h4>
        <p class="text-center fs-5">
          <?= $match_result['data']['summary'] ?? "No summary available"; ?>
        </p>

        <details class="mt-4">
          <summary class="text-info">🔍 Full API Response</summary>
          <pre class="bg-dark text-warning p-3 rounded-3 small"><?php print_r($match_result); ?></pre>
        </details>

      <?php else: ?>
        <div class="alert alert-danger text-center">
          ❌ Failed to fetch matchmaking result.<br>
          <strong>Error:</strong> 
          <?= $match_result['error'] ?? $match_result['message'] ?? "Unknown error"; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
