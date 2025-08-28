<?php include_once __DIR__ . '/../includes/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Matchmaking - AstroGuide</title>
  <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../public/assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-dark text-light">

<section class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
      <div class="card shadow-lg border-0 rounded-4"
           style="background:linear-gradient(135deg,#1b1430,#3b2d6e);">
        <div class="card-body p-5 text-light">
          <h2 class="text-center mb-4">
            <i class="bi bi-heart-fill text-danger"></i> Matchmaking
          </h2>

          <!-- Matchmaking Form -->
          <form method="POST" action="../backend/matchmaking.php" class="row g-4">

            <!-- Boy -->
            <div class="col-12">
              <h4 class="border-bottom pb-2 mb-3">👦 Boy Details</h4>
            </div>
            <div class="col-md-6">
              <label class="form-label">Name</label>
              <input type="text" name="boy_name" class="form-control" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">Date of Birth</label>
              <input type="date" name="boy_dob" class="form-control" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">Time of Birth</label>
              <input type="time" name="boy_tob" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">City</label>
              <select name="boy_city" class="form-select" required>
                  <option value="28.6139,77.2090">New Delhi</option>
                  <option value="19.0760,72.8777">Mumbai</option>
                  <option value="22.5726,88.3639">Kolkata</option>
                  <option value="13.0827,80.2707">Chennai</option>
                  <option value="12.9716,77.5946">Bangalore</option>
              </select>
            </div>

            <!-- Girl -->
            <div class="col-12 mt-4">
              <h4 class="border-bottom pb-2 mb-3">👧 Girl Details</h4>
            </div>
            <div class="col-md-6">
              <label class="form-label">Name</label>
              <input type="text" name="girl_name" class="form-control" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">Date of Birth</label>
              <input type="date" name="girl_dob" class="form-control" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">Time of Birth</label>
              <input type="time" name="girl_tob" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">City</label>
              <select name="girl_city" class="form-select" required>
                  <option value="28.6139,77.2090">New Delhi</option>
                  <option value="19.0760,72.8777">Mumbai</option>
                  <option value="22.5726,88.3639">Kolkata</option>
                  <option value="13.0827,80.2707">Chennai</option>
                  <option value="12.9716,77.5946">Bangalore</option>
              </select>
            </div>

            <!-- Submit -->
            <div class="col-12 text-center mt-4">
              <button type="submit" class="btn btn-lg btn-primary px-4">
                <i class="bi bi-stars"></i> Check Match
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
