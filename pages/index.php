<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>AstroGuide — Home</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <style>
    :root {
      --bg: #fafafa;
      --surface: #ffffff;
      --primary: #3b2d6e;
      /* deep purple */
      --accent: #ffd166;
      --accent1: #ff6ec7;
      --muted: #bfbfbf;
      --sky: #8ec5fc;
      /* warm accent */
      --muted: #6b6b6b;
      --glass-bg: rgba(255, 255, 255, 0.06);
      --glass-border: rgba(255, 255, 255, 0.08);
    }

    /* base */
    html,
    body {
      height: 100%;
    }

    body {
      margin: 0;
      font-family: "Segoe UI", Roboto, -apple-system, Arial, sans-serif;
      background: linear-gradient(135deg, #e0c3fc, #8ec5fc, #ffd166);
      color: #222;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
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
      background: #111;
      color: #fff;
      border-radius: 4px;
    }

    /* header / navbar wrapper (transparent glass look) */
    header {
      position: sticky;
      top: 0;
      z-index: 60;
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(6px);
      box-shadow: 0 6px 18px rgba(20, 20, 40, 0.06);
    }

    header .container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 20px;
    }

    .brand {
      font-weight: 700;
      color: var(--primary);
      font-size: 1.15rem;
      letter-spacing: 0.2px;
      text-decoration: none;
    }

    nav .nav-link {
      color: #333;
      font-weight: 500;
      margin-left: 0.6rem;
    }

    nav .nav-link:hover {
      color: var(--primary);
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
      filter: brightness(0.55) saturate(1.05);
      transform-origin: center;
    }

    /* dim overlay (keeps text legible) */
    .hero-overlay {
      position: absolute;
      inset: 0;
      background: rgba(10, 12, 20, 0.28);
      z-index: 1;
    }

    /* transparent glass panel in center */
    .hero-panel {
      position: relative;
      z-index: 2;
      max-width: 1080px;
      width: calc(100% - 48px);
      margin: 0 auto;
      background: rgba(255, 255, 255, 0.06);
      /* subtle glass */
      border-radius: 14px;
      padding: 28px;
      display: flex;
      align-items: center;
      gap: 28px;
      box-shadow: 0 18px 40px rgba(10, 12, 20, 0.28);
      border: 1px solid rgba(255, 255, 255, 0.06);
      backdrop-filter: blur(8px) saturate(120%);
      color: #fff;
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
      color: #fff;
      text-shadow: 0 6px 20px rgba(5, 8, 20, 0.35);
    }

    .hero p.lead {
      margin: 0 0 18px 0;
      color: rgba(255, 255, 255, 0.95);
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
      padding: 10px 20px;
      border-radius: 10px;
      font-weight: 700;
      border: none;
      cursor: pointer;
      transition: transform .18s ease, box-shadow .18s ease;
      box-shadow: 0 8px 20px rgba(2, 6, 23, 0.25);
    }

    .btn-primary {
      background: var(--accent);
      color: #1b1430;
    }

    .btn-outline {
      background: transparent;
      color: #fff;
      border: 1px solid rgba(255, 255, 255, 0.14);
    }

    .btn-solid {
      background: var(--accent1);
      color: #1b1430;
    }

    .btn-cta:hover {
      transform: translateY(-4px);
      box-shadow: 0 14px 32px rgba(2, 6, 23, 0.32);
    }

    .quick-features {
      display: flex;
      gap: 20px;
      margin-top: 10px;
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
      color: var(--primary);
    }

    .grid-3 {
      display: grid;
      gap: 24px;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    }

    .feature {
      background: var(--surface);
      padding: 28px;
      border-radius: 14px;
      box-shadow: 0 10px 28px rgba(0, 0, 0, .08);
      transition: .25s;
      text-align: center;
    }

    .feature:hover {
      transform: translateY(-6px);
      box-shadow: 0 16px 40px rgba(0, 0, 0, .12);
    }

    .feature img {
      width: 60px;
      margin-bottom: 14px;
    }

    .feature h5 {
      color: var(--primary);
      font-weight: 700;
      margin-bottom: 6px;
    }

    /* Testimonials */
    .testimonials {
      padding: 60px 20px;
      text-align: center;
      background: linear-gradient(135deg, #3b2d6e, #1b1430);
      color: #fff;
      border-radius: 20px;
      margin: 60px 0;
    }

    .testimonial-card {
      background: rgba(255, 255, 255, .08);
      border: 1px solid rgba(255, 255, 255, .12);
      border-radius: 14px;
      padding: 20px;
      margin: 10px;
      backdrop-filter: blur(6px);
    }

    .testimonial-card p {
      font-style: italic;
      color: #f1f1f1;
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
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 8px 24px rgba(0, 0, 0, .08);
      transition: .25s;
    }

    .blog-card:hover {
      transform: translateY(-6px);
    }

    .blog-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .blog-card-body {
      padding: 16px;
    }

    .blog-card-body h6 {
      color: var(--primary);
      font-weight: 700;
      margin-bottom: 6px;
    }

    .blog-card-body p {
      font-size: .95rem;
      color: var(--muted);
    }

    /* Call to Action */
    .cta-band {
      margin: 80px 0;
      padding: 60px 20px;
      text-align: center;
      background: linear-gradient(135deg, var(--primary), #1b1430);
      color: #fff;
      border-radius: 20px;
    }

    .cta-band h2 {
      margin-bottom: 16px;
    }

    .cta-band .btn-cta {
      margin-top: 16px;
    }

    /* Zodiac */
    .zodiac-strip {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
      gap: 18px;
    }

    .zodiac-item {
      background: var(--surface);
      padding: 14px;
      border-radius: 12px;
      text-align: center;
      box-shadow: 0 6px 18px rgba(0, 0, 0, .06);
      transition: .25s;
    }

    .zodiac-item:hover {
      transform: scale(1.08);
      box-shadow: 0 10px 28px rgba(0, 0, 0, .1);
    }

    .zodiac-item img {
      width: 50px;
      margin-bottom: 8px;
    }

    /* footer */
    footer {
      padding: 32px 20px;
      text-align: center;
      color: var(--muted);
      font-size: 0.95rem;
    }

    /* responsiveness */
    @media (max-width: 992px) {
      .hero-panel {
        flex-direction: column;
        gap: 16px;
        padding: 20px;
      }

      .hero-right {
        width: 100%;
      }

      .zodiac-strip {
        grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
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
  <?php include __DIR__ . '/../shared/navbar.php'; ?>

  <!-- HERO with video -->
  <section class="hero" aria-label="Hero">
    <!-- background video (muted autoplay loop; include poster fallback) -->
    <video id="bg-video" autoplay muted loop playsinline poster="../assets/images/hero-poster.jpg" preload="auto"
      aria-hidden="true">
      <source src="../assets/videos/hero2.mp4" type="video/mp4">
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
          <h4>Today’s Highlights</h4>
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
        <img src="../assets/images/zodiac-icons/aries.png" alt="Horoscope">
        <h5>Daily Horoscope</h5>
        <p>Accurate & personalized predictions updated every single day.</p>
      </div>
      <div class="feature">
        <img src="../assets/images/zodiac-icons/chart.png" alt="Kundli">
        <h5>Kundli Generator</h5>
        <p>Generate detailed birth charts with planetary positions & insights.</p>
      </div>
      <div class="feature">
        <img src="../assets/images/zodiac-icons/love.png" alt="Love">
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
        <img src="../assets/images/blog1.jpg" alt="Zodiac Blog">
        <div class="blog-card-body">
          <h6>5 Things to Know About Your Moon Sign</h6>
          <p>Understanding your emotions & inner self through your moon placement.</p>
        </div>
      </div>
      <div class="blog-card">
        <img src="../assets/images/blog2.jpg" alt="Astro Tips">
        <div class="blog-card-body">
          <h6>Astrology & Career Choices</h6>
          <p>Which zodiac signs thrive in leadership, creativity, or service roles?</p>
        </div>
      </div>
      <div class="blog-card">
        <img src="../assets/images/blog3.jpg" alt="Love">
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
        echo "<div class='zodiac-item'><img src='../assets/images/zodiac-icons/$file.png' alt='$name'><div><strong>$name</strong></div></div>";
      }
    ?>
    </div>
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