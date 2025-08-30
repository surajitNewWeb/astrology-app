<?php
require_once __DIR__ . '/../backend/auth/auth_check.php';
require_once __DIR__ . '/../backend/astrology/matchmaking.php';

$data = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $boy = [
        'dob' => $_POST['boy_dob'],
        'tob' => $_POST['boy_tob'],
        'latitude' => $_POST['boy_lat'],
        'longitude' => $_POST['boy_lng'],
    ];
    $girl = [
        'dob' => $_POST['girl_dob'],
        'tob' => $_POST['girl_tob'],
        'latitude' => $_POST['girl_lat'],
        'longitude' => $_POST['girl_lng'],
    ];
    $data = getMatchmaking($_SESSION['user_id'], null, $boy, $girl);
}
?>

<?php include_once __DIR__ . '/../includes/navbar.php'; ?>

<style>
body {
  background: #0a0e1a;
  color: #f8fafc;
  font-family: 'Segoe UI', sans-serif;
}

/* Form card */
.form-card {
  background: #111827;
  border-radius: 15px;
  padding: 30px;
  margin: 40px auto;
  max-width: 900px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.5);
}

/* Heading inside form */
.form-card h2 {
  text-align: center;
  color: #fbbf24;
  font-weight: bold;
  margin-bottom: 30px;
}

.card {
  background: linear-gradient(145deg, #111827, #1e293b);
  border-radius: 15px;
  border: none;
  color: #f8fafc;
  padding: 20px;
  margin-bottom: 20px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.4);
}

.form-label {
  font-weight: 500;
  margin-bottom: 6px;
  color: #cbd5e1;
}

.form-control {
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.2);
  color: #fff;
  border-radius: 12px;
  padding: 10px 14px;
}
.form-control::placeholder {
  color: #94a3b8;
}
.form-control:focus {
  border-color: #818cf8;
  box-shadow: 0 0 6px #6366f1;
}

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

/* Result card */
.result-card {
  background: rgba(255,255,255,0.05);
  border-left: 4px solid #4facfe;
  border-radius: 12px;
  padding: 15px;
  margin-top: 15px;
}
</style>

<div class="container py-5">
  <div class="form-card">
    <h2>✨ Kundli Matchmaking ✨</h2>

    <form method="POST" class="row g-4">
      <!-- Boy Details -->
      <div class="col-md-6">
        <div class="card">
          <h4 class="mb-3">👦 Boy Details</h4>
          <div class="mb-3">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="boy_dob" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Time of Birth</label>
            <input type="time" name="boy_tob" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Latitude</label>
            <input type="text" name="boy_lat" placeholder="Enter Latitude" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Longitude</label>
            <input type="text" name="boy_lng" placeholder="Enter Longitude" class="form-control" required>
          </div>
        </div>
      </div>

      <!-- Girl Details -->
      <div class="col-md-6">
        <div class="card">
          <h4 class="mb-3">👧 Girl Details</h4>
          <div class="mb-3">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="girl_dob" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Time of Birth</label>
            <input type="time" name="girl_tob" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Latitude</label>
            <input type="text" name="girl_lat" placeholder="Enter Latitude" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Longitude</label>
            <input type="text" name="girl_lng" placeholder="Enter Longitude" class="form-control" required>
          </div>
        </div>
      </div>

      <div class="col-12">
        <button type="submit" class="btn-submit">💞 Check Compatibility</button>
      </div>
    </form>
  </div>

  <!-- Results -->
  <?php if ($data): ?>
    <?php if (isset($data['status']) && $data['status'] === 'ok'): ?>
      <?php 
        $boy = $data['data']['boy_info'];
        $girl = $data['data']['girl_info'];
        $guna = $data['data']['guna_milan'];
      ?>
      <div class="result-card">
        <h4>💑 Matchmaking Result</h4>
        <p><b>Guna Milan Score:</b> <?= $guna['total_points'] ?> / <?= $guna['maximum_points'] ?></p>
      </div>

      <div class="row mt-4">
        <div class="col-md-6">
          <div class="card">
            <h5>👦 Boy Details</h5>
            <p><b>Nakshatra:</b> <?= $boy['nakshatra']['name'] ?> (Pada <?= $boy['nakshatra']['pada'] ?>)</p>
            <p><b>Rasi:</b> <?= $boy['rasi']['name'] ?> (<?= $boy['rasi']['lord']['name'] ?>)</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <h5>👧 Girl Details</h5>
            <p><b>Nakshatra:</b> <?= $girl['nakshatra']['name'] ?> (Pada <?= $girl['nakshatra']['pada'] ?>)</p>
            <p><b>Rasi:</b> <?= $girl['rasi']['name'] ?> (<?= $girl['rasi']['lord']['name'] ?>)</p>
          </div>
        </div>
      </div>
    <?php else: ?>
      <div class="alert alert-danger mt-4">
        ❌ Error: <?= htmlspecialchars(json_encode($data)) ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
