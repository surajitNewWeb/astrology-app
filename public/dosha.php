<?php
require_once __DIR__ . '/../backend/auth/auth_check.php';
require_once __DIR__ . '/../backend/astrology/dosha.php';

$data = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $birth = [
        'dob' => $_POST['dob'],
        'tob' => $_POST['tob'],
        'latitude' => $_POST['latitude'],
        'longitude' => $_POST['longitude'],
    ];
    $data = analyzeDosha($_SESSION['user_id'], $_POST['dosha_type'], $birth);
}
?>
<?php include_once __DIR__ . '/../includes/navbar.php'; ?>

<style>
body {
    background: #0a0e1a;
    color: #f8fafc;
    font-family: 'Segoe UI', sans-serif;
}

/* Only the Dosha page container */
.dosha-container {
    max-width: 500px;
    margin: 0 auto;
    padding-top: 50px;
    padding-bottom: 50px;
}

/* Card for form and results */
.form-card, .result-card {
    background: #111827;
    border-radius: 15px;
    padding: 25px 30px;
    margin-bottom: 25px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.5);
    transition: 0.3s ease;
}
.form-card:hover, .result-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(0,0,0,0.6);
}

/* Headings */
h2 {
    text-align: center;
    color: #fbbf24;
    font-weight: bold;
    margin-bottom: 25px;
}
.result-card h4 {
    font-weight: bold;
    margin-bottom: 12px;
    font-size: 1.4rem;
    background: linear-gradient(135deg,#4facfe,#f093fb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Inputs */
.form-control, .form-select {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.2);
    color: #fff;
    border-radius: 12px;
    padding: 10px 14px;
}
.form-control::placeholder {
    color: #94a3b8;
}
.form-control:focus, .form-select:focus {
    border-color: #818cf8;
    box-shadow: 0 0 8px #6366f1;
}

/* Button */
.btn-primary {
    background: linear-gradient(135deg,#4facfe,#00f2fe);
    border: none;
    font-weight: bold;
    padding: 12px;
    border-radius: 12px;
    transition: 0.3s;
}
.btn-primary:hover {
    background: linear-gradient(135deg,#f093fb,#f5576c);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.4);
}

/* Dosha result sections */
.dosha-status {
    font-size: 1.1rem;
    font-weight: bold;
    margin-bottom: 10px;
}
.dosha-description {
    line-height: 1.5;
    color: #e5e7eb;
}

/* Adjust result cards inside small container */
.result-card ul {
    padding-left: 20px;
}
</style>

<div class="dosha-container">
    <div class="form-card">
        <h2>🔮 Dosha Analysis</h2>

        <!-- Dosha Form -->
        <form method="POST" class="row g-3">
            <div class="col-md-12">
                <label class="form-label">Select Dosha</label>
                <select name="dosha_type" class="form-select" required>
                    <option value="mangal-dosha">Mangal Dosha</option>
                </select>
            </div>
            <div class="col-md-12">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control" required>
            </div>
            <div class="col-md-12">
                <label class="form-label">Time of Birth</label>
                <input type="time" name="tob" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Latitude</label>
                <input type="text" name="latitude" placeholder="e.g. 19.0760" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Longitude</label>
                <input type="text" name="longitude" placeholder="e.g. 72.8777" class="form-control" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100">Analyze</button>
            </div>
        </form>
    </div>

    <!-- Result Display -->
    <?php if ($data): ?>
        <?php if (isset($data['status']) && $data['status'] === 'ok'): ?>
            <div class="row">
                <!-- Dosha Status -->
                <div class="col-md-12">
                    <div class="result-card">
                        <h4>💠 Status</h4>
                        <p class="dosha-status">
                            <?= $data['data']['has_dosha'] ? '⚠ Mangal Dosha Present' : '✅ No Dosha' ?>
                        </p>
                    </div>
                </div>

                <!-- Dosha Description -->
                <div class="col-md-12">
                    <div class="result-card">
                        <h4>📖 Description</h4>
                        <p class="dosha-description"><?= htmlspecialchars($data['data']['description']); ?></p>
                    </div>
                </div>
            </div>

            <?php if (!empty($data['data']['remedies'])): ?>
                <!-- Dosha Remedies -->
                <div class="result-card mt-4">
                    <h4>🛠 Remedies / Advice</h4>
                    <ul>
                        <?php foreach ($data['data']['remedies'] as $remedy): ?>
                            <li><?= htmlspecialchars($remedy); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        <?php elseif (isset($data['error'])): ?>
            <div class="alert alert-danger mt-3">
                ⚠️ <?= htmlspecialchars($data['error']); ?>
            </div>
        <?php else: ?>
            <pre class="bg-light p-3 border rounded mt-3"><?= json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); ?></pre>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
