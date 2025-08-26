<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">

  <!-- Custom Styles -->
  <style>
    body {
      background: linear-gradient(135deg, #1f1c2c, #928DAB);
      min-height: 100vh;
      color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
      position: relative;
    }
    .dashboard-header {
      text-align: center;
      margin-bottom: 50px;
    }
    .dashboard-header h3 {
      font-weight: 700;
      font-size: 2rem;
      background: linear-gradient(to right, #fceabb, #f8b500);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .dashboard-header p {
      color: #d1d1d1;
      font-size: 1rem;
    }

    .card {
      border: none;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(12px);
      color: #fff;
      padding: 25px;
      text-align: center;
      box-shadow: 0 6px 20px rgba(0,0,0,0.3);
      transition: all 0.3s ease-in-out;
      height: 100%;
    }
    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 28px rgba(255, 193, 7, 0.4);
    }
    .card i {
      font-size: 40px;
      color: #ffc107;
      margin-bottom: 15px;
      transition: 0.3s;
    }
    .card:hover i {
      color: #ffdd57;
      transform: scale(1.1);
    }
    .card h5 {
      font-weight: 600;
      margin-bottom: 10px;
    }
    .card p {
      color: #cfcfcf;
      font-size: 0.9rem;
    }

    .logout-btn {
      position: absolute;
      top: 20px;
      right: 20px;
      background: #ff4757;
      color: #fff;
      padding: 8px 18px;
      border-radius: 30px;
      text-decoration: none;
      transition: background 0.3s;
    }
    .logout-btn:hover {
      background: #ff6b81;
      color: #fff;
    }
  </style>
</head>
<body>
<?php include __DIR__ . '/../shared/navbar.php'; ?>


<div class="container py-5">
  <div class="dashboard-header">
    <h3>✨ Welcome, <?=htmlspecialchars($_SESSION['user_name'])?> ✨</h3>
    <p>Your personalized astrology experience awaits 🌌</p>
  </div>

  <div class="row g-4">
    <!-- Horoscope -->
    <div class="col-md-4">
      <a href="horoscope.php" class="text-decoration-none">
        <div class="card">
          <i class="bi bi-star"></i>
          <h5>Daily Horoscope</h5>
          <p>Check your zodiac prediction for today</p>
        </div>
      </a>
    </div>

    <!-- Kundli -->
    <div class="col-md-4">
      <a href="kundli.php" class="text-decoration-none">
        <div class="card">
          <i class="bi bi-moon-stars"></i>
          <h5>Kundli / Birth Chart</h5>
          <p>Generate your personalized Kundli</p>
        </div>
      </a>
    </div>

    <!-- Matchmaking -->
    <div class="col-md-4">
      <a href="matchmaking.php" class="text-decoration-none">
        <div class="card">
          <i class="bi bi-heart"></i>
          <h5>Compatibility Match</h5>
          <p>Check partner compatibility</p>
        </div>
      </a>
    </div>
  </div>

  <div class="row g-4 mt-4">
    <!-- History -->
    <div class="col-md-6">
      <div class="card">
        <i class="bi bi-clock-history"></i>
        <h5>Consultation History</h5>
        <p>View your past consultations & predictions</p>
      </div>
    </div>

    <!-- Profile -->
    <div class="col-md-6">
      <div class="card">
        <i class="bi bi-person-circle"></i>
        <h5>My Profile</h5>
        <p>Manage your personal astrology info</p>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
