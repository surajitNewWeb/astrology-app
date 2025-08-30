<?php
// Include navbar
require_once __DIR__ . '/includes/navbar.php';
?>

<style>
/* --- BASE --- */
body {
    margin: 0;
    font-family: 'Segoe UI', Roboto, Arial, sans-serif;
    background: #0a0e1a;
    color: #f8fafc;
}
a { text-decoration: none; }

/* --- HERO --- */
.hero {
    position: relative;
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
#bg-video {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.35) contrast(1.1) saturate(1.2);
    z-index: 0;
}
.hero-overlay {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.05), transparent 70%);
    z-index: 1;
    pointer-events: none;
}
.hero-panel {
    position: relative;
    z-index: 2;
    max-width: 1080px;
    width: calc(100% - 48px);
    background: rgba(255, 255, 255, 0.05);
    border-radius: 25px;
    padding: 36px;
    display: flex;
    gap: 32px;
    align-items: center;
    box-shadow: 0 25px 50px rgba(0,0,0,0.5);
    border: 1px solid rgba(255,215,0,0.3);
    backdrop-filter: blur(16px) saturate(180%);
}
.hero-left { flex: 1; }
.hero-right { width: 320px; display: flex; align-items: center; justify-content: center; }
.gradient-text {
    font-size: clamp(28px, 3.5vw, 44px);
    font-weight: 800;
    line-height: 1.1;
    background: linear-gradient(135deg,#ffd700,#ffec8b);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 5px 15px rgba(0,0,0,0.5);
}
.hero p.lead { color: #cbd5e1; font-size: 1.05rem; margin: 12px 0 18px; }
.cta-row { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 12px; }
.btn-cta { padding: 12px 28px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; transition: 0.3s; }
.btn-primary { background: #ffd70000; color: #ffffff; border: 2px solid #ffcb00; }
.btn-outline { background: transparent; border: 2px solid #ffd700; color: #ffd700; }
.btn-solid { background: #1a1f2e; border: 2px solid #ffd700; color: #ffd700; }
.btn-cta:hover { transform: translateY(-3px); box-shadow: 0 12px 35px rgba(255,215,0,0.4); }
.panel-card { background: rgba(255,255,255,0.08); border-radius:20px; padding:25px; backdrop-filter:blur(10px); border:1px solid rgba(255,215,0,0.3); transition:transform 0.4s ease;}
.panel-card:hover { transform:translateY(-5px); box-shadow:0 15px 40px rgba(255,215,0,0.4);}
.quick-features { display:flex; gap:18px; flex-wrap:wrap; color:#ffd700; margin-top:16px; }

/* --- MAIN --- */
main { max-width:1200px; margin:0 auto; padding:60px 20px; }
.section-title { text-align:center; font-size:2rem; font-weight:700; margin-bottom:40px; color:white; }
.grid-3 { display:grid; gap:24px; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); }
.feature { background:#111827; border-radius:16px; padding:28px; text-align:center; border:1px solid rgba(255,255,255,0.05); transition:all 0.3s ease;}
.feature:hover { transform:translateY(-8px); box-shadow:0 20px 50px rgba(255,215,0,0.4); border-color:#ffd700;}
.feature img { width:100%; height:200px; object-fit:cover; border-radius:12px; margin-bottom:12px;}
.feature h5 { color:#ffd700; font-weight:700; margin-bottom:8px;}
.feature p { color:#cbd5e1; font-size:0.95rem; }

/* --- TESTIMONIALS --- */
.testimonials { padding:60px 20px; text-align:center; background:#101829; color:white; border-radius:20px; margin:60px 0; border:1px solid rgba(255,215,0,0.2);}
.testimonial-card { background:#111827; border:1px solid rgba(255,215,0,0.2); border-radius:16px; padding:24px; margin:10px; backdrop-filter:blur(10px); transition: transform 0.3s ease;}
.testimonial-card:hover { transform:translateY(-5px);}
.testimonial-card p { font-style:italic; color:rgba(255,255,255,0.95);}
.testimonial-card strong { display:block; margin-top:8px; color:#ffd700; }

/* --- BLOG --- */
.blog-grid { display:grid; gap:24px; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); }
.blog-card { background:#111827; border-radius:16px; overflow:hidden; transition:all 0.3s ease; border:1px solid rgba(255,255,255,0.05);}
.blog-card:hover { transform:translateY(-8px); border-color:#ffd700; box-shadow:0 15px 40px rgba(255,215,0,0.3);}
.blog-card img { width:100%; height:180px; object-fit:cover; }
.blog-card-body { padding:20px; }
.blog-card-body h6 { color:#ffd700; font-weight:700; margin-bottom:8px; }
.blog-card-body p { font-size:0.95rem; color:#cbd5e1; }

/* --- ZODIAC --- */
.zodiac-strip { display:grid; grid-template-columns:repeat(4,1fr); gap:20px; margin-top:20px; }
.zodiac-item { background:#111827; padding:16px; border-radius:16px; text-align:center; transition: all 0.3s ease; border:1px solid rgba(255,255,255,0.05);}
.zodiac-item:hover { transform:scale(1.05); box-shadow:0 15px 40px rgba(255,215,0,0.4); border-color:#ffd700;}
.zodiac-item img { width:100%; height:200px; object-fit:cover; border-radius:12px; margin-bottom:8px; }

/* --- SUBSCRIBE --- */
.subscribe-section { background:#111827; padding:60px 20px; border-radius:20px; color:white; margin:60px 0; text-align:center; border:1px solid rgba(255,215,0,0.2);}
.subscribe-section h2 { margin-bottom:12px; color:#ffd700;}
.subscribe-section p { margin-bottom:24px; color:rgba(255,255,255,0.9);}
.subscribe-form { display:flex; justify-content:center; flex-wrap:wrap; gap:12px;}
.subscribe-form input { padding:14px 18px; border-radius:12px; border:1px solid rgba(255,215,0,0.3); background:#0a0e1a; color:white; flex:1; min-width:250px; max-width:350px;}
.subscribe-form button { padding:14px 28px; border-radius:12px; border:none; font-weight:700; cursor:pointer; background:#ffd70000; color:#ffffff; border:2px solid #ffcb00;}
.subscribe-form button:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(255,223,0,0.4); }

/* --- FOOTER --- */
footer { padding:32px 20px; text-align:center; color:#94a3b8; font-size:0.95rem; background:#0a0e1a; border-top:1px solid rgba(255,255,255,0.05);}
footer a { color:#ffd700; transition:0.3s; }
footer a:hover { color:white; }

/* --- RESPONSIVE --- */
@media(max-width:992px){.hero-panel{flex-direction:column;gap:20px;}.hero-right{width:100%;}}
@media(max-width:560px){.hero{min-height:56vh;padding:48px 0;}.hero-left{text-align:center;}.quick-features{justify-content:center;}}
@media(max-width:768px){.zodiac-strip{grid-template-columns:repeat(2,1fr);}}
@media(max-width:480px){.zodiac-strip{grid-template-columns:1fr;}}
</style>

<!-- HERO -->
<section class="hero">
<video id="bg-video" autoplay muted loop playsinline poster="./public/assets/images/hero-poster.jpg">
    <source src="./public/assets/videos/hero2.mp4" type="video/mp4">
</video>
<div class="hero-overlay"></div>
<div class="hero-panel container">
<div class="hero-left">
    <h1 class="gradient-text">Discover Your Cosmic Path — Daily Guidance & Natal Charts</h1>
    <p class="lead">Fast personalized horoscopes, accurate birth charts, and compatibility reports — made simple & beautiful.</p>
    <div class="cta-row">
        <button class="btn-cta btn-primary" onclick="location.href='horoscope.php'">Get My Horoscope</button>
        <button class="btn-cta btn-outline" onclick="location.href='kundli.php'">Generate Kundli</button>
        <button class="btn-cta btn-solid" onclick="location.href='matchmaking.php'">Matchmaking</button>
    </div>
    <div class="quick-features">
        <div>✨ Daily updates</div>
        <div>📜 Accurate charts</div>
        <div>💞 Compatibility</div>
    </div>
</div>
<div class="hero-right">
    <div class="panel-card">
        <h4 style="color:#ffd700;">Today's Highlights</h4>
        <p><strong>Lucky Color:</strong> Teal · <strong>Lucky Number:</strong> 7</p>
        <p style="margin-top:10px; font-size:0.95rem;">Quick insight: Favor conversations and new ideas — the moon supports clarity.</p>
    </div>
</div>
</div>
</section>

<!-- FEATURES -->
<main id="main">
<h2 class="section-title">Our Features 🔮</h2>
<div class="grid-3">
<div class="feature"><img src="./public/assets/images/horoscope.jpg" alt="Horoscope"><h5>Daily Horoscope</h5><p>Accurate & personalized predictions updated every day.</p></div>
<div class="feature"><img src="./public/assets/images/kundali.jpg" alt="Kundli"><h5>Kundli Generator</h5><p>Generate detailed birth charts with planetary insights.</p></div>
<div class="feature"><img src="./public/assets/images/matchmaking.jpg" alt="Love"><h5>Matchmaking</h5><p>Check compatibility & love predictions instantly.</p></div>
</div>

<!-- TESTIMONIALS -->
<section class="testimonials">
<h2 class="section-title">What People Say ✨</h2>
<div class="d-flex flex-wrap justify-content-center">
<div class="testimonial-card col-md-3"><p>"AstroGuide gave me clarity about my career choices. Spot on!"</p><strong>– Priya, Mumbai</strong></div>
<div class="testimonial-card col-md-3"><p>"The Kundli generator is beautiful & accurate. Love the design!"</p><strong>– Rahul, Delhi</strong></div>
<div class="testimonial-card col-md-3"><p>"The love compatibility feature was fun and surprisingly true 😍."</p><strong>– Ayesha, Dubai</strong></div>
</div>
</section>

<!-- BLOG -->
<h2 class="section-title">Astrology Insights 📝</h2>
<div class="blog-grid">
<div class="blog-card"><img src="./public/assets/images/moonsign.jpg" alt="Moon Sign"><div class="blog-card-body"><h6>5 Things to Know About Your Moon Sign</h6><p>Understanding your emotions & inner self through moon placement.</p></div></div>
<div class="blog-card"><img src="./public/assets/images/Astrology.jpg" alt="Astro Tips"><div class="blog-card-body"><h6>Astrology & Career Choices</h6><p>Which zodiac signs thrive in leadership, creativity, or service roles?</p></div></div>
<div class="blog-card"><img src="./public/assets/images/Love.jpg" alt="Love"><div class="blog-card-body"><h6>Love & Compatibility in 2025</h6><p>Check which signs are most aligned for long-term relationships this year.</p></div></div>
</div>

<!-- ZODIAC STRIP -->
<h2 class="section-title">Zodiac Signs ♈</h2>
<div class="zodiac-strip">
<?php
$zodiacs = ["aries"=>"Aries","taurus"=>"Taurus","gemini"=>"Gemini","cancer"=>"Cancer","leo"=>"Leo","virgo"=>"Virgo","libra"=>"Libra","scorpio"=>"Scorpio","sagittarius"=>"Sagittarius","capricorn"=>"Capricorn","aquarius"=>"Aquarius","pisces"=>"Pisces"];
foreach($zodiacs as $file=>$name){
    echo "<div class='zodiac-item'><img src='./public/assets/images/zodiac-icons/$file.jpg' alt='$name'><div><strong style='color:#ffd700;'>$name</strong></div></div>";
}
?>
</div>

<!-- SUBSCRIBE -->
<section class="subscribe-section">
<h2>Subscribe to AstroGuide Newsletter ✨</h2>
<p>Get weekly horoscope updates, astrology tips & cosmic insights directly to your inbox.</p>
<form class="subscribe-form" action="#" method="POST">
<input type="email" name="email" placeholder="Enter your email" required>
<button type="submit">Subscribe</button>
</form>
</section>

</main>

<!-- FOOTER -->
<?php require_once __DIR__ . '/includes/footer.php'; ?>
