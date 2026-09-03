<?php ob_start(); ?>

<style>
.svc-scope {
  --bg:#F8FAFC;--bg2:#F1F5F9;--card:#FFFFFF;--card2:#FFFFFF;
  --blue:#EA580C;--cyan:#EA580C;--purple:#0284C7;--green:#16A34A;
  --text:#0F172A;--muted:#64748B;--line:#E2E8F0;
  background: var(--bg);
  color: var(--text);
  margin: -1.5rem -1.25rem -5rem -1.25rem;
}
.svc-scope .container { width: min(1160px, calc(100% - 42px)); margin: auto; }
.svc-scope .hero {
  min-height: 480px;
  padding-top: 60px;
  padding-bottom: 70px;
  position: relative;
  overflow: hidden;
  background:
    radial-gradient(circle at 72% 48%,#EA580C10,transparent 25%),
    radial-gradient(circle at 92% 26%,#0284C710,transparent 22%),
    linear-gradient(135deg,#FFFFFF,#F8FAFC 56%,#FFF7ED);
  border-bottom: 1px solid #E2E8F0;
}
.svc-scope .hero:before {
  content: "";
  position: absolute;
  inset: 0;
  background-image: linear-gradient(#EA580C09 1px,transparent 1px),linear-gradient(90deg,#EA580C09 1px,transparent 1px);
  background-size: 52px 52px;
  mask-image: linear-gradient(#000,transparent);
}
.svc-scope .hero-grid {
  position: relative;
  z-index: 2;
  display: grid;
  grid-template-columns: .78fr 1.22fr;
  gap: 35px;
  align-items: center;
}
.svc-scope .kicker {
  display: inline-flex;
  padding: 7px 12px;
  border-radius: 99px;
  border: 1px solid #FFEDD5;
  background: #FFF7ED;
  color: #EA580C;
  font-size: 9px;
  font-weight: 900;
  letter-spacing: .13em;
  text-transform: uppercase;
}
.svc-scope .hero h1 {
  font-size: 58px;
  line-height: 1.05;
  letter-spacing: -.06em;
  margin-top: 20px;
  color: #FFF;
}
.svc-scope .hero h1 em { font-style: normal; color: #159fff; }
.svc-scope .hero-copy { font-size: 14px; line-height: 1.75; color: #a5b5ca; margin-top: 17px; max-width: 450px; }
.svc-scope .features { display: flex; gap: 22px; margin-top: 29px; }
.svc-scope .feature { display: grid; grid-template-columns: 27px auto; gap: 8px; align-items: center; font-size: 10px; color: #FFF; }
.svc-scope .feature i { font-style: normal; width: 27px; height: 27px; border: 1px solid #27d8ff55; border-radius: 8px; display: grid; place-items: center; color: #2edaff; }
.svc-scope .feature small { display: block; color: #71859e; font-size: 8px; margin-top: 2px; }

.svc-scope .visual { height: 400px; position: relative; }
.svc-scope .skyline {
  position: absolute; left: 0; right: 0; bottom: 0; height: 160px; opacity: .45;
  background: linear-gradient(90deg,transparent 0 5%,#0a1d37 5% 10%,transparent 10% 13%,#0a1d37 13% 18%,transparent 18% 22%,#0a1d37 22% 27%,transparent 27% 31%,#0a1d37 31% 38%,transparent 38% 43%,#0a1d37 43% 47%,transparent 47% 53%,#0a1d37 53% 58%,transparent 58% 62%,#0a1d37 62% 68%,transparent 68% 73%,#0a1d37 73% 78%,transparent 78% 84%,#0a1d37 84% 89%,transparent 89% 94%,#0a1d37 94%);
  clip-path: polygon(0 80%,8% 62%,13% 75%,19% 48%,26% 70%,33% 42%,40% 69%,48% 30%,56% 68%,64% 45%,72% 72%,80% 50%,88% 69%,95% 54%,100% 62%,100% 100%,0 100%);
}
.svc-scope .road {
  position: absolute; left: 0; right: -20px; bottom: -25px; height: 170px;
  background: linear-gradient(155deg,transparent 35%,#08b8ff20 36%,#08b8ff 37%,transparent 38%),linear-gradient(22deg,transparent 42%,#8b45ff25 43%,#36dfff 44%,transparent 45%),linear-gradient(169deg,transparent 58%,#ff9d3d1b 59%,#20bfff 60%,transparent 61%);
  filter: blur(1px); transform: perspective(450px) rotateX(48deg);
}
.svc-scope .globe {
  position: absolute; right: 35px; top: 10px; width: 295px; height: 295px; border-radius: 50%;
  border: 2px solid #32dfff88; box-shadow: 0 0 55px #129cff55,inset 0 0 50px #129cff22,0 0 0 18px #129cff06,0 0 0 50px #9b53ff04;
}
.svc-scope .globe:before, .svc-scope .globe:after {
  content: ""; position: absolute; inset: 17px; border: 1px solid #35ddff32; border-radius: 50%; transform: rotate(28deg) scaleX(.48);
}
.svc-scope .globe:after { transform: rotate(-28deg) scaleX(.48); }
.svc-scope .globe .equator { position: absolute; left: 10px; right: 10px; top: 50%; border: 1px solid #37ddff28; border-radius: 50%; transform: scaleY(.35); }
.svc-scope .pin {
  position: absolute; left: 48%; top: 34%; width: 39px; height: 39px; border-radius: 50% 50% 50% 8px; transform: rotate(-45deg);
  background: linear-gradient(135deg,#14c0ff,#0759d0); box-shadow: 0 0 32px #1ad2ffbb; display: grid; place-items: center;
}
.svc-scope .pin b { transform: rotate(45deg); font-size: 10px; color: #FFF; }
.svc-scope .metric {
  position: absolute; padding: 13px 15px; min-width: 118px; background: #07172bd9; border: 1px solid #ffffff1e; border-radius: 12px; backdrop-filter: blur(15px); box-shadow: 0 15px 40px #0007; z-index: 5;
}
.svc-scope .metric strong { display: block; font-size: 19px; color: #FFF; }
.svc-scope .metric small { font-size: 8px; color: #8296b0; }
.svc-scope .one { right: -5px; top: 45px; }
.svc-scope .two { right: 18px; top: 178px; }
.svc-scope .three { left: 8px; bottom: 28px; }
.svc-scope .one strong { color: #45dcff; }
.svc-scope .three strong { color: #4de5c1; }

.svc-scope .services-section { background: var(--bg); padding: 78px 0 70px; position: relative; }
.svc-scope .services-section:before { content: ""; position: absolute; inset: 0; background: radial-gradient(circle at 50% 20%,#EA580C09,transparent 45%); }
.svc-scope .head { position: relative; text-align: center; margin-bottom: 40px; }
.svc-scope .head h2 { font-size: 35px; letter-spacing: -.045em; margin-top: 10px; color: var(--text); }
.svc-scope .head p { font-size: 11px; color: var(--muted); margin-top: 7px; }

.svc-scope .grid { position: relative; display: grid; grid-template-columns: repeat(3, 1fr); gap: 17px; }
.svc-scope .card {
  min-height: 260px; padding: 25px; border: 1px solid var(--line); border-radius: 14px;
  background: var(--card); box-shadow: 0 1px 3px rgba(15,23,42,0.05); transition: .3s; position: relative; overflow: hidden; color: var(--text);
}
.svc-scope .card:hover { transform: translateY(-4px); border-color: var(--blue); box-shadow: 0 12px 30px rgba(15,23,42,0.08); }
.svc-scope .card:after { content: ""; position: absolute; width: 130px; height: 130px; right: -80px; top: -80px; border-radius: 50%; background: rgba(234,88,12,0.04); }
.svc-scope .icon { width: 44px; height: 44px; border-radius: 11px; background: #FFF7ED; border: 1px solid #FFEDD5; color: #EA580C; display: grid; place-items: center; font-size: 21px; }
.svc-scope .card:nth-child(3) .icon { color: #EA580C; }
.svc-scope .card:nth-child(4) .icon { color: #0284C7; }
.svc-scope .card:nth-child(6) .icon { color: #16A34A; }
.svc-scope .card h3 { font-size: 16px; line-height: 1.18; margin-top: 19px; color: var(--text); }
.svc-scope .card p { font-size: 10px; line-height: 1.7; color: var(--muted); margin-top: 9px; }
.svc-scope .checks { list-style: none; margin-top: 12px; display: grid; gap: 5px; font-size: 9px; color: var(--muted); }
.svc-scope .checks li:before { content: "✓"; color: #16A34A; font-weight: 900; margin-right: 7px; }
.svc-scope .learn { display: inline-block; margin-top: 14px; color: #EA580C; font-size: 10px; font-weight: 900; }

.svc-scope .card.featured { grid-column: span 2; min-height: 205px; display: grid; grid-template-columns: 1fr .9fr; align-items: center; }
.svc-scope .truck { height: 170px; position: relative; }
.svc-scope .truck:before {
  content: ""; position: absolute; width: 300px; height: 115px; right: 5px; top: 30px;
  border: 3px solid rgba(234,88,12,0.2); border-radius: 35px 18px 8px 8px; transform: skewX(-8deg); box-shadow: 0 0 25px rgba(234,88,12,0.1);
}
.svc-scope .truck:after {
  content: ""; position: absolute; width: 55px; height: 55px; border: 3px solid rgba(234,88,12,0.3); border-radius: 50%;
  right: 70px; bottom: 22px; box-shadow: 0 0 0 13px rgba(234,88,12,0.05),90px 0 0 -3px #F8FAFC,90px 0 0 0 rgba(234,88,12,0.3);
}

.svc-scope .stats { margin-top: 45px; padding: 25px; border: 1px solid var(--line); border-radius: 14px; background: #FFFFFF; display: grid; grid-template-columns: repeat(4, 1fr); color: var(--text); box-shadow: 0 1px 3px rgba(15,23,42,0.05); }
.svc-scope .stat { text-align: center; border-right: 1px solid var(--line); }
.svc-scope .stat:last-child { border: 0; }
.svc-scope .stat strong { display: block; font-size: 23px; color: var(--text); }
.svc-scope .stat small { font-size: 9px; color: var(--muted); }
.svc-scope .stat:nth-child(1) strong { color: #EA580C; }
.svc-scope .stat:nth-child(2) strong { color: #0284C7; }
.svc-scope .stat:nth-child(3) strong { color: #16A34A; }
.svc-scope .stat:nth-child(4) strong { color: #EA580C; }

.svc-scope .custom { padding: 25px 0 85px; background: var(--bg); }
.svc-scope .cta {
  padding: 28px 33px; border: 1px solid #FFEDD5; border-radius: 14px;
  background: linear-gradient(135deg, #FFF7ED, #FFFFFF);
  display: flex; justify-content: space-between; align-items: center; color: var(--text);
  box-shadow: 0 4px 15px rgba(234,88,12,0.08);
}
.svc-scope .cta h2 { font-size: 26px; letter-spacing: -.04em; color: var(--text); }
.svc-scope .cta p { font-size: 11px; color: var(--muted); margin-top: 5px; }
.svc-scope .ctaRight { display: flex; align-items: center; gap: 28px; }
.svc-scope .benefits { display: grid; gap: 7px; color: #b6c4d7; font-size: 9px; }
.svc-scope .benefits span:before { content: "◉"; color: #43dfff; margin-right: 7px; }
.svc-scope .headphones { font-size: 68px; color: #a45cff; filter: drop-shadow(0 0 24px #a45cff88); }

@media(max-width:900px){
  .svc-scope .hero-grid { grid-template-columns: 1fr; }
  .svc-scope .hero { padding-top: 100px; }
  .svc-scope .visual { height: 370px; }
  .svc-scope .grid { grid-template-columns: 1fr 1fr; }
  .svc-scope .card.featured { grid-column: span 2; }
  .svc-scope .cta { display: block; }
  .svc-scope .ctaRight { margin-top: 22px; }
}
@media(max-width:600px){
  .svc-scope .hero h1 { font-size: 45px; }
  .svc-scope .features { flex-wrap: wrap; gap: 13px; }
  .svc-scope .globe { width: 220px; height: 220px; right: 5px; }
  .svc-scope .metric { transform: scale(.82); }
  .svc-scope .services-section { padding-top: 65px; }
  .svc-scope .head h2 { font-size: 30px; }
  .svc-scope .grid { grid-template-columns: 1fr; }
  .svc-scope .card.featured { grid-column: auto; display: block; }
  .svc-scope .truck { display: none; }
  .svc-scope .stats { grid-template-columns: 1fr 1fr; gap: 20px; }
  .svc-scope .stat:nth-child(2) { border: 0; }
  .svc-scope .stat:nth-child(1), .svc-scope .stat:nth-child(2) { padding-bottom: 17px; border-bottom: 1px solid #ffffff12; }
  .svc-scope .cta { padding: 25px; }
  .svc-scope .ctaRight { display: block; }
  .svc-scope .benefits { margin-bottom: 18px; }
}
</style>

<div class="svc-scope">
    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-grid">
            <div>
                <div class="kicker">Our Services</div>
                <h1>Premium UK &<br>International <em>Logistics</em></h1>
                <p class="hero-copy">End-to-end courier and logistics solutions built for speed, security, and reliability. From same-day delivery to global shipping — we move what matters.</p>
                <div class="features">
                    <div class="feature"><i>ϟ</i><div>Fast & Reliable<small>Delivery Promise</small></div></div>
                    <div class="feature"><i>◈</i><div>Real-time Tracking<small>Full Visibility</small></div></div>
                    <div class="feature"><i>♢</i><div>Secure Handling<small>Every Step</small></div></div>
                </div>
            </div>
            <div class="visual">
                <div class="skyline"></div>
                <div class="road"></div>
                <div class="globe">
                    <div class="equator"></div>
                    <div class="pin"><b>RP</b></div>
                </div>
                <div class="metric one"><strong>99.4%</strong><small>ON-TIME DELIVERY</small></div>
                <div class="metric two"><strong>12,458+</strong><small>SHIPMENTS / MONTH</small></div>
                <div class="metric three"><strong>98%</strong><small>UK POSTCODE COVERAGE</small></div>
            </div>
        </div>
    </section>

    <!-- Services Grid Section -->
    <section class="services-section">
        <div class="container">
            <div class="head">
                <div class="kicker">What We Offer</div>
                <h2>Our Delivery & Logistics Services</h2>
                <p>Flexible solutions tailored to individuals, businesses and enterprises.</p>
            </div>
            
            <div class="grid">
                <article class="card">
                    <div class="icon">▱</div>
                    <h3>Standard & Express Parcel<br>Delivery</h3>
                    <p>Reliable UK-wide delivery with next-day and express options. Door-to-door service with real-time tracking.</p>
                    <ul class="checks">
                        <li>Next-day & Express delivery</li>
                        <li>Real-time tracking updates</li>
                        <li>Signature & photo proof</li>
                    </ul>
                    <a class="learn" href="<?= url('/services/parcel-delivery') ?>">Learn More &rarr;</a>
                </article>

                <article class="card">
                    <div class="icon">▤</div>
                    <h3>B2B & Corporate Logistics</h3>
                    <p>Tailored logistics solutions for businesses of all sizes. Dedicated accounts, volume discounts and priority support.</p>
                    <ul class="checks">
                        <li>Dedicated account manager</li>
                        <li>Volume based pricing</li>
                        <li>Scheduled & multi-drop delivery</li>
                    </ul>
                    <a class="learn" href="<?= url('/services/business-logistics') ?>">Learn More &rarr;</a>
                </article>

                <article class="card">
                    <div class="icon">ϟ</div>
                    <h3>Same-Day Courier Service</h3>
                    <p>When time is critical, our same-day courier gets there in 60 minutes within selected areas.</p>
                    <ul class="checks">
                        <li>Collection within 60 minutes</li>
                        <li>Live driver tracking</li>
                        <li>Instant notifications</li>
                    </ul>
                    <a class="learn" href="<?= url('/services/same-day-delivery') ?>">Learn More &rarr;</a>
                </article>

                <article class="card">
                    <div class="icon">✈</div>
                    <h3>Worldwide International<br>Shipping</h3>
                    <p>Secure and affordable international shipping to global destinations with customs support and duty assistance.</p>
                    <ul class="checks">
                        <li>Global shipping network</li>
                        <li>Customs clearance support</li>
                        <li>Door-to-door delivery</li>
                    </ul>
                    <a class="learn" href="<?= url('/services/international-shipping') ?>">Learn More &rarr;</a>
                </article>

                <article class="card">
                    <div class="icon">▰</div>
                    <h3>UK & Europe Road Freight</h3>
                    <p>Cost-effective road freight solutions across the UK and Europe for pallets, boxes and oversized cargo.</p>
                    <ul class="checks">
                        <li>Full & part load freight</li>
                        <li>Pallet network across Europe</li>
                        <li>Regular scheduled departures</li>
                    </ul>
                    <a class="learn" href="<?= url('/services/uk-europe-shipping') ?>">Learn More &rarr;</a>
                </article>

                <article class="card">
                    <div class="icon">⌖</div>
                    <h3>UK Forwarding Address<br>Service</h3>
                    <p>Shop from anywhere in the world and deliver to your UK address. We store, inspect and forward your parcels.</p>
                    <ul class="checks">
                        <li>Dedicated UK address</li>
                        <li>Parcel consolidation</li>
                        <li>Worldwide forwarding</li>
                    </ul>
                    <a class="learn" href="<?= url('/services/forwarding-address') ?>">Learn More &rarr;</a>
                </article>

                <article class="card featured">
                    <div>
                        <div class="icon">⬟</div>
                        <h3>Customs Clearance & Brokerage</h3>
                        <p>Expert customs clearance services to ensure smooth import and export. We handle documentation, duties and compliance.</p>
                        <ul class="checks">
                            <li>Import & export clearance</li>
                            <li>Duty & VAT management</li>
                            <li>Expert customs consultancy</li>
                        </ul>
                        <a class="learn" href="<?= url('/services/customs-clearance') ?>">Learn More &rarr;</a>
                    </div>
                    <div class="truck"></div>
                </article>
            </div>

            <!-- Stats Bar -->
            <div class="stats">
                <div class="stat">
                    <strong>12,458+</strong>
                    <small>Parcels Delivered Daily</small>
                </div>
                <div class="stat">
                    <strong>99.4%</strong>
                    <small>On-Time Delivery Rate</small>
                </div>
                <div class="stat">
                    <strong>220+</strong>
                    <small>Countries Connected</small>
                </div>
                <div class="stat">
                    <strong>24/7</strong>
                    <small>Customer Support</small>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom Logistics CTA Section -->
    <section class="custom">
        <div class="container">
            <div class="cta">
                <div>
                    <div class="kicker">Custom Logistics</div>
                    <h2>Need a Custom Logistics Solution?</h2>
                    <p>Our team is ready to design a solution that fits your business.</p>
                    <a class="btn primary" href="<?= url('/contact') ?>" style="margin-top: 17px;">Get in Touch &rarr;</a>
                </div>
                <div class="ctaRight">
                    <div class="benefits">
                        <span>Tailored pricing</span>
                        <span>Dedicated support</span>
                        <span>Scalable solutions</span>
                    </div>
                    <div class="headphones">◉</div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
