<footer class="footer mt-5">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<div class="container">
    <div class="row">
        <!-- Logo & About -->
        <div class="col-md-4 mb-4">
            <a href="<?=$base?>/index.php" class="footer-logo"> <img class="logo" src="<?=$base?>/public/assets/images/astrology_logo1.png" alt="logo">Astro-Guide</a>
            <p class="mt-3">Your trusted partner for Astrology, Matchmaking, Kundli, Panchang, and future insights. 🌠</p>
            <div class="social-icons mt-3">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-youtube"></i></a>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="col-md-2 mb-4">
            <h5>Quick Links</h5>
            <ul class="list-unstyled">
                <li><a href="<?=$base?>/index.php">Home</a></li>
                <li><a href="<?=$base?>/public/about.php">About Us</a></li>
                <li><a href="<?=$base?>/public/services.php">Services</a></li>
                <li><a href="<?=$base?>/public/contact.php">Contact</a></li>
            </ul>
        </div>

        <!-- Services Links -->
        <div class="col-md-3 mb-4">
            <h5>Our Services</h5>
            <ul class="list-unstyled">
                <li><a href="<?=$base?>/public/horoscope.php">Daily Horoscope</a></li>
                <li><a href="<?=$base?>/public/matchmaking.php">Matchmaking</a></li>
                <li><a href="<?=$base?>/public/panchang.php">Panchang</a></li>
                <li><a href="<?=$base?>/public/birthchart.php">Birth Chart</a></li>
                <li><a href="<?=$base?>/public/dosha.php">Dosha Analysis</a></li>
            </ul>
        </div>

        <!-- Newsletter / Subscribe -->
        <div class="col-md-3 mb-4">
            <h5>Subscribe</h5>
            <p>Get astrology updates, predictions & special offers in your inbox ✨</p>
            <form class="footer-subscribe d-flex">
                <input type="email" class="form-control me-2 mb-2 mb-sm-0" placeholder="Your Email" required>
                <button type="submit" class="btn btn-warning fw-bold">Subscribe</button>
            </form>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="footer-bottom mt-4 pt-3 border-top text-center">
        <p>© <?=date('Y')?> <strong>AstroGuide</strong>. All Rights Reserved. | Designed with ❤️ by Team AstroGuide</p>
    </div>
</div>

<style>
.footer {
    background: linear-gradient(180deg, #4415a2, #1a1a1a);
    color: #e5e5e5;
    padding: 60px 20px 20px;
    box-shadow: 0 -4px 20px rgba(0,0,0,0.4);
}
.footer-logo {
    font-size: 28px;
    font-weight: bold;
    color: #fbbf24;
    text-decoration: none;
}
.footer-logo:hover { color: #fff; }
.footer p { color: #cfcfcf; }
.footer a { color: #ddd; text-decoration: none; transition: 0.3s; }
.footer a:hover { color: #fbbf24; text-shadow: 0 0 6px rgba(251,191,36,0.6); }
.footer h5 { font-weight: bold; margin-bottom: 20px; color: #fbbf24; letter-spacing: 0.5px; }
.footer .social-icons a {
    font-size: 20px; margin-right: 12px; color: #fbbf24; border: 1px solid #fbbf24; border-radius: 50%;
    width: 38px; height: 38px; display: inline-flex; align-items: center; justify-content: center; transition: 0.3s;
}
.footer .social-icons a:hover {
    background: #fbbf24; color: #1a1a1a; transform: scale(1.15); box-shadow: 0 0 12px rgba(251,191,36,0.7);
}

/* Subscribe */
.footer-subscribe input.form-control {
    flex: 1 1 auto; min-width: 150px;
    border-radius: 30px 0 0 30px;
    border: 1px solid #fbbf24;
    padding: 10px 15px;
    background: #1f1f1f;
    color: #fff;
}
.footer-subscribe button {
    border-radius: 0 30px 30px 0; border: none; padding: 10px 20px; background: #fbbf24; color: #1a1a1a; font-weight: bold;
    transition: 0.3s;
}
.footer-subscribe button:hover {
    background: #f59e0b; color: #fff; box-shadow: 0 0 10px rgba(251,191,36,0.6);
}

.footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 15px; font-size: 14px; color: #aaa; }

/* Responsive */
@media(max-width:576px){
    .footer-subscribe { flex-direction: column; }
    .footer-subscribe input.form-control { border-radius: 30px 30px 0 0; width: 100%; margin-bottom: 8px; }
    .footer-subscribe button { border-radius: 0 0 30px 30px; width: 100%; }
    .footer .col-md-4, .footer .col-md-3, .footer .col-md-2 { margin-bottom: 30px; }
}
</style>

<script src="<?=$base?>/public/assets/js/bootstrap.bundle.min.js"></script>
</footer>
