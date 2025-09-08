<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$logged = isset($_SESSION['user_id']);
$current_page = basename($_SERVER['PHP_SELF']); 
$base = "/astrology-app"; 
$userName = $_SESSION['user_name'] ?? "User";

// Pages under Astrology dropdown
$astrologyPages = ['horoscope.php','birthchart.php','kundli.php','matchmaking.php','numerology.php','panchang.php','dosha.php'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Astrology</title>
  <link rel="stylesheet" href="<?=$base?>/public/assets/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    /* Astro Navbar */
    .astro-navbar {
      background: linear-gradient(90deg, #4415a2ff, #1a1a1aff);
      padding: 14px 0;
      font-size: 16px;
      border-bottom: 2px solid #fbbf24;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
    }

    .astro-navbar .navbar-brand {
      font-size: 1.5rem;
      color: #fbbf24 !important;
      letter-spacing: 1px;
      transition: all 0.3s ease;
    }

    .astro-navbar .navbar-brand:hover {
      color: #fff !important;
    }

    .astro-navbar .nav-link {
      color: #e5e5e5 !important;
      font-weight: 500;
      margin: 0 14px;
      position: relative;
      transition: all 0.3s ease;
    }

    .astro-navbar .nav-link::after {
      content: "";
      display: block;
      width: 0;
      height: 3px;
      background: #fbbf24;
      border-radius: 3px;
      transition: width 0.3s;
      margin-top: 4px;
    }

    .astro-navbar .nav-link:hover::after,
    .astro-navbar .nav-link.active::after {
      width: 100%;
    }

    .astro-navbar .nav-link.active {
      color: #fbbf24 !important;
      font-weight: 600;
    }

    /* Dropdown fix */
    .astro-dropdown {
      background: rgba(26, 26, 26, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      margin-top: 10px;
      z-index: 1050;
    }

    .astro-dropdown .dropdown-item {
      color: #f1f1f1;
      padding: 10px 15px;
      transition: all 0.3s ease;
      border-radius: 8px;
    }

    .astro-dropdown .dropdown-item.active,
    .astro-dropdown .dropdown-item:hover {
      background: #fbbf24;
      color: #1a1a1a !important;
      transform: translateX(4px);
    }

    /* Keep Astrology parent highlighted if child active */
    .nav-item.dropdown.active>.nav-link {
      color: #fbbf24 !important;
      font-weight: 600;
    }

    .nav-item.dropdown.active>.nav-link::after {
      width: 100%;
    }

    /* Auth Buttons */
    .text-gold {
      color: #fbbf24;
    }

    .btn-login {
      border: 2px solid #fbbf24;
      color: #fbbf24;
      border-radius: 25px;
      padding: 6px 18px;
      transition: all 0.3s ease;
    }

    .btn-login:hover {
      background: #fbbf24;
      color: #1a1a1a;
    }

    .btn-signup {
      background: #fbbf24;
      border-radius: 25px;
      color: #1a1a1a;
      font-weight: 600;
      padding: 6px 18px;
      transition: all 0.3s ease;
    }

    .btn-signup:hover {
      background: #fff;
      color: #000;
    }

    .btn-logout {
      border: 2px solid #fbbf24;
      color: #fbbf24;
      border-radius: 25px;
      padding: 6px 18px;
      transition: all 0.3s ease;
    }

    .btn-logout:hover {
      background: #fbbf24;
      color: #1a1a1a;
    }

    /* Toggler Fix */
    .navbar-toggler {
      border: 2px solid #fbbf24;
      border-radius: 6px;
      padding: 4px 8px;
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(251,191,36, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }

    .logo {
      height: 60px;
      /* Adjust height */
      width: auto;
      /* Keep aspect ratio */
      object-fit: contain;
      /* Ensure it doesn't stretch */
      transition: all 0.3s ease;
    }

    .logo:hover {
      transform: scale(1.05);
      /* Slight zoom effect on hover */
    }

    /* Responsive */
    @media (max-width: 992px) {
      .astro-navbar .navbar-nav {
        text-align: center;
        padding: 10px 0;
      }

      .auth-buttons {
        margin-top: 10px;
        justify-content: center;
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg astro-navbar sticky-top">
    <div class="container">

      <!-- Logo -->
      <a class="navbar-brand fw-bold d-flex align-items-center" href="<?=$base?>/index.php">
        <img class="logo" src="<?=$base?>/public/assets/images/astrology_logo1.png" alt="logo">
        Astro-Guide
      </a>

      <!-- Toggler -->
      <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
        aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu -->
      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link <?=($current_page=='index.php'?'active':'')?>" href="<?=$base?>/index.php">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?=($current_page=='about.php'?'active':'')?>"
              href="<?=$base?>/public/about.php">About</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?=($current_page=='service.php'?'active':'')?>"
              href="<?=$base?>/public/service.php">Services</a>
          </li>

          <!-- Dropdown -->
          <li class="nav-item dropdown <?=in_array($current_page, $astrologyPages)?'active':''?>">
            <a class="nav-link dropdown-toggle <?=in_array($current_page, $astrologyPages)?'active':''?>" href="#"
              id="astrologyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Astrology
            </a>
            <ul class="dropdown-menu astro-dropdown" aria-labelledby="astrologyDropdown">
              <li><a class="dropdown-item <?=($current_page=='horoscope.php'?'active':'')?>"
                  href="<?=$base?>/public/horoscope.php"><i class="bi bi-stars"></i> Horoscope</a></li>
              <li><a class="dropdown-item <?=($current_page=='birthchart.php'?'active':'')?>"
                  href="<?=$base?>/public/birthchart.php"><i class="bi bi-diagram-3"></i> Birth Chart</a></li>
              <li><a class="dropdown-item <?=($current_page=='kundli.php'?'active':'')?>"
                  href="<?=$base?>/public/kundli.php"><i class="bi bi-moon"></i> Kundli</a></li>
              <li><a class="dropdown-item <?=($current_page=='matchmaking.php'?'active':'')?>"
                  href="<?=$base?>/public/matchmaking.php"><i class="bi bi-heart-fill"></i> Matchmaking</a></li>
              <li><a class="dropdown-item <?=($current_page=='panchang.php'?'active':'')?>"
                  href="<?=$base?>/public/panchang.php"><i class="bi bi-calendar-event"></i> Panchang</a></li>
              <li><a class="dropdown-item <?=($current_page=='dosha.php'?'active':'')?>"
                  href="<?=$base?>/public/dosha.php"><i class="bi bi-exclamation-triangle"></i> Dosha</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link <?=($current_page=='contact.php'?'active':'')?>"
              href="<?=$base?>/public/contact.php">Contact Us</a>
          </li>

          <!-- Dashboard (only if logged in) -->
          <?php if ($logged): ?>
          <li class="nav-item">
            <a class="nav-link <?=($current_page=='dashboard.php'?'active':'')?>"
              href="<?=$base?>/public/dashboard.php">
              Dashboard
            </a>
          </li>
          <?php endif; ?>
        </ul>

        <!-- Auth Buttons -->
        <div class="d-flex align-items-center auth-buttons">
          <?php if ($logged): ?>
          <span class="welcome-text me-3 text-gold fw-semibold">
            Hi,
            <?= htmlspecialchars($userName) ?>
          </span>
          <a href="<?=$base?>/backend/auth/logout.php" class="btn btn-sm btn-logout">Logout</a>
          <?php else: ?>
          <a href="<?=$base?>/public/login.php" class="btn btn-sm btn-login me-2">Login</a>
          <a href="<?=$base?>/public/register.php" class="btn btn-sm btn-signup">Sign Up</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>