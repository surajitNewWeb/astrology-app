<?php
require_once __DIR__ . '/../backend/helpers.php';
require_login();

// Create profile (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'create_profile') {
    $full_name = trim($_POST['full_name'] ?? '');
    $dob = $_POST['dob'] ?? '';
    $tob = $_POST['tob'] ?? '';
    $timezone = trim($_POST['timezone'] ?? '');
    $latitude = (float)($_POST['latitude'] ?? 0);
    $longitude = (float)($_POST['longitude'] ?? 0);
    $place = trim($_POST['place'] ?? '');

    if ($full_name && $dob && $tob && $timezone && $latitude && $longitude) {
        $st = db()->prepare('INSERT INTO profiles(user_id, full_name, dob, tob, timezone, latitude, longitude, place) VALUES(?,?,?,?,?,?,?,?)');
        $st->execute([current_user_id(), $full_name, $dob, $tob, $timezone, $latitude, $longitude, $place]);
        $_SESSION['flash'] = 'Profile added.';
        header('Location: /public/view.php');
        exit;
    } else {
        $_SESSION['flash'] = 'All fields required.';
    }
}

// Fetch my profiles
$st = db()->prepare('SELECT * FROM profiles WHERE user_id = ? ORDER BY created_at DESC');
$st->execute([current_user_id()]);
$profiles = $st->fetchAll();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="/public/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/public/assets/css/style.css">
  <script>
    async function callApi(url, form) {
      const fd = new FormData(form);
      const r = await fetch(url, {method: 'POST', body: fd});
      const j = await r.json();
      alert(JSON.stringify(j, null, 2));
      if (j.file) document.getElementById('latestChart').src = j.file;
      return false;
    }
  </script>
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>
<div class="container py-4">
  <?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-info"><?php echo e($_SESSION['flash']); unset($_SESSION['flash']); ?></div>
  <?php endif; ?>

  <div class="card mb-4">
    <h4>Add Profile</h4>
    <form method="post">
      <input type="hidden" name="action" value="create_profile">
      <div class="row">
        <div class="col-md-6 mb-3"><label>Full Name</label><input required name="full_name" class="form-control"></div>
        <div class="col-md-3 mb-3"><label>Date of Birth</label><input required type="date" name="dob" class="form-control"></div>
        <div class="col-md-3 mb-3"><label>Time of Birth</label><input required type="time" name="tob" class="form-control" step="60"></div>
        <div class="col-md-3 mb-3"><label>Timezone (e.g. +05:30)</label><input required name="timezone" class="form-control" placeholder="+05:30"></div>
        <div class="col-md-3 mb-3"><label>Latitude</label><input required type="number" step="0.000001" name="latitude" class="form-control"></div>
        <div class="col-md-3 mb-3"><label>Longitude</label><input required type="number" step="0.000001" name="longitude" class="form-control"></div>
        <div class="col-md-3 mb-3"><label>Place</label><input name="place" class="form-control" placeholder="City, Country"></div>
      </div>
      <button class="btn btn-primary">Save Profile</button>
    </form>
  </div>

  <div class="card mb-4">
    <h4>Your Profiles</h4>
    <?php if (!$profiles): ?>
      <p>No profiles yet.</p>
    <?php else: ?>
      <table class="table table-sm">
        <thead><tr><th>#</th><th>Name</th><th>DOB</th><th>TOB</th><th>Lat</th><th>Lon</th><th></th></tr></thead>
        <tbody>
        <?php foreach ($profiles as $p): ?>
          <tr>
            <td><?php echo (int)$p['id']; ?></td>
            <td><?php echo e($p['full_name']); ?></td>
            <td><?php echo e($p['dob']); ?></td>
            <td><?php echo e($p['tob']); ?></td>
            <td><?php echo e($p['latitude']); ?></td>
            <td><?php echo e($p['longitude']); ?></td>
            <td>
              <form onsubmit="return callApi('/backend/horoscope.php', this)" class="d-inline">
                <input type="hidden" name="profile_id" value="<?php echo (int)$p['id']; ?>">
                <select name="type" class="form-select form-select-sm d-inline w-auto">
                  <option value="daily">Daily</option>
                  <option value="weekly">Weekly</option>
                  <option value="monthly">Monthly</option>
                  <option value="yearly">Yearly</option>
                </select>
                <button class="btn btn-outline-secondary btn-sm">Horoscope</button>
              </form>
              <form onsubmit="return callApi('/backend/kundali.php', this)" class="d-inline ms-1">
                <input type="hidden" name="profile_id" value="<?php echo (int)$p['id']; ?>">
                <button class="btn btn-outline-secondary btn-sm">Kundali</button>
              </form>
              <form onsubmit="return callApi('/backend/birthchart.php', this)" class="d-inline ms-1">
                <input type="hidden" name="profile_id" value="<?php echo (int)$p['id']; ?>">
                <button class="btn btn-outline-secondary btn-sm">Birth Chart</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>

  <?php if (count($profiles) >= 2): ?>
    <div class="card mb-4">
      <h4>Matchmaking</h4>
      <form onsubmit="return callApi('/backend/matchmaking.php', this)">
        <div class="row">
          <div class="col-md-4 mb-2">
            <label>Profile A</label>
            <select name="profile_a" class="form-select">
              <?php foreach ($profiles as $p): ?>
                <option value="<?php echo (int)$p['id']; ?>"><?php echo e($p['full_name']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-4 mb-2">
            <label>Profile B</label>
            <select name="profile_b" class="form-select">
              <?php foreach ($profiles as $p): ?>
                <option value="<?php echo (int)$p['id']; ?>"><?php echo e($p['full_name']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-4 d-flex align-items-end mb-2">
            <button class="btn btn-outline-primary w-100">Run Matchmaking</button>
          </div>
        </div>
      </form>
    </div>
  <?php endif; ?>

  <div class="card text-center">
    <h4>Latest Chart</h4>
    <img id="latestChart" src="" alt="Chart will appear here" style="max-width:100%; height:auto;">
  </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
