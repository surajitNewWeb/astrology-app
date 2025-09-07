<?php
require_once __DIR__ . '/../includes/navbar.php';
?>

<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Roboto, Arial, sans-serif;
        background: #090f23ff;
        /* deeper cosmic navy */
        color: #e5e7eb;
        /* softer off-white */
        background: #090f23ff url("https://www.transparenttextures.com/patterns/stardust.png");
        animation: moveStars 60s linear infinite;
        overflow-x: hidden;
    }
    
    @keyframes moveStars {
        from {
            background-position: 0 0;
        }
        to {
            background-position: 10000px 5000px;
        }
    }

    /* Floating animation for decorative elements */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.8; }
        50% { transform: scale(1.1); opacity: 1; }
    }

    @keyframes glow {
        0%, 100% { box-shadow: 0 0 20px rgba(251,191,36,0.3); }
        50% { box-shadow: 0 0 40px rgba(251,191,36,0.6); }
    }

    @keyframes slideInLeft {
        from { transform: translateX(-100px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    @keyframes slideInRight {
        from { transform: translateX(100px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    @keyframes fadeInUp {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    /* Floating cosmic elements */
    .floating-element {
        position: absolute;
        pointer-events: none;
        animation: float 6s ease-in-out infinite;
        opacity: 0.1;
        z-index: -1;
    }

    .floating-star {
        color: #fbbf24;
        font-size: 24px;
        animation: pulse 4s ease-in-out infinite;
    }

    .floating-moon {
        color: #e5e7eb;
        font-size: 32px;
        animation: float 8s ease-in-out infinite;
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
    position: relative;
    overflow: hidden;
    animation: glow 4s ease-in-out infinite;
}

.service-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(251,191,36,0.1) 0%, transparent 70%);
    animation: spin 20s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.service-hero h1 { 
    position: relative;
    z-index: 2;
    animation: fadeInUp 1s ease-out;
}
.service-hero h1 span { 
    color: #fbbf24;
    text-shadow: 0 0 20px rgba(251,191,36,0.5);
}
.service-hero p.lead { 
    font-size: 1.25rem; 
    opacity: 0.9;
    position: relative;
    z-index: 2;
    animation: fadeInUp 1s ease-out 0.3s both;
}

/* Card Style */
.card-custom, .feature-card, .team-card {
    background: #1e293b;
    border-radius: 16px;
    color: #f8fafc;
    transition: all 0.3s ease;
    padding: 25px 20px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.card-custom::before, .feature-card::before, .team-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(251,191,36,0.1), transparent);
    transition: left 0.6s;
}

.card-custom:hover::before, .feature-card:hover::before, .team-card:hover::before {
    left: 100%;
}

.card-custom:hover, .feature-card:hover, .team-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 12px 30px rgba(251,191,36,0.4);
    border: 1px solid rgba(251,191,36,0.3);
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
    transition: all 0.3s ease;
}

.about-img:hover, .mission-img:hover, .vision-img:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 36px rgba(251,191,36,0.5);
}

/* Who We Are Cards */
.who-we-are .card-custom {
    background: linear-gradient(145deg, #1a1a2b, #111827);
    text-align: left;
    animation: slideInLeft 1s ease-out;
}

.who-we-are .about-img {
    animation: slideInRight 1s ease-out;
}

/* Mission & Vision Cards */
.mission-vision .card-custom {
    background: linear-gradient(135deg,#111827,#1e293b);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    animation: fadeInUp 1s ease-out;
}

.mission-vision .card-custom:nth-child(1) {
    animation-delay: 0.2s;
    animation-fill-mode: both;
}

.mission-vision .card-custom:nth-child(2) {
    animation-delay: 0.4s;
    animation-fill-mode: both;
}

.mission-vision .card-custom:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 12px 30px rgba(251,191,36,0.4);
}

/* Journey Timeline */
.journey-timeline {
    position: relative;
    padding: 60px 0;
}

.timeline-line {
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, #fbbf24, #4415a2);
    transform: translateX(-50%);
    z-index: 1;
}

.timeline-item {
    position: relative;
    margin-bottom: 40px;
    animation: fadeInUp 1s ease-out;
}

.timeline-item:nth-child(odd) {
    animation-delay: 0.2s;
    animation-fill-mode: both;
}

.timeline-item:nth-child(even) {
    animation-delay: 0.4s;
    animation-fill-mode: both;
}

.timeline-content {
    background: linear-gradient(135deg, #1e293b, #334155);
    padding: 30px;
    border-radius: 16px;
    position: relative;
    box-shadow: 0 8px 24px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
}

.timeline-content:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 36px rgba(251,191,36,0.2);
}

.timeline-icon {
    position: absolute;
    left: 50%;
    top: 30px;
    transform: translateX(-50%);
    width: 60px;
    height: 60px;
    background: linear-gradient(45deg, #fbbf24, #4415a2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
    z-index: 2;
    animation: pulse 3s ease-in-out infinite;
}

/* Values Section */
.values-section {
    margin: 80px 0;
    border-radius: 20px;
}

.values-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 20%, rgba(251,191,36,0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(68,21,162,0.1) 0%, transparent 50%);
}

.value-card {
    background: rgba(30,41,59,0.8);
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(251,191,36,0.2);
    transition: all 0.3s ease;
    height: 100%;
}

.value-card:hover {
    transform: translateY(-10px);
    background: rgba(30,41,59,0.9);
    border-color: rgba(251,191,36,0.4);
}

.value-icon {
    font-size: 64px;
    margin-bottom: 20px;
    display: block;
    animation: float 4s ease-in-out infinite;
}

/* Headings */
.who-we-are h3, .mission-vision h4 {
    color: #fbbf24;
    font-weight: 600;
    text-shadow: 0 0 10px rgba(251,191,36,0.3);
}

/* Lists in Who We Are */
.who-we-are ul li {
    margin-top: 8px;
    color: #f8fafc;
    font-weight: 500;
    padding-left: 10px;
    position: relative;
}

.who-we-are ul li::before {
    content: '✨';
    position: absolute;
    left: -15px;
    animation: pulse 2s ease-in-out infinite;
}

/* Feature Cards */
.feature-icon { 
    font-size: 48px; 
    margin-bottom: 12px; 
    color: #4facfe;
    animation: float 3s ease-in-out infinite;
}

.feature-card {
    animation: fadeInUp 1s ease-out;
}

.feature-card:nth-child(1) { animation-delay: 0.1s; animation-fill-mode: both; }
.feature-card:nth-child(2) { animation-delay: 0.2s; animation-fill-mode: both; }
.feature-card:nth-child(3) { animation-delay: 0.3s; animation-fill-mode: both; }

/* Team */
.team-card {
    animation: fadeInUp 1s ease-out;
}

.team-card:nth-child(1) { animation-delay: 0.2s; animation-fill-mode: both; }
.team-card:nth-child(2) { animation-delay: 0.4s; animation-fill-mode: both; }
.team-card:nth-child(3) { animation-delay: 0.6s; animation-fill-mode: both; }

.team-card img {
    border-radius: 50%;
    width: 140px;
    height: 140px;
    object-fit: cover;
    border: 3px solid #fbbf24;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.team-card:hover img {
    transform: scale(1.1);
    border-width: 4px;
    box-shadow: 0 0 30px rgba(251,191,36,0.6);
}

/* Stats */
.stats {
    animation: fadeInUp 1s ease-out 0.5s both;
}

.stats h2 { 
    font-size: 2.2rem; 
    color: #fbbf24; 
    font-weight: 700;
    text-shadow: 0 0 15px rgba(251,191,36,0.5);
    animation: pulse 3s ease-in-out infinite;
}
.stats p { 
    color: #f8fafc; 
    font-weight: 500; 
}

/* Buttons */
.btn-gold {
    border-radius: 12px;
    font-weight: bold;
    background: linear-gradient(45deg,#fbbf24,#db6070);
    color: #111827;
    border: none;
    padding: 12px 28px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn-gold::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s;
}

.btn-gold:hover::before {
    left: 100%;
}

.btn-gold:hover {
    background: linear-gradient(135deg,#db6070,#fbbf24);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(251,191,36,0.4);
}

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg,#4415a2,#1a1a1a);
    padding: 40px 20px;
    border-radius: 16px;
    text-align: center;
    margin-top: 60px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.6);
    position: relative;
    overflow: hidden;
    animation: glow 6s ease-in-out infinite;
}

.cta-section::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(251,191,36,0.05) 0%, transparent 70%);
    animation: spin 30s linear infinite reverse;
}

.cta-section h2 { 
    position: relative;
    z-index: 2;
}
.cta-section h2 span { 
    color: #fbbf24;
    text-shadow: 0 0 20px rgba(251,191,36,0.5);
}

.cta-section p {
    position: relative;
    z-index: 2;
}

.cta-section .btn-gold {
    position: relative;
    z-index: 2;
}

/* Testimonial Section */
.testimonial-section {
    margin: 80px 0;
    border-radius: 20px;
}

.testimonial-card {
    background: rgba(30,41,59,0.8);
    border-radius: 16px;
    padding: 30px;
    margin: 20px 0;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(251,191,36,0.2);
    transition: all 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    border-color: rgba(251,191,36,0.4);
    box-shadow: 0 10px 30px rgba(251,191,36,0.2);
}

.testimonial-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 3px solid #fbbf24;
    object-fit: cover;
    margin-bottom: 15px;
}

/* Section Divider */
.section-divider {
    height: 3px;
    background: linear-gradient(90deg, transparent, #fbbf24, transparent);
    margin: 80px 0;
    border-radius: 2px;
}
.text-muted{
    color: #9ca3af !important;
}

/* Responsive Fixes */
@media(max-width:768px){
    .service-hero { padding: 100px 15px 60px; }
    .card-custom, .feature-card, .team-card { padding: 20px 15px; }
    .team-card img { width: 120px; height: 120px; }
    .timeline-line { display: none; }
    .timeline-icon { position: relative; left: auto; transform: none; margin-bottom: 20px; }
    .value-card { padding: 30px 20px; }
    .values-section { padding: 60px 20px; }
    .testimonial-section { padding: 60px 20px; }
}

@media(max-width:576px){
    .about-img { max-width: 100%; }
    .floating-element { display: none; }
}
</style>

<!-- Floating Cosmic Elements -->
<div class="floating-element floating-star" style="top: 10%; left: 5%; animation-delay: 0s;">✨</div>
<div class="floating-element floating-moon" style="top: 20%; right: 10%; animation-delay: 2s;">🌙</div>
<div class="floating-element floating-star" style="top: 60%; left: 8%; animation-delay: 4s;">⭐</div>
<div class="floating-element floating-star" style="top: 80%; right: 15%; animation-delay: 6s;">✨</div>
<div class="floating-element floating-moon" style="top: 40%; left: 15%; animation-delay: 8s;">🌟</div>

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
            <p>Founded by passionate astrologers and technology enthusiasts, we believe that everyone deserves access to the profound wisdom of the stars. Our platform combines centuries-old astrological knowledge with cutting-edge algorithms to deliver precise, meaningful guidance.</p>
            <ul class="list-unstyled mt-3">
                <li>🌟 Trusted Astrology Experts</li>
                <li>🔮 Personalized Daily Predictions</li>
                <li>💖 Matchmaking & Dosha Analysis</li>
                <li>🎯 Career & Finance Guidance</li>
                <li>🌿 Health & Wellness Insights</li>
            </ul>
        </div>
    </div>
</div>

<div class="section-divider"></div>

<!-- Mission & Vision Section -->
<div class="row g-4 mb-5 mission-vision text-center text-md-start">
    <div class="col-md-6">
        <div class="card-custom p-4 h-100 d-flex align-items-center justify-content-center flex-column">
            <img src="<?=$base?>/public/assets/images/mission.jpg" alt="Mission" class="mb-3 mission-img shadow">
            <h4>🔮 Our Mission</h4>
            <p>To make astrology accessible, reliable, and meaningful for everyone seeking guidance, empowering their personal and professional journey through the wisdom of celestial movements.</p>
            <p class="small text-muted">We strive to bridge the gap between ancient wisdom and modern life, providing tools that help you navigate life's complexities with confidence.</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-custom p-4 h-100 d-flex align-items-center justify-content-center flex-column">
            <img src="<?=$base?>/public/assets/images/vision.jpg" alt="Vision" class="mb-3 vision-img shadow">
            <h4>🚀 Our Vision</h4>
            <p>To be the leading global platform providing accurate, personalized astrology insights that inspire self-discovery, growth, and positive transformation in millions of lives.</p>
            <p class="small text-muted">We envision a world where cosmic wisdom guides every important decision, fostering harmony between individuals and the universe.</p>
        </div>
    </div>
</div>

<!-- Core Values Section -->
<div class="values-section">
    <div class="container">
        <h2 class="fw-bold text-center mb-5 text-white">💎 Our Core Values</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="value-card">
                    <span class="value-icon">🎯</span>
                    <h5 class="text-warning mb-3">Accuracy</h5>
                    <p>We provide precise predictions based on authentic astrological calculations and time-tested methodologies.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="value-card">
                    <span class="value-icon">🔒</span>
                    <h5 class="text-warning mb-3">Privacy</h5>
                    <p>Your personal information and birth details are completely secure with our advanced encryption technology.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="value-card">
                    <span class="value-icon">💝</span>
                    <h5 class="text-warning mb-3">Empathy</h5>
                    <p>We understand life's challenges and provide compassionate guidance to help you navigate difficult times.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="value-card">
                    <span class="value-icon">🚀</span>
                    <h5 class="text-warning mb-3">Innovation</h5>
                    <p>Constantly evolving our platform with cutting-edge technology to deliver the best astrological experience.</p>
                </div>
            </div>
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
                <p>Personalized daily predictions for love, career, health & finance based on your unique birth chart and current planetary positions.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">❤️</div>
                <h5>Matchmaking</h5>
                <p>Comprehensive Kundli matching, dosha analysis, and love compatibility insights to find your perfect life partner.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h5>Dosha Analysis</h5>
                <p>Identify Manglik, Kaal Sarp, and other doshas with detailed analysis and effective remedies for harmonious living.</p>
            </div>
        </div>
    </div>

    <!-- Additional Features Row -->
    <div class="row g-4 mb-5 text-center">
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">💼</div>
                <h5>Career Guidance</h5>
                <p>Navigate your professional journey with astrological insights about the best career paths and timing for important decisions.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">🌿</div>
                <h5>Health Predictions</h5>
                <p>Understand potential health challenges and optimal times for treatments through detailed medical astrology analysis.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">💰</div>
                <h5>Financial Forecast</h5>
                <p>Make informed investment decisions and understand your financial cycles with personalized wealth astrology reports.</p>
            </div>
        </div>
    </div>

    <!-- Team -->
    <h2 class="fw-bold text-center mb-4">🌟 Meet Our Expert Astrologers</h2>
    <div class="row g-4 justify-content-center mb-5">
        <?php for($i=1;$i<=3;$i++): ?>
        <div class="col-md-3">
            <div class="team-card card-custom p-3">
                <img src="<?=$base?>/public/assets/images/team<?=$i?>.jpg" alt="astrologer <?=$i?>">
                <h5>Dr. Astrological Expert <?=$i?></h5>
                <p class="text-muted">Vedic Astrology Specialist</p>
                <p class="small">15+ years of experience in providing accurate predictions and spiritual guidance to thousands of satisfied clients worldwide.</p>
                <div class="mt-2">
                    <span class="badge bg-warning text-dark me-1">Vedic</span>
                    <span class="badge bg-info text-dark me-1">Numerology</span>
                    <span class="badge bg-success text-dark">Tarot</span>
                </div>
            </div>
        </div>
        <?php endfor; ?>
    </div>

    <!-- Testimonials Section -->
    <div class="testimonial-section">
        <div class="container">
            <h2 class="fw-bold text-center mb-5 text-white">💝 What Our Users Say</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card text-center">
                        <img src="<?=$base?>/public/assets/images/user1.jpg" alt="User 1" class="testimonial-avatar">
                        <p class="fst-italic">"AstroGuide's predictions have been incredibly accurate! The daily horoscope helps me plan my day perfectly, and the matchmaking service helped me find my soulmate."</p>
                        <h6 class="text-warning">Priya Sharma</h6>
                        <small class="text-muted">Software Engineer, Mumbai</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card text-center">
                        <img src="<?=$base?>/public/assets/images/user2.jpg" alt="User 2" class="testimonial-avatar">
                        <p class="fst-italic">"The career guidance from AstroGuide transformed my professional life. Their timing predictions for job changes were spot-on, and I'm now in my dream role!"</p>
                        <h6 class="text-warning">Rajesh Kumar</h6>
                        <small class="text-muted">Marketing Manager, Delhi</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card text-center">
                        <img src="<?=$base?>/public/assets/images/user3.jpg" alt="User 3" class="testimonial-avatar">
                        <p class="fst-italic">"The dosha analysis and remedies suggested by AstroGuide brought peace and harmony to my family. Their expertise is truly remarkable!"</p>
                        <h6 class="text-warning">Meera Patel</h6>
                        <small class="text-muted">Teacher, Ahmedabad</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row stats text-center mb-5">
        <div class="col-md-3"><h2>10K+</h2><p>Users Served</p></div>
        <div class="col-md-3"><h2>50K+</h2><p>Horoscopes Generated</p></div>
        <div class="col-md-3"><h2>1K+</h2><p>Matchmaking Reports</p></div>
        <div class="col-md-3"><h2>99%</h2><p>User Satisfaction</p></div>
    </div>

    <!-- Enhanced Stats Section -->
    <div class="row stats text-center mb-5">
        <div class="col-md-2"><h3 class="text-info">500+</h3><p>Expert Consultations</p></div>
        <div class="col-md-2"><h3 class="text-success">25+</h3><p>Countries Served</p></div>
        <div class="col-md-2"><h3 class="text-warning">15+</h3><p>Years Combined Experience</p></div>
        <div class="col-md-2"><h3 class="text-danger">24/7</h3><p>Customer Support</p></div>
        <div class="col-md-2"><h3 class="text-primary">365</h3><p>Days of Accuracy</p></div>
        <div class="col-md-2"><h3 class="text-secondary">100%</h3><p>Privacy Protected</p></div>
    </div>

    <!-- Why Choose Us Section -->
    <div class="row g-4 mb-5">
        <div class="col-12">
            <div class="card-custom p-5 text-center">
                <h2 class="fw-bold mb-4 text-warning">🎯 Why Choose AstroGuide?</h2>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <span class="feature-icon me-3" style="font-size: 32px;">🔬</span>
                            <div class="text-start">
                                <h5 class="text-info">Scientific Approach</h5>
                                <p>Our predictions are based on precise astronomical calculations and ancient Vedic principles, ensuring maximum accuracy.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <span class="feature-icon me-3" style="font-size: 32px;">🎨</span>
                            <div class="text-start">
                                <h5 class="text-info">Personalized Experience</h5>
                                <p>Every reading is tailored to your unique birth chart, providing insights that are specifically relevant to your life journey.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <span class="feature-icon me-3" style="font-size: 32px;">⚡</span>
                            <div class="text-start">
                                <h5 class="text-info">Instant Results</h5>
                                <p>Get immediate access to your horoscopes, compatibility reports, and astrological analysis without any waiting time.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <span class="feature-icon me-3" style="font-size: 32px;">🛡️</span>
                            <div class="text-start">
                                <h5 class="text-info">Trusted & Secure</h5>
                                <p>Your personal information is encrypted and protected. We maintain the highest standards of privacy and data security.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Awards & Recognition -->
    <div class="row g-4 mb-5 text-center">
        <div class="col-12">
            <h2 class="fw-bold mb-4">🏆 Awards & Recognition</h2>
        </div>
        <div class="col-md-3">
            <div class="card-custom p-4">
                <div class="feature-icon">🥇</div>
                <h6 class="text-warning">Best Astrology App 2023</h6>
                <p class="small">Recognized by Digital India Awards for innovation in traditional astrology</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-custom p-4">
                <div class="feature-icon">⭐</div>
                <h6 class="text-warning">5-Star Rating</h6>
                <p class="small">Consistently rated 5 stars by users on app stores and review platforms</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-custom p-4">
                <div class="feature-icon">🎖️</div>
                <h6 class="text-warning">Excellence in Service</h6>
                <p class="small">Awarded by Indian Astrology Council for outstanding service quality</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-custom p-4">
                <div class="feature-icon">🌟</div>
                <h6 class="text-warning">User's Choice</h6>
                <p class="small">Most trusted astrology platform according to user surveys and feedback</p>
            </div>
        </div>
    </div>

    <!-- Our Promise Section -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card-custom p-4 h-100">
                <h4 class="text-warning mb-3">🤝 Our Promise to You</h4>
                <ul class="list-unstyled">
                    <li class="mb-2">✅ Accurate predictions based on authentic astrological methods</li>
                    <li class="mb-2">✅ Complete privacy and confidentiality of your personal data</li>
                    <li class="mb-2">✅ 24/7 customer support for all your queries</li>
                    <li class="mb-2">✅ Regular updates and new features based on user feedback</li>
                    <li class="mb-2">✅ Affordable pricing with no hidden charges</li>
                    <li class="mb-2">✅ Money-back guarantee if not satisfied</li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-custom p-4 h-100 text-center">
                <h4 class="text-warning mb-3">📞 Get in Touch</h4>
                <p>Have questions? Need personalized consultation? Our expert astrologers are here to help!</p>
                <div class="contact-info mt-4">
                    <p><strong>📧 Email:</strong> support@astroguide.com</p>
                    <p><strong>📱 WhatsApp:</strong> +91 98765 43210</p>
                    <p><strong>⏰ Consultation Hours:</strong> 9 AM - 9 PM (IST)</p>
                    <p><strong>🌍 Languages:</strong> Hindi, English, Tamil, Telugu</p>
                </div>
                <a href="<?=$base?>/public/contact.php" class="btn btn-gold mt-3">Contact Us Now</a>
            </div>
        </div>
    </div>

    <!-- Call To Action -->
    <div class="cta-section">
        <h2>🌟 Unlock the Secrets of Your <span>Future</span></h2>
        <p class="lead">Join thousands who trust AstroGuide for accurate predictions & insights.</p>
        <p class="mb-4">Start your cosmic journey today and discover what the stars have in store for you!</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="<?=$base?>/public/register.php" class="btn btn-gold px-4 mt-3">Create Free Account</a>
            <a href="<?=$base?>/public/services.php" class="btn btn-outline-light px-4 mt-3">Explore Services</a>
        </div>
        <div class="mt-4">
            <small class="text-muted">✨ Get your first horoscope absolutely FREE! ✨</small>
        </div>
    </div>

</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>