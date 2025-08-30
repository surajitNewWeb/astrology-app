<?php
require_once __DIR__ . '/../backend/auth/auth_check.php';
require_once __DIR__ . '/../backend/astrology/kundli.php';

$data = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $details = [
        'dob'        => $_POST['dob'],
        'tob'        => $_POST['tob'],
        'latitude'   => $_POST['latitude'],
        'longitude'  => $_POST['longitude'],
        'chart_type' => $_POST['chart_type'],
        'chart_style'=> $_POST['chart_style'],
    ];
    $data = generateKundli($_SESSION['user_id'], $details);
}
?>

<?php include_once __DIR__ . '/../includes/navbar.php'; ?>

<style>
  body {
    background: #0a0e1a;
    color: #f8fafc;
    font-family: 'Segoe UI', sans-serif;
  }

  .form-card {
    background: #111827;
    border-radius: 15px;
    padding: 30px 35px;
    max-width: 650px;
    margin: 40px auto;
    box-shadow: 0 6px 20px rgba(0,0,0,0.5);
    animation: fadeIn 0.8s ease;
  }

  /* Heading inside form */
  .form-card h2 {
    text-align: center;
    color: #fbbf24;
    font-weight: bold;
    margin-bottom: 25px;
  }

  .form-label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    color: #e5e7eb;
    font-size: 0.95rem;
  }

  .form-control, .form-select {
    width: 100%;
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid #374151;
    background: #1f2937;
    color: #f8fafc;
    font-size: 0.95rem;
    margin-bottom: 15px;
    outline: none;
    transition: 0.2s;
  }

  .form-control:focus, .form-select:focus {
    border-color: #818cf8;
    box-shadow: 0 0 6px #6366f1;
  }

  .btn-submit {
    width: 100%;
    padding: 12px;
    font-weight: bold;
    font-size: 1rem;
    border-radius: 12px;
    border: none;
    background: linear-gradient(135deg,#4facfe,#00f2fe);
    color: #111;
    cursor: pointer;
    transition: 0.3s;
  }

  .btn-submit:hover {
    background: linear-gradient(135deg,#f093fb,#f5576c);
    color: #fff;
    transform: translateY(-2px);
  }

  /* Result cards */
  #result .card {
    background: #1f2937;
    border-radius: 14px;
    color: #f8fafc;
    padding: 20px;
    margin-top: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.5);
  }

  #result h4 {
    color: #fbbf24;
    margin-bottom: 10px;
  }

  #result p, #result li {
    color: #e5e7eb;
  }

  .kundli-chart {
    background: #fff;
    color: #000;
    padding: 15px;
    border-radius: 12px;
    text-align: center;
  }

  @keyframes fadeIn {
    from { opacity:0; transform: translateY(10px); }
    to { opacity:1; transform: translateY(0); }
  }
</style>

<div class="form-card">
  <h2>✨ Generate Your Kundli ✨</h2>
  
  <form method="POST" class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Date of Birth</label>
      <input type="date" name="dob" class="form-control" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Time of Birth</label>
      <input type="time" name="tob" class="form-control" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Latitude</label>
      <input type="text" name="latitude" placeholder="e.g. 28.7041" class="form-control" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Longitude</label>
      <input type="text" name="longitude" placeholder="e.g. 77.1025" class="form-control" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Chart Type</label>
      <select name="chart_type" class="form-select" required>
        <option value="">-- Select Type --</option>
        <option value="rasi">Rasi</option>
        <option value="navamsa">Navamsa</option>
        <option value="lagna">Lagna</option>
        <option value="moon">Moon</option>
        <option value="sun">Sun</option>
      </select>
    </div>

    <div class="col-md-6">
      <label class="form-label">Chart Style</label>
      <select name="chart_style" class="form-select" required>
        <option value="">-- Select Style --</option>
        <option value="north-indian">North Indian</option>
        <option value="south-indian">South Indian</option>
        <option value="east-indian">East Indian</option>
      </select>
    </div>

    <div class="col-12">
      <button type="submit" class="btn-submit">🔮 Generate Kundli</button>
    </div>
  </form>

  <div id="result">
    <?php if ($data): ?>
      <?php if (isset($data['json']['data'])): 
          $astro = $data['json']['data'];
      ?>
        <div class="card">
          <h4>🌙 Nakshatra & Rashi</h4>
          <p><b>Moon Rashi:</b> <?= $astro['nakshatra_details']['chandra_rasi']['name']; ?> (<?= $astro['nakshatra_details']['chandra_rasi']['lord']['vedic_name']; ?>)</p>
          <p><b>Sun Rashi:</b> <?= $astro['nakshatra_details']['soorya_rasi']['name']; ?> (<?= $astro['nakshatra_details']['soorya_rasi']['lord']['vedic_name']; ?>)</p>
          <p><b>Nakshatra:</b> <?= $astro['nakshatra_details']['nakshatra']['name']; ?> (Pada <?= $astro['nakshatra_details']['nakshatra']['pada']; ?>)</p>
        </div>

        <div class="card">
          <h4>🔥 Mangal Dosha</h4>
          <?php if ($astro['mangal_dosha']['has_dosha']): ?>
            <p style="color:#f87171;">⚠ Mangal Dosha Present</p>
          <?php else: ?>
            <p style="color:#10b981;">✅ No Mangal Dosha</p>
          <?php endif; ?>
        </div>

        <div class="card">
          <h4>✨ Yogas</h4>
          <ul>
            <?php foreach ($astro['yoga_details'] as $yoga): ?>
              <li><?= $yoga['name']; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if (isset($data['chart'])): ?>
        <div class="card">
          <h4>📜 Kundli Chart</h4>
          <div class="kundli-chart"><?= $data['chart']; ?></div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
