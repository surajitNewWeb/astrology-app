<?php include("../backend/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kundli Generator</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <?php include("../shared/navbar.php"); ?>

  <div class="container py-5">
    <div class="card shadow-lg p-4">
      <h2 class="mb-4 text-center">📜 Generate Kundli</h2>
      <form id="kundliForm">
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Date of Birth</label>
            <input type="date" class="form-control" name="dob" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Time of Birth</label>
            <input type="time" class="form-control" name="tob" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Latitude</label>
            <input type="text" class="form-control" name="lat" placeholder="e.g., 28.7041" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Longitude</label>
            <input type="text" class="form-control" name="lon" placeholder="e.g., 77.1025" required>
          </div>
        </div>
        <button class="btn btn-success w-100">Generate Kundli</button>
      </form>
      <div id="kundliResult" class="mt-4"></div>
    </div>
  </div>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById("kundliForm").addEventListener("submit", function(e){
      e.preventDefault();
      let formData = new FormData(this);

      fetch("../backend/kundli.php", {
        method: "POST",
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        document.getElementById("kundliResult").innerHTML = `
          <div class="alert alert-info">
            <h5>Kundli for ${formData.get("name")}</h5>
            <pre>${JSON.stringify(data, null, 2)}</pre>
          </div>
        `;
      })
    });
  </script>
</body>
</html>
