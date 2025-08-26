<?php include("../backend/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Horoscope</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <?php include("../shared/navbar.php"); ?>

  <div class="container py-5">
    <div class="card shadow-lg p-4">
      <h2 class="mb-4 text-center">🔮 Daily Horoscope</h2>
      <form id="horoscopeForm">
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Select Zodiac Sign</label>
            <select class="form-select" name="sign" required>
              <option value="aries">♈ Aries</option>
              <option value="taurus">♉ Taurus</option>
              <option value="gemini">♊ Gemini</option>
              <option value="cancer">♋ Cancer</option>
              <option value="leo">♌ Leo</option>
              <option value="virgo">♍ Virgo</option>
              <option value="libra">♎ Libra</option>
              <option value="scorpio">♏ Scorpio</option>
              <option value="sagittarius">♐ Sagittarius</option>
              <option value="capricorn">♑ Capricorn</option>
              <option value="aquarius">♒ Aquarius</option>
              <option value="pisces">♓ Pisces</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Day</label>
            <select class="form-select" name="day">
              <option value="today">Today</option>
              <option value="yesterday">Yesterday</option>
              <option value="tomorrow">Tomorrow</option>
            </select>
          </div>
        </div>
        <button class="btn btn-primary w-100">Get Horoscope</button>
      </form>
      <div id="horoscopeResult" class="mt-4"></div>
    </div>
  </div>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/script.js"></script>
  <script>
    document.getElementById("horoscopeForm").addEventListener("submit", function(e){
      e.preventDefault();
      let formData = new FormData(this);

      fetch("../backend/horoscope.php", {
        method: "POST",
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        document.getElementById("horoscopeResult").innerHTML = `
          <div class="alert alert-info">
            <h5>${data.current_date}</h5>
            <p><strong>${formData.get("sign")}</strong>: ${data.description}</p>
            <p>💑 Compatibility: ${data.compatibility}</p>
            <p>😊 Mood: ${data.mood}</p>
            <p>🎨 Lucky Color: ${data.color}</p>
            <p>🍀 Lucky Number: ${data.lucky_number}</p>
          </div>
        `;
      })
    });
  </script>
</body>
</html>
