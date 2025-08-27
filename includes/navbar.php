<?php
// shared/navbar.php
if (session_status() === PHP_SESSION_NONE) session_start();
$logged = isset($_SESSION['user_id']);
?>
<link rel="stylesheet" href="../assets/css/style.css">
<nav class="navbar navbar-expand-lg custom-navbar shadow-sm sticky-top">
  <div class="container">

    <!-- Left: Logo -->
    <a class="navbar-brand fw-bold" href="/pages/index.php">
      🌌 AstroGuide
    </a>

    <!-- Toggler (for mobile) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#mainNavbar" aria-controls="mainNavbar" 
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="mainNavbar">
      
      <!-- Center: Navigation links -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
         <li class="nav-item">
          <a class="nav-link" href="../pages/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/horoscope.php">Horoscope</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/matchmaking.php">Matchmaking</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/kundli.php">Kundli</a>
        </li>
      </ul>

      <!-- Right: Auth buttons -->
      <div class="d-flex align-items-center auth-buttons">
        <?php if ($logged): ?>
          <span class="welcome-text me-3">
            Hello, <?=htmlspecialchars($_SESSION['user_name'])?>
          </span>
          <a href="../backend/user_logout.php" class="btn btn-sm btn-logout">Logout</a>
        <?php else: ?>
          <a href="../pages/login.php" class="btn btn-sm btn-login me-2">Login</a>
          <a href="../pages/register.php" class="btn btn-sm btn-signup">Sign Up</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<style>
  /* Custom Navbar Styling */
.custom-navbar {
  background: linear-gradient(135deg, #3b2d6e, #1b1430); /* cosmic gradient */
  padding: 12px 0;
}

.custom-navbar .navbar-brand {
  font-size: 1.25rem;
  font-weight: 700;
  color: #ffd166 !important;
  letter-spacing: 1px;
  transition: color 0.3s ease;
}

.custom-navbar .navbar-brand:hover {
  color: #ff6ec7 !important;
}

/* Nav Links */
.custom-navbar .nav-link {
  color: #f1f1f1 !important;
  font-weight: 500;
  margin: 0 12px;
  position: relative;
  transition: color 0.3s ease;
}

.custom-navbar .nav-link:hover {
  color: #ffd166 !important;
}

/* Active link highlight */
.custom-navbar .nav-link.active {
  color: #ff6ec7 !important;
  font-weight: 600;
}

.custom-navbar .nav-link::after {
  content: '';
  position: absolute;
  width: 0;
  height: 2px;
  left: 50%;
  bottom: -6px;
  background: #ffd166;
  transition: all 0.3s ease;
}

.custom-navbar .nav-link:hover::after {
  width: 100%;
  left: 0;
}

/* Right Side: Auth Buttons */
.auth-buttons .welcome-text {
  color: #f8f9fa;
  font-weight: 500;
}

.btn-login {
  border: 1px solid #ffd166;
  color: #ffd166;
  background: transparent;
  transition: 0.3s;
}

.btn-login:hover {
  background: #ffd166;
  color: #1b1430;
}

.btn-signup {
  background: #ff6ec7;
  border: none;
  color: #1b1430;
  font-weight: 600;
  transition: 0.3s;
}

.btn-signup:hover {
  background: #ffd166;
  color: #1b1430;
}

.btn-logout {
  border: 1px solid #ff6ec7;
  color: #ff6ec7;
  background: transparent;
  transition: 0.3s;
}

.btn-logout:hover {
  background: #ff6ec7;
  color: #1b1430;
}

/* Mobile adjustments */
@media (max-width: 992px) {
  .custom-navbar .navbar-nav {
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
