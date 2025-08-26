<?php include("../backend/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Matchmaking</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
   <?php include("../shared/navbar.php"); ?>

  <div class="container py-5">
    <div class="card shadow-lg p-4">
      <h2 class="mb-4 text-center">💞 Matchmaking (Ashtakoot)</h2>
      <form id="matchForm">
        <h5>👦 Boy's Details</h5>
        <div class="row mb-3">
          <div class="col-md-6"><input class="form-control mb-2" name="boy_name" placeholder="Name" required></div>
          <div class="col-md-6"><input class="form-control mb-2" type="date" name="boy_dob" required></div>
          <div class="col-md-6"><input class="form-control mb-2" type="time" name="boy_tob" required></div>
          <div class="col-md-6"><input class="form-control mb-2" name="boy_lat" placeholder="Latitude" required></div>
          <div class="col-md-6"><input class="form-control mb-2" name="boy_lon" placeholder="Longitude" required></div>
        </div>

        <h5>👧 Girl's Details</h5>
        <div class="row mb-3">
          <div class="col-md-6"><input class="form-control mb-2" name="girl_name" placeholder="Name" required></div>
          <div class="col-md-6"><input class="form-control mb-2" type="date" name="girl_dob" required></div>
          <div class="col-md-6"><input class="form-control mb-2" type="time" name="girl_tob" required></div>
          <div class="col-md-6"><input class="form-control mb-2" name="girl_lat" placeholder="Latitude" required></div>
          <div class="col-md-6"><input class="form-control mb-2" name="girl_lon" placeholder="Longitude" required></div>
        </div>

        <button class="btn btn-danger w-100">Check Compatibility</button>
      </form>
      <div id="matchResult" class="mt-4"></div>
    </div>
  </div>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById("matchForm").addEventListener("submit", function(e){
      e.preventDefault();
      let formData = new FormData(this);

      fetch("../backend/matchmaking.php", {
        method: "POST",
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        document.getElementById("matchResult").innerHTML = `
          <div class="alert alert-warning">
            <h5>Matchmaking Result</h5>
            <pre>${JSON.stringify(data, null, 2)}</pre>
          </div>
        `;
      })
    });
  </script>
</body>
</html>
