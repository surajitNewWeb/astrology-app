<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>AstroGuide — Home</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="./public/assets/css/bootstrap.min.css">
  <style>
    :root {
      --bg: #0a0e1a;
      --surface: #1a1f2e;
      --surface-light: #252b3d;
      --primary: #6366f1;
      /* modern indigo */
      --primary-light: #818cf8;
      --accent: #f59e0b;
      /* warm amber */
      --accent1: #ec4899;
      /* vibrant pink */
      --accent2: #10b981;
      /* emerald green */
      --text-primary: #f8fafc;
      --text-secondary: #cbd5e1;
      --text-muted: #94a3b8;
      --sky: #0ea5e9;
      /* bright sky blue */
      --glass-bg: rgba(255, 255, 255, 0.05);
      --glass-border: rgba(255, 255, 255, 0.1);
      --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    /* base */
    html,
    body {
      height: 100%;
    }

    body {
      margin: 0;
      font-family: "Segoe UI", Roboto, -apple-system, Arial, sans-serif;
      background: var(--bg);
      color: var(--text-primary);
    }

    /* skip link for accessibility */
    .skip-link {
      position: absolute;
      left: -9999px;
      top: auto;
      width: 1px;
      height: 1px;
      overflow: hidden;
    }

    .skip-link:focus {
      position: static;
      width: auto;
      height: auto;
      padding: 8px 12px;
      margin: 8px;
      background: var(--surface);
      color: var(--text-primary);
      border-radius: 4px;
    }



    /* HERO — video background container */
    .hero {
      position: relative;
      min-height: 68vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    /* the background video itself */
    #bg-video {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 0;
      filter: brightness(0.4) saturate(1.2) contrast(1.1);
      transform-origin: center;
    }

    /* dim overlay (keeps text legible) */
    .hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(10, 14, 26, 0.6), rgba(37, 43, 61, 0.4));
      z-index: 1;
    }

    /* transparent glass panel in center */
    .hero-panel {
      position: relative;
      z-index: 2;
      max-width: 1080px;
      width: calc(100% - 48px);
      margin: 0 auto;
      background: rgba(26, 31, 46, 0.25);
      border-radius: 20px;
      padding: 32px;
      display: flex;
      align-items: center;
      gap: 32px;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
      border: 1px solid rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(16px) saturate(180%);
      color: var(--text-primary);
    }

    .hero-left {
      flex: 1;
      min-width: 260px;
    }

    .hero-right {
      width: 320px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .hero h1 {
      margin: 0 0 10px 0;
      font-size: clamp(28px, 3.5vw, 44px);
      line-height: 1.02;
      font-weight: 800;
      background: linear-gradient(135deg, #f8fafc, #e2e8f0);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-shadow: 0 6px 20px rgba(0, 0, 0, 0.5);
    }

    .hero p.lead {
      margin: 0 0 18px 0;
      color: var(--text-secondary);
      font-size: 1.02rem;
      max-width: 58ch;
    }

    /* CTA buttons inside glass */
    .cta-row {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
    }

    .btn-cta {
      padding: 12px 24px;
      border-radius: 12px;
      font-weight: 700;
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
      position: relative;
      overflow: hidden;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--primary), var(--primary-light));
      color: white;
    }

    .btn-outline {
      background: transparent;
      color: var(--text-primary);
      border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .btn-solid {
      background: linear-gradient(135deg, var(--accent1), #f97316);
      color: white;
    }

    .btn-cta:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, var(--primary-light), #a855f7);
    }

    .btn-outline:hover {
      background: rgba(255, 255, 255, 0.1);
      border-color: var(--primary-light);
    }

    .quick-features {
      display: flex;
      gap: 20px;
      margin-top: 10px;
      color: var(--text-secondary);
    }

    main {
      max-width: 1200px;
      margin: 0 auto;
      padding: 60px 20px;
    }

    /* Features Section */
    .section-title {
      text-align: center;
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 40px;
      background: linear-gradient(135deg, var(--primary-light), var(--accent));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .grid-3 {
      display: grid;
      gap: 24px;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    }

    .feature {
      background: var(--surface);
      padding: 28px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      transition: all 0.3s ease;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .feature:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
      border-color: var(--primary);
    }

    .feature img {
      width: 250px;
      height: 200px;
      object-fit: cover;
      margin-bottom: 14px;
      border-radius: 12px;
    }

    .feature h5 {
      color: var(--primary-light);
      font-weight: 700;
      margin-bottom: 6px;
    }

    .feature p {
      color: var(--text-secondary);
    }

    /* Testimonials */
    .testimonials {
      padding: 60px 20px;
      text-align: center;
      background: var(--gradient-1);
      color: white;
      border-radius: 20px;
      margin: 60px 0;
      position: relative;
      overflow: hidden;
    }

    .testimonials::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
      pointer-events: none;
    }

    .testimonial-card {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 16px;
      padding: 24px;
      margin: 10px;
      backdrop-filter: blur(10px);
      transition: transform 0.3s ease;
    }

    .testimonial-card:hover {
      transform: translateY(-5px);
    }

    .testimonial-card p {
      font-style: italic;
      color: rgba(255, 255, 255, 0.95);
    }

    .testimonial-card strong {
      display: block;
      margin-top: 8px;
      color: var(--accent);
    }

    /* Blog / Insights */
    .blog-grid {
      display: grid;
      gap: 24px;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    }

    .blog-card {
      background: var(--surface);
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
      transition: all 0.3s ease;
      border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .blog-card:hover {
      transform: translateY(-8px);
      border-color: var(--accent2);
    }

    .blog-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .blog-card-body {
      padding: 20px;
    }

    .blog-card-body h6 {
      color: var(--primary-light);
      font-weight: 700;
      margin-bottom: 8px;
    }

    .blog-card-body p {
      font-size: 0.95rem;
      color: var(--text-secondary);
    }

    /* Call to Action */
    .cta-band {
      margin: 80px 0;
      padding: 60px 20px;
      text-align: center;
      background: var(--gradient-2);
      color: white;
      border-radius: 20px;
      position: relative;
      overflow: hidden;
    }

    .cta-band::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: radial-gradient(circle at 70% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
      pointer-events: none;
    }

    .cta-band h2 {
      margin-bottom: 16px;
    }

    .cta-band .btn-cta {
      margin-top: 16px;
    }

/* Zodiac Grid */
.zodiac-strip {
  display: grid;
  grid-template-columns: repeat(4, 1fr); /* Default: Desktop */
  gap: 20px;
  margin-top: 20px;
}

.zodiac-item {
  background: var(--surface);
  padding: 16px;
  border-radius: 16px;
  text-align: center;
  transition: all 0.3s ease;
  border: 1px solid rgba(255, 255, 255, 0.05);
}

.zodiac-item:hover {
  transform: scale(1.05);
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
  border-color: var(--primary);
}

.zodiac-item img {
  max-width: 200px;   /* Make image responsive */
  height: 200px;      /* Maintain aspect ratio */
  object-fit: cover;
  background: transparent;
  margin-bottom: 8px;
  border-radius: 12px;
}

.zodiac-item strong {
  color: var(--text-primary);
}

/* 📱 Responsive Breakpoints */
@media (max-width: 1200px) {
  .zodiac-strip {
    grid-template-columns: repeat(3, 1fr); /* Large tablet / small desktop */
  }
}

@media (max-width: 900px) {
  .zodiac-strip {
    grid-template-columns: repeat(2, 1fr); /* Tablet view */
  }
}

@media (max-width: 600px) {
  .zodiac-strip {
    grid-template-columns: 1fr; /* Mobile view: 1 per row */
  }
}


    /* Subscribe / Newsletter Section */
    .subscribe-section {
      background: var(--gradient-3);
      padding: 60px 20px;
      border-radius: 20px;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .subscribe-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: radial-gradient(circle at 50% 50%, rgba(4, 112, 219, 0.1) 0%, transparent 70%);
      pointer-events: none;
    }

    .subscribe-section h2 {
      font-size: 2rem;
      margin-bottom: 12px;
      color: white;
    }

    .subscribe-section p {
      font-size: 1rem;
      margin-bottom: 24px;
      color: rgba(255, 255, 255, 0.9);
    }

    .subscribe-form input[type="email"] {
      padding: 14px 18px;
      border-radius: 12px;
      border: 2px solid rgba(255, 255, 255, 0.3);
      margin-right: 12px;
      min-width: 250px;
      max-width: 350px;
      flex: 1;
      background: rgba(255, 255, 255, 0.1);
      color: white;
      backdrop-filter: blur(10px);
    }

    .subscribe-form input[type="email"]::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }

    .subscribe-form input[type="email"]:focus {
      outline: none;
      border-color: var(--accent);
      box-shadow: 0 0 20px rgba(245, 158, 11, 0.4);
    }

    .subscribe-form button {
      padding: 14px 28px;
      border-radius: 12px;
      font-weight: 700;
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
      background: var(--accent);
      color: white;
    }

    .subscribe-form button:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(245, 158, 11, 0.4);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .subscribe-form {
        flex-direction: column;
        gap: 12px;
      }

      .subscribe-form input[type="email"] {
        margin-right: 0;
        width: 100%;
      }

      .subscribe-form button {
        width: 100%;
      }
    }

    /* footer */
    footer {
      padding: 32px 20px;
      text-align: center;
      color: var(--text-muted);
      font-size: 0.95rem;
      background: var(--surface);
      border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    footer a {
      color: var(--text-secondary);
      text-decoration: none;
      transition: color 0.3s ease;
    }

    footer a:hover {
      color: var(--primary-light);
    }

    /* responsiveness */
    @media (max-width: 992px) {
      .hero-panel {
        flex-direction: column;
        gap: 20px;
        padding: 24px;
      }

      .hero-right {
        width: 100%;
      }
    }

    @media (max-width: 560px) {
      .hero {
        min-height: 56vh;
        padding: 48px 0;
      }

      header .container {
        padding: 8px 12px;
      }

      .hero-left {
        text-align: center;
      }

      .quick-features {
        justify-content: center;
      }
    }
  </style>
</head>

<body>

  <a class="skip-link" href="#main">Skip to content</a>

  <!-- Header -->
  <?php include __DIR__ . '../includes/navbar.php'; ?>

  <!-- HERO with video -->
  <section class="hero" aria-label="Hero">
    <!-- background video (muted autoplay loop; include poster fallback) -->
    <video id="bg-video" autoplay muted loop playsinline poster="./public/assets/images/hero-poster.jpg" preload="auto"
      aria-hidden="true">
      <source src="./public/assets/videos/hero2.mp4" type="video/mp4">
      <!-- optionally add webm -->
      <!-- <source src="../assets/videos/hero.webm" type="video/webm"> -->
      Your browser does not support HTML5 video.
    </video>

    <div class="hero-overlay" aria-hidden="true"></div>

    <div class="hero-panel container">
      <div class="hero-left">
        <h1>Discover your cosmic path — daily guidance & natal charts</h1>
        <p class="lead">Fast personalized horoscopes, accurate birth charts, and compatibility reports — made simple &
          beautiful.</p>

        <div class="cta-row">
          <button class="btn-cta btn-primary" onclick="location.href='horoscope.php'">Get My Horoscope</button>
          <button class="btn-cta btn-outline" onclick="location.href='kundli.php'">Generate Kundli</button>
          <button class="btn-cta btn-solid" onclick="location.href='matchmaking.php'">Matchmaking</button>
        </div>

        <div class="quick-features" aria-hidden="true">
          <div class="item">✨ Daily updates</div>
          <div class="item">📜 Accurate charts</div>
          <div class="item">💞 Compatibility</div>
        </div>
      </div>

      <div class="hero-right">
        <div class="panel-card" role="region" aria-label="Today highlights">
          <h4>Today's Highlights</h4>
          <p><strong>Lucky Color:</strong> Teal · <strong>Lucky Number:</strong> 7</p>
          <p style="margin-top:10px; font-size:0.95rem; color:rgba(255,255,255,0.95)">Quick insight: Favor conversations
            and new ideas — the moon supports clarity.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Features -->
  <main>
    <h2 class="section-title">Our Features 🔮</h2>
    <div class="grid-3">
      <div class="feature">
        <img src="./public/assets/images/horoscope.jpg" alt="Horoscope">
        <h5>Daily Horoscope</h5>
        <p>Accurate & personalized predictions updated every single day.</p>
      </div>
      <div class="feature">
        <img src="./public/assets/images/kundali.jpg" alt="Kundli">
        <h5>Kundli Generator</h5>
        <p>Generate detailed birth charts with planetary positions & insights.</p>
      </div>
      <div class="feature">
        <img src="./public/assets/images/matchmaking.jpg" alt="Love">
        <h5>Matchmaking</h5>
        <p>Check compatibility & love predictions with your partner instantly.</p>
      </div>
    </div>

    <!-- Testimonials -->
    <section class="testimonials">
      <h2>What People Say ✨</h2>
      <div class="d-flex flex-wrap justify-content-center">
        <div class="testimonial-card col-md-3">
          <p>"AstroGuide gave me so much clarity about my career choices. Spot on!"</p>
          <strong>– Priya, Mumbai</strong>
        </div>
        <div class="testimonial-card col-md-3">
          <p>"The Kundli generator is so beautiful & accurate. Love the design!"</p>
          <strong>– Rahul, Delhi</strong>
        </div>
        <div class="testimonial-card col-md-3">
          <p>"The love compatibility feature was fun and surprisingly true 😍."</p>
          <strong>– Ayesha, Dubai</strong>
        </div>
      </div>
    </section>

    <!-- Blog / Insights -->
    <h2 class="section-title">Astrology Insights 📝</h2>
    <div class="blog-grid">
      <div class="blog-card">
        <img src="./public/assets/images/moonsign.jpg" alt="Zodiac Blog">
        <div class="blog-card-body">
          <h6>5 Things to Know About Your Moon Sign</h6>
          <p>Understanding your emotions & inner self through your moon placement.</p>
        </div>
      </div>
      <div class="blog-card">
        <img src="./public/assets/images/Astrology.jpg" alt="Astro Tips">
        <div class="blog-card-body">
          <h6>Astrology & Career Choices</h6>
          <p>Which zodiac signs thrive in leadership, creativity, or service roles?</p>
        </div>
      </div>
      <div class="blog-card">
        <img src="./public/assets/images/Love.jpg" alt="Love">
        <div class="blog-card-body">
          <h6>Love & Compatibility in 2025</h6>
          <p>Check which signs are most aligned for long-term relationships this year.</p>
        </div>
      </div>
    </div>

    <!-- Call to Action Band -->
    <div class="cta-band">
      <h2>Ready to Explore Your Stars? 🌠</h2>
      <p>Get your personalized horoscope, detailed Kundli & love compatibility in seconds.</p>
      <button class="btn-cta btn-primary" onclick="location.href='matchmaking.php'">Start Now</button>
    </div>

    <!-- Zodiac Strip -->
    <h2 class="section-title">Zodiac Signs ♈</h2>
    <div class="zodiac-strip">
      <?php
$zodiacs = [
  "aries"=>"Aries","taurus"=>"Taurus","gemini"=>"Gemini","cancer"=>"Cancer",
  "leo"=>"Leo","virgo"=>"Virgo","libra"=>"Libra","scorpio"=>"Scorpio",
  "sagittarius"=>"Sagittarius","capricorn"=>"Capricorn","aquarius"=>"Aquarius","pisces"=>"Pisces"
];
foreach($zodiacs as $file => $name){
  echo "<div class='zodiac-item'>
          <img src='./public/assets/images/zodiac-icons/$file.jpg' alt='$name'>
          <div><strong>$name</strong></div>
        </div>";
}
?>
    </div>

    <section class="extra-content mt-5 mb-5">
      <h2 class="section-title">Astrology Tips & Guides 🌟</h2>
      <div class="grid-3">
        <div class="feature">
          <img src="./public/assets/images/daily-retuals.jpg" alt="Tip 1">
          <h5>Daily Rituals</h5>
          <p>Small daily practices that align your energy with the cosmos.</p>
        </div>
        <div class="feature">
          <img src="./public/assets/images/moon-phase.jpg" alt="Tip 2">
          <h5>Moon Phases</h5>
          <p>Learn how to use lunar cycles to plan and manifest effectively.</p>
        </div>
        <div class="feature">
          <img src="./public/assets/images/plantry-insight.jpg" alt="Tip 3">
          <h5>Planetary Insights</h5>
          <p>Understand how each planet affects your daily life and decisions.</p>
        </div>
      </div>
    </section>

    <!-- Subscribe / Newsletter Section -->
    <section class="subscribe-section mt-5 mb-5">
      <div class="container text-center">
        <h2 class="section-title">Subscribe to AstroGuide Newsletter ✨</h2>
        <p>Get weekly horoscope updates, astrology tips & cosmic insights directly to your inbox.</p>
        <form class="subscribe-form d-flex justify-content-center flex-wrap mt-3" action="#" method="POST">
          <input type="email" name="email" placeholder="Enter your email" required>
          <button type="submit" class="btn-cta btn-primary">Subscribe</button>
        </form>
      </div>
    </section>

  </main>
  <footer>
    <div class="container">
      <div style="margin-bottom:10px">&copy;
        <?=date("Y")?> AstroGuide
      </div>
      <div><a href="#">Privacy</a> · <a href="#">Terms</a> · <a href="contact.php">Contact</a></div>
    </div>
  </footer>

  <script>
    // Respect reduced-motion preference
    const prefersReduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const video = document.getElementById('bg-video');
    if (prefersReduce && video) {
      video.pause();
      video.style.display = 'none';
      document.querySelector('.hero-overlay').style.background = 'rgba(10,12,20,0.45)';
    }

    // On small screens, optionally hide video to save bandwidth
    function handleResize() {
      if (window.innerWidth < 600) {
        if (video) video.style.display = 'none';
      } else {
        if (video && !prefersReduce) video.style.display = '';
      }
    }
    handleResize();
    window.addEventListener('resize', handleResize);
  </script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>