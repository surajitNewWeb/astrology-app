<?php
require_once __DIR__ . '/../backend/auth/auth_check.php';
require_once __DIR__ . '/../backend/database.php';

$db = new Database();
$conn = $db->connect();

$userId = $_SESSION['user_id'];

// Fetch user reports
$stmt = $conn->prepare("SELECT * FROM reports WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$reports = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

// Summary counts
$totalReports = count($reports);
$horoscopes   = count(array_filter($reports, fn($r) => $r['type'] === 'horoscope'));
$kundlis      = count(array_filter($reports, fn($r) => $r['type'] === 'kundli'));
$matchmaking  = count(array_filter($reports, fn($r) => $r['type'] === 'matchmaking'));
$numerology   = count(array_filter($reports, fn($r) => $r['type'] === 'numerology'));
?>

<?php include_once __DIR__ . '/../includes/navbar.php'; ?>

<style>
body {
  background: #0a0e1a; /* Deep cosmic background */
  color: #f8fafc;
  font-family: 'Segoe UI', sans-serif;
}

/* Quick Links */
.quick-links-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
  margin-top: 30px;
}

.quick-link {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  padding: 20px;
  border-radius: 16px;
  background: linear-gradient(145deg,#1e293b,#111827);
  border: 1px solid rgba(255,215,0,0.2);
  color: #ffd700;
  font-weight: 600;
  font-size: 1rem;
  cursor: pointer;
  transition: all 0.3s ease;
  text-align: center;
}

.quick-link:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 30px rgba(255,215,0,0.4);
  background: linear-gradient(145deg,#111827,#1e293b);
}

.quick-link span.icon {
  font-size: 2rem;
}

/* Summary Cards */
.summary-card {
  background: linear-gradient(145deg,#111827,#1e293b);
  border-radius: 16px;
  padding: 20px;
  text-align: center;
  color: #ffd700;
  box-shadow: 0 6px 18px rgba(255,215,0,0.3);
  transition: all 0.3s ease;
}

.summary-card h3 {
  font-size: 2rem;
  margin-bottom: 8px;
}

.summary-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 28px rgba(255,215,0,0.4);
}

/* Reports Table */
.table-container {
  margin-top: 30px;
  overflow-x: auto;
}

.table-container table {
  width: 100%;
  border-collapse: collapse;
}

.table-container th, .table-container td {
  padding: 12px 10px;
  border: 1px solid rgba(255,255,255,0.1);
  text-align: center;
}

.table-container th {
  background: #1e293b;
  color: #ffd700;
}

.table-container tr:nth-child(even) {
  background: #111827;
}

.table-container tr:hover {
  background: #1a1f2e;
}

.btn-download {
  padding: 6px 12px;
  border-radius: 8px;
  background: #ffd700;
  color: #111827;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
}

.btn-download:hover {
  background: #ffec8b;
}

/* Additional Sections */
.card-section {
  background: linear-gradient(145deg,#111827,#1e293b);
  border-radius: 16px;
  padding: 20px;
  border: 1px solid rgba(255,215,0,0.2);
  margin-top: 30px;
  color: #f8fafc;
}

.section-title {
  color: #ffd700;
  margin-bottom: 12px;
  font-weight: 600;
}

/* Recent Activity List */
.list-group-item {
  background: #1e293b;
  border: 1px solid rgba(255,215,0,0.15);
  color: #f8fafc;
  font-weight: 500;
  transition: all 0.3s ease;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-radius: 12px;
  margin-bottom: 8px;
}

.list-group-item:hover {
  background: #111827;
  box-shadow: 0 6px 20px rgba(255,215,0,0.2);
}

.list-group-item span {
  background: #ffd700;
  color: #111827;
  padding: 2px 8px;
  border-radius: 8px;
  font-weight: 600;
}
</style>

<?php
require_once __DIR__ . '/../backend/auth/auth_check.php';
require_once __DIR__ . '/../backend/database.php';

$db = new Database();
$conn = $db->connect();

$userId = $_SESSION['user_id'];

// Fetch user reports
$stmt = $conn->prepare("SELECT * FROM reports WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$reports = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

// Summary counts
$totalReports = count($reports);
$horoscopes   = count(array_filter($reports, fn($r) => $r['type'] === 'horoscope'));
$kundlis      = count(array_filter($reports, fn($r) => $r['type'] === 'kundli'));
$matchmaking  = count(array_filter($reports, fn($r) => $r['type'] === 'matchmaking'));
$birthchart   = count(array_filter($reports, fn($r) => $r['type'] === 'birthchart'));
$panchang   = count(array_filter($reports, fn($r) => $r['type'] === 'panchang'));
$dosha   = count(array_filter($reports, fn($r) => $r['type'] === 'dosha'));
?>

<?php include_once __DIR__ . '/../includes/navbar.php'; ?>

<div class="container mt-5">
  <!-- Welcome -->
  <div class="text-center mb-4">
    <h2>🌟 Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
    <p>Your astrology dashboard at a glance</p>
  </div>

  <!-- Quick Links -->
  <div class="quick-links-container">
    <div class="quick-link" onclick="location.href='horoscope.php'">
      <span class="icon">🔮</span>
      Daily Horoscope
      <small>Personalized daily predictions</small>
    </div>
    <div class="quick-link" onclick="location.href='kundli.php'">
      <span class="icon">🪐</span>
      Generate Kundli
      <small>Detailed birth chart insights</small>
    </div>
    <div class="quick-link" onclick="location.href='matchmaking.php'">
      <span class="icon">💖</span>
      Matchmaking
      <small>Check love & compatibility</small>
    </div>
    <div class="quick-link" onclick="location.href='numerology.php'">
      <span class="icon">🔢</span>
      Numerology
      <small>Life path & lucky numbers</small>
    </div>
    <div class="quick-link" onclick="location.href='panchang.php'">
      <span class="icon">📅</span>
      Panchang
      <small>Today's tithi, nakshatra, yoga</small>
    </div>
    <div class="quick-link" onclick="location.href='dosha.php'">
      <span class="icon">⚖️</span>
      Dosha
      <small>Manglik & dosha remedies</small>
    </div>
  </div>

  <!-- Summary Cards -->
  <div class="row g-4 mt-5">
    <div class="col-md-3"><div class="summary-card"><h3><?php echo $totalReports; ?></h3>Total Reports</div></div>
    <div class="col-md-3"><div class="summary-card"><h3><?php echo $horoscopes; ?></h3>Horoscopes</div></div>
    <div class="col-md-3"><div class="summary-card"><h3><?php echo $kundlis; ?></h3>Kundli</div></div>
    <div class="col-md-3"><div class="summary-card"><h3><?php echo $matchmaking; ?></h3>Matchmaking</div></div>
    <div class="col-md-3 mt-3"><div class="summary-card"><h3><?php echo $numerology; ?></h3>Numerology</div></div>
      <div class="col-md-3 mt-3"><div class="summary-card"><h3><?php echo $birthchart; ?></h3>Birthcharts</div></div>
        <div class="col-md-3 mt-3"><div class="summary-card"><h3><?php echo $panchang; ?></h3>Panchnag</div></div>
          <div class="col-md-3 mt-3"><div class="summary-card"><h3><?php echo $dosha; ?></h3>Dosha</div></div>
  </div>

  <!-- Recent Activity -->
  <div class="row g-4 mt-5">
    <div class="col-md-6">
      <div class="card-section">
        <h3 class="section-title">🔮 Today's Astrology Tip</h3>
        <p>Favor conversations and new ideas — the moon supports clarity. Wear teal for good luck!</p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card-section">
        <h3 class="section-title">🌟 Recent Activity</h3>
        <ul class="list-group list-group-flush text-white">
          <?php foreach(array_slice($reports,0,5) as $r): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span>📄 <?= ucfirst($r['type']) ?> report</span>
              <span><?= date("d M", strtotime($r['created_at'])) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>

  <!-- Reports Table -->
  <div class="table-container mt-5">
    <h4>📑 My Reports</h4>
    <?php if (empty($reports)): ?>
      <div class="alert alert-info mt-3">
        No reports found. Generate your first horoscope, kundli, or matchmaking report!
      </div>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Type</th>
            <th>Location</th>
            <th>Score</th>
            <th>Date</th>
            <th>Report</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($reports as $r): ?>
            <tr>
              <td><?= $r['id']; ?></td>
              <td><?= ucfirst($r['type']); ?></td>
              <td><?= $r['location'] ?? '-'; ?></td>
              <td><?= !empty($r['score']) ? $r['score'].' / 36' : '-'; ?></td>
              <td><?= date("d M Y", strtotime($r['created_at'])); ?></td>
              <td>
                <?php if (!empty($r['file_path'])): ?>
                  <a href="/storage/reports/<?= $r['file_path']; ?>" target="_blank" class="btn-download">⬇ Download</a>
                <?php else: ?>
                  <button onclick="viewReport(<?= $r['id']; ?>)" class="btn-download">👁 View</button>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</div>

<script>
function viewReport(id) {
  window.location.href = "view_report.php?id=" + id;
}
</script>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
