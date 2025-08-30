<?php 
require_once __DIR__ . '/../backend/auth/auth_check.php';
include_once __DIR__ . '/../includes/navbar.php'; 
?>

  <style>
    body {
      background: #0a0e1a;
      color: #f8fafc;
      font-family: 'Segoe UI', sans-serif;
    }

    h2 {
      text-align: center;
      color: #fbbf24;
      font-weight: bold;
      margin-bottom: 20px;
    }

    /* Form card */
    .form-card {
      background: #111827;
      border-radius: 15px;
      padding: 25px 30px;
      margin: 40px auto;
      max-width: 650px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.5);
    }

    .form-label {
      display: block;
      font-weight: 600;
      margin-bottom: 6px;
      color: #e5e7eb;
      font-size: 0.9rem;
    }

    .form-input,
    .form-select {
      width: 100%;
      padding: 8px 12px;
      border-radius: 10px;
      border: 1px solid #374151;
      background: #1f2937;
      color: #f8fafc;
      font-size: 0.95rem;
      outline: none;
      transition: 0.2s;
    }

    .form-input::placeholder {
      color: #9ca3af;
    }

    .form-input:focus,
    .form-select:focus {
      border-color: #818cf8;
      box-shadow: 0 0 6px #6366f1;
    }

    /* Two-column layout */
    .form-row {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
    }
    .form-col {
      flex: 1;
      min-width: 240px;
    }

    /* Button */
    .btn-submit {
      margin-top: 15px;
      background: linear-gradient(135deg,#4facfe,#00f2fe);
      border: none;
      color: #111;
      padding: 10px 18px;
      border-radius: 12px;
      font-weight: bold;
      font-size: 1rem;
      cursor: pointer;
      width: 100%;
      transition: 0.3s;
    }
    .btn-submit:hover {
      background: linear-gradient(135deg,#f093fb,#f5576c);
      color: #fff;
      transform: translateY(-2px);
    }

    /* Result styling */
    .alert {
      border-radius: 10px;
      margin-top: 15px;
      padding: 12px 18px;
    }
    .alert-success { background: #065f46; color: #d1fae5; }
    .alert-danger { background: #7f1d1d; color: #fee2e2; }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 15px;
    }
    table th, table td {
      border: 1px solid #374151;
      padding: 8px;
      text-align: center;
    }
    table thead {
      background: #1f2937;
      color: #fbbf24;
    }
    table tbody tr:hover {
      background: rgba(255,255,255,0.05);
    }
  </style>
</head>
<body>

<section>
  <div class="form-card">
    <h2><i class="bi bi-globe2"></i> Birth Chart</h2>
    
    <!-- ===== FORM ===== -->
    <form action="../backend/astrology/birthchart.php" method="POST">
      <div class="form-row">
        <div class="form-col">
          <label class="form-label">Date of Birth</label>
          <input type="date" name="dob" class="form-input" required>
        </div>
        <div class="form-col">
          <label class="form-label">Time of Birth</label>
          <input type="time" name="tob" class="form-input" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-col">
          <label class="form-label">Latitude</label>
          <input type="text" name="latitude" placeholder="22.5726" class="form-input" required>
        </div>
        <div class="form-col">
          <label class="form-label">Longitude</label>
          <input type="text" name="longitude" placeholder="88.3639" class="form-input" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-col">
          <label class="form-label">Chart Type</label>
          <select name="chart_type" class="form-select" required>
            <option value="rasi">Rasi</option>
            <option value="navamsa">Navamsa</option>
            <option value="lagna">Lagna</option>
            <option value="moon">Moon</option>
            <option value="sun">Sun</option>
          </select>
        </div>
        <div class="form-col">
          <label class="form-label">Chart Style</label>
          <select name="chart_style" class="form-select" required>
            <option value="north-indian">North Indian</option>
            <option value="south-indian">South Indian</option>
            <option value="east-indian">East Indian</option>
          </select>
        </div>
      </div>

      <button type="submit" class="btn-submit">🌌 Generate Birth Chart</button>
    </form>

    <!-- ===== RESULT SECTION ===== -->
    <?php if (isset($_SESSION['birth_data'])): 
        $data = $_SESSION['birth_data'];
        unset($_SESSION['birth_data']); 
    ?>
        <?php if (isset($data['json']['status']) && $data['json']['status'] === 'ok'): ?>
          <div class="alert alert-success">✅ Birth Chart successfully generated!</div>

          <?php if (!empty($data['chart'])): ?>
            <h4>🪐 Chart</h4>
            <div class="bg-white p-3 rounded text-dark text-center">
              <?php echo $data['chart']; ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($data['json']['data']['planets'])): ?>
            <h4>🌍 Planetary Positions</h4>
            <table>
              <thead>
                <tr>
                  <th>Planet</th>
                  <th>Sign</th>
                  <th>Degree</th>
                  <th>House</th>
                  <th>Nakshatra</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['json']['data']['planets'] as $planet): ?>
                  <tr>
                    <td><?php echo $planet['name']; ?></td>
                    <td><?php echo $planet['sign']['name']; ?></td>
                    <td><?php echo $planet['degree']; ?></td>
                    <td><?php echo $planet['house']; ?></td>
                    <td><?php echo $planet['nakshatra']['name'] ?? '-'; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>

          <?php if (!empty($data['json']['data']['houses'])): ?>
            <h4>🏠 House Cusps</h4>
            <table>
              <thead>
                <tr>
                  <th>House</th>
                  <th>Sign</th>
                  <th>Degree</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['json']['data']['houses'] as $house): ?>
                  <tr>
                    <td><?php echo $house['house']; ?></td>
                    <td><?php echo $house['sign']['name']; ?></td>
                    <td><?php echo $house['degree']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>

        <?php else: ?>
          <div class="alert alert-danger">❌ Failed to generate Birth Chart</div>
          <?php if (!empty($data['json']['errors'])): ?>
            <ul>
              <?php foreach ($data['json']['errors'] as $err): ?>
                <li><strong><?php echo $err['title']; ?>:</strong> <?php echo $err['detail']; ?></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
  </div>
</section>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
