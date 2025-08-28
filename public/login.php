<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - AstroGuide</title>
  <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../public/assets/css/style.css">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">

      <div class="card shadow-lg">
        <div class="card-header bg-success text-white text-center">
          <h4>User Login</h4>
        </div>
        <div class="card-body">

          <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
          <?php endif; ?>

          <?php if (isset($_GET['registered'])): ?>
            <div class="alert alert-success">✅ Registration successful! Please log in.</div>
          <?php endif; ?>

          <form action="../backend/user_login.php" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Login</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>

</body>
</html>
