<?php 
require_once __DIR__ . '/../includes/navbar.php'; 
?>

<style>
/* Base */
body {
    margin: 0;
    font-family: 'Segoe UI', Roboto, Arial, sans-serif;
    background: #090f23 url("https://www.transparenttextures.com/patterns/stardust.png");
    color: #e5e7eb;
    animation: moveStars 60s linear infinite;
    overflow-x: hidden;
}
@keyframes moveStars {
    from { background-position: 0 0; }
    to { background-position: 2000px 1000px; }
}
section { margin: 60px 0; padding: 60px 20px; }

/* Hero */
.service-hero {
    background: linear-gradient(135deg,#4415a2,#1a1a1a);
    color: #f8fafc;
    padding: 120px 20px;
    text-align: center;
    border-radius: 18px;
    box-shadow: 0 10px 30px rgba(0,0,0,.6);
}
.service-hero h1 { font-size: 2.8rem; font-weight: 700; }
.service-hero h1 span { color: #fbbf24; }
.service-hero p { font-size: 1.2rem; margin-top: 15px; }

/* Cards */
.service-card {
    background: linear-gradient(145deg, #1e293b, #334155);
    border-radius: 16px;
    padding: 25px 20px;
    text-align: center;
    transition: .3s;
}
.service-card:hover {
    transform: translateY(-6px);
    border: 1px solid #fbbf24;
    box-shadow: 0 12px 24px rgba(251,191,36,0.3);
}
.service-card h5 { color: #fbbf24; margin: 10px 0; }
.service-icon { font-size: 40px; margin-bottom: 10px; }

/* Features + Guarantee Cards */
.feature-highlight {
    background: rgba(30,41,59,0.8);
    border-radius: 14px;
    padding: 25px;
    text-align: center;
    transition: .3s;
}
.feature-highlight:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(251,191,36,0.2);
}
.feature-highlight h5 { color: #fbbf24; margin: 15px 0; }

/* Stats */
.stats-section {
    background: rgba(30,41,59,0.5);
    border-radius: 16px;
    padding: 40px 20px;
    text-align: center;
}
.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #fbbf24;
}
.stat-label { margin-top: 8px; }

/* Benefits */
.benefit-item {
    display: flex;
    gap: 15px;
    padding: 15px;
    border-radius: 10px;
    background: rgba(248,250,252,0.05);
    transition: .3s;
}
.benefit-item:hover { background: rgba(251,191,36,0.1); }

/* Pricing */
.pricing-card {
    background: linear-gradient(145deg, #1e293b, #334155);
    border-radius: 16px;
    padding: 30px 20px;
    text-align: center;
    transition: .3s;
    position: relative;
}
.pricing-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 24px rgba(0,0,0,.4);
}
.pricing-card h4 { margin-bottom: 10px; }
.pricing-card .lead { color: #fbbf24; font-size: 1.6rem; }

/* FAQ */
.faq-item {
    background: rgba(30,41,59,0.7);
    border-radius: 12px;
    margin-bottom: 15px;
    overflow: hidden;
}
.faq-question {
    padding: 15px 20px;
    background: rgba(251,191,36,0.1);
    cursor: pointer;
    color: #fbbf24;
    font-weight: 600;
}
.faq-answer {
    padding: 15px 20px;
    color: #f1f5f9;
    display: none;
}

/* CTA */
.cta-section {
    background: linear-gradient(135deg,#4415a2,#1a1a1a);
    text-align: center;
    padding: 80px 20px;
    border-radius: 18px;
    box-shadow: 0 8px 20px rgba(0,0,0,.6);
}
.cta-section h2 span { color: #fbbf24; }
.btn-gold {
    background: linear-gradient(135deg,#fbbf24,#db6070);
    color: #111827;
    padding: 12px 28px;
    border-radius: 10px;
    font-weight: bold;
    border: none;
    transition: .3s;
}
.btn-gold:hover { transform: translateY(-2px); }

/* Responsive */
@media(max-width:768px){
    .service-hero h1 { font-size: 2rem; }
    .stat-number { font-size: 2rem; }
}
</style>

<div class="container mt-5">

    <!-- Hero -->
    <section class="service-hero">
        <h1>Our <span>Astrology Services</span></h1>
        <p>Explore tools crafted to guide you in love, career, health, and spiritual growth 🌌</p>
    </section>

    <!-- Services -->
    <section>
        <h2 class="text-center mb-4">✨ Our Core Services</h2>
        <div class="row g-4">
            <?php
            $base = "http://localhost/astrology-app";
            $services = [
                ['📅','Daily Horoscope','horoscope.php','Personalized daily predictions on love, career, finance & health.'],
                ['❤️','Matchmaking','matchmaking.php','Check compatibility with Kundli matching & love insights.'],
                ['🌞','Panchang','panchang.php','Today\'s tithi, nakshatra, sunrise & sunset timings.'],
                ['🌌','Birth Chart','birthchart.php','Discover your Rasi, Lagna, and life path analysis.'],
                ['⚡','Dosha Analysis','dosha.php','Identify Manglik & other doshas with remedies.'],
                ['📊','Kundli Reports','kundli.php','Astrologer-verified reports tailored for you.']
            ];
            foreach($services as $s): ?>
                <div class="col-md-4">
                    <a href="<?=$base?>/public/<?=$s[2]?>" class="text-decoration-none text-white">
                        <div class="service-card h-100">
                            <div class="service-icon"><?=$s[0]?></div>
                            <h5><?=$s[1]?></h5>
                            <p><?=$s[3]?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Features -->
    <section class="service-features text-center">
        <h2 class="fw-bold mb-5">🌟 Why Choose Us?</h2>
        <div class="row g-4">
            <div class="col-md-3"><div class="feature-highlight"><div class="service-icon">🎯</div><h5>Precision</h5><p>Accurate Vedic predictions.</p></div></div>
            <div class="col-md-3"><div class="feature-highlight"><div class="service-icon">⚡</div><h5>Instant</h5><p>Get detailed reports instantly.</p></div></div>
            <div class="col-md-3"><div class="feature-highlight"><div class="service-icon">👥</div><h5>Expert</h5><p>Prepared by certified astrologers.</p></div></div>
            <div class="col-md-3"><div class="feature-highlight"><div class="service-icon">🔒</div><h5>Secure</h5><p>Safe with encryption.</p></div></div>
        </div>
    </section>

    <!-- Stats -->
    <section class="stats-section">
        <h2 class="mb-4">📊 Our Impact</h2>
        <div class="row g-4">
            <div class="col-md-3"><div class="stat-number">10K+</div><div class="stat-label">Happy Users</div></div>
            <div class="col-md-3"><div class="stat-number">50K+</div><div class="stat-label">Predictions</div></div>
            <div class="col-md-3"><div class="stat-number">99%</div><div class="stat-label">Accuracy</div></div>
            <div class="col-md-3"><div class="stat-number">24/7</div><div class="stat-label">Support</div></div>
        </div>
    </section>

    <!-- Benefits -->
    <section>
        <h2 class="text-center mb-4">💫 Benefits You Get</h2>
        <div class="row g-4">
            <div class="col-md-6"><div class="benefit-item"><span>🔮</span> <p>Clarity in personal and professional life.</p></div></div>
            <div class="col-md-6"><div class="benefit-item"><span>❤️</span> <p>Better relationships with compatibility analysis.</p></div></div>
            <div class="col-md-6"><div class="benefit-item"><span>🌿</span> <p>Practical remedies for doshas & obstacles.</p></div></div>
            <div class="col-md-6"><div class="benefit-item"><span>🌍</span> <p>Global astrological support at your fingertips.</p></div></div>
        </div>
    </section>

    <!-- Guarantee -->
    <section>
        <h2 class="text-center mb-4">✅ Our Service Guarantee</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="feature-highlight">
                    <div class="service-icon">🔒</div>
                    <h5>100% Privacy</h5>
                    <p>Your personal data and birth details are safe with end-to-end encryption.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-highlight">
                    <div class="service-icon">🎯</div>
                    <h5>Accuracy Promise</h5>
                    <p>Predictions are based on authentic Vedic astrology with maximum precision.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-highlight">
                    <div class="service-icon">🤝</div>
                    <h5>Customer Support</h5>
                    <p>24/7 assistance to ensure your journey is smooth and worry-free.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section>
        <h2 class="text-center mb-4">💎 Affordable Plans</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="pricing-card">
                    <h4>Basic</h4>
                    <p class="lead">Free</p>
                    <p>Daily horoscope, limited access to tools.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pricing-card">
                    <h4>Premium</h4>
                    <p class="lead">₹299 / month</p>
                    <p>Full access to matchmaking, dosha analysis & reports.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pricing-card">
                    <h4>Elite</h4>
                    <p class="lead">₹799 / month</p>
                    <p>One-on-one astrologer consultation + premium features.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section>
        <h2 class="text-center mb-4">❓ Frequently Asked Questions</h2>
        <div class="faq-item">
            <div class="faq-question">👉 How accurate are the predictions?</div>
            <div class="faq-answer">Our predictions are based on authentic Vedic astrology, with 99% accuracy reported by users.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">👉 Can I use the app for free?</div>
            <div class="faq-answer">Yes, basic features are free forever. Premium plans unlock advanced tools.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">👉 Do you provide remedies for doshas?</div>
            <div class="faq-answer">Yes, we provide personalized remedies for Manglik, Kaal Sarp and other doshas.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">👉 Is my data safe?</div>
            <div class="faq-answer">Absolutely! We use secure encryption to protect your personal data.</div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <h2>Start Your <span>Cosmic Journey</span> Today</h2>
        <p>Unlock premium insights into your future with trusted astrology.</p>
        <a href="<?=$base?>/public/subscribe.php" class="btn-gold">Upgrade Now</a>
    </section>
</div>

<script>
// FAQ Toggle
document.querySelectorAll(".faq-question").forEach(q => {
    q.addEventListener("click", () => {
        let ans = q.nextElementSibling;
        ans.style.display = ans.style.display === "block" ? "none" : "block";
    });
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
