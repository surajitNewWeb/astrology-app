<?php
require_once __DIR__ . '/../backend/auth/auth_check.php';
require_once __DIR__ . '/../backend/astrology/panchang.php';

$data = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $place = [
        'location'  => $_POST['location'],
        'latitude'  => $_POST['latitude'],
        'longitude' => $_POST['longitude']
    ];
    $ayanamsa = $_POST['ayanamsa'] ?? 1; // default Lahiri
    $data = getPanchang($_SESSION['user_id'], $_POST['date'], $place, $ayanamsa);
}
?>

<?php include_once __DIR__ . '/../includes/navbar.php'; ?>

<style>
body {
  background: #0a0e1a;
  color: #f8fafc;
  font-family: 'Segoe UI', sans-serif;
}

/* Form Card */
.form-card {
  background: #111827;
  border-radius: 15px;
  padding: 30px;
  margin: 40px auto;
  max-width: 700px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.5);
}
.form-card h2 {
  text-align: center;
  color: #fbbf24;
  font-weight: bold;
  margin-bottom: 25px;
}

/* Inputs */
.form-control {
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.2);
  color: #fff;
  border-radius: 12px;
  padding: 12px;
}
.form-control::placeholder {
  color: #94a3b8;
}
.form-control:focus {
  border-color: #818cf8;
  box-shadow: 0 0 6px #6366f1;
}

/* Button */
.btn-submit {
  margin-top: 20px;
  background: linear-gradient(135deg,#4facfe,#00f2fe);
  border: none;
  color: #111;
  padding: 12px 20px;
  border-radius: 12px;
  font-weight: bold;
  font-size: 1rem;
  cursor: pointer;
  width: 100%;
  transition: 0.3s;
}
.btn-submit:hover {
  background: linear-gradient(135deg,#f093fb,#f5576c);
  color: #fff;
  transform: translateY(-2px);
}

/* Result Cards */
.result-card {
  background: rgba(255,255,255,0.05);
  border-radius: 14px;
  padding: 20px;
  margin-bottom: 20px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.4);
  transition: 0.3s;
}
.result-card:hover {
  box-shadow: 0 8px 24px rgba(0,0,0,0.6);
  transform: translateY(-2px);
}

.result-card h4 {
  font-weight: bold;
  margin-bottom: 12px;
  background: linear-gradient(135deg, #4facfe, #f093fb);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.result-card p, .result-card li {
  color: #f8fafc;
  line-height: 1.5;
}
</style>

<div class="container py-5">
  <div class="form-card">
    <h2>📅 Panchang</h2>

    <!-- Panchang Form -->
    <form method="POST" class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Date</label>
        <input type="date" name="date" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Location</label>
        <input type="text" name="location" class="form-control" placeholder="City name" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Latitude</label>
        <input type="text" name="latitude" class="form-control" placeholder="e.g. 19.0760" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Longitude</label>
        <input type="text" name="longitude" class="form-control" placeholder="e.g. 72.8777" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Ayanamsa</label>
        <select name="ayanamsa" class="form-control" required>
          <option value="1">Lahiri</option>
          <option value="3">Krishnamurti</option>
          <option value="5">Raman</option>
        </select>
      </div>
      <div class="col-12 text-center">
        <button type="submit" class="btn-submit">✨ Get Panchang</button>
      </div>
    </form>
  </div>

  <!-- Panchang Results -->
  <?php if ($data): ?>
    <?php 
      if (is_string($data)) $data = json_decode($data, true);
      if (isset($data['status']) && $data['status'] === 'ok' && isset($data['data'])): 
        $details = $data['data'];
    ?>
      <h3 class="text-center mb-4" style="background: linear-gradient(135deg,#4facfe,#f093fb); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">📊 Panchang Results</h3>

      <!-- Basic Info -->
      <div class="result-card">
        <h4>🌞 Basic Info</h4>
        <p><strong>Vaara (Day):</strong> <?= $details['vaara'] ?? '-' ?></p>
        <p><strong>Sunrise:</strong> <?= date("H:i:s", strtotime($details['sunrise'])) ?></p>
        <p><strong>Sunset:</strong> <?= date("H:i:s", strtotime($details['sunset'])) ?></p>
        <p><strong>Moonrise:</strong> <?= date("H:i:s", strtotime($details['moonrise'])) ?></p>
        <p><strong>Moonset:</strong> <?= date("H:i:s", strtotime($details['moonset'])) ?></p>
      </div>

      <!-- Nakshatra -->
      <?php if (!empty($details['nakshatra'])): ?>
        <div class="result-card">
          <h4>🌌 Nakshatra</h4>
          <ul>
            <?php foreach ($details['nakshatra'] as $n): ?>
              <li>
                <strong><?= $n['name'] ?></strong> (Lord: <?= $n['lord']['name'] ?>) <br>
                From <?= date("d M H:i", strtotime($n['start'])) ?> 
                to <?= date("d M H:i", strtotime($n['end'])) ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <!-- Additional sections: Tithi, Karana, Yoga -->
      <?php if (!empty($details['tithi'])): ?>
        <div class="result-card">
          <h4>🌙 Tithi</h4>
          <ul>
            <?php foreach ($details['tithi'] as $t): ?>
              <li>
                <strong><?= $t['name'] ?></strong> <br>
                From <?= date("d M H:i", strtotime($t['start'])) ?> 
                to <?= date("d M H:i", strtotime($t['end'])) ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if (!empty($details['karana'])): ?>
        <div class="result-card">
          <h4>⚡ Karana</h4>
          <ul>
            <?php foreach ($details['karana'] as $k): ?>
              <li>
                <strong><?= $k['name'] ?></strong> <br>
                From <?= date("d M H:i", strtotime($k['start'])) ?> 
                to <?= date("d M H:i", strtotime($k['end'])) ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if (!empty($details['yoga'])): ?>
        <div class="result-card">
          <h4>✨ Yoga</h4>
          <ul>
            <?php foreach ($details['yoga'] as $y): ?>
              <li>
                <strong><?= $y['name'] ?></strong> <br>
                From <?= date("d M H:i", strtotime($y['start'])) ?> 
                to <?= date("d M H:i", strtotime($y['end'])) ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

    <?php else: ?>
      <div class="alert alert-warning mt-4 shadow">
        ⚠️ No Panchang data found. <br>
        <small>Raw Response:</small>
        <pre><?php print_r($data); ?></pre>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</div>
<?php include_once __DIR__ . '/../includes/footer.php'; ?>
