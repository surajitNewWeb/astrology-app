<!doctype html>
<html>
<head>
  <meta charset="utf-8"><title>Login</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/../shared/navbar.php'; ?>
<div class="container py-5">
  <div class="col-md-6 mx-auto">
    <div class="card p-4">
      <h5>Login</h5>
      <form method="post" action="login_process.php">
        <input name="email" type="email" required class="form-control mb-2" placeholder="Email">
        <input name="password" type="password" required class="form-control mb-2" placeholder="Password">
        <button class="btn btn-primary w-100">Login</button>
      </form>
      <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger mt-2"><?=htmlspecialchars($_GET['error'])?></div>
      <?php endif; ?>
    </div>
  </div>
</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
