<?php ob_start(); ?>

<style>
.contact-page {
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
  font-family: 'Plus Jakarta Sans', Inter, system-ui, sans-serif;
}

/* HERO SECTION */
.contact-page .hero {
  background:
    radial-gradient(circle at 76% 45%,rgba(22,137,232,.10),transparent 24%),
    radial-gradient(circle at 94% 80%,rgba(244,91,11,.07),transparent 27%),
    linear-gradient(135deg,#fff 0%,#fbfdff 63%,#fff9f5 100%);
  border-bottom:1px solid var(--line);
}
.contact-page .hero-inner{
  width:min(1080px,100%);
  min-height:405px;
  margin:0 auto;
  padding:42px 20px 34px;
  display:grid;
  grid-template-columns:minmax(0, 56%) minmax(0, 44%);
  align-items:center;
}
.contact-page .hero-copy{
  min-width:0;
  width:100%;
  padding:0 30px 0 10px;
}
.contact-page .eyebrow{
  display:inline-flex;align-items:center;gap:7px;
  padding:7px 12px;border-radius:999px;
  background:var(--orange-soft);
  border:1px solid #ffd7bf;
  color:#c94b08;
  font-size:8px;font-weight:900;
  letter-spacing:1px;text-transform:uppercase
}
.contact-page .eyebrow:before{
  content:"";width:6px;height:6px;border-radius:50%;
  background:var(--green);box-shadow:0 0 0 4px #def6e8
}
.contact-page .hero h1{
  margin:17px 0 13px;
  max-width:580px;
  color:var(--navy);
  font-size:clamp(46px,5.5vw,68px);
  line-height:.95;
  letter-spacing:-3px;
  font-weight:900;
}
.contact-page .hero h1 span{color:var(--orange)}
.contact-page .hero-description{
  display:block;
  width:100%;
  max-width:570px;
  margin:0;
  color:#56657a;
  font-size:13px;
  line-height:1.7;
}
.contact-page .hero-stats{
  display:flex;
  align-items:flex-start;
  gap:36px;
  margin-top:25px;
}
.contact-page .stat strong{
  display:block;color:var(--navy);
  font-size:16px;line-height:1.15;
  white-space:nowrap;
  font-weight:800;
}
.contact-page .stat small{
  display:block;margin-top:4px;color:#77859a;
  font-size:7px;letter-spacing:.8px;
  text-transform:uppercase;
  font-weight:700;
}

/* HERO VISUAL GRAPHIC */
.contact-page .hero-visual{
  position:relative;
  width:100%;
  height:330px;
  min-width:0;
  display:flex;
  align-items:center;
  justify-content:center;
}
.contact-page .halo{
  position:absolute;width:315px;height:315px;border-radius:50%;
  background:radial-gradient(circle,rgba(22,137,232,.13),rgba(22,137,232,.035) 50%,transparent 70%)
}
.contact-page .ring{
  position:absolute;width:205px;height:205px;border-radius:50%;
  border:1px solid rgba(22,137,232,.29);
  box-shadow:
    0 0 0 23px rgba(22,137,232,.045),
    0 0 0 47px rgba(22,137,232,.03),
    0 0 0 70px rgba(244,91,11,.018)
}
.contact-page .ring-inner{
  width:151px;height:151px;
  border:1px solid rgba(244,91,11,.25);
  box-shadow:none
}
.contact-page .beam{
  position:absolute;width:410px;height:1px;
  background:linear-gradient(90deg,transparent,rgba(22,137,232,.40),transparent);
  transform:rotate(-19deg)
}
.contact-page .beam.two{
  transform:rotate(20deg);
  background:linear-gradient(90deg,transparent,rgba(244,91,11,.25),transparent)
}
.contact-page .core{
  position:relative;z-index:5;
  width:80px;height:80px;border-radius:20px;
  background:linear-gradient(145deg,#2798f4,#0870ce);
  border:4px solid #fff;
  display:grid;place-items:center;
  color:#fff;font-size:22px;font-weight:950;
  box-shadow:
    0 18px 38px rgba(8,112,206,.30),
    0 0 0 10px rgba(22,137,232,.07)
}
.contact-page .node{
  position:absolute;z-index:6;
  width:10px;height:10px;border-radius:50%;
  border:3px solid #fff;background:var(--orange);
  box-shadow:0 4px 12px rgba(244,91,11,.28)
}
.contact-page .node.a{left:12%;top:38%}
.contact-page .node.b{right:10%;top:23%;background:var(--green)}
.contact-page .node.c{right:18%;bottom:18%;background:var(--blue)}
.contact-page .badge{
  position:absolute;z-index:8;
  min-width:112px;padding:10px 13px;
  background:#fff;border:1px solid #d9e2eb;
  border-radius:10px;
  box-shadow:0 13px 28px rgba(16,26,51,.14)
}
.contact-page .badge small{
  display:block;margin-bottom:4px;
  color:#8b98aa;font-size:7px;font-weight:800;
  text-transform:uppercase;letter-spacing:.5px
}
.contact-page .badge strong{font-size:9px;color:var(--orange)}
.contact-page .badge.available strong{color:var(--green)}
.contact-page .badge.top{right:1%;top:7%}
.contact-page .badge.bottom{left:0;bottom:16%}
.contact-page .phone{
  position:absolute;right:17%;bottom:7%;
  z-index:8;width:34px;height:34px;border-radius:50%;
  display:grid;place-items:center;
  color:var(--orange);background:var(--orange-soft);
  border:1px solid #ffd7bf;font-size:13px
}

/* CONTACT CENTRE */
.contact-page .contact-section{
  background:#f5f8fc;padding:62px 20px 72px
}
.contact-page .contact-wrap{max-width:1080px;margin:auto}
.contact-page .center{text-align:center}
.contact-page .blue-pill{
  display:inline-block;padding:7px 12px;border-radius:999px;
  color:#0879bf;background:var(--blue-soft);
  border:1px solid #d3edff;font-size:8px;
  font-weight:900;letter-spacing:1px
}
.contact-page .center h2{
  margin:12px 0 5px;color:var(--navy);
  font-size:32px;letter-spacing:-1.5px;font-weight:900
}
.contact-page .center p{margin:0;color:var(--muted);font-size:12px}
.contact-page .content-grid{
  display:grid;grid-template-columns:1.1fr .75fr;
  gap:16px;margin-top:27px
}
.contact-page .card{
  background:#fff;border:1px solid var(--line);
  border-radius:16px;box-shadow:0 10px 28px rgba(16,26,51,.04)
}
.contact-page .form-card{padding:26px}
.contact-page .form-head{display:flex;align-items:center;justify-content:space-between}
.contact-page .form-head h3{margin:0;font-size:16px;color:var(--navy);font-weight:800}
.contact-page .secure{
  color:var(--green);background:#edfaf2;
  border:1px solid #d2efdd;padding:6px 11px;
  border-radius:99px;font-size:8px;font-weight:800
}
.contact-page .fields{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:18px}
.contact-page .field.full{grid-column:1/-1}
.contact-page .field label{display:block;margin-bottom:6px;font-size:9px;font-weight:800;color:#44536a}
.contact-page .field input,.contact-page .field select,.contact-page .field textarea{
  width:100%;border:1px solid #dce4ec;border-radius:9px;
  background:#fbfcfe;padding:11px 12px;outline:0;
  color:var(--ink);font-size:11px;font-weight:600;transition:.2s
}
.contact-page .field input:focus,.contact-page .field select:focus,.contact-page .field textarea:focus{
  border-color:var(--orange);box-shadow:0 0 0 3px rgba(244,91,11,.12);background:#fff
}
.contact-page .field textarea{height:100px;resize:vertical}
.contact-page .submit{
  width:100%;margin-top:14px;border:0;border-radius:10px;
  background:linear-gradient(135deg,var(--orange),var(--orange-dark));
  color:#fff;padding:13px;font-size:12px;font-weight:900;cursor:pointer;
  box-shadow:0 8px 18px rgba(244,91,11,.2);transition:.2s
}
.contact-page .submit:hover{transform:translateY(-1px);box-shadow:0 12px 24px rgba(244,91,11,.3)}

/* SIDE CARDS */
.contact-page .side{display:grid;gap:12px}
.contact-page .side-card{padding:20px}
.contact-page .side-icon{
  width:36px;height:36px;border-radius:10px;
  display:grid;place-items:center;
  color:var(--blue);background:var(--blue-soft);
  margin-bottom:12px;font-weight:900;font-size:16px
}
.contact-page .side-card h3{margin:0 0 6px;color:var(--navy);font-size:13px;font-weight:800}
.contact-page .side-card p{margin:0;color:var(--muted);font-size:11px;line-height:1.6}
.contact-page .side-card a{color:var(--blue);font-weight:800}

/* ACTION CARDS */
.contact-page .actions{
  display:grid;grid-template-columns:repeat(3,1fr);
  gap:12px;margin-top:28px
}
.contact-page .action{
  padding:20px;border-radius:14px;
  background:#0d2340;border:1px solid #23496d;color:#fff
}
.contact-page .action span{font-size:18px;color:#ff7720}
.contact-page .action b{display:block;margin:8px 0 4px;font-size:12px;font-weight:800}
.contact-page .action p{margin:0;color:#b6c9dd;font-size:10px;line-height:1.55}
.contact-page .action a{display:inline-block;margin-top:12px;color:#ff7720;font-size:10px;font-weight:900}

/* OPERATIONS SECTION WITH ANIMATED CITY & VAN */
.contact-page .operations{
  background:#fff;padding:70px 20px;border-top:1px solid var(--line)
}
.contact-page .operations-inner{
  max-width:1080px;margin:auto;
  display:grid;grid-template-columns:.72fr 1fr;
  gap:28px;align-items:center
}
.contact-page .operations h2{
  margin:13px 0 8px;color:var(--navy);
  font-size:32px;line-height:1.05;letter-spacing:-1.5px;font-weight:900
}
.contact-page .operations p{max-width:390px;color:var(--muted);font-size:12px;line-height:1.7}
.contact-page .address{
  margin-top:16px;padding:15px;
  background:#f8fafc;border:1px solid var(--line);border-radius:12px
}
.contact-page .address strong{display:block;font-size:11px;color:var(--navy);font-weight:800}
.contact-page .address span{display:block;margin-top:4px;color:var(--muted);font-size:10px;line-height:1.5}
.contact-page .op-art{
  height:245px;border:1px solid #dce7f0;border-radius:18px;
  position:relative;overflow:hidden;
  background:
    radial-gradient(circle at 50% 38%,rgba(22,137,232,.15),transparent 25%),
    linear-gradient(145deg,#eef8ff,#fff,#fff7f1);
  box-shadow:0 18px 45px rgba(16,26,51,.08)
}
.contact-page .op-art:before{
  content:"";position:absolute;inset:0;opacity:.5;
  background-image:linear-gradient(rgba(22,137,232,.055) 1px,transparent 1px),linear-gradient(90deg,rgba(22,137,232,.055) 1px,transparent 1px);
  background-size:28px 28px
}
.contact-page .city{position:absolute;left:0;right:0;bottom:43px;height:75px;z-index:2;display:flex;align-items:end;justify-content:space-around;padding:0 55px}
.contact-page .building{width:35px;background:#dceefa;border:1px solid #c4dff1;border-radius:3px 3px 0 0;position:relative}
.contact-page .building:nth-child(1){height:43px}.contact-page .building:nth-child(2){height:65px}.contact-page .building:nth-child(3){height:51px}.contact-page .building:nth-child(4){height:72px}.contact-page .building:nth-child(5){height:35px}
.contact-page .building:after{content:"";position:absolute;inset:7px;background:repeating-linear-gradient(0deg,transparent 0 9px,#a7d0ed 9px 11px)}
.contact-page .route{position:absolute;left:8%;right:8%;bottom:42px;height:3px;background:linear-gradient(90deg,var(--blue),var(--orange));z-index:4}
.contact-page .road{position:absolute;left:-3%;right:-3%;bottom:0;height:47px;background:#dce3ea;border-top:2px solid #c8d3df;z-index:3;transform:skewY(-2deg)}
.contact-page .road:after{content:"";position:absolute;left:0;right:0;top:20px;height:4px;background:repeating-linear-gradient(90deg,#fff 0 35px,transparent 35px 70px)}
.contact-page .van{position:absolute;z-index:6;bottom:29px;left:-105px;width:95px;height:38px;animation:drive 6s linear infinite;filter:drop-shadow(0 7px 5px rgba(16,26,51,.18))}
.contact-page .vbody{position:absolute;left:0;bottom:5px;width:65px;height:26px;border:2px solid #b9c8d5;border-radius:5px;background:#fff}
.contact-page .vcab{position:absolute;right:0;bottom:5px;width:35px;height:24px;border:2px solid #b9c8d5;border-left:0;border-radius:2px 6px 3px 2px;background:#f5f8fb}
.contact-page .vwindow{position:absolute;right:4px;top:4px;width:20px;height:10px;border-radius:2px 4px 1px 1px;background:#bfe6fb;border:1px solid #90c9e9}
.contact-page .vstripe{position:absolute;left:3px;top:10px;width:56px;height:5px;background:var(--orange)}
.contact-page .vlogo{position:absolute;left:7px;top:2px;font-size:5px;font-weight:950;color:var(--navy)}
.contact-page .wheel{position:absolute;bottom:0;width:13px;height:13px;border-radius:50%;background:#172033;border:3px solid #adb9c6}
.contact-page .w1{left:9px}.contact-page .w2{right:8px}
@keyframes drive{0%{left:-105px}100%{left:110%}}
.contact-page .pin{position:absolute;z-index:7;width:12px;height:12px;border-radius:50%;border:3px solid #fff;background:var(--orange);box-shadow:0 4px 12px rgba(244,91,11,.3);top:27%;left:31%}.contact-page .pin.two{left:69%;top:36%;background:var(--green)}

/* CTA BOX SECTION */
.contact-page .cta{background:#f5f8fc;padding:32px 20px 45px;border-top:1px solid var(--line)}
.contact-page .cta-box{
  max-width:900px;margin:auto;padding:26px 30px;
  border-radius:16px;background:#0d2340;border:1px solid #23496d;
  color:#fff;display:flex;justify-content:space-between;align-items:center
}
.contact-page .cta-box h3{margin:0 0 4px;font-size:18px;font-weight:900}.contact-page .cta-box p{margin:0;color:#b7c9dd;font-size:11px}
.contact-page .cta-box a.cta-btn{border:0;border-radius:10px;background:var(--orange);color:#fff;padding:12px 18px;font-size:11px;font-weight:900;text-decoration:none;display:inline-block;transition:.2s}
.contact-page .cta-box a.cta-btn:hover{background:#e04f03;transform:translateY(-1px)}

/* RESPONSIVE */
@media(max-width:850px){
  .contact-page .hero-inner{grid-template-columns:1fr;text-align:center}
  .contact-page .hero-copy{padding:0;max-width:650px;margin:auto}
  .contact-page .hero-description{margin:auto}
  .contact-page .hero h1{margin-left:auto;margin-right:auto}
  .contact-page .hero-stats{justify-content:center}
  .contact-page .hero-visual{height:310px}
  .contact-page .content-grid,.contact-page .operations-inner{grid-template-columns:1fr}
  .contact-page .actions{grid-template-columns:1fr 1fr}
}
@media(max-width:540px){
  .contact-page .hero-inner{padding:35px 16px 12px}
  .contact-page .hero h1{font-size:42px;letter-spacing:-2px}
  .contact-page .hero-description{font-size:12px}
  .contact-page .hero-stats{gap:18px}
  .contact-page .stat strong{font-size:14px}
  .contact-page .hero-visual{height:275px}
  .contact-page .halo{width:275px;height:275px}
  .contact-page .ring{width:175px;height:175px}.contact-page .ring-inner{width:130px;height:130px}
  .contact-page .beam{width:320px}
  .contact-page .badge{transform:scale(.86)}.contact-page .badge.top{right:-2%}.contact-page .badge.bottom{left:-2%}
  .contact-page .fields{grid-template-columns:1fr}.contact-page .field.full{grid-column:auto}
  .contact-page .actions{grid-template-columns:1fr}
  .contact-page .cta-box{flex-direction:column;align-items:flex-start;gap:14px}
  .contact-page .cta-box a.cta-btn{width:100%;text-align:center}
}
</style>

<div class="contact-page">
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

  <!-- MAIN CONTACT CENTRE -->
  <section class="contact-section">
    <div class="contact-wrap">
      <div class="center">
        <span class="blue-pill">CONTACT CENTRE</span>
        <h2>How can we help?</h2>
        <p>Send us a message and we'll route your enquiry to the right Rush Parcel team.</p>
      </div>

      <?php if (\App\Core\Session::has('success')): ?>
          <div style="background: #edf9f2; border: 1px solid #c9ecd8; color: #16834d; padding: 14px 18px; border-radius: 12px; margin-top: 20px; font-weight: 700; font-size: 13px;">
              ✓ <?= e(\App\Core\Session::getFlash('success')) ?>
          </div>
      <?php endif; ?>

      <?php if (\App\Core\Session::has('error')): ?>
          <div style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 14px 18px; border-radius: 12px; margin-top: 20px; font-weight: 700; font-size: 13px;">
              ⚠️ <?= e(\App\Core\Session::getFlash('error')) ?>
          </div>
      <?php endif; ?>

      <div class="content-grid">
        <!-- Contact Form Card -->
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

            <button type="submit" class="submit">Send Message →</button>
          </form>
        </div>

        <!-- Side Info Cards Stack -->
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

      <!-- Quick Actions Grid -->
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

  <!-- UK OPERATIONS WITH ANIMATED VAN & CITY -->
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

  <!-- CTA SECTION -->
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
