<!doctype html>
<html>
<head>
  <meta charset="utf-8"><title>Register</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../shared/navbar.php'; ?>
<div class="container py-5">
  <div class="col-md-6 mx-auto">
    <div class="card p-4">
      <h5>Create account</h5>
      
      <!-- Form sends data to backend/user_register.php -->
      <form id="regForm" method="POST" action="../backend/user_register.php">
        <input name="name" class="form-control mb-2" placeholder="Full name" required>
        <input name="email" type="email" class="form-control mb-2" placeholder="Email" required>
        <input name="password" type="password" class="form-control mb-2" placeholder="Password" required>
        <label>Date of Birth</label>
        <input name="dob" type="date" class="form-control mb-2" required>
        <label>Time of Birth</label>
        <input name="tob" type="time" class="form-control mb-2">
        <input name="place" class="form-control mb-2" placeholder="Place of birth">
        <button class="btn btn-primary w-100">Register</button>
      </form>

      <!-- For showing messages (optional) -->
      <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-info mt-2"><?= htmlspecialchars($_GET['msg']) ?></div>
      <?php endif; ?>

    </div>
  </div>
</div>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
