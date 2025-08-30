<?php
require_once __DIR__ . '/../backend/auth/auth_check.php';
require_once __DIR__ . '/../backend/astrology/numerology.php';

$data = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = [
        'name' => $_POST['name'],
        'dob'  => $_POST['dob']
    ];
    $data = calculateNumerology($_SESSION['user_id'], $input);
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
  max-width: 700px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.5);
}

.form-card h2 {
  text-align: center;
  color: #fbbf24;
  font-weight: bold;
  margin-bottom: 25px;
}

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
  padding: 20px;
  margin-top: 15px;
}
.result-card h5 {
  border-bottom: 1px solid rgba(255,255,255,0.2);
  padding-bottom: 6px;
  margin-bottom: 12px;
}
</style>

<div class="container py-5">
  <div class="form-card">
    <h2>🔢 Numerology Calculator</h2>

    <!-- FORM -->
    <form method="POST" class="row g-3">
      <div class="col-md-6">
        <input type="text" class="form-control" name="name" placeholder="Enter Full Name" required>
      </div>
      <div class="col-md-6">
        <input type="date" class="form-control" name="dob" required>
      </div>
      <div class="col-12">
        <button type="submit" class="btn-submit">✨ Calculate</button>
      </div>
    </form>
  </div>

    <!-- RESULTS -->
  <?php if ($data): ?>
  <h3 class="text-center mt-5 mb-4">📊 Numerology Results</h3>
  <div class="row g-4">
    <?php
    function renderCard($title, $emoji, $section) {
        if (!isset($section['status']) || $section['status'] !== 'ok') return;

        $number = $section['data']['number'] ?? null;
        $name   = $section['data']['name'] ?? null;
        $desc   = $section['data']['description'] ?? null;

        ?>
        <div class="col-md-6">
          <div class="result-card h-100">
            <h5><?= $emoji . " " . htmlspecialchars($title) ?></h5>
            <?php if ($name): ?>
              <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
            <?php endif; ?>
            <?php if ($number): ?>
              <p><strong>Number:</strong> <?= htmlspecialchars($number) ?></p>
            <?php endif; ?>
            <?php if ($desc): ?>
              <p><?= htmlspecialchars($desc) ?></p>
            <?php else: ?>
              <p><em>No description available from API.</em></p>
            <?php endif; ?>
          </div>
        </div>
        <?php
    }

    renderCard("Life Path", "🌌", $data['life_path'] ?? []);
    renderCard("Chaldean Name Number", "🔮", $data['chaldean'] ?? []);
    renderCard("Pythagorean Name Number", "📐", $data['pythagorean'] ?? []);
    renderCard("Destiny Number", "🌟", $data['destiny'] ?? []);
    renderCard("Soul Urge Number", "💖", $data['soul_urge'] ?? []);
    renderCard("Personality Number", "🧩", $data['personality'] ?? []);
    ?>
  </div>
<?php endif; ?>


</div>
<?php include_once __DIR__ . '/../includes/footer.php'; ?>
