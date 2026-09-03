<?php ob_start(); ?>

<style>
.contact-page-scope {
  --navy:#101a33;
  --orange:#f45b0b;
  --orange-dark:#dc4d06;
  --blue:#1689e8;
  --green:#18a45b;
  --ink:#172033;
  --muted:#637289;
  --line:#dfe6ee;
  --bg:#f6f9fc;
  --orange-soft:#fff2e9;
  --blue-soft:#eef8ff;
  margin: -1.5rem -1.25rem -5rem -1.25rem;
  background: var(--bg);
  color: var(--ink);
  font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Arial, sans-serif;
}

.contact-page-scope * { box-sizing: border-box; }
.contact-page-scope a { text-decoration: none; color: inherit; }

/* ---------- HERO ---------- */
.contact-page-scope .hero {
  background:
    radial-gradient(circle at 76% 45%,rgba(22,137,232,.10),transparent 24%),
    radial-gradient(circle at 94% 80%,rgba(244,91,11,.07),transparent 27%),
    linear-gradient(135deg,#fff 0%,#fbfdff 63%,#fff9f5 100%);
  border-bottom: 1px solid var(--line);
}
.contact-page-scope .hero-inner {
  width: min(1080px, 100%);
  min-height: 405px;
  margin: 0 auto;
  padding: 42px 20px 34px;
  display: grid;
  grid-template-columns: minmax(0, 56%) minmax(0, 44%);
  align-items: center;
}
.contact-page-scope .hero-copy {
  min-width: 0;
  width: 100%;
  padding: 0 30px 0 10px;
}
.contact-page-scope .eyebrow {
  display: inline-flex; align-items: center; gap: 7px;
  padding: 7px 12px; border-radius: 999px;
  background: var(--orange-soft);
  border: 1px solid #ffd7bf;
  color: #c94b08;
  font-size: 8px; font-weight: 900;
  letter-spacing: 1px; text-transform: uppercase;
}
.contact-page-scope .eyebrow:before {
  content: ""; width: 6px; height: 6px; border-radius: 50%;
  background: var(--green); box-shadow: 0 0 0 4px #def6e8;
}
.contact-page-scope .hero h1 {
  margin: 17px 0 13px;
  max-width: 580px;
  color: var(--navy);
  font-size: clamp(50px, 5.7vw, 70px);
  line-height: .95;
  letter-spacing: -3.9px;
  font-weight: 900;
}
.contact-page-scope .hero h1 span { color: var(--orange); }
.contact-page-scope .hero-description {
  display: block;
  width: 100%;
  max-width: 570px;
  margin: 0;
  color: #56657a;
  font-size: 13px;
  line-height: 1.7;
  white-space: normal;
  word-break: normal;
  overflow-wrap: normal;
}
.contact-page-scope .hero-stats {
  display: flex;
  align-items: flex-start;
  gap: 36px;
  margin-top: 25px;
}
.contact-page-scope .stat strong {
  display: block; color: var(--navy);
  font-size: 16px; line-height: 1.15;
  white-space: nowrap;
}
.contact-page-scope .stat small {
  display: block; margin-top: 4px; color: #77859a;
  font-size: 7px; letter-spacing: .8px;
  text-transform: uppercase;
}

/* ---------- HERO VISUAL ---------- */
.contact-page-scope .hero-visual {
  position: relative;
  width: 100%;
  height: 330px;
  min-width: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}
.contact-page-scope .halo {
  position: absolute; width: 315px; height: 315px; border-radius: 50%;
  background: radial-gradient(circle,rgba(22,137,232,.13),rgba(22,137,232,.035) 50%,transparent 70%);
}
.contact-page-scope .ring {
  position: absolute; width: 205px; height: 205px; border-radius: 50%;
  border: 1px solid rgba(22,137,232,.29);
  box-shadow:
    0 0 0 23px rgba(22,137,232,.045),
    0 0 0 47px rgba(22,137,232,.03),
    0 0 0 70px rgba(244,91,11,.018);
}
.contact-page-scope .ring-inner {
  width: 151px; height: 151px;
  border: 1px solid rgba(244,91,11,.25);
  box-shadow: none;
}
.contact-page-scope .beam {
  position: absolute; width: 410px; height: 1px;
  background: linear-gradient(90deg,transparent,rgba(22,137,232,.40),transparent);
  transform: rotate(-19deg);
}
.contact-page-scope .beam.two {
  transform: rotate(20deg);
  background: linear-gradient(90deg,transparent,rgba(244,91,11,.25),transparent);
}
.contact-page-scope .core {
  position: relative; z-index: 5;
  width: 80px; height: 80px; border-radius: 20px;
  background: linear-gradient(145deg,#2798f4,#0870ce);
  border: 4px solid #fff;
  display: grid; place-items: center;
  color: #fff; font-size: 22px; font-weight: 950;
  box-shadow:
    0 18px 38px rgba(8,112,206,.30),
    0 0 0 10px rgba(22,137,232,.07);
}
.contact-page-scope .node {
  position: absolute; z-index: 6;
  width: 10px; height: 10px; border-radius: 50%;
  border: 3px solid #fff; background: var(--orange);
  box-shadow: 0 4px 12px rgba(244,91,11,.28);
}
.contact-page-scope .node.a { left: 12%; top: 38%; }
.contact-page-scope .node.b { right: 10%; top: 23%; background: var(--green); }
.contact-page-scope .node.c { right: 18%; bottom: 18%; background: var(--blue); }
.contact-page-scope .badge {
  position: absolute; z-index: 8;
  min-width: 112px; padding: 10px 13px;
  background: #fff; border: 1px solid #d9e2eb;
  border-radius: 10px;
  box-shadow: 0 13px 28px rgba(16,26,51,.14);
}
.contact-page-scope .badge small {
  display: block; margin-bottom: 4px;
  color: #8b98aa; font-size: 7px; font-weight: 800;
  text-transform: uppercase; letter-spacing: .5px;
}
.contact-page-scope .badge strong { font-size: 9px; color: var(--orange); }
.contact-page-scope .badge.available strong { color: var(--green); }
.contact-page-scope .badge.top { right: 1%; top: 7%; }
.contact-page-scope .badge.bottom { left: 0; bottom: 16%; }
.contact-page-scope .phone {
  position: absolute; right: 17%; bottom: 7%;
  z-index: 8; width: 34px; height: 34px; border-radius: 50%;
  display: grid; place-items: center;
  color: var(--orange); background: var(--orange-soft);
  border: 1px solid #ffd7bf; font-size: 13px;
}

/* ---------- CONTACT CENTRE ---------- */
.contact-page-scope .contact-section {
  background: #f5f8fc; padding: 62px 20px 72px;
}
.contact-page-scope .contact-wrap { max-width: 1080px; margin: auto; }
.contact-page-scope .center { text-align: center; }
.contact-page-scope .blue-pill {
  display: inline-block; padding: 7px 12px; border-radius: 999px;
  color: #0879bf; background: var(--blue-soft);
  border: 1px solid #d3edff; font-size: 8px;
  font-weight: 900; letter-spacing: 1px;
}
.contact-page-scope .center h2 {
  margin: 12px 0 5px; color: var(--navy);
  font-size: 32px; letter-spacing: -1.5px;
}
.contact-page-scope .center p { margin: 0; color: var(--muted); font-size: 11px; }
.contact-page-scope .content-grid {
  display: grid; grid-template-columns: 1.1fr .75fr;
  gap: 16px; margin-top: 27px;
}
.contact-page-scope .card {
  background: #fff; border: 1px solid var(--line);
  border-radius: 16px; box-shadow: 0 10px 28px rgba(16,26,51,.04);
}
.contact-page-scope .form-card { padding: 20px; }
.contact-page-scope .form-head { display: flex; align-items: center; justify-content: space-between; }
.contact-page-scope .form-head h3 { margin: 0; font-size: 14px; color: var(--navy); }
.contact-page-scope .secure {
  color: var(--green); background: #edfaf2;
  border: 1px solid #d2efdd; padding: 6px 9px;
  border-radius: 999px; font-size: 8px; font-weight: 800;
}
.contact-page-scope .fields { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 16px; }
.contact-page-scope .field.full { grid-column: 1/-1; }
.contact-page-scope .field label { display: block; margin-bottom: 5px; font-size: 8px; font-weight: 800; color: #44536a; }
.contact-page-scope .field input, .contact-page-scope .field select, .contact-page-scope .field textarea {
  width: 100%; border: 1px solid #dce4ec; border-radius: 8px;
  background: #fbfcfe; padding: 9px 10px; outline: 0;
  color: var(--ink); font-size: 9px;
}
.contact-page-scope .field textarea { height: 78px; resize: vertical; }
.contact-page-scope .submit {
  width: 100%; margin-top: 10px; border: 0; border-radius: 9px;
  background: linear-gradient(90deg,#18a4ef,#0875d4);
  color: #fff; padding: 11px; font-size: 9px; font-weight: 900; cursor: pointer;
  transition: transform .2s ease;
}
.contact-page-scope .submit:hover { transform: translateY(-1px); }

.contact-page-scope .side { display: grid; gap: 10px; }
.contact-page-scope .side-card { padding: 17px; }
.contact-page-scope .side-icon {
  width: 32px; height: 32px; border-radius: 9px;
  display: grid; place-items: center;
  color: var(--blue); background: var(--blue-soft);
  margin-bottom: 10px; font-weight: 900;
}
.contact-page-scope .side-card h3 { margin: 0 0 4px; color: var(--navy); font-size: 11px; }
.contact-page-scope .side-card p { margin: 0; color: var(--muted); font-size: 9px; line-height: 1.6; }
.contact-page-scope .side-card a { color: var(--blue); font-weight: 800; }

.contact-page-scope .actions {
  display: grid; grid-template-columns: repeat(3, 1fr);
  gap: 10px; margin-top: 28px;
}
.contact-page-scope .action {
  padding: 17px; border-radius: 12px;
  background: #0d2340; border: 1px solid #23496d; color: #fff;
}
.contact-page-scope .action b { display: block; margin: 7px 0 4px; font-size: 10px; }
.contact-page-scope .action p { margin: 0; color: #b6c9dd; font-size: 8px; line-height: 1.5; }
.contact-page-scope .action a { display: inline-block; margin-top: 10px; color: #ff7720; font-size: 8px; font-weight: 900; }

/* ---------- OPERATIONS VISUAL ---------- */
.contact-page-scope .operations {
  background: #fff; padding: 70px 20px;
}
.contact-page-scope .operations-inner {
  max-width: 1080px; margin: auto;
  display: grid; grid-template-columns: .72fr 1fr;
  gap: 25px; align-items: center;
}
.contact-page-scope .operations h2 {
  margin: 13px 0 8px; color: var(--navy);
  font-size: 32px; line-height: 1.05; letter-spacing: -1.5px;
}
.contact-page-scope .operations p { max-width: 390px; color: var(--muted); font-size: 10px; line-height: 1.7; }
.contact-page-scope .address {
  margin-top: 16px; padding: 13px;
  background: #f8fafc; border: 1px solid var(--line); border-radius: 11px;
}
.contact-page-scope .address strong { display: block; font-size: 9px; }
.contact-page-scope .address span { display: block; margin-top: 4px; color: var(--muted); font-size: 8px; line-height: 1.5; }
.contact-page-scope .op-art {
  height: 235px; border: 1px solid #dce7f0; border-radius: 15px;
  position: relative; overflow: hidden;
  background:
    radial-gradient(circle at 50% 38%,rgba(22,137,232,.15),transparent 25%),
    linear-gradient(145deg,#eef8ff,#fff,#fff7f1);
  box-shadow: 0 18px 45px rgba(16,26,51,.08);
}
.contact-page-scope .op-art:before {
  content: ""; position: absolute; inset: 0; opacity: .5;
  background-image: linear-gradient(rgba(22,137,232,.055) 1px,transparent 1px),linear-gradient(90deg,rgba(22,137,232,.055) 1px,transparent 1px);
  background-size: 28px 28px;
}
.contact-page-scope .city { position: absolute; left: 0; right: 0; bottom: 43px; height: 75px; z-index: 2; display: flex; align-items: end; justify-content: space-around; padding: 0 55px; }
.contact-page-scope .building { width: 35px; background: #dceefa; border: 1px solid #c4dff1; border-radius: 3px 3px 0 0; position: relative; }
.contact-page-scope .building:nth-child(1) { height: 43px; }
.contact-page-scope .building:nth-child(2) { height: 65px; }
.contact-page-scope .building:nth-child(3) { height: 51px; }
.contact-page-scope .building:nth-child(4) { height: 72px; }
.contact-page-scope .building:nth-child(5) { height: 35px; }
.contact-page-scope .building:after { content: ""; position: absolute; inset: 7px; background: repeating-linear-gradient(0deg,transparent 0 9px,#a7d0ed 9px 11px); }
.contact-page-scope .route { position: absolute; left: 8%; right: 8%; bottom: 42px; height: 3px; background: linear-gradient(90deg,var(--blue),var(--orange)); z-index: 4; }
.contact-page-scope .road { position: absolute; left: -3%; right: -3%; bottom: 0; height: 47px; background: #dce3ea; border-top: 2px solid #c8d3df; z-index: 3; transform: skewY(-2deg); }
.contact-page-scope .road:after { content: ""; position: absolute; left: 0; right: 0; top: 20px; height: 4px; background: repeating-linear-gradient(90deg,#fff 0 35px,transparent 35px 70px); }
.contact-page-scope .van { position: absolute; z-index: 6; bottom: 29px; left: -105px; width: 95px; height: 38px; animation: drive 6s linear infinite; filter: drop-shadow(0 7px 5px rgba(16,26,51,.18)); }
.contact-page-scope .vbody { position: absolute; left: 0; bottom: 5px; width: 65px; height: 26px; border: 2px solid #b9c8d5; border-radius: 5px; background: #fff; }
.contact-page-scope .vcab { position: absolute; right: 0; bottom: 5px; width: 35px; height: 24px; border: 2px solid #b9c8d5; border-left: 0; border-radius: 2px 6px 3px 2px; background: #f5f8fb; }
.contact-page-scope .vwindow { position: absolute; right: 4px; top: 4px; width: 20px; height: 10px; border-radius: 2px 4px 1px 1px; background: #bfe6fb; border: 1px solid #90c9e9; }
.contact-page-scope .vstripe { position: absolute; left: 3px; top: 10px; width: 56px; height: 5px; background: var(--orange); }
.contact-page-scope .vlogo { position: absolute; left: 7px; top: 2px; font-size: 5px; font-weight: 950; color: var(--navy); }
.contact-page-scope .wheel { position: absolute; bottom: 0; width: 13px; height: 13px; border-radius: 50%; background: #172033; border: 3px solid #adb9c6; }
.contact-page-scope .w1 { left: 9px; }
.contact-page-scope .w2 { right: 8px; }
@keyframes drive { 0% { left: -105px; } 100% { left: 110%; } }
.contact-page-scope .pin { position: absolute; z-index: 7; width: 12px; height: 12px; border-radius: 50%; border: 3px solid #fff; background: var(--orange); box-shadow: 0 4px 12px rgba(244,91,11,.3); top: 27%; left: 31%; }
.contact-page-scope .pin.two { left: 69%; top: 36%; background: var(--green); }

/* ---------- CTA / FOOTER ---------- */
.contact-page-scope .cta { background: #f5f8fc; padding: 28px 20px 35px; }
.contact-page-scope .cta-box {
  max-width: 900px; margin: auto; padding: 22px 25px;
  border-radius: 14px; background: #0d2340; border: 1px solid #23496d;
  color: #fff; display: flex; justify-content: space-between; align-items: center;
}
.contact-page-scope .cta-box h3 { margin: 0 0 4px; font-size: 16px; }
.contact-page-scope .cta-box p { margin: 0; color: #b7c9dd; font-size: 9px; }
.contact-page-scope .cta-box button, .contact-page-scope .cta-box a.cta-btn {
  border: 0; border-radius: 8px; background: var(--orange); color: #fff; padding: 10px 14px; font-size: 9px; font-weight: 900; text-decoration: none; display: inline-block; cursor: pointer;
}

/* ---------- RESPONSIVE ---------- */
@media(max-width:850px){
  .contact-page-scope .hero-inner { grid-template-columns: 1fr; text-align: center; }
  .contact-page-scope .hero-copy { padding: 0; max-width: 650px; margin: auto; }
  .contact-page-scope .hero-description { margin: auto; }
  .contact-page-scope .hero h1 { margin-left: auto; margin-right: auto; }
  .contact-page-scope .hero-stats { justify-content: center; }
  .contact-page-scope .hero-visual { height: 310px; }
  .contact-page-scope .content-grid, .contact-page-scope .operations-inner { grid-template-columns: 1fr; }
  .contact-page-scope .actions { grid-template-columns: 1fr 1fr; }
}
@media(max-width:540px){
  .contact-page-scope .hero-inner { padding: 35px 16px 12px; }
  .contact-page-scope .hero h1 { font-size: 47px; letter-spacing: -2.8px; }
  .contact-page-scope .hero-description { font-size: 12px; }
  .contact-page-scope .hero-stats { gap: 18px; }
  .contact-page-scope .stat strong { font-size: 14px; }
  .contact-page-scope .hero-visual { height: 275px; }
  .contact-page-scope .halo { width: 275px; height: 275px; }
  .contact-page-scope .ring { width: 175px; height: 175px; }
  .contact-page-scope .ring-inner { width: 130px; height: 130px; }
  .contact-page-scope .beam { width: 320px; }
  .contact-page-scope .badge { transform: scale(.86); }
  .contact-page-scope .badge.top { right: -2%; }
  .contact-page-scope .badge.bottom { left: -2%; }
  .contact-page-scope .fields { grid-template-columns: 1fr; }
  .contact-page-scope .field.full { grid-column: auto; }
  .contact-page-scope .actions { grid-template-columns: 1fr; }
  .contact-page-scope .cta-box { flex-direction: column; align-items: flex-start; gap: 14px; }
  .contact-page-scope .cta-box button, .contact-page-scope .cta-box a.cta-btn { width: 100%; text-align: center; }
}
</style>

<div class="contact-page-scope">
  <!-- CONTACT HERO -->
  <section class="hero">
    <div class="hero-inner">
      <div class="hero-copy">
        <div class="eyebrow">Get in touch</div>
        <h1>Let's move<br><span>things forward.</span></h1>
        <p class="hero-description">
          Contact Rush Parcel Support &amp; Sales — Whether you need help with a
          shipment, want to discuss business logistics or simply have a question,
          the Rush Parcel team is ready to help.
        </p>
        <div class="hero-stats">
          <div class="stat"><strong>0800 123 4567</strong><small>UK Support</small></div>
          <div class="stat"><strong>24/7</strong><small>Online Platform</small></div>
          <div class="stat"><strong>UK</strong><small>Operations</small></div>
        </div>
      </div>

      <div class="hero-visual">
        <div class="halo"></div>
        <div class="ring"></div>
        <div class="ring ring-inner"></div>
        <div class="beam"></div><div class="beam two"></div>
        <div class="node a"></div><div class="node b"></div><div class="node c"></div>
        <div class="core">RP</div>

        <div class="badge available top">
          <small>Support Status</small><strong>● AVAILABLE</strong>
        </div>
        <div class="badge bottom">
          <small>Response Channel</small><strong>DIRECT</strong>
        </div>
        <div class="phone">☎</div>
      </div>
    </div>
  </section>

  <!-- CONTACT CENTRE -->
  <section class="contact-section">
    <div class="contact-wrap">
      <div class="center">
        <span class="blue-pill">CONTACT CENTRE</span>
        <h2>How can we help?</h2>
        <p>Send us a message and we'll route your enquiry to the right Rush Parcel team.</p>
      </div>

      <?php if (\App\Core\Session::has('success')): ?>
          <div style="background: #edfaf2; border: 1px solid #d2efdd; color: #18a45b; padding: 12px 16px; border-radius: 12px; margin-top: 20px; font-weight: 700; font-size: 12px;">
              ✓ <?= e(\App\Core\Session::getFlash('success')) ?>
          </div>
      <?php endif; ?>

      <?php if (\App\Core\Session::has('error')): ?>
          <div style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 12px 16px; border-radius: 12px; margin-top: 20px; font-weight: 700; font-size: 12px;">
              ⚠️ <?= e(\App\Core\Session::getFlash('error')) ?>
          </div>
      <?php endif; ?>

      <div class="content-grid">
        <div class="card form-card" id="contactForm">
          <div class="form-head">
            <h3>Send us a message</h3>
            <span class="secure">● SECURE FORM</span>
          </div>

          <form action="<?= url('/contact') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="fields">
              <div class="field">
                <label for="name">Full Name *</label>
                <input type="text" id="name" name="name" required placeholder="e.g. Sarah Jenkins">
              </div>
              <div class="field">
                <label for="company">Company</label>
                <input type="text" id="company" name="company" placeholder="Company name (optional)">
              </div>
              <div class="field">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" required placeholder="you@example.co.uk">
              </div>
              <div class="field">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" placeholder="e.g. 07700 900123">
              </div>
              <div class="field full">
                <label for="subject">What can we help with? *</label>
                <select id="subject" name="subject" required>
                  <option value="">Select an enquiry type</option>
                  <option value="Parcel / Delivery Support">Shipment support</option>
                  <option value="Business / Corporate Account">Business logistics</option>
                  <option value="Get a Quote">Get a quote</option>
                  <option value="General Enquiry">General enquiry</option>
                </select>
              </div>
              <div class="field full">
                <label for="message">Message *</label>
                <textarea id="message" name="message" required placeholder="Tell us how we can help..."></textarea>
              </div>
            </div>

            <button class="submit" type="submit">Send Message →</button>
          </form>
        </div>

        <div class="side">
          <div class="card side-card">
            <div class="side-icon">☎</div>
            <h3>Phone Support</h3>
            <p>Speak directly with our UK customer support team.</p>
            <p style="margin-top:7px"><a href="tel:08001234567">0800 123 4567</a></p>
            <p style="margin-top:8px">Mon–Fri　07:30–19:00<br>Sat　08:00–13:00<br>Sunday　Online support</p>
          </div>
          <div class="card side-card">
            <div class="side-icon">✉</div>
            <h3>Email Support</h3>
            <p>Customer Service: <a href="mailto:support@rushparcel.co.uk">support@rushparcel.co.uk</a></p>
            <p style="margin-top:6px">Corporate Accounts: <a href="mailto:sales@rushparcel.co.uk">sales@rushparcel.co.uk</a></p>
          </div>
          <div class="card side-card">
            <div class="side-icon">⌖</div>
            <h3>Operations Hub</h3>
            <p>Rush Parcel Platform Logistics Centre<br>100 Express Way, Park Royal<br>London NW10 7XW<br>United Kingdom</p>
          </div>
        </div>
      </div>

      <div class="actions">
        <div class="action">
          <span>⚡</span>
          <b>Need a quick quote?</b>
          <p>Get a server-verified UK delivery price in minutes.</p>
          <a href="<?= url('/quote') ?>">Get a Quote →</a>
        </div>
        <div class="action">
          <span>◉</span>
          <b>Looking for a parcel?</b>
          <p>Enter your shipment reference and see the latest status.</p>
          <a href="<?= url('/track') ?>">Track Parcel →</a>
        </div>
        <div class="action">
          <span>▣</span>
          <b>Business logistics?</b>
          <p>Talk to our team about recurring shipments and corporate solutions.</p>
          <a href="#contactForm">Speak to Sales →</a>
        </div>
      </div>
    </div>
  </section>

  <!-- OPERATIONS VISUAL -->
  <section class="operations">
    <div class="operations-inner">
      <div>
        <div class="eyebrow">UK Operations</div>
        <h2>Built close to the action.</h2>
        <p>Our UK-focused operation is designed around responsive customer support and dependable courier coordination.</p>
        <div class="address">
          <strong>Rush Parcel Platform Logistics Centre</strong>
          <span>100 Express Way, Park Royal<br>London NW10 7XW<br>United Kingdom</span>
        </div>
      </div>

      <div class="op-art">
        <div class="pin"></div><div class="pin two"></div>
        <div class="city"><i class="building"></i><i class="building"></i><i class="building"></i><i class="building"></i><i class="building"></i></div>
        <div class="route"></div><div class="road"></div>
        <div class="van">
          <span class="vbody"><span class="vlogo">RUSHPARCEL</span><span class="vstripe"></span></span>
          <span class="vcab"><span class="vwindow"></span></span>
          <span class="wheel w1"></span><span class="wheel w2"></span>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta">
    <div class="cta-box">
      <div>
        <h3>Prefer to start online?</h3>
        <p>Get your UK courier price or track an existing shipment instantly.</p>
      </div>
      <a href="<?= url('/quote') ?>" class="cta-btn">Get an Instant Quote →</a>
    </div>
  </section>
</div>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
