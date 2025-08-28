<?php include_once __DIR__ . '/../includes/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Daily Horoscope - AstroGuide</title>
  <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../public/assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-dark text-light">

<section class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-lg border-0 rounded-4" style="background:linear-gradient(135deg,#1b1430,#3b2d6e);">
        <div class="card-body p-5 text-light">

          <h2 class="text-center mb-4"><i class="bi bi-stars"></i> Daily Horoscope</h2>
          <p class="text-center text-muted mb-4">
            Select your zodiac sign and date to check your horoscope.
          </p>

          <!-- Horoscope Form -->
          <form id="horoscopeForm">
            <div class="mb-3">
              <label for="sign" class="form-label">Choose Zodiac Sign:</label>
              <select class="form-select" id="sign" name="sign" required>
                <option value="">-- Select Sign --</option>
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

            <div class="mb-3">
              <label for="date" class="form-label">Select Date:</label>
              <input type="date" class="form-control" id="date" name="date" value="<?= date('Y-m-d') ?>" required>
            </div>

            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" value="1" id="advanced" name="advanced">
              <label class="form-check-label" for="advanced">Get Advanced Horoscope</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3" id="submitBtn">
              <i class="bi bi-search"></i> Get Horoscope
            </button>
          </form>

          <!-- Result Display -->
          <div id="horoscopeResult" class="mt-4"></div>

        </div>
      </div>
    </div>
  </div>
</section>

<script>
$(document).ready(function() {
    $('#horoscopeForm').on('submit', function(e) {
        e.preventDefault();

        $('#submitBtn').prop('disabled', true).text('Loading...');

        $.ajax({
            url: '../backend/horoscope.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                $('#submitBtn').prop('disabled', false).html('<i class="bi bi-search"></i> Get Horoscope');

                let html = '';
                if(response.data) {
                    let prediction = response.data.prediction || response.data.horoscope || 'No horoscope available';
                    html += `<h4 class="text-center text-capitalize">${$('#sign').val()} - ${$('#date').val()}</h4>`;
                    html += `<p class="text-center fs-5">${prediction}</p>`;
                    html += `<details class="mt-3"><summary class="text-info">🔍 Full API Response</summary>`;
                    html += `<pre class="bg-dark text-warning p-3 rounded-3 small">${JSON.stringify(response, null, 2)}</pre></details>`;
                } else if(response.error) {
                    html = `<div class="alert alert-danger text-center">❌ Failed to fetch horoscope.<br><strong>Error:</strong> ${response.error_description || response.error}</div>`;
                } else {
                    html = `<div class="alert alert-warning text-center">⚠️ No data available.</div>`;
                }

                $('#horoscopeResult').html(html);
            },
            error: function(xhr, status, error) {
                $('#submitBtn').prop('disabled', false).html('<i class="bi bi-search"></i> Get Horoscope');
                $('#horoscopeResult').html(`<div class="alert alert-danger text-center">❌ An error occurred: ${error}</div>`);
            }
        });
    });
});
</script>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
