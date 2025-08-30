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
    padding: 150px 20px 100px;
    border-radius: 20px;
    text-align: center;
    margin-bottom: 60px;
    box-shadow: 0 10px 28px rgba(0,0,0,0.6);
    position: relative;
    overflow: hidden;
}
.service-hero h1 {
    font-size: 3rem;
    font-weight: 700;
    letter-spacing: 1px;
    text-shadow: 1px 1px 8px rgba(0,0,0,0.4);
}
.service-hero h1 span { color: #fbbf24; }
.service-hero p.lead {
    font-size: 1.25rem;
    opacity: 0.9;
    margin-top: 15px;
}
.service-hero::after {
    content: "✨";
    font-size: 160px;
    position: absolute;
    bottom: -20px;
    right: 20px;
    opacity: 0.08;
}

/* Service Grid Links */
.service-link {
    text-decoration: none !important;
    color: inherit !important;
    display: block;
    transition: color 0.3s ease;
}
.service-link:hover {
    color: #fbbf24 !important;
    text-decoration: none;
}

/* Service Cards */
.service-card {
    background: #1e293b;
    border-radius: 18px;
    color: #f8fafc;
    padding: 30px 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease, border 0.3s ease;
    text-align: center;
    border: 2px solid transparent;
}
.service-card:hover {
    transform: translateY(-5px);
    border: 2px solid #fbbf24; /* gold border */
    box-shadow: 0 12px 28px rgba(251,191,36,0.5);
}
.service-card h5 {
    color: #fbbf24; /* gold heading */
    margin-bottom: 10px;
}
.service-card p {
    color: #f8fafc;
}
.service-icon { 
    font-size: 50px; 
    margin-bottom: 15px; 
    color: #fbbf24; /* gold icon */
}

/* Pricing Cards */
.pricing-card {
    background: #1e293b;
    border-radius: 18px;
    padding: 25px 20px;
    text-align: center;
    transition: 0.3s;
    position: relative;
}
.pricing-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.6);
}
.border-premium { border: 2px solid #4facfe; }
.ribbon {
    position: absolute;
    top: -10px;
    right: -10px;
    background: #fbbf24;
    color: #111827;
    padding: 5px 15px;
    font-size: 0.85rem;
    font-weight: 700;
    border-radius: 8px;
    transform: rotate(15deg);
}

/* Buttons */
.btn-gold {
    border-radius: 12px;
    font-weight: bold;
    background: linear-gradient(135deg,#fbbf24,#db6070);
    color: #111827;
    padding: 12px 28px;
    transition: 0.3s;
}
.btn-gold:hover {
    background: linear-gradient(135deg,#db6070,#fbbf24);
    box-shadow: 0 6px 16px rgba(0,0,0,0.4);
}
.btn-outline-gold {
    border: 2px solid #fbbf24;
    color: #fbbf24;
    background: transparent;
    padding: 12px 28px;
}
.btn-outline-gold:hover {
    background: #fbbf24;
    color: #111827;
}

/* Testimonials */
.testimonial {
    background: #1e293b;
    border-radius: 16px;
    padding: 25px;
    margin: 12px 0;
    box-shadow: 0 6px 20px rgba(0,0,0,0.5);
    transition: 0.3s;
    text-align: center;
}
.testimonial:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.6);
}
.testimonial img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 12px;
    border: 2px solid #fbbf24; /* gold border */
}

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg,#4415a2,#1a1a1a);
    padding: 80px 20px;
    border-radius: 20px;
    text-align: center;
    margin-top: 80px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.6);
}
.cta-section h2 span { color: #fbbf24; }

/* Responsive */
@media(max-width:768px){
    .service-hero { padding: 100px 15px 80px; }
    .service-card, .pricing-card, .testimonial { padding: 20px 15px; }
}
</style>

<div class="container mt-5">

    <!-- Hero -->
    <div class="service-hero shadow">
        <h1>Our <span>Astrology Services</span></h1>
        <p class="lead">Explore tools crafted to guide you in love, career, health, and spiritual growth 🌌</p>
    </div>

    <!-- Services Grid -->
    <div class="row g-4 mb-5">
        <?php
        $services = [
            ['📅','Daily Horoscope','horoscope.php','Personalized daily predictions on love, career, finance & health.'],
            ['❤️','Matchmaking','matchmaking.php','Check compatibility with Kundli matching, dosha analysis, and love insights.'],
            ['🌞','Panchang','panchang.php','Today’s tithi, nakshatra, yoga, karana, sunrise & sunset timings.'],
            ['🌌','Birth Chart','birthchart.php','Discover your Rasi, Lagna, planetary positions, and life path.'],
            ['⚡','Dosha Analysis','dosha.php','Identify Manglik & other doshas, and explore remedies.'],
            ['📊','Premium Reports','reports.php','In-depth, astrologer-verified reports tailored for your birth chart.']
        ];
        foreach($services as $s): ?>
        <div class="col-md-4">
            <a href="<?=$base?>/public/<?=$s[2]?>" class="service-link">
                <div class="service-card h-100">
                    <div class="service-icon"><?=$s[0]?></div>
                    <h5><?=$s[1]?></h5>
                    <p><?=$s[3]?></p>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Pricing Section -->
    <div class="mt-5">
        <h2 class="fw-bold text-center mb-4">🌟 Choose Your Plan</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="pricing-card text-center">
                    <h4 class="fw-bold">Free Plan</h4>
                    <p class="lead">₹0 / Forever</p>
                    <ul class="list-unstyled">
                        <li>✔ Daily Horoscope</li>
                        <li>✔ Free Panchang Access</li>
                        <li>✔ Basic Birth Chart</li>
                        <li>❌ Detailed Reports</li>
                        <li>❌ Matchmaking Analysis</li>
                    </ul>
                    <a href="<?=$base?>/public/register.php" class="btn btn-outline-gold mt-2">Get Started</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="pricing-card text-center border-premium">
                    <div class="ribbon">Most Popular</div>
                    <h4 class="fw-bold text-warning">Premium Plan</h4>
                    <p class="lead">₹499 / Month</p>
                    <ul class="list-unstyled">
                        <li>✔ All Free Features</li>
                        <li>✔ Detailed Kundli Reports</li>
                        <li>✔ Matchmaking & Dosha Remedies</li>
                        <li>✔ Personalized Predictions</li>
                        <li>✔ Priority Support</li>
                    </ul>
                    <a href="<?=$base?>/public/subscribe.php" class="btn btn-gold mt-2">Upgrade Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="mt-5">
        <h2 class="fw-bold text-center mb-4">✨ What Our Users Say</h2>
        <div class="row g-3 justify-content-center">
            <div class="col-md-4">
                <div class="testimonial">
                    <img src="<?=$base?>/public/assets/images/user1.jpg" alt="Priya Sharma">
                    <p>“The horoscope is always so accurate! I check it every morning.”</p>
                    <h6>- Priya Sharma</h6>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial">
                    <img src="<?=$base?>/public/assets/images/user2.jpg" alt="Rahul & Neha">
                    <p>“Matchmaking reports helped us a lot in understanding compatibility.”</p>
                    <h6>- Rahul & Neha</h6>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial">
                    <img src="<?=$base?>/public/assets/images/user3.jpg" alt="Arjun Verma">
                    <p>“Detailed Kundli gave me clarity about my career path. Highly recommended!”</p>
                    <h6>- Arjun Verma</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section mt-5">
        <h2 class="fw-bold">🌟 Unlock the Secrets of Your <span>Future</span></h2>
        <p class="lead">Join thousands who trust AstroGuide for accurate predictions & insights.</p>
        <a href="<?=$base?>/public/register.php" class="btn btn-gold px-4 mt-3">Create Free Account</a>
    </div>

</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
