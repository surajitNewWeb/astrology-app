<?php
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../backend/database.php';

// ✅ create DB connection
$db = new Database();
$conn = $db->connect();

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        $error_message = "⚠ Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "⚠ Please enter a valid email address.";
    } else {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);
            if ($stmt->execute()) {
                $success_message = "✅ Thank you, $name! Your message has been received.";
                // clear fields
                $name = $email = $phone = $subject = $message = '';
            } else {
                $error_message = "⚠ Something went wrong while saving your message.";
            }
            $stmt->close();
        } else {
            $error_message = "⚠ Query preparation failed: " . $conn->error;
        }
    }
}


// Contact information data (dynamic)
$contact_info = [
    'address' => 'AstroGuide Headquarters, 123 Cosmic Lane, Mumbai, Maharashtra 400001',
    'phone' => '+91 98765 43210',
    'email' => 'support@astroguide.com',
    'whatsapp' => '+91 98765 43210',
    'office_hours' => 'Mon - Sun: 9:00 AM - 9:00 PM (IST)',
    'emergency' => '24/7 Emergency Consultations Available'
];

// Social media links (dynamic)
$social_links = [
    'facebook' => 'https://facebook.com/astroguide',
    'twitter' => 'https://twitter.com/astroguide',
    'instagram' => 'https://instagram.com/astroguide',
    'youtube' => 'https://youtube.com/astroguide',
    'linkedin' => 'https://linkedin.com/company/astroguide',
    'telegram' => 'https://t.me/astroguide'
];

