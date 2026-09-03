<?php ob_start(); ?>

<style>
.about-page {
  --orange:#f45b0b;
  --orange2:#ff7a18;
  --orange-light:#fff2e9;
  --orange-line:#ffd8c0;
  --navy:#101a33;
  --blue:#1684dc;
  --green:#16a05a;
  --text:#172033;
  --muted:#66758b;
  --line:#e3e9f0;
  --white:#fff;
  --page:#f7f9fc;
  --shadow:0 18px 45px rgba(16,26,51,.10);
  margin: -1.5rem -1.25rem -5rem -1.25rem;
  background: var(--page);
  color: var(--text);
  font-family: 'Plus Jakarta Sans', Inter, system-ui, sans-serif;
}

/* Intro Hero */
.about-page .hero {
  background:
    radial-gradient(circle at 18% 5%,rgba(244,91,11,.08),transparent 28%),
    radial-gradient(circle at 85% 15%,rgba(22,132,220,.07),transparent 30%),#fff;
  padding:54px 20px 42px;
  text-align:center;
  border-bottom:1px solid #eef2f6;
}
.about-page .hero-inner{max-width:850px;margin:auto}
.about-page .eyebrow {
  display:inline-flex;align-items:center;gap:7px;padding:7px 14px;border-radius:999px;
  background:var(--orange-light);border:1px solid var(--orange-line);
  color:#ca4c0a;text-transform:uppercase;letter-spacing:1px;font-size:9px;font-weight:900;
}
.about-page .hero h1{margin:17px 0 12px;color:var(--navy);font-size:clamp(38px,5vw,57px);line-height:1.03;letter-spacing:-2.5px;font-weight:900}
.about-page .hero h1 span{color:var(--orange)}
.about-page .hero p{max-width:650px;margin:auto;color:var(--muted);font-size:14px;line-height:1.65}
.about-page .hero-actions{display:flex;gap:12px;justify-content:center;margin-top:24px}
.about-page .hero-btn{border:0;background:var(--orange);color:#fff;border-radius:11px;padding:12px 22px;font-size:12px;font-weight:850;box-shadow:0 8px 20px rgba(244,91,11,.2);transition:.2s;text-decoration:none;display:inline-block}
.about-page .hero-btn:hover{background:#e04f03;transform:translateY(-1px);color:#fff}
.about-page .hero-btn-outline{border:1px solid var(--line);background:#fff;color:var(--navy);border-radius:11px;padding:12px 22px;font-size:12px;font-weight:850;transition:.2s;text-decoration:none;display:inline-block}
.about-page .hero-btn-outline:hover{border-color:var(--orange);color:var(--orange)}

/* Slider Section */
.about-page .slider-section{background:#fff;padding:24px 20px 72px}
.about-page .slider{max-width:980px;margin:auto}
.about-page .slider-window{
  position:relative;overflow:hidden;border:1px solid var(--line);
  border-radius:22px;background:#fff;box-shadow:var(--shadow)
}
.about-page .slides{display:flex;transition:transform .7s cubic-bezier(.22,.75,.2,1)}
.about-page .slide{min-width:100%;display:grid;grid-template-columns:1.05fr .95fr;min-height:350px}

/* Left Panel */
.about-page .slide-copy{
  padding:45px 48px;background:#fff;display:flex;
  flex-direction:column;justify-content:center
}
.about-page .slide-number{color:var(--orange);font-size:9px;font-weight:900;letter-spacing:1.2px;text-transform:uppercase;margin-bottom:9px}
.about-page .slide-copy h2{margin:0 0 12px;color:var(--navy);font-size:30px;line-height:1.08;letter-spacing:-1.35px;font-weight:900}
.about-page .slide-copy p{max-width:470px;margin:0;color:var(--muted);font-size:12px;line-height:1.7}
.about-page .slide-copy ul{list-style:none;padding:0;margin:17px 0 0;display:grid;gap:7px}
.about-page .slide-copy li{color:#526076;font-size:10px;font-weight:600}
.about-page .slide-copy li::before{content:"✓";color:var(--green);font-weight:900;margin-right:7px}

/* Right Visual */
.about-page .slide-art{
  min-height:350px;position:relative;overflow:hidden;display:flex;
  align-items:center;justify-content:center;
  background:
    radial-gradient(circle at 50% 40%,rgba(22,132,220,.14),transparent 24%),
    radial-gradient(circle at 50% 60%,rgba(244,91,11,.06),transparent 42%),
    linear-gradient(145deg,#eef8ff 0%,#fff 54%,#fff7f1 100%)
}
.about-page .slide-art::before{
  content:"";position:absolute;inset:0;opacity:.48;
  background-image:linear-gradient(rgba(22,132,220,.05) 1px,transparent 1px),
                   linear-gradient(90deg,rgba(22,132,220,.05) 1px,transparent 1px);
  background-size:34px 34px
}
.about-page .orbit{
  position:absolute;width:340px;height:110px;border:1px solid rgba(22,132,220,.2);
  border-radius:50%;transform:rotate(-24deg)
}
.about-page .orbit.two{width:370px;height:120px;border-color:rgba(244,91,11,.15);transform:rotate(27deg)}
.about-page .rp-core{
  position:relative;z-index:3;width:76px;height:76px;border-radius:18px;
  display:grid;place-items:center;color:#fff;font-size:21px;font-weight:950;
  background:linear-gradient(145deg,#EA580C,#C2410C);
  border:4px solid rgba(255,255,255,.85);
  box-shadow:0 18px 35px rgba(234,88,12,.27),0 0 0 12px rgba(234,88,12,.06)
}
.about-page .float-card{
  position:absolute;z-index:4;min-width:100px;padding:9px 12px;border-radius:9px;
  background:#fff;border:1px solid var(--line);box-shadow:0 12px 28px rgba(16,26,51,.13);
  color:var(--navy);font-size:8px;font-weight:900
}
.about-page .float-card small{display:block;margin-bottom:3px;color:#98a3b3;font-size:7px;font-weight:800;letter-spacing:.5px}
.about-page .float-card.orange{left:10%;top:22%;border-left:3px solid var(--orange)}
.about-page .float-card.blue{right:9%;top:14%;border-left:3px solid var(--blue)}
.about-page .float-card.green{right:14%;bottom:18%;border-left:3px solid var(--green)}

/* COURIER ROAD + ANIMATED VAN */
.about-page .road-scene{
  position:absolute;
  left:0;right:0;bottom:0;height:94px;
  z-index:2;overflow:hidden;
}
.about-page .road-glow{
  position:absolute;left:0;right:0;bottom:30px;height:48px;
  background:linear-gradient(180deg,transparent,rgba(22,132,220,.035))
}
.about-page .road{
  position:absolute;left:-5%;right:-5%;bottom:13px;height:42px;
  background:#dfe5ec;
  border-top:2px solid #c9d2dd;
  border-bottom:2px solid #c9d2dd;
  transform:skewY(-2deg);
}
.about-page .road::before{
  content:"";position:absolute;left:0;right:0;top:18px;height:4px;
  background:repeating-linear-gradient(90deg,var(--orange) 0 34px,transparent 34px 68px);
  opacity:.9;
}
.about-page .road-edge{
  position:absolute;left:0;right:0;bottom:0;height:13px;background:#eef2f5;
}
.about-page .road-line{
  position:absolute;left:0;right:0;bottom:7px;height:2px;background:#fff
}

/* Van */
.about-page .van{
  position:absolute;z-index:6;bottom:37px;left:-130px;
  width:116px;height:47px;
  animation:drive 6s linear infinite;
  filter:drop-shadow(0 9px 7px rgba(16,26,51,.16));
}
.about-page .van-body{
  position:absolute;left:0;bottom:8px;width:83px;height:34px;
  border-radius:7px 5px 4px 5px;
  background:linear-gradient(180deg,#fff,#f2f5f8);
  border:2px solid #cbd5df;
}
.about-page .van-cab{
  position:absolute;right:0;bottom:8px;width:42px;height:30px;
  background:linear-gradient(180deg,#fff,#eef2f6);
  border:2px solid #cbd5df;border-left:0;
  border-radius:3px 9px 4px 3px;
}
.about-page .van-window{
  position:absolute;right:5px;top:5px;width:26px;height:13px;
  background:#ccecff;border:1px solid #9ccbea;
  border-radius:3px 6px 2px 2px
}
.about-page .van-stripe{
  position:absolute;left:4px;top:14px;width:73px;height:7px;
  background:var(--orange);border-radius:2px
}
.about-page .van-logo{
  position:absolute;left:10px;top:3px;font-size:7px;font-weight:950;color:var(--navy);
  letter-spacing:.3px
}
.about-page .van-wheel{
  position:absolute;bottom:0;width:18px;height:18px;border-radius:50%;
  background:#172033;border:4px solid #b8c1cb
}
.about-page .w1{left:13px}.about-page .w2{right:13px}
.about-page .wheel-inner{width:5px;height:5px;border-radius:50%;background:#e6ebf0;position:absolute;left:2px;top:2px}
@keyframes drive{
  0%{left:-135px}
  45%{left:42%}
  100%{left:110%}
}

/* Motion trail */
.about-page .motion{
  position:absolute;z-index:5;bottom:55px;left:0;width:80px;height:2px;
  background:linear-gradient(90deg,transparent,rgba(244,91,11,.35));
  animation:trail 6s linear infinite
}
@keyframes trail{
  0%{left:-80px;opacity:0}
  35%{opacity:1}
  50%{left:42%;opacity:0}
  100%{left:100%;opacity:0}
}

/* Slider Controls */
.about-page .slider-controls{margin-top:16px;display:flex;align-items:center;justify-content:center}
.about-page .dots{display:flex;align-items:center;gap:6px}
.about-page .dot{
  width:23px;height:4px;padding:0;border:0;border-radius:10px;
  background:#dbe3ec;transition:.25s;cursor:pointer
}
.about-page .dot.active{width:36px;background:var(--orange)}

/* Mission Section */
.about-page .mission{background:#f3f7fb;padding:75px 20px}
.about-page .mission-inner{max-width:980px;margin:auto}
.about-page .center{text-align:center}
.about-page .center h2{color:var(--navy);font-size:32px;letter-spacing:-1.4px;margin:12px 0 5px;font-weight:900}
.about-page .center p{color:var(--muted);font-size:13px}
.about-page .cards{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-top:28px}
.about-page .card{background:#fff;border:1px solid var(--line);border-radius:16px;padding:20px;transition:.2s}
.about-page .card:hover{transform:translateY(-3px);box-shadow:0 12px 30px rgba(16,26,51,.08)}
.about-page .card-icon{width:36px;height:36px;display:grid;place-items:center;border-radius:10px;background:var(--orange-light);color:var(--orange);font-weight:900;margin-bottom:13px;font-size:15px}
.about-page .card h3{margin:0 0 6px;color:var(--navy);font-size:13px;font-weight:800}
.about-page .card p{margin:0;color:var(--muted);font-size:11px;line-height:1.6}

/* CTA Footer Section */
.about-page .cta-section{background:#fff;padding:60px 20px;border-top:1px solid var(--line)}
.about-page .cta-box{max-width:980px;margin:auto;background:linear-gradient(135deg,#FFF7ED,#FFFFFF);border:1px solid #FFEDD5;border-radius:20px;padding:32px 40px;display:flex;justify-content:space-between;align-items:center;box-shadow:0 10px 30px rgba(234,88,12,0.06)}
.about-page .cta-box h2{font-size:24px;font-weight:900;color:var(--navy);margin:0 0 6px}
.about-page .cta-box p{font-size:12px;color:var(--muted);margin:0}

@media(max-width:800px){
  .about-page .slide{grid-template-columns:1fr}
  .about-page .slide-art{min-height:285px;order:-1}
  .about-page .slide-copy{padding:32px}
  .about-page .cards{grid-template-columns:1fr 1fr}
  .about-page .cta-box{flex-direction:column;align-items:flex-start;gap:20px}
}
@media(max-width:520px){
  .about-page .hero{padding:40px 16px 28px}.about-page .hero h1{font-size:39px;letter-spacing:-2px}
  .about-page .slider-section{padding:10px 12px 55px}.about-page .slider-window{border-radius:18px}
  .about-page .slide-art{min-height:245px}
  .about-page .slide-copy{padding:27px 22px}.about-page .slide-copy h2{font-size:25px}
  .about-page .rp-core{width:64px;height:64px;font-size:18px}
  .about-page .orbit{width:280px}.about-page .float-card{transform:scale(.88)}
  .about-page .van{transform:scale(.82);transform-origin:bottom left}
  .about-page .mission{padding:55px 16px}.about-page .cards{grid-template-columns:1fr}
}
</style>

<div class="about-page">
  <!-- Intro Hero -->
  <section class="hero">
    <div class="hero-inner">
      <div class="eyebrow">About RushParcel</div>
      <h1>We move <span>what matters.</span></h1>
      <p>Architected for Modern UK Logistics — Modern logistics built around reliable delivery, clear communication and a better customer experience.</p>
      <div class="hero-actions">
        <a href="<?= url('/services') ?>" class="hero-btn">Explore Services &rarr;</a>
        <a href="<?= url('/quote') ?>" class="hero-btn-outline">Get Instant Quote</a>
      </div>
    </div>
  </section>

  <!-- Interactive Story Slider -->
  <section class="slider-section">
    <div class="slider">
      <div class="slider-window">
        <div class="slides" id="slides">

          <!-- SLIDE 1 -->
          <article class="slide">
            <div class="slide-copy">
              <div class="slide-number">01 / The Future</div>
              <h2>Logistics should keep getting smarter.</h2>
              <p>We are building a technology-led courier experience that removes unnecessary friction from modern delivery operations — without losing the human experience.</p>
              <ul>
                <li>Clearer delivery visibility</li>
                <li>Smarter operational workflows</li>
                <li>Technology-led infrastructure</li>
              </ul>
            </div>

            <div class="slide-art">
              <div class="orbit"></div>
              <div class="orbit two"></div>
              <div class="rp-core">RP</div>

              <div class="float-card orange"><small>BUILT AROUND</small>TRUST + SPEED</div>
              <div class="float-card blue"><small>CONNECTED</small>ONE NETWORK</div>
              <div class="float-card green"><small>DESIGNED FOR</small>DIGITAL FIRST</div>

              <div class="road-scene">
                <div class="road-glow"></div>
                <div class="road"></div>
                <div class="road-edge"></div>
                <div class="road-line"></div>
                <div class="motion"></div>

                <div class="van" aria-label="RushParcel courier van">
                  <div class="van-body">
                    <div class="van-logo">RUSHPARCEL</div>
                    <div class="van-stripe"></div>
                  </div>
                  <div class="van-cab"><div class="van-window"></div></div>
                  <div class="van-wheel w1"><span class="wheel-inner"></span></div>
                  <div class="van-wheel w2"><span class="wheel-inner"></span></div>
                </div>
              </div>
            </div>
          </article>

          <!-- SLIDE 2 -->
          <article class="slide">
            <div class="slide-copy">
              <div class="slide-number">02 / The Network</div>
              <h2>Connected delivery, without the complexity.</h2>
              <p>RushParcel brings customers, businesses and delivery operations together through one simple, connected experience.</p>
              <ul>
                <li>One connected delivery platform</li>
                <li>Simple customer communication</li>
                <li>Visibility from collection to delivery</li>
              </ul>
            </div>

            <div class="slide-art">
              <div class="orbit"></div>
              <div class="orbit two"></div>
              <div class="rp-core">RP</div>

              <div class="float-card orange"><small>CONNECTED</small>ONE PLATFORM</div>
              <div class="float-card blue"><small>VISIBLE</small>EVERY STEP</div>
              <div class="float-card green"><small>BUILT FOR</small>BUSINESS</div>

              <div class="road-scene">
                <div class="road-glow"></div>
                <div class="road"></div>
                <div class="road-edge"></div>
                <div class="road-line"></div>
                <div class="motion"></div>

                <div class="van" aria-label="RushParcel courier van">
                  <div class="van-body">
                    <div class="van-logo">RUSHPARCEL</div>
                    <div class="van-stripe"></div>
                  </div>
                  <div class="van-cab"><div class="van-window"></div></div>
                  <div class="van-wheel w1"><span class="wheel-inner"></span></div>
                  <div class="van-wheel w2"><span class="wheel-inner"></span></div>
                </div>
              </div>
            </div>
          </article>

          <!-- SLIDE 3 -->
          <article class="slide">
            <div class="slide-copy">
              <div class="slide-number">03 / The Experience</div>
              <h2>Better technology. Better delivery.</h2>
              <p>Every part of the experience is designed around making delivery easier to understand, easier to manage and easier to trust.</p>
              <ul>
                <li>Customer-first experience</li>
                <li>Reliable operational systems</li>
                <li>Clear information at every stage</li>
              </ul>
            </div>

            <div class="slide-art">
              <div class="orbit"></div>
              <div class="orbit two"></div>
              <div class="rp-core">RP</div>

              <div class="float-card orange"><small>EXPERIENCE</small>CUSTOMER FIRST</div>
              <div class="float-card blue"><small>TECHNOLOGY</small>SMARTER TOOLS</div>
              <div class="float-card green"><small>DELIVERY</small>BUILT BETTER</div>

              <div class="road-scene">
                <div class="road-glow"></div>
                <div class="road"></div>
                <div class="road-edge"></div>
                <div class="road-line"></div>
                <div class="motion"></div>

                <div class="van" aria-label="RushParcel courier van">
                  <div class="van-body">
                    <div class="van-logo">RUSHPARCEL</div>
                    <div class="van-stripe"></div>
                  </div>
                  <div class="van-cab"><div class="van-window"></div></div>
                  <div class="van-wheel w1"><span class="wheel-inner"></span></div>
                  <div class="van-wheel w2"><span class="wheel-inner"></span></div>
                </div>
              </div>
            </div>
          </article>

        </div>
      </div>

      <!-- Slider Controls (Dots Only) -->
      <div class="slider-controls">
        <div class="dots" aria-label="Slider position">
          <button class="dot active" aria-label="Slide 1"></button>
          <button class="dot" aria-label="Slide 2"></button>
          <button class="dot" aria-label="Slide 3"></button>
        </div>
      </div>
    </div>
  </section>

  <!-- Mission Section -->
  <section class="mission">
    <div class="mission-inner">
      <div class="center">
        <div class="eyebrow">Our Mission</div>
        <h2>Technology that makes logistics feel human.</h2>
        <p>Reliable operations with a modern digital experience.</p>
      </div>
      <div class="cards">
        <div class="card">
          <div class="card-icon">✓</div>
          <h3>Customer First</h3>
          <p>Clear and useful information at every stage of the delivery journey.</p>
        </div>
        <div class="card">
          <div class="card-icon">↗</div>
          <h3>Smart Technology</h3>
          <p>Digital tools designed to make logistics easier to manage.</p>
        </div>
        <div class="card">
          <div class="card-icon">◆</div>
          <h3>Reliable Delivery</h3>
          <p>Dependable delivery operations supported by better visibility.</p>
        </div>
        <div class="card">
          <div class="card-icon">⚡</div>
          <h3>Built for Business</h3>
          <p>Flexible logistics experiences designed around real business needs.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action Section -->
  <section class="cta-section">
    <div class="cta-box">
      <div>
        <h2>Ready to ship with RushParcel?</h2>
        <p>Get a instant quote or explore our nationwide courier delivery services today.</p>
      </div>
      <a href="<?= url('/quote') ?>" class="hero-btn">Get an Instant Quote &rarr;</a>
    </div>
  </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const slides = document.getElementById("slides");
  const dots = [...document.querySelectorAll(".about-page .dot")];
  let current = 0;
  const total = dots.length;
  const intervalTime = 6500;
  let autoplay;

  function renderSlide(){
    if (slides) {
      slides.style.transform = `translateX(-${current * 100}%)`;
    }
    dots.forEach((dot, i) => dot.classList.toggle("active", i === current));
  }

  dots.forEach((dot, i) => {
    dot.addEventListener("click", () => {
      current = i;
      renderSlide();
      restartAutoplay();
    });
  });

  function startAutoplay(){
    autoplay = setInterval(() => {
      current = (current + 1) % total;
      renderSlide();
    }, intervalTime);
  }

  function restartAutoplay(){
    clearInterval(autoplay);
    startAutoplay();
  }

  startAutoplay();

  const sliderWindow = document.querySelector('.about-page .slider-window');
  if (sliderWindow) {
    sliderWindow.addEventListener('mouseenter', () => clearInterval(autoplay));
    sliderWindow.addEventListener('mouseleave', startAutoplay);
  }
});
</script>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
