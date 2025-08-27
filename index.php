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
  <link rel="stylesheet" href="./public/assets/css/style.css">
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