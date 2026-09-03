<?php ob_start(); ?>

<style>
.dropoff-page-scope {
  --navy:#101a33;
  --navy2:#09233f;
  --orange:#f45b0b;
  --orange2:#ff7618;
  --blue:#16a7ef;
  --green:#19a55b;
  --ink:#172033;
  --muted:#68778d;
  --line:#dfe7ef;
  --bg:#f6f9fc;
  --white:#fff;
  margin: -1.5rem -1.25rem 0 -1.25rem;
  background: var(--bg);
  color: var(--ink);
  font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}

.dropoff-page-scope * { box-sizing: border-box; }
.dropoff-page-scope a { text-decoration: none; color: inherit; }

.dropoff-page-scope .wrap {
  width: min(1100px, calc(100% - 36px));
  margin: auto;
}

/* HERO SLIDER SECTION */
.dropoff-page-scope .hero {
  position: relative;
  overflow: hidden;
  background: linear-gradient(135deg,#fff 0%,#f8fbfe 62%,#eef8fd 100%);
  padding: 34px 0 58px;
  border-bottom: 1px solid var(--line);
}
.dropoff-page-scope .hero:before {
  content: "";
  position: absolute;
  width: 440px;
  height: 440px;
  border-radius: 50%;
  right: -160px;
  top: -210px;
  background: rgba(22,167,239,.10);
}

.dropoff-page-scope .slider {
  position: relative;
  height: 455px;
  border-radius: 28px;
  overflow: hidden;
  background: #dfe7ef;
  box-shadow: 0 25px 55px rgba(16,26,51,.16);
}

.dropoff-page-scope .slide {
  position: absolute;
  inset: 0;
  opacity: 0;
  animation: fade 15s infinite;
}
.dropoff-page-scope .slide:nth-child(1) { animation-delay: 0s; }
.dropoff-page-scope .slide:nth-child(2) { animation-delay: 5s; }
.dropoff-page-scope .slide:nth-child(3) { animation-delay: 10s; }

.dropoff-page-scope .slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.dropoff-page-scope .slide:after {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg,rgba(8,20,40,.05),rgba(8,20,40,.72));
}

@keyframes fade {
  0%, 30% { opacity: 1; }
  36%, 100% { opacity: 0; }
}

.dropoff-page-scope .photo-copy {
  position: absolute;
  z-index: 2;
  left: 42px;
  right: 42px;
  bottom: 38px;
  max-width: 650px;
  color: #fff;
}
.dropoff-page-scope .photo-copy small {
  font-weight: 800;
  letter-spacing: .1em;
  text-transform: uppercase;
  font-size: 11px;
  color: #aed9f6;
}
.dropoff-page-scope .photo-copy h3 {
  margin: 7px 0 0;
  font-size: 42px;
  line-height: 1.05;
  font-weight: 900;
  letter-spacing: -1.5px;
}
.dropoff-page-scope .photo-copy p {
  max-width: 560px;
  line-height: 1.6;
  color: #e9f0f7;
  font-size: 14px;
  margin: 8px 0 0;
}

.dropoff-page-scope .dots {
  position: absolute;
  z-index: 4;
  right: 25px;
  bottom: 25px;
  display: flex;
  gap: 6px;
}
.dropoff-page-scope .dot {
  width: 8px;
  height: 8px;
  background: #fff;
  border-radius: 50%;
  opacity: .55;
}
.dropoff-page-scope .dot:nth-child(1) { animation: dot1 15s infinite; }
.dropoff-page-scope .dot:nth-child(2) { animation: dot2 15s infinite; }
.dropoff-page-scope .dot:nth-child(3) { animation: dot3 15s infinite; }

@keyframes dot1 {
  0%, 30% { opacity: 1; transform: scale(1.3); }
  36%, 100% { opacity: .55; transform: scale(1); }
}
@keyframes dot2 {
  0%, 30% { opacity: .55; }
  36%, 63% { opacity: 1; transform: scale(1.3); }
  70%, 100% { opacity: .55; transform: scale(1); }
}
@keyframes dot3 {
  0%, 63% { opacity: .55; }
  70%, 96% { opacity: 1; transform: scale(1.3); }
  100% { opacity: .55; }
}

.dropoff-page-scope .hero-stats-row {
  display: flex;
  gap: 32px;
  flex-wrap: wrap;
  margin-top: 22px;
}
.dropoff-page-scope .stat strong {
  display: block;
  font-size: 24px;
  color: var(--navy);
  font-weight: 900;
}
.dropoff-page-scope .stat span {
  font-size: 12px;
  color: var(--muted);
  font-weight: 600;
}

/* BUTTONS */
.dropoff-page-scope .btn {
  padding: 13px 22px;
  border-radius: 12px;
  font-weight: 850;
  font-size: 13px;
  display: inline-block;
  transition: transform .2s ease, background .2s ease;
  cursor: pointer;
  border: 0;
}
.dropoff-page-scope .btn:hover {
  transform: translateY(-1px);
}
.dropoff-page-scope .btn-white {
  background: #fff;
  color: var(--navy);
  margin-top: 14px;
  box-shadow: 0 8px 18px rgba(0,0,0,.15);
}

/* SEARCH SECTION */
.dropoff-page-scope .search {
  background: #fff;
  padding: 28px 0;
  border-bottom: 1px solid var(--line);
}
.dropoff-page-scope .searchbox {
  display: flex;
  gap: 12px;
  align-items: center;
  background: #f7f9fc;
  border: 1px solid var(--line);
  border-radius: 16px;
  padding: 8px 12px;
}
.dropoff-page-scope .searchbox input {
  border: 0;
  background: transparent;
  outline: 0;
  flex: 1;
  padding: 10px;
  font-size: 14px;
  color: var(--ink);
  font-weight: 600;
}
.dropoff-page-scope .searchbox button {
  border: 0;
  background: var(--blue);
  color: #fff;
  padding: 13px 22px;
  border-radius: 11px;
  font-weight: 850;
  font-size: 13px;
  cursor: pointer;
  box-shadow: 0 8px 18px rgba(22,167,239,.25);
  transition: .2s;
}
.dropoff-page-scope .searchbox button:hover {
  background: #0f93d4;
}

/* SECTION COMMON */
.dropoff-page-scope .section {
  padding: 68px 0;
}
.dropoff-page-scope .section-head {
  text-align: center;
  max-width: 680px;
  margin: 0 auto 38px;
}
.dropoff-page-scope .eyebrow {
  display: inline-flex;
  gap: 8px;
  align-items: center;
  color: var(--orange);
  font-size: 12px;
  font-weight: 900;
  letter-spacing: .12em;
  text-transform: uppercase;
}
.dropoff-page-scope .eyebrow:before {
  content: "";
  width: 28px;
  height: 3px;
  background: var(--orange);
  border-radius: 5px;
}
.dropoff-page-scope .section-head h2 {
  font-size: 38px;
  letter-spacing: -1.8px;
  color: var(--navy);
  margin: 13px 0;
  font-weight: 900;
}
.dropoff-page-scope .section-head p {
  color: var(--muted);
  line-height: 1.7;
  font-size: 14px;
}

/* 4 STEPS GRID */
.dropoff-page-scope .steps {
  display: grid;
  grid-template-columns: repeat(4,1fr);
  gap: 16px;
}
.dropoff-page-scope .step {
  background: #fff;
  border: 1px solid var(--line);
  border-radius: 18px;
  padding: 23px;
  box-shadow: 0 10px 28px rgba(16,26,51,.05);
  transition: transform .2s ease;
}
.dropoff-page-scope .step:hover {
  transform: translateY(-3px);
}
.dropoff-page-scope .num {
  width: 36px;
  height: 36px;
  border-radius: 10px;
  background: #eaf7fd;
  color: var(--blue);
  display: grid;
  place-items: center;
  font-weight: 950;
  font-size: 14px;
}
.dropoff-page-scope .step h3 {
  margin: 18px 0 8px;
  color: var(--navy);
  font-size: 16px;
  font-weight: 800;
}
.dropoff-page-scope .step p {
  font-size: 13px;
  line-height: 1.6;
  color: var(--muted);
  margin: 0;
}

/* CONNECTED NETWORK CARD */
.dropoff-page-scope .network {
  background: var(--navy);
  color: #fff;
  border-radius: 26px;
  padding: 42px;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 30px;
  overflow: hidden;
  position: relative;
}
.dropoff-page-scope .network:after {
  content: "";
  position: absolute;
  width: 360px;
  height: 360px;
  border: 1px solid rgba(22,167,239,.3);
  border-radius: 50%;
  right: -100px;
  top: -120px;
}
.dropoff-page-scope .network h2 {
  font-size: 39px;
  letter-spacing: -1.8px;
  margin: 8px 0 15px;
  font-weight: 900;
  color: #fff;
}
.dropoff-page-scope .network p {
  color: #b9c7d8;
  line-height: 1.7;
  font-size: 14px;
}

.dropoff-page-scope .mini-map {
  min-height: 230px;
  border-radius: 18px;
  background: linear-gradient(145deg,#102846,#0a1c34);
  position: relative;
  overflow: hidden;
  border: 1px solid rgba(22,167,239,.2);
}
.dropoff-page-scope .route {
  position: absolute;
  left: 15%;
  top: 55%;
  width: 70%;
  height: 3px;
  background: linear-gradient(90deg,var(--orange),var(--blue));
  transform: rotate(-12deg);
  box-shadow: 0 0 20px rgba(22,167,239,.5);
}
.dropoff-page-scope .pin {
  position: absolute;
  width: 13px;
  height: 13px;
  border-radius: 50%;
  background: #fff;
  border: 4px solid var(--orange);
  box-shadow: 0 0 0 7px rgba(244,91,11,.14);
}
.dropoff-page-scope .p1 { left: 18%; top: 60%; }
.dropoff-page-scope .p2 { left: 50%; top: 45%; }
.dropoff-page-scope .p3 { right: 16%; top: 31%; }

/* CTA BANNER SECTION */
.dropoff-page-scope .cta {
  padding: 58px 0;
}
.dropoff-page-scope .cta-box {
  background: linear-gradient(135deg,var(--orange),#ff7c1f);
  color: #fff;
  border-radius: 24px;
  padding: 38px 45px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 25px;
  box-shadow: 0 15px 40px rgba(244,91,11,.2);
}
.dropoff-page-scope .cta-box h2 {
  font-size: 32px;
  letter-spacing: -1.2px;
  margin: 0 0 8px;
  font-weight: 900;
  color: #fff;
}
.dropoff-page-scope .cta-box p {
  margin: 0;
  color: #ffe9dc;
  font-size: 14px;
}
.dropoff-page-scope .cta-box .btn {
  background: #fff;
  color: var(--navy);
  padding: 14px 24px;
  border-radius: 12px;
  font-size: 14px;
  font-weight: 850;
  text-decoration: none;
  white-space: nowrap;
}

/* RESPONSIVE */
@media(max-width:850px){
  .dropoff-page-scope .hero-grid,
  .dropoff-page-scope .network { grid-template-columns: 1fr; }
  .dropoff-page-scope .slider { height: 310px; }
  .dropoff-page-scope .photo-copy h3 { font-size: 28px; }
  .dropoff-page-scope .steps { grid-template-columns: 1fr 1fr; }
  .dropoff-page-scope .cta-box { flex-direction: column; align-items: flex-start; }
}
@media(max-width:540px){
  .dropoff-page-scope .slider { height: 270px; }
  .dropoff-page-scope .photo-copy { left: 20px; right: 20px; bottom: 20px; }
  .dropoff-page-scope .steps { grid-template-columns: 1fr; }
  .dropoff-page-scope .network { padding: 28px; }
  .dropoff-page-scope .cta-box { padding: 28px; }
}
@media(prefers-reduced-motion:reduce){
  .dropoff-page-scope .slide, .dropoff-page-scope .dot { animation: none!important; }
  .dropoff-page-scope .slide:first-child { opacity: 1; }
}
</style>

<div class="dropoff-page-scope">
  <!-- CINEMATIC HERO SLIDER -->
  <section class="hero">
    <div class="wrap">
      <div class="slider">
        <!-- SLIDE 1 -->
        <div class="slide">
          <img src="https://images.pexels.com/photos/6169129/pexels-photo-6169129.jpeg?auto=compress&cs=tinysrgb&w=1600" alt="Courier driving a delivery van" loading="eager" onerror="this.src='https://katzg.com/assets/img/services/delivery/rd.jpg'">
          <div class="photo-copy">
            <small>UK Parcel Drop-off Locations</small>
            <h3>Your parcel’s next stop — <span style="color:#ff9a61">closer than you think.</span></h3>
            <p>Find a convenient point, hand over your parcel and stay connected through every stage.</p>
            <a class="btn btn-white" href="#search">Find a drop-off point</a>
          </div>
        </div>

        <!-- SLIDE 2 -->
        <div class="slide">
          <img src="https://katzg.com/assets/img/services/delivery/rd.jpg" alt="Courier unloading packages from a van" loading="eager" onerror="this.src='https://images.pexels.com/photos/6868177/pexels-photo-6868177.jpeg?auto=compress&cs=tinysrgb&w=1600'">
          <div class="photo-copy">
            <small>SMART HANDOFF</small>
            <h3>Drop it off. <span style="color:#ff9a61">We’ll take it from here.</span></h3>
            <p>Professional handling with clear confirmation at the point of handover.</p>
            <a class="btn btn-white" href="#search">Find a drop-off point</a>
          </div>
        </div>

        <!-- SLIDE 3 -->
        <div class="slide">
          <img src="https://images.pexels.com/photos/6868177/pexels-photo-6868177.jpeg?auto=compress&cs=tinysrgb&w=1600" alt="Courier delivering a parcel" loading="eager" onerror="this.src='https://images.pexels.com/photos/6169129/pexels-photo-6169129.jpeg?auto=compress&cs=tinysrgb&w=1600'">
          <div class="photo-copy">
            <small>LAST MILE</small>
            <h3>A connected journey from <span style="color:#ff9a61">point to doorstep.</span></h3>
            <p>Track your parcel with confidence after it leaves your local RushParcel point.</p>
            <a class="btn btn-white" href="#search">Find a drop-off point</a>
          </div>
        </div>

        <div class="dots">
          <i class="dot"></i>
          <i class="dot"></i>
          <i class="dot"></i>
        </div>
      </div>

      <div class="hero-stats-row">
        <div class="stat">
          <strong>1,240+</strong>
          <span>UK connected points</span>
        </div>
        <div class="stat">
          <strong>24/7</strong>
          <span>Tracking visibility</span>
        </div>
        <div class="stat">
          <strong>Fast</strong>
          <span>Local handoff</span>
        </div>
      </div>
    </div>
  </section>

  <!-- SEARCH BAR SECTION -->
  <section class="search" id="search">
    <div class="wrap">
      <form class="searchbox" action="<?= url('/drop-off') ?>" method="GET">
        <input name="location" placeholder="Enter postcode, town or location to find your nearest drop-off point" value="<?= e($_GET['location'] ?? '') ?>">
        <button type="submit">Find a location</button>
      </form>
    </div>
  </section>

  <!-- 4 STEPS SECTION -->
  <section class="section">
    <div class="wrap">
      <div class="section-head">
        <div class="eyebrow">Simple from start to finish</div>
        <h2>Drop off in four easy steps.</h2>
        <p>Find a convenient point, prepare your parcel, hand it over and get moving. RushParcel keeps every handoff clear and connected.</p>
      </div>

      <div class="steps">
        <div class="step">
          <div class="num">01</div>
          <h3>Find</h3>
          <p>Search your postcode and choose the most convenient nearby point.</p>
        </div>
        <div class="step">
          <div class="num">02</div>
          <h3>Prepare</h3>
          <p>Securely pack and label your parcel before arriving.</p>
        </div>
        <div class="step">
          <div class="num">03</div>
          <h3>Drop off</h3>
          <p>Hand your parcel to the location team and receive confirmation.</p>
        </div>
        <div class="step">
          <div class="num">04</div>
          <h3>Track</h3>
          <p>Follow the parcel through the RushParcel network from collection to delivery.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CONNECTED NETWORK MAP SECTION -->
  <section class="section" style="padding-top:0">
    <div class="wrap">
      <div class="network">
        <div>
          <div class="eyebrow" style="color:#ff9a61">Connected network</div>
          <h2>Closer to where life happens.</h2>
          <p>Thousands of convenient collection and drop-off points connect local streets to the wider RushParcel network.</p>
          <div class="hero-stats-row" style="margin-top:28px">
            <div class="stat">
              <strong style="color:#fff">1,240+</strong>
              <span style="color:#9fb0c3">Connected points</span>
            </div>
            <div class="stat">
              <strong style="color:#fff">24/7</strong>
              <span style="color:#9fb0c3">Tracking visibility</span>
            </div>
          </div>
        </div>

        <div class="mini-map">
          <div class="route"></div>
          <i class="pin p1"></i>
          <i class="pin p2"></i>
          <i class="pin p3"></i>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA SECTION -->
  <section class="cta">
    <div class="wrap">
      <div class="cta-box">
        <div>
          <h2>Ready to send something?</h2>
          <p>Find a nearby RushParcel drop-off point and get your parcel on its way.</p>
        </div>
        <a class="btn" href="#search">Find a drop-off point</a>
      </div>
    </div>
  </section>
</div>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
