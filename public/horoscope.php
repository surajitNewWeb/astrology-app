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

    /* Form heading inside form */
    .form-card h2 {
        text-align: center;
        color: #fbbf24;
        font-weight: bold;
        margin-bottom: 25px;
    }

    /* Form card */
    .form-card {
        background: #111827;
        border-radius: 15px;
        padding: 30px;
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

    .form-select:focus {
        border-color: #818cf8;
        box-shadow: 0 0 6px #6366f1;
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

    /* Result */
    #result .result-card {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 14px;
        padding: 20px;
        margin-top: 20px;
        text-align: center;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.4);
    }

    #result .result-title {
        font-size: 1.3rem;
        font-weight: bold;
        color: #fbbf24;
        margin-bottom: 6px;
    }

    #result .result-subtitle {
        font-size: 0.95rem;
        color: #9ca3af;
        margin-bottom: 12px;
    }

    #result .result-text {
        font-size: 1rem;
        line-height: 1.5;
        color: #f8fafc;
    }

    /* Alerts */
    .alert {
        padding: 12px;
        margin-top: 15px;
        border-radius: 12px;
        text-align: center;
        font-weight: 500;
    }
    .alert-danger {
        background: rgba(255, 77, 77, 0.15);
        border: 1px solid rgba(255, 77, 77, 0.4);
        color: #ff4d4d;
    }
    .alert-warning {
        background: rgba(255, 193, 7, 0.15);
        border: 1px solid rgba(255, 193, 7, 0.4);
        color: #ffc107;
    }
</style>

<section>
    <div class="form-card">
        <!-- Heading inside form -->
        <h2>✨ Find Your Horoscope ✨</h2>

        <!-- 🔮 Horoscope Form -->
        <form method="POST" action="../backend/astrology/horoscope.php" id="horoscopeForm" class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="sign">🌠 Zodiac Sign:</label>
                <select name="sign" id="sign" class="form-select" required>
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

            <div class="col-md-6">
                <label class="form-label" for="period">🗓️ Period:</label>
                <select name="period" id="period" class="form-select">
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                </select>
            </div>

            <div class="col-12">
                <button type="submit" class="btn-submit">🔮 Get Horoscope</button>
            </div>
        </form>

        <!-- Horoscope result -->
        <div id="result"></div>
    </div>
</section>

<script>
document.getElementById('horoscopeForm').addEventListener('submit', async function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const response = await fetch(this.action, { method: 'POST', body: formData });
    const data = await response.json();
    const resultDiv = document.getElementById('result');
    resultDiv.innerHTML = '';

    if (data.status === "ok" && data.data.daily_prediction) {
        const h = data.data.daily_prediction;
        resultDiv.innerHTML = `
            <div class="result-card">
                <div class="result-title">♒ Horoscope for ${h.sign_name}</div>
                <div class="result-subtitle">📅 ${h.date}</div>
                <div class="result-text">${h.prediction}</div>
            </div>`;
    } else if (data.error) {
        resultDiv.innerHTML = `<div class="alert alert-danger">${data.error}</div>`;
    } else {
        resultDiv.innerHTML = `<div class="alert alert-warning">No horoscope available.</div>`;
    }
});
</script>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
