<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - AstroGuide</title>
  <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../public/assets/css/style.css">

  <style>
    body {
      background: linear-gradient(135deg, #4a148c, #283593);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .card {
      border: none;
      border-radius: 15px;
      overflow: hidden;
    }
    .card-header {
      background: linear-gradient(90deg, #6a1b9a, #283593);
      padding: 20px;
    }
    .card-header h4 {
      margin: 0;
      font-weight: bold;
    }
    .form-control, .form-select {
      border-radius: 10px;
      padding: 12px;
    }
    .btn-success {
      background: linear-gradient(90deg, #43a047, #2e7d32);
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-size: 16px;
      font-weight: 600;
      transition: 0.3s ease-in-out;
    }
    .btn-success:hover {
      background: linear-gradient(90deg, #2e7d32, #1b5e20);
      transform: translateY(-2px);
      box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
    }
    .alert {
      border-radius: 10px;
    }
  </style>
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <div class="card shadow-lg">
        <div class="card-header text-white text-center">
          <h4>🌟 Create an Account</h4>
        </div>
        <div class="card-body p-4">

          <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger text-center">
              <?= htmlspecialchars($_GET['error']) ?>
            </div>
          <?php endif; ?>

          <form action="../backend/user_register.php" method="POST">
            <div class="mb-3">
              <label for="full_name" class="form-label">Full Name</label>
              <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter your full name" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="example@email.com" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Enter a strong password" required>
            </div>

            <div class="mb-3">
              <label for="gender" class="form-label">Gender</label>
              <select name="gender" id="gender" class="form-select">
                <option disabled selected>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="date_of_birth" class="form-label">Date of Birth</label>
              <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="time_of_birth" class="form-label">Time of Birth</label>
              <input type="time" name="time_of_birth" id="time_of_birth" class="form-control">
            </div>

            <div class="mb-3">
              <label for="place_of_birth" class="form-label">Place of Birth</label>
              <input type="text" name="place_of_birth" id="place_of_birth" class="form-control" placeholder="Enter your birth place">
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-success">Register</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>

</body>
</html>
