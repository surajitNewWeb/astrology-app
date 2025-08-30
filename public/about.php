<?php
require_once __DIR__ . '/../includes/navbar.php';
?>

<style>
body {
    background: #0a0e1a;
    color: #f8fafc;
    font-family: 'Segoe UI', sans-serif;
    line-height: 1.6;
}

/* Hero Section */
.service-hero {
    background: linear-gradient(135deg,#4415a2,#1a1a1a);
    color: #f8fafc;
    padding: 120px 20px 80px;
    border-radius: 20px;
    text-align: center;
    margin-bottom: 50px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.6);
}
.service-hero h1 span { color: #fbbf24; }
.service-hero p.lead { font-size: 1.25rem; opacity: 0.9; }

/* Card Style */
.card-custom, .feature-card, .team-card {
    background: #1e293b;
    border-radius: 16px;
    color: #f8fafc;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    padding: 25px 20px;
    text-align: center;
}
.card-custom:hover, .feature-card:hover, .team-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 18px rgba(251,191,36,0.3);
}

/* About Section Images */
.about-img, .mission-img, .vision-img {
    width: 100%;
    max-width: 420px;
    border-radius: 16px;
    object-fit: cover;
    display: block;
    margin: 0 auto;
    box-shadow: 0 8px 24px rgba(251,191,36,0.3);
}

/* Who We Are Cards */
.who-we-are .card-custom {
    background: linear-gradient(145deg, #1a1a2b, #111827);
    text-align: left;
}

/* Mission & Vision Cards */
.mission-vision .card-custom {
    background: linear-gradient(135deg,#111827,#1e293b);
    text-align: center;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.mission-vision .card-custom:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 18px rgba(251,191,36,0.3);
}

/* Headings */
.who-we-are h3, .mission-vision h4 {
    color: #fbbf24;
    font-weight: 600;
}

/* Lists in Who We Are */
.who-we-are ul li {
    margin-top: 6px;
    color: #f8fafc;
    font-weight: 500;
}

/* Feature Cards */
.feature-icon { 
    font-size: 48px; 
    margin-bottom: 12px; 
    color: #4facfe;
}

/* Team */
.team-card img {
    border-radius: 50%;
    width: 140px;
    height: 140px;
    object-fit: cover;
    border: 2px solid #fbbf24;
    margin-bottom: 15px;
}

/* Stats */
.stats h2 { font-size: 2.2rem; color: #fbbf24; font-weight: 700; }
.stats p { color: #f8fafc; font-weight: 500; }

/* Buttons */
.btn-gold {
    border-radius: 12px;
    font-weight: bold;
    background: linear-gradient(45deg,#fbbf24,#db6070);
    color: #111827;
    border: none;
    padding: 12px 28px;
    transition: all 0.2s ease;
}
.btn-gold:hover {
    background: linear-gradient(135deg,#db6070,#fbbf24);
}

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg,#4415a2,#1a1a1a);
    padding: 80px 20px;
    border-radius: 16px;
    text-align: center;
    margin-top: 60px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.6);
}
.cta-section h2 span { color: #fbbf24; }

/* Responsive Fixes */
@media(max-width:768px){
    .service-hero { padding: 100px 15px 60px; }
    .card-custom, .feature-card, .team-card { padding: 20px 15px; }
    .team-card img { width: 120px; height: 120px; }
}
@media(max-width:576px){
    .about-img { max-width: 100%; }
}
</style>


<div class="container mt-5">

    <!-- Hero -->
    <div class="service-hero shadow">
        <h1>About <span>AstroGuide</span></h1>
        <p class="lead">Blending Ancient Astrology with Modern Technology to Empower Your Journey 🌌</p>
    </div>

<!-- Who We Are Section -->
<div class="row g-4 mb-5 align-items-center who-we-are">
    <div class="col-md-6 order-md-2 text-center">
        <img src="<?=$base?>/public/assets/images/about-astrology.jpg" alt="Astrology" class="about-img shadow">
    </div>
    <div class="col-md-6 order-md-1">
        <div class="card-custom p-4 h-100">
            <h3 class="mb-3">Who We Are</h3>
            <p>At <strong>AstroGuide</strong>, we blend the ancient wisdom of astrology with modern technology to empower your journey. We provide accurate, personalized insights for personal growth, relationships, career, and health.</p>
            <ul class="list-unstyled mt-3">
                <li>🌟 Trusted Astrology Experts</li>
                <li>🔮 Personalized Daily Predictions</li>
                <li>💖 Matchmaking & Dosha Analysis</li>
            </ul>
        </div>
    </div>
</div>

<!-- Mission & Vision Section -->
<div class="row g-4 mb-5 mission-vision text-center text-md-start">
    <div class="col-md-6">
        <div class="card-custom p-4 h-100 d-flex align-items-center justify-content-center flex-column">
            <img src="<?=$base?>/public/assets/images/mission.jpg" alt="Mission" class="mb-3 mission-img shadow">
            <h4>🔮 Our Mission</h4>
            <p>To make astrology accessible, reliable, and meaningful for everyone seeking guidance, empowering their personal and professional journey.</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-custom p-4 h-100 d-flex align-items-center justify-content-center flex-column">
            <img src="<?=$base?>/public/assets/images/vision.jpg" alt="Vision" class="mb-3 vision-img shadow">
            <h4>🚀 Our Vision</h4>
            <p>To be the leading global platform providing accurate, personalized astrology insights that inspire self-discovery and growth.</p>
        </div>
    </div>
</div>


    <!-- Features -->
    <h2 class="fw-bold text-center mb-4">✨ Our Key Features</h2>
    <div class="row g-4 mb-5 text-center">
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">📅</div>
                <h5>Daily Horoscope</h5>
                <p>Personalized daily predictions for love, career, health & finance.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">❤️</div>
                <h5>Matchmaking</h5>
                <p>Kundli matching, dosha analysis, and love insights.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h5>Dosha Analysis</h5>
                <p>Identify Manglik & other doshas and explore remedies.</p>
            </div>
        </div>
    </div>

    <!-- Team -->
    <h2 class="fw-bold text-center mb-4">🌟 Meet Our Astrologers</h2>
    <div class="row g-4 justify-content-center mb-5">
        <?php for($i=1;$i<=3;$i++): ?>
        <div class="col-md-3">
            <div class="team-card card-custom p-3">
                <img src="<?=$base?>/public/assets/images/team<?=$i?>.jpg" alt="astrologer <?=$i?>">
                <h5>Astrologer Name</h5>
                <p class="text-muted">Expertise Description</p>
            </div>
        </div>
        <?php endfor; ?>
    </div>

    <!-- Stats -->
    <div class="row stats text-center mb-5">
        <div class="col-md-3"><h2>10K+</h2><p>Users Served</p></div>
        <div class="col-md-3"><h2>50K+</h2><p>Horoscopes Generated</p></div>
        <div class="col-md-3"><h2>1K+</h2><p>Matchmaking Reports</p></div>
        <div class="col-md-3"><h2>99%</h2><p>User Satisfaction</p></div>
    </div>

    <!-- Call To Action -->
    <div class="cta-section">
        <h2>🌟 Unlock the Secrets of Your <span>Future</span></h2>
        <p class="lead">Join thousands who trust AstroGuide for accurate predictions & insights.</p>
        <a href="<?=$base?>/public/register.php" class="btn btn-gold px-4 mt-3">Create Free Account</a>
    </div>

</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