// Office locations (dynamic)
$office_locations = [
    [
        'city' => 'Mumbai',
        'address' => '123 Cosmic Lane, Andheri West, Mumbai 400058',
        'phone' => '+91 98765 43210',
        'lat' => '19.1136',
        'lng' => '72.8697'
    ],
    [
        'city' => 'Delhi',
        'address' => '456 Vedic Street, Connaught Place, New Delhi 110001',
        'phone' => '+91 98765 43211',
        'lat' => '28.6304',
        'lng' => '77.2177'
    ],
    [
        'city' => 'Bangalore',
        'address' => '789 Astro Avenue, Koramangala, Bangalore 560034',
        'phone' => '+91 98765 43212',
        'lat' => '12.9352',
        'lng' => '77.6245'
    ]
];
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Roboto, Arial, sans-serif;
        background: #090f23ff;
        color: #e5e7eb;
        background: #090f23ff url("https://www.transparenttextures.com/patterns/stardust.png");
        animation: moveStars 60s linear infinite;
        overflow-x: hidden;
    }
    
    @keyframes moveStars {
        from { background-position: 0 0; }
        to { background-position: 10000px 5000px; }
    }

    /* Advanced Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.8; }
        50% { transform: scale(1.05); opacity: 1; }
    }

    @keyframes glow {
        0%, 100% { box-shadow: 0 0 20px rgba(251,191,36,0.3); }
        50% { box-shadow: 0 0 40px rgba(251,191,36,0.6); }
    }

    @keyframes slideInUp {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    @keyframes slideInLeft {
        from { transform: translateX(-50px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    @keyframes slideInRight {
        from { transform: translateX(50px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
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
        font-size: 28px;
        animation: pulse 4s ease-in-out infinite;
    }

    .floating-moon {
        color: #e5e7eb;
        font-size: 36px;
        animation: float 8s ease-in-out infinite;
    }

    /* Hero Section */
    .contact-hero {
        background: linear-gradient(135deg,#4415a2,#1a1a1a);
        color: #f8fafc;
        padding: 120px 20px 80px;
        border-radius: 20px;
        text-align: center;
        margin-bottom: 60px;
        box-shadow: 0 10px 28px rgba(0,0,0,0.6);
        position: relative;
        overflow: hidden;
        animation: glow 6s ease-in-out infinite;
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(251,191,36,0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }

    .contact-hero h1 {
        font-size: 3rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-shadow: 1px 1px 8px rgba(0,0,0,0.4);
        position: relative;
        z-index: 2;
        animation: slideInUp 1s ease-out;
    }

    .contact-hero h1 span { 
        color: #fbbf24;
        text-shadow: 0 0 20px rgba(251,191,36,0.5);
    }

    .contact-hero p.lead {
        font-size: 1.25rem;
        opacity: 0.9;
        margin-top: 15px;
        position: relative;
        z-index: 2;
        animation: slideInUp 1s ease-out 0.3s both;
    }

    /* Card Styles */
    .contact-card, .info-card, .location-card {
        background: linear-gradient(145deg, #1e293b, #334155);
        border-radius: 18px;
        color: #f8fafc;
        padding: 30px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
        animation: slideInUp 1s ease-out;
    }

    .contact-card::before, .info-card::before, .location-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(251,191,36,0.1), transparent);
        transition: left 0.6s;
    }

    .contact-card:hover::before, .info-card:hover::before, .location-card:hover::before {
        left: 100%;
    }

    .contact-card:hover, .info-card:hover, .location-card:hover {
        transform: translateY(-8px) scale(1.02);
        border: 2px solid #fbbf24;
        box-shadow: 0 15px 35px rgba(251,191,36,0.4);
    }

    /* Form Styles */
    .form-control {
        background: rgba(30,41,59,0.8);
        border: 2px solid rgba(251,191,36,0.3);
        border-radius: 12px;
        color: #f8fafc;
        padding: 15px;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .form-control:focus {
        background: rgba(30,41,59,0.9);
        border-color: #fbbf24;
        box-shadow: 0 0 20px rgba(251,191,36,0.3);
        color: #f8fafc;
    }

    .form-control::placeholder {
        color: rgba(241,245,249,0.6);
    }

    .form-label {
        color: #fbbf24;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }

    /* Contact Info Cards */
    .contact-info-item {
        display: flex;
        align-items: center;
        padding: 20px;
        background: rgba(248,250,252,0.05);
        border-radius: 12px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
        border: 1px solid rgba(251,191,36,0.2);
    }

    .contact-info-item:hover {
        background: rgba(251,191,36,0.1);
        transform: translateX(10px);
        border-color: rgba(251,191,36,0.4);
    }

    .contact-icon {
        font-size: 32px;
        color: #fbbf24;
        margin-right: 20px;
        animation: float 3s ease-in-out infinite;
    }

    /* Social Media Icons */
    .social-icons {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
        margin: 30px 0;
    }

    .social-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background: linear-gradient(45deg, #fbbf24, #4415a2);
        color: white;
        border-radius: 50%;
        font-size: 24px;
        text-decoration: none;
        transition: all 0.3s ease;
        animation: bounce 2s infinite;
        position: relative;
        overflow: hidden;
    }

    .social-icon::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255,255,255,0.3);
        border-radius: 50%;
        transition: all 0.3s ease;
        transform: translate(-50%, -50%);
    }

    .social-icon:hover::before {
        width: 100%;
        height: 100%;
    }

    .social-icon:hover {
        transform: translateY(-5px) scale(1.1);
        box-shadow: 0 10px 25px rgba(251,191,36,0.4);
        animation: none;
    }

    .social-icon:nth-child(1) { animation-delay: 0.1s; }
    .social-icon:nth-child(2) { animation-delay: 0.2s; }
    .social-icon:nth-child(3) { animation-delay: 0.3s; }
    .social-icon:nth-child(4) { animation-delay: 0.4s; }
    .social-icon:nth-child(5) { animation-delay: 0.5s; }
    .social-icon:nth-child(6) { animation-delay: 0.6s; }

    /* Map Container */
    .map-container {
        position: relative;
        height: 400px;
        border-radius: 18px;
        overflow: hidden;
        border: 3px solid rgba(251,191,36,0.3);
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        animation: slideInUp 1s ease-out;
    }

    .map-container:hover {
        border-color: rgba(251,191,36,0.6);
        box-shadow: 0 15px 40px rgba(251,191,36,0.2);
    }

    #map {
        width: 100%;
        height: 100%;
        border-radius: 15px;
    }

    /* Location Tabs */
    .location-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .location-tab {
        padding: 12px 20px;
        background: rgba(30,41,59,0.8);
        border: 2px solid rgba(251,191,36,0.3);
        border-radius: 25px;
        color: #f8fafc;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .location-tab:hover, .location-tab.active {
        background: linear-gradient(45deg, #fbbf24, #4415a2);
        border-color: #fbbf24;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(251,191,36,0.3);
    }

    /* Buttons */
    .btn-gold {
        border-radius: 12px;
        font-weight: bold;
        background: linear-gradient(135deg,#fbbf24,#db6070);
        color: #111827;
        padding: 15px 32px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
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
        box-shadow: 0 8px 20px rgba(251,191,36,0.4);
        transform: translateY(-2px);
    }

    /* Alert Messages */
    .alert {
        border-radius: 12px;
        padding: 15px 20px;
        margin-bottom: 20px;
        border: none;
        animation: slideInUp 0.5s ease-out;
    }

    .alert-success {
        background: linear-gradient(135deg, rgba(34,197,94,0.2), rgba(22,163,74,0.2));
        border: 2px solid rgba(34,197,94,0.5);
        color: #bbf7d0;
    }

    .alert-danger {
        background: linear-gradient(135deg, rgba(239,68,68,0.2), rgba(220,38,38,0.2));
        border: 2px solid rgba(239,68,68,0.5);
        color: #fecaca;
    }

    /* Emergency Contact */
    .emergency-contact {
        background:linear-gradient(145deg, #1e293b, #334155);
        border-radius: 16px;
        padding: 25px;
        text-align: center;
        margin: 30px 0;
        animation: pulse 3s ease-in-out infinite;
        border: 2px solid rgba(255,255,255,0.2);
    }

    .emergency-contact h5 {
        color: #fbbf24;
        margin-bottom: 10px;
        font-size: 1.2rem;
    }

    .emergency-contact p {
        margin-bottom: 15px;
        color: #fecaca;
    }

    .emergency-contact .btn {
        background: rgba(255,255,255,0.2);
        border: 2px solid rgba(255,255,255,0.3);
        color: white;
        font-weight: bold;
        backdrop-filter: blur(10px);
    }

    .emergency-contact .btn:hover {
        background: rgba(255,255,255,0.3);
        transform: translateY(-2px);
    }

    /* Working Hours */
    .working-hours {
        background: rgba(30,41,59,0.6);
        border-radius: 16px;
        padding: 25px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(251,191,36,0.3);
        text-align: center;
    }

    .working-hours h5 {
        color: #fbbf24;
        margin-bottom: 15px;
    }

    .working-hours .time-slot {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid rgba(248,250,252,0.1);
    }

    .working-hours .time-slot:last-child {
        border-bottom: none;
    }

    /* Animation delays */
    .contact-card:nth-child(1) { animation-delay: 0.1s; animation-fill-mode: both; }
    .contact-card:nth-child(2) { animation-delay: 0.2s; animation-fill-mode: both; }
    .info-card:nth-child(1) { animation-delay: 0.3s; animation-fill-mode: both; }
    .info-card:nth-child(2) { animation-delay: 0.4s; animation-fill-mode: both; }
    .map-container { animation-delay: 0.5s; animation-fill-mode: both; }

    /* Responsive Design */
    @media(max-width:768px){
        .contact-hero { padding: 80px 15px 60px; }
        .contact-hero h1 { font-size: 2.2rem; }
        .contact-card, .info-card, .location-card { padding: 20px; }
        .contact-info-item { flex-direction: column; text-align: center; }
        .contact-icon { margin-right: 0; margin-bottom: 10px; }
        .map-container { height: 300px; }
        .floating-element { display: none; }
        .location-tabs { flex-direction: column; align-items: center; }
        .social-icons { gap: 10px; }
        .social-icon { width: 50px; height: 50px; font-size: 20px; }
    }

    @media(max-width:576px){
        .contact-hero h1 { font-size: 1.8rem; }
        .btn-gold { padding: 12px 24px; font-size: 0.9rem; }
    }
</style>

<!-- Floating Cosmic Elements -->
<div class="floating-element floating-star" style="top: 15%; left: 8%; animation-delay: 0s;">✨</div>
<div class="floating-element floating-moon" style="top: 25%; right: 12%; animation-delay: 2s;">🌙</div>
<div class="floating-element floating-star" style="top: 65%; left: 5%; animation-delay: 4s;">⭐</div>
<div class="floating-element floating-moon" style="top: 75%; right: 8%; animation-delay: 6s;">🌟</div>
<div class="floating-element floating-star" style="top: 45%; right: 15%; animation-delay: 8s;">✨</div>

<div class="container mt-5">
    <!-- Hero Section -->
    <div class="contact-hero shadow">
        <h1>Contact <span>AstroGuide</span></h1>
        <p class="lead">Get in touch with our expert astrologers for personalized guidance 🌌</p>
    </div>

    <!-- Success/Error Messages -->
    <?php if ($success_message): ?>
        <div class="alert alert-success">
            <strong>✅ Success!</strong> <?= htmlspecialchars($success_message) ?>
        </div>
    <?php endif; ?>

    <?php if ($error_message): ?>
        <div class="alert alert-danger">
            <strong>❌ Error!</strong> <?= htmlspecialchars($error_message) ?>
        </div>
    <?php endif; ?>

    <div class="row g-4 mb-5">
        <!-- Contact Form -->
        <div class="col-lg-8">
            <div class="contact-card">
                <h3 class="mb-4" style="color: #fbbf24;">💬 Send us a Message</h3>
                <form method="POST" action="">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">👤 Full Name *</label>
                            <input type="text" name="name" class="form-control" 
                                   placeholder="Enter your full name" 
                                   value="<?= htmlspecialchars($name ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">📧 Email Address *</label>
                            <input type="email" name="email" class="form-control" 
                                   placeholder="Enter your email address" 
                                   value="<?= htmlspecialchars($email ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">📱 Phone Number</label>
                            <input type="tel" name="phone" class="form-control" 
                                   placeholder="Enter your phone number" 
                                   value="<?= htmlspecialchars($phone ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">📝 Subject</label>
                            <select name="subject" class="form-control">
                                <option value="">Choose a subject</option>
                                <option value="General Inquiry" <?= ($subject ?? '') === 'General Inquiry' ? 'selected' : '' ?>>General Inquiry</option>
                                <option value="Technical Support" <?= ($subject ?? '') === 'Technical Support' ? 'selected' : '' ?>>Technical Support</option>
                                <option value="Billing Question" <?= ($subject ?? '') === 'Billing Question' ? 'selected' : '' ?>>Billing Question</option>
                                <option value="Consultation Request" <?= ($subject ?? '') === 'Consultation Request' ? 'selected' : '' ?>>Consultation Request</option>
                                <option value="Feedback" <?= ($subject ?? '') === 'Feedback' ? 'selected' : '' ?>>Feedback</option>
                                <option value="Partnership" <?= ($subject ?? '') === 'Partnership' ? 'selected' : '' ?>>Partnership</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">💭 Your Message *</label>
                            <textarea name="message" class="form-control" rows="6" 
                                      placeholder="Tell us how we can help you..." required><?= htmlspecialchars($message ?? '') ?></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="contact_submit" class="btn btn-gold">
                                Send Message ✨
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="col-lg-4">
            <div class="info-card">
                <h3 class="mb-4" style="color: #fbbf24;">📞 Get in Touch</h3>
                
                <div class="contact-info-item">
                    <div class="contact-icon">🏢</div>
                    <div>
                        <h6 class="text-warning mb-1">Office Address</h6>
                        <p class="mb-0"><?= $contact_info['address'] ?></p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-icon">📞</div>
                    <div>
                        <h6 class="text-warning mb-1">Phone Number</h6>
                        <p class="mb-0">
                            <a href="tel:<?= $contact_info['phone'] ?>" class="text-decoration-none text-light">
                                <?= $contact_info['phone'] ?>
                            </a>
                        </p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-icon">📧</div>
                    <div>
                        <h6 class="text-warning mb-1">Email Address</h6>
                        <p class="mb-0">
                            <a href="mailto:<?= $contact_info['email'] ?>" class="text-decoration-none text-light">
                                <?= $contact_info['email'] ?>
                            </a>
                        </p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-icon">💬</div>
                    <div>
                        <h6 class="text-warning mb-1">WhatsApp</h6>
                        <p class="mb-0">
                            <a href="https://wa.me/<?= str_replace(['+', ' '], '', $contact_info['whatsapp']) ?>" 
                               class="text-decoration-none text-light" target="_blank">
                                <?= $contact_info['whatsapp'] ?>
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Working Hours -->
                <div class="working-hours mt-4">
                    <h5>⏰ Office Hours</h5>
                    <div class="time-slot">
                        <span>Monday - Friday</span>
                        <span>9:00 AM - 8:00 PM</span>
                    </div>
                    <div class="time-slot">
                        <span>Saturday</span>
                        <span>10:00 AM - 6:00 PM</span>
                    </div>
                    <div class="time-slot">
                        <span>Sunday</span>
                        <span>11:00 AM - 5:00 PM</span>
                    </div>
                    <div class="time-slot">
                        <span>Emergency</span>
                        <span>24/7 Available</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Emergency Contact -->
    <div class="emergency-contact">
        <h5>🚨 Emergency Consultations</h5>
        <p>Need urgent astrological guidance? Our experts are available 24/7 for emergency consultations.</p>
        <a href="tel:<?= $contact_info['phone'] ?>" class="btn btn-outline-light">
            Call Now: <?= $contact_info['phone'] ?>
        </a>
    </div>

    <!-- Social Media Section -->
    <div class="text-center mb-5">
        <h3 class="mb-4" style="color: #fbbf24;">🌐 Follow Us on Social Media</h3>
        <p class="mb-4">Stay connected with us for daily horoscopes, astrology tips, and exclusive content!</p>
        <div class="social-icons">
            <a href="<?= $social_links['facebook'] ?>" class="social-icon" target="_blank" title="Facebook">
               <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="<?= $social_links['twitter'] ?>" class="social-icon" target="_blank" title="Twitter">
              <i class="fa-brands fa-twitter"></i>
            </a>
            <a href="<?= $social_links['instagram'] ?>" class="social-icon" target="_blank" title="Instagram">
               <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="<?= $social_links['youtube'] ?>" class="social-icon" target="_blank" title="YouTube">
               <i class="fa-brands fa-youtube"></i>
            </a>
            <a href="<?= $social_links['linkedin'] ?>" class="social-icon" target="_blank" title="LinkedIn">
               <i class="fa-brands fa-linkedin"></i>
            </a>
            <a href="<?= $social_links['telegram'] ?>" class="social-icon" target="_blank" title="Telegram">
               <i class="fa-brands fa-telegram"></i>
            </a>
        </div>
    </div>

    <!-- Office Locations -->
    <div class="mb-5">
        <h3 class="text-center mb-4" style="color: #fbbf24;">🏢 Our Office Locations</h3>
        
        <!-- Location Tabs -->
        <div class="location-tabs">
            <?php foreach ($office_locations as $index => $location): ?>
                <div class="location-tab <?= $index === 0 ? 'active' : '' ?>" 
                     onclick="showLocation(<?= $index ?>)">
                    📍 <?= $location['city'] ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Google Map -->
        <div class="map-container">
            <iframe id="map" 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3770.2123456789!2d72.8697!3d19.1136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDA2JzQ5LjAiTiA3Mso1MicxMS4wIkU!5e0!3m2!1sen!2sin!4v1234567890123"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" 
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        <!-- Location Details -->
        <div class="row g-4 mt-4">
            <?php foreach ($office_locations as $index => $location): ?>
                <div class="col-md-4 location-detail" id="location-<?= $index ?>" 
                     style="<?= $index !== 0 ? 'display: none;' : '' ?>">
                    <div class="location-card text-center">
                        <div class="contact-icon mb-3">📍</div>
                        <h5 class="text-warning mb-3"><?= $location['city'] ?> Office</h5>
                        <p class="mb-3"><?= $location['address'] ?></p>
                        <p class="mb-3">
                            <strong>📞 Phone:</strong> 
                            <a href="tel:<?= $location['phone'] ?>" class="text-decoration-none text-light">
                                <?= $location['phone'] ?>
                            </a>
                        </p>
                        <div class="d-flex gap-2 justify-content-center flex-wrap">
                            <a href="https://maps.google.com/?q=<?= $location['lat'] ?>,<?= $location['lng'] ?>" 
                               target="_blank" class="btn btn-sm btn-outline-gold">
                                🗺️ Get Directions
                            </a>
                            <a href="tel:<?= $location['phone'] ?>" class="btn btn-sm btn-gold">
                                📞 Call Now
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="mb-5">
        <h3 class="text-center mb-4" style="color: #fbbf24;">❓ Frequently Asked Questions</h3>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-card">
                    <div class="accordion" id="faqAccordion">
                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between p-3" 
                                 style="background: rgba(251,191,36,0.1); border-radius: 12px; cursor: pointer;"
                                 data-bs-toggle="collapse" data-bs-target="#faq1">
                                <h6 class="mb-0 text-warning">🕐 What are your consultation hours?</h6>
                                <span class="text-warning">+</span>
                            </div>
                            <div id="faq1" class="collapse show" data-bs-parent="#faqAccordion">
                                <div class="p-3">
                                    <p>Our expert astrologers are available Monday to Sunday from 9:00 AM to 9:00 PM (IST). For emergency consultations, we provide 24/7 support.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between p-3" 
                                 style="background: rgba(251,191,36,0.1); border-radius: 12px; cursor: pointer;"
                                 data-bs-toggle="collapse" data-bs-target="#faq2">
                                <h6 class="mb-0 text-warning">💰 What are your consultation fees?</h6>
                                <span class="text-warning">+</span>
                            </div>
                            <div id="faq2" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="p-3">
                                    <p>We offer various consultation packages starting from ₹299 for a basic reading to ₹1,999 for comprehensive life analysis. Free plan users get basic horoscope access.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between p-3" 
                                 style="background: rgba(251,191,36,0.1); border-radius: 12px; cursor: pointer;"
                                 data-bs-toggle="collapse" data-bs-target="#faq3">
                                <h6 class="mb-0 text-warning">🌍 Do you provide consultations in other languages?</h6>
                                <span class="text-warning">+</span>
                            </div>
                            <div id="faq3" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="p-3">
                                    <p>Yes! We provide consultations in Hindi, English, Tamil, Telugu, and Marathi. More languages are being added based on demand.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between p-3" 
                                 style="background: rgba(251,191,36,0.1); border-radius: 12px; cursor: pointer;"
                                 data-bs-toggle="collapse" data-bs-target="#faq4">
                                <h6 class="mb-0 text-warning">📱 Do you offer online consultations?</h6>
                                <span class="text-warning">+</span>
                            </div>
                            <div id="faq4" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="p-3">
                                    <p>Absolutely! We offer video calls, phone consultations, and chat-based readings. You can book online consultations through our website or mobile app.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between p-3" 
                                 style="background: rgba(251,191,36,0.1); border-radius: 12px; cursor: pointer;"
                                 data-bs-toggle="collapse" data-bs-target="#faq5">
                                <h6 class="mb-0 text-warning">🔒 How secure is my personal information?</h6>
                                <span class="text-warning">+</span>
                            </div>
                            <div id="faq5" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="p-3">
                                    <p>Your privacy is our top priority. All personal data and birth details are encrypted with military-grade security and never shared with third parties.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Contact Options -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="contact-card text-center">
                <div class="contact-icon mb-3">📞</div>
                <h6 class="text-warning mb-2">Call Us</h6>
                <p class="small mb-3">Speak directly with our experts</p>
                <a href="tel:<?= $contact_info['phone'] ?>" class="btn btn-sm btn-gold">
                    Call Now
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="contact-card text-center">
                <div class="contact-icon mb-3">💬</div>
                <h6 class="text-warning mb-2">WhatsApp</h6>
                <p class="small mb-3">Quick chat for instant help</p>
                <a href="https://wa.me/<?= str_replace(['+', ' '], '', $contact_info['whatsapp']) ?>" 
                   target="_blank" class="btn btn-sm btn-gold">
                    Chat Now
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="contact-card text-center">
                <div class="contact-icon mb-3">📧</div>
                <h6 class="text-warning mb-2">Email Us</h6>
                <p class="small mb-3">Detailed queries welcome</p>
                <a href="mailto:<?= $contact_info['email'] ?>" class="btn btn-sm btn-gold">
                    Send Email
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="contact-card text-center">
                <div class="contact-icon mb-3">📅</div>
                <h6 class="text-warning mb-2">Book Session</h6>
                <p class="small mb-3">Schedule consultation</p>
                <a href="<?= $base ?>/public/booking.php" class="btn btn-sm btn-gold">
                    Book Now
                </a>
            </div>
        </div>
    </div>

    <!-- Newsletter Subscription -->
    <div class="contact-card text-center mb-5">
        <h3 class="mb-4" style="color: #fbbf24;">📬 Stay Updated</h3>
        <p class="mb-4">Subscribe to our newsletter for daily horoscopes, astrology tips, and exclusive offers!</p>
        <form class="row g-3 justify-content-center align-items-end" method="POST" action="">
            <div class="col-md-4">
                <input type="email" name="newsletter_email" class="form-control" 
                       placeholder="Enter your email address" required>
            </div>
            <div class="col-md-2">
                <button type="submit" name="newsletter_submit" class="btn btn-gold w-100">
                    Subscribe ✨
                </button>
            </div>
        </form>
        <div class="mt-3">
            <small class="text-muted">📧 Get daily horoscopes • 🎁 Exclusive offers • 🔒 No spam, unsubscribe anytime</small>
        </div>
    </div>

    <!-- Review & Rating Section -->
    <div class="contact-card text-center">
        <h3 class="mb-4" style="color: #fbbf24;">⭐ Rate Your Experience</h3>
        <p class="mb-4">Help us improve our services by sharing your feedback!</p>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="d-flex justify-content-center mb-3">
                    <div class="rating-stars">
                        <span class="star" data-rating="1">⭐</span>
                        <span class="star" data-rating="2">⭐</span>
                        <span class="star" data-rating="3">⭐</span>
                        <span class="star" data-rating="4">⭐</span>
                        <span class="star" data-rating="5">⭐</span>
                    </div>
                </div>
                <textarea class="form-control mb-3" rows="3" 
                          placeholder="Share your experience with us..."></textarea>
                <button class="btn btn-gold">Submit Review</button>
            </div>
            <div class="col-md-6">
                <div class="text-start">
                    <h6 class="text-warning mb-3">Recent Reviews:</h6>
                    <div class="mb-3 p-3" style="background: rgba(251,191,36,0.1); border-radius: 8px;">
                        <div class="d-flex justify-content-between">
                            <strong class="text-warning">Priya S.</strong>
                            <span>⭐⭐⭐⭐⭐</span>
                        </div>
                        <small>"Amazing service! Very accurate predictions."</small>
                    </div>
                    <div class="mb-3 p-3" style="background: rgba(251,191,36,0.1); border-radius: 8px;">
                        <div class="d-flex justify-content-between">
                            <strong class="text-warning">Raj K.</strong>
                            <span>⭐⭐⭐⭐⭐</span>
                        </div>
                        <small>"Excellent customer support and guidance!"</small>
                    </div>
                    <div class="p-3" style="background: rgba(251,191,36,0.1); border-radius: 8px;">
                        <div class="d-flex justify-content-between">
                            <strong class="text-warning">Meera P.</strong>
                            <span>⭐⭐⭐⭐⭐</span>
                        </div>
                        <small>"Life-changing insights. Highly recommended!"</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- JavaScript for Dynamic Functionality -->
<script>
    // Location switching functionality
    function showLocation(index) {
        // Hide all location details
        const locationDetails = document.querySelectorAll('.location-detail');
        locationDetails.forEach(detail => {
            detail.style.display = 'none';
        });
        
        // Show selected location
        document.getElementById('location-' + index).style.display = 'block';
        
        // Update active tab
        const tabs = document.querySelectorAll('.location-tab');
        tabs.forEach(tab => {
            tab.classList.remove('active');
        });
        tabs[index].classList.add('active');
        
        // Update map based on location data
        const locations = <?= json_encode($office_locations) ?>;
        const selectedLocation = locations[index];
        
        // Update map iframe src (simplified Google Maps embed)
        const mapFrame = document.getElementById('map');
        const mapSrc = `https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3770.2123456789!2d${selectedLocation.lng}!3d${selectedLocation.lat}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z${selectedLocation.lat}!5e0!3m2!1sen!2sin!4v1234567890123`;
        mapFrame.src = mapSrc;
    }

    // Star rating functionality
    document.querySelectorAll('.star').forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.dataset.rating;
            const stars = document.querySelectorAll('.star');
            
            stars.forEach((s, index) => {
                if (index < rating) {
                    s.style.opacity = '1';
                    s.style.transform = 'scale(1.2)';
                } else {
                    s.style.opacity = '0.3';
                    s.style.transform = 'scale(1)';
                }
            });
            
            // Store rating (you can send this to backend)
            console.log('Rating selected:', rating);
        });

        star.addEventListener('mouseenter', function() {
            const rating = this.dataset.rating;
            const stars = document.querySelectorAll('.star');
            
            stars.forEach((s, index) => {
                if (index < rating) {
                    s.style.opacity = '1';
                    s.style.transform = 'scale(1.1)';
                } else {
                    s.style.opacity = '0.3';
                    s.style.transform = 'scale(1)';
                }
            });
        });

        star.addEventListener('mouseleave', function() {
            const stars = document.querySelectorAll('.star');
            stars.forEach(s => {
                s.style.opacity = '0.8';
                s.style.transform = 'scale(1)';
            });
        });
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const name = document.querySelector('input[name="name"]').value.trim();
        const email = document.querySelector('input[name="email"]').value.trim();
        const message = document.querySelector('textarea[name="message"]').value.trim();
        
        if (!name || !email || !message) {
            e.preventDefault();
            alert('Please fill in all required fields.');
            return;
        }
        
        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            e.preventDefault();
            alert('Please enter a valid email address.');
            return;
        }
    });

    // Newsletter subscription handling
    <?php if (isset($_POST['newsletter_submit'])): ?>
        <?php
        $newsletter_email = trim($_POST['newsletter_email'] ?? '');
        if ($newsletter_email && filter_var($newsletter_email, FILTER_VALIDATE_EMAIL)) {
            echo "alert('✅ Thank you for subscribing to our newsletter!');";
        } else {
            echo "alert('❌ Please enter a valid email address.');";
        }
        ?>
    <?php endif; ?>

    // Social media click tracking
    document.querySelectorAll('.social-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            const platform = this.getAttribute('title');
            console.log('Social media click:', platform);
            // You can send this data to analytics
        });
    });

    // Contact method click tracking
    document.querySelectorAll('[href^="tel:"], [href^="mailto:"], [href^="https://wa.me/"]').forEach(link => {
        link.addEventListener('click', function() {
            const type = this.href.split(':')[0];
            console.log('Contact method used:', type);
            // You can send this data to analytics
        });
    });

    // Smooth scroll for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>

<style>
    .rating-stars {
        display: flex;
        gap: 5px;
        font-size: 24px;
    }

    .star {
        cursor: pointer;
        transition: all 0.3s ease;
        opacity: 0.3;
    }

    .star:hover {
        opacity: 1;
        transform: scale(1.2);
    }
</style>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>