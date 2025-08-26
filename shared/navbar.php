<?php
// shared/navbar.php
if (session_status() === PHP_SESSION_NONE) session_start();
$logged = isset($_SESSION['user_id']);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/pages/index.php">AstroGuide</a>
    <div class="ms-auto">
      <?php if ($logged): ?>
        <span class="text-light me-3">Hello, <?=htmlspecialchars($_SESSION['user_name'])?></span>
        <a href="../backend/user_logout.php" class="btn btn-sm btn-outline-light">Logout</a>
      <?php else: ?>
        <a href="../pages/login.php" class="btn btn-sm btn-outline-light me-2">Login</a>
        <a href="../pages/register.php" class="btn btn-sm btn-warning">Sign Up</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
