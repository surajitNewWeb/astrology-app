<?php include_once __DIR__ . '/../includes/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Birth Chart - AstroGuide</title>
 <link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="public/assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-dark text-light">

<section class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-lg border-0 rounded-4"
           style="background:linear-gradient(135deg,#0d0d2b,#302b63);">
        <div class="card-body p-5 text-light">
          <h2 class="text-center mb-4"><i class="bi bi-globe2"></i> Birth Chart</h2>
          <form action="../backend/birthchart.php" method="POST">

            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="date_of_birth" class="form-control rounded-pill" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Time of Birth</label>
                <input type="time" name="time_of_birth" class="form-control rounded-pill" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Place of Birth</label>
                <input type="text" name="place_of_birth" class="form-control rounded-pill" required>
              </div>
            </div>

            <button type="submit" class="btn btn-info w-100 fw-bold rounded-pill">
              🌌 Generate Birth Chart
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
