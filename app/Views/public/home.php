<?php ob_start(); ?>

<style>
.home-scope {
  --navy:#061120;--navy2:#0d2038;--blue:#1198f5;--cyan:#45d9ff;--ink:#071426;--muted:#7b899b;--bg:#f6f9fc;--line:#e5ebf2;--shadow:0 25px 70px rgba(3,18,38,.14);
  margin: -1.5rem -1.25rem -5rem -1.25rem;
  background: var(--bg);
  color: var(--ink);
}
.home-scope .container { width: min(1180px, calc(100% - 40px)); margin: auto; }
.home-scope .hero {
  min-height: 720px; color: #fff; position: relative; overflow: hidden;
  background: radial-gradient(circle at 75% 38%,#148ef52b,transparent 28%),linear-gradient(135deg,#061120,#0d1d32 55%,#061120);
}
.home-scope .hero:before {
  content: ""; position: absolute; inset: 0; opacity: .3;
  background-image: linear-gradient(#ffffff09 1px,transparent 1px),linear-gradient(90deg,#ffffff09 1px,transparent 1px);
  background-size: 55px 55px;
}
.home-scope .hero:after {
  content: ""; position: absolute; width: 600px; height: 600px; right: -260px; top: 40px; border-radius: 50%;
  border: 1px solid #45d9ff18; box-shadow: 0 0 0 60px #45d9ff06,0 0 0 120px #45d9ff03;
}
.home-scope .heroIn {
  position: relative; z-index: 2; padding-top: 60px; padding-bottom: 85px; display: grid; grid-template-columns: 1fr 1fr; gap: 70px; align-items: center;
}
.home-scope .eyebrow {
  display: inline-flex; gap: 8px; align-items: center; border: 1px solid #45d9ff40; background: #22bfff10; color: #4bd8ff;
  border-radius: 99px; padding: 7px 12px; font-size: 10px; font-weight: 900; letter-spacing: .13em; text-transform: uppercase;
}
.home-scope .pulse { width: 6px; height: 6px; background: #4bdfff; border-radius: 50%; box-shadow: 0 0 14px #4bdfff; animation: pulse 1.6s infinite; }
@keyframes pulse { 50% { opacity: .35; } }

.home-scope h1 { font-size: clamp(48px, 5.4vw, 76px); line-height: .96; letter-spacing: -.065em; margin-top: 22px; color: #FFF; }
.home-scope h1 span { color: var(--cyan); }
.home-scope .hero p { color: #a9b8cb; line-height: 1.7; font-size: 15px; max-width: 570px; margin-top: 22px; }
.home-scope .heroBtns { display: flex; gap: 11px; margin-top: 28px; }
.home-scope .proof { display: flex; flex-wrap: wrap; gap: 17px; margin-top: 27px; padding-top: 18px; border-top: 1px solid #ffffff15; color: #9eb0c5; font-size: 10px; }
.home-scope .proof b { color: #49d7ff; }

/* Interactive Slider Sculpture */
.home-scope .slider {
  height: 430px; position: relative; overflow: hidden; border: 1px solid #ffffff20; border-radius: 28px;
  background: linear-gradient(145deg,rgba(255,255,255,0.07),rgba(255,255,255,0.02)); box-shadow: 0 35px 100px #00000055,inset 0 1px #ffffff12; backdrop-filter: blur(18px);
}
.home-scope .slide {
  position: absolute; inset: 0; padding: 34px; display: flex; flex-direction: column; justify-content: space-between;
  opacity: 0; transform: translateX(28px) scale(.98); transition: .65s; pointer-events: none; z-index: 1;
}
.home-scope .slide.active { opacity: 1; transform: none; pointer-events: auto; z-index: 2; }
.home-scope .slideTop, .home-scope .slideFoot { display: flex; justify-content: space-between; align-items: center; position: relative; z-index: 10; }
.home-scope .slideFoot a.btn { position: relative; z-index: 15; pointer-events: auto; cursor: pointer; }
.home-scope .label { font-size: 10px; letter-spacing: .14em; text-transform: uppercase; color: #55d9ff; font-weight: 900; }
.home-scope .num { font-size: 10px; color: #70849c; }
.home-scope .visual { height: 160px; position: relative; }
.home-scope .line { position: absolute; left: 8%; right: 8%; top: 78px; height: 1px; background: linear-gradient(90deg,transparent,#43d8ff,#148df4,transparent); }
.home-scope .node { position: absolute; top: 65px; width: 27px; height: 27px; border: 1px solid #58dcff; border-radius: 50%; background: #09182b; box-shadow: 0 0 0 7px #39d8ff0d,0 0 25px #20baff77; }
.home-scope .node:after { content: ""; display: block; width: 6px; height: 6px; background: #53ddff; border-radius: 50%; margin: 9px; }
.home-scope .node:first-child { left: 7%; }
.home-scope .node:nth-child(2) { right: 7%; }
.home-scope .route { position: absolute; left: 22%; top: 28px; background: #08182bdb; border: 1px solid #ffffff1c; border-radius: 13px; padding: 12px 15px; color: #9fb1c7; font-size: 10px; box-shadow: 0 15px 40px #0004; }
.home-scope .route strong { display: block; color: #fff; font-size: 12px; margin-bottom: 3px; }
.home-scope .slide h2 { font-size: 30px; line-height: 1.08; letter-spacing: -.04em; color: #FFF; }
.home-scope .slide p { font-size: 11px; color: #9cafc4; line-height: 1.6; margin-top: 8px; max-width: 440px; }
.home-scope .mini strong { display: block; color: #fff; font-size: 18px; }
.home-scope .mini small { color: #71859d; font-size: 8px; }
.home-scope .dots { position: absolute; right: 22px; bottom: 20px; z-index: 20; display: flex; gap: 6px; }
.home-scope .dot { width: 27px; height: 4px; border: 0; border-radius: 9px; background: #ffffff25; cursor: pointer; }
.home-scope .dot.active { width: 44px; background: #45d9ff; box-shadow: 0 0 15px #45d9ff88; }
.home-scope .radar { position: absolute; right: -35px; bottom: -45px; width: 180px; height: 180px; border: 1px solid #45d9ff20; border-radius: 50%; box-shadow: 0 0 0 35px #45d9ff05,0 0 0 70px #45d9ff02; pointer-events: none; z-index: 0; }
.home-scope .radar:after { content: ""; position: absolute; left: 50%; top: 0; height: 50%; width: 1px; background: linear-gradient(#45d9ff,transparent); transform-origin: bottom; animation: spin 3s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }

/* Floating Live Tracking Bar */
.home-scope .track { margin-top: -40px; position: relative; z-index: 10; }
.home-scope .trackCard { display: flex; align-items: center; gap: 15px; background: #fffffff7; border: 1px solid var(--line); border-radius: 20px; padding: 18px 24px; box-shadow: var(--shadow); }
.home-scope .trackIcon { width: 45px; height: 45px; border-radius: 13px; background: #edf8ff; color: #078eea; display: grid; place-items: center; font-size: 20px; }
.home-scope .trackTitle { font-size: 14px; font-weight: 900; color: var(--ink); }
.home-scope .trackSub { font-size: 10px; color: var(--muted); margin-top: 3px; }
.home-scope .trackForm { margin-left: auto; display: flex; gap: 8px; min-width: 430px; }
.home-scope .trackForm input { flex: 1; border: 1px solid #dce4ed; border-radius: 10px; padding: 12px 16px; outline: none; font-size: 11px; }
.home-scope .trackForm input:focus { border-color: #1598f7; box-shadow: 0 0 0 3px #1598f71a; }

/* Sections Styling */
.home-scope section { padding: 90px 0; }
.home-scope .light { background: var(--bg); }
.home-scope .head { text-align: center; max-width: 700px; margin: 0 auto 48px; }
.home-scope .kicker { font-size: 10px; letter-spacing: .14em; text-transform: uppercase; color: #1399ef; font-weight: 900; }
.home-scope .head h2 { font-size: 42px; line-height: 1.05; letter-spacing: -.055em; margin-top: 12px; color: var(--ink); }
.home-scope .head p { font-size: 13px; color: #7d8b9c; line-height: 1.7; margin-top: 12px; }

.home-scope .grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 17px; }
.home-scope .card { background: #fff; border: 1px solid var(--line); border-radius: 20px; padding: 27px; min-height: 220px; transition: .3s; }
.home-scope .card:hover { transform: translateY(-6px); box-shadow: var(--shadow); border-color: #b8ddf7; }
.home-scope .ico { width: 43px; height: 43px; border-radius: 13px; background: #eef8ff; color: #1097ed; display: grid; place-items: center; font-size: 18px; }
.home-scope .card h3 { font-size: 16px; margin-top: 20px; color: var(--ink); }
.home-scope .card p { font-size: 11px; color: #7b899a; line-height: 1.7; margin-top: 8px; }
.home-scope .card a { display: inline-block; margin-top: 17px; color: #0795ed; font-size: 11px; font-weight: 900; }

.home-scope .process { max-width: 900px; margin: auto; display: grid; gap: 11px; }
.home-scope .step { display: grid; grid-template-columns: 52px 1fr auto; align-items: center; gap: 20px; padding: 22px; border: 1px solid var(--line); border-radius: 18px; background: #FFF; }
.home-scope .circle { width: 38px; height: 38px; background: #071526; color: #fff; border-radius: 50%; display: grid; place-items: center; font-size: 11px; font-weight: 900; }
.home-scope .step h3 { font-size: 14px; color: var(--ink); }
.home-scope .step p { font-size: 11px; color: #8390a0; margin-top: 4px; }
.home-scope .arrow { color: #119cf1; font-size: 20px; }

.home-scope .cover { display: grid; grid-template-columns: 1fr 1fr; gap: 55px; align-items: center; }
.home-scope .cover h2 { font-size: 42px; letter-spacing: -.055em; line-height: 1.05; color: var(--ink); }
.home-scope .cover p { font-size: 13px; color: #7c899a; line-height: 1.7; margin-top: 13px; }
.home-scope .regions { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 23px; font-size: 11px; color: #516176; }
.home-scope .regions div:before { content: "✓"; color: #129bed; font-weight: 900; margin-right: 7px; }
.home-scope .map { height: 350px; border-radius: 27px; background: linear-gradient(145deg,#071628,#0c223b); position: relative; overflow: hidden; border: 1px solid #159bf52b; box-shadow: var(--shadow); }
.home-scope .map:before { content: ""; position: absolute; inset: 0; background: radial-gradient(circle at 30% 30%,#2dcfff2b,transparent 25%),linear-gradient(#ffffff06 1px,transparent 1px),linear-gradient(90deg,#ffffff06 1px,transparent 1px); background-size: auto,40px 40px,40px 40px; }
.home-scope .mDot { position: absolute; width: 10px; height: 10px; border-radius: 50%; background: #4bdcff; box-shadow: 0 0 0 7px #4bdcff12,0 0 25px #20baff; }
.home-scope .m1 { left: 20%; top: 37%; }
.home-scope .m2 { left: 45%; top: 25%; }
.home-scope .m3 { left: 68%; top: 48%; }
.home-scope .m4 { left: 38%; top: 68%; }
.home-scope .m5 { left: 78%; top: 70%; }
.home-scope .mapText { position: absolute; bottom: 24px; left: 25px; color: #fff; }
.home-scope .mapText strong { display: block; font-size: 22px; }
.home-scope .mapText small { color: #8ea2b9; font-size: 9px; }

.home-scope .business { padding-top: 20px; }
.home-scope .businessCard { background: linear-gradient(135deg,#071526,#0c213a); border-radius: 25px; padding: 43px; color: #fff; display: flex; align-items: center; justify-content: space-between; overflow: hidden; box-shadow: 0 30px 80px rgba(3,18,38,0.2); }
.home-scope .businessCard h2 { font-size: 30px; letter-spacing: -.04em; color: #FFF; }
.home-scope .businessCard p { color: #9eb0c5; font-size: 12px; line-height: 1.7; margin-top: 8px; }
.home-scope .stat strong { display: block; color: #4bd8ff; font-size: 23px; }
.home-scope .stat small { color: #8194aa; font-size: 9px; }

.home-scope .faq { max-width: 800px; margin: auto; }
.home-scope .faqItem { border-bottom: 1px solid var(--line); }
.home-scope .faqQ { width: 100%; padding: 20px 3px; border: 0; background: none; text-align: left; display: flex; justify-content: space-between; font-size: 12px; font-weight: 850; cursor: pointer; color: var(--ink); }
.home-scope .plus { color: #159bf1; font-size: 19px; transition: .25s; }
.home-scope .faqA { max-height: 0; overflow: hidden; color: #7c899a; font-size: 11px; line-height: 1.7; transition: .3s; }
.home-scope .faqItem.open .faqA { max-height: 140px; padding-bottom: 18px; }
.home-scope .faqItem.open .plus { transform: rotate(45deg); }

@media(max-width:900px){
  .home-scope .heroIn { grid-template-columns: 1fr; padding-top: 40px; }
  .home-scope .trackCard { display: block; }
  .home-scope .trackForm { min-width: 0; margin-top: 14px; }
  .home-scope .grid { grid-template-columns: 1fr 1fr; }
  .home-scope .cover { grid-template-columns: 1fr; }
}
@media(max-width:600px){
  .home-scope section { padding: 65px 0; }
  .home-scope .grid { grid-template-columns: 1fr; }
  .home-scope .head h2, .home-scope .cover h2 { font-size: 32px; }
  .home-scope h1 { font-size: 44px; }
  .home-scope .slider { height: 400px; }
  .home-scope .slide { padding: 25px; }
  .home-scope .slide h2 { font-size: 25px; }
  .home-scope .trackForm { display: grid; }
  .home-scope .trackForm .btn { width: 100%; }
  .home-scope .step { grid-template-columns: 44px 1fr; }
  .home-scope .arrow { display: none; }
  .home-scope .businessCard { display: block; padding: 30px; }
}
</style>

<div class="home-scope">
    <!-- Premium Dark Hero Section -->
    <section class="hero" id="home">
        <div class="container heroIn">
            <div>
                <div class="eyebrow"><i class="pulse"></i> UK-WIDE COURIER NETWORK</div>
                <h1>Move Anything.<br><span>Move It Fast.</span></h1>
                <p>Premium UK courier and logistics solutions for individuals, retailers and growing businesses. From urgent same-day delivery to reliable nationwide transport.</p>
                <div class="heroBtns">
                    <a class="btn primary" href="<?= url('/quote') ?>">Get Instant Quote &rarr;</a>
                    <a class="btn outline" href="<?= url('/services') ?>">Explore Services</a>
                </div>
                <div class="proof">
                    <span><b>●</b> Same-Day Dispatch</span>
                    <span><b>◈</b> Live Tracking</span>
                    <span><b>✓</b> Photo Proof of Delivery</span>
                    <span><b>▣</b> VAT-Ready Invoices</span>
                </div>
            </div>

            <div class="slider">
                <article class="slide active">
                    <div class="slideTop">
                        <span class="label">01 / Express Network</span>
                        <span class="num">RUSH / 01</span>
                    </div>
                    <div class="visual">
                        <div class="line"></div>
                        <div class="node"></div>
                        <div class="node"></div>
                        <div class="route">
                            <strong>Manchester &rarr; London</strong>
                            Express Network • Live
                        </div>
                    </div>
                    <div>
                        <h2>Speed engineered<br>for modern business.</h2>
                        <p>Book urgent UK deliveries with intelligent routing, clear pricing and real-time shipment visibility.</p>
                    </div>
                    <div class="slideFoot">
                        <div class="mini">
                            <strong>Same Day</strong>
                            <small>EXPRESS SERVICE</small>
                        </div>
                        <a class="btn primary" href="<?= url('/quote') ?>">Book Now &rarr;</a>
                    </div>
                </article>

                <article class="slide">
                    <div class="slideTop">
                        <span class="label">02 / Live Intelligence</span>
                        <span class="num">RUSH / 02</span>
                    </div>
                    <div class="visual">
                        <div class="line"></div>
                        <div class="node"></div>
                        <div class="node"></div>
                        <div class="route">
                            <strong>Shipment UK9823410574</strong>
                            ● Out for delivery
                        </div>
                    </div>
                    <div>
                        <h2>Know where it is.<br>Know when it arrives.</h2>
                        <p>A modern tracking experience gives customers a clear view from collection through final delivery.</p>
                    </div>
                    <div class="slideFoot">
                        <div class="mini">
                            <strong>24 / 7</strong>
                            <small>TRACKING VISIBILITY</small>
                        </div>
                        <a class="btn primary" href="<?= url('/track') ?>">Track Parcel &rarr;</a>
                    </div>
                </article>

                <article class="slide">
                    <div class="slideTop">
                        <span class="label">03 / Business Logistics</span>
                        <span class="num">RUSH / 03</span>
                    </div>
                    <div class="visual">
                        <div class="line"></div>
                        <div class="node"></div>
                        <div class="node"></div>
                        <div class="route">
                            <strong>Business Account</strong>
                            Scheduled • Multi-drop
                        </div>
                    </div>
                    <div>
                        <h2>Logistics that<br>scales with you.</h2>
                        <p>Flexible courier services, scheduled collections and business invoicing designed around your operation.</p>
                    </div>
                    <div class="slideFoot">
                        <div class="mini">
                            <strong>Business</strong>
                            <small>DEDICATED SUPPORT</small>
                        </div>
                        <a class="btn primary" href="<?= url('/contact') ?>">For Business &rarr;</a>
                    </div>
                </article>

                <div class="dots">
                    <button class="dot active" data-i="0"></button>
                    <button class="dot" data-i="1"></button>
                    <button class="dot" data-i="2"></button>
                </div>
                <div class="radar"></div>
            </div>
        </div>
    </section>

    <!-- Floating Live Tracking Input Bar -->
    <div class="container track" id="tracking">
        <div class="trackCard">
            <div class="trackIcon">⌁</div>
            <div>
                <div class="trackTitle">Track Your Shipment</div>
                <div class="trackSub">Enter your 12-character tracking reference for the latest delivery status.</div>
            </div>
            <form class="trackForm" action="<?= url('/track') ?>" method="GET">
                <input type="text" name="tracking_number" id="trackingInput" placeholder="e.g. UK9823410574" maxlength="30" required>
                <button type="submit" class="btn primary">Track Parcel</button>
            </form>
        </div>
    </div>

    <!-- Solutions Grid Section -->
    <section class="light" id="services">
        <div class="container">
            <div class="head">
                <div class="kicker">Our Solutions</div>
                <h2>Complete UK Delivery & Logistics</h2>
                <p>Premium courier solutions designed for individuals, online retailers and corporate teams.</p>
            </div>
            <div class="grid">
                <article class="card">
                    <div class="ico">▣</div>
                    <h3>Standard & Express Parcel Delivery</h3>
                    <p>Reliable UK parcel delivery with flexible collection options and clear pricing.</p>
                    <a href="<?= url('/services/parcel-delivery') ?>">Learn More &rarr;</a>
                </article>

                <article class="card">
                    <div class="ico">ϟ</div>
                    <h3>Same-Day Courier Delivery</h3>
                    <p>Urgent courier dispatch for time-critical shipments across the UK.</p>
                    <a href="<?= url('/services/same-day-delivery') ?>">Learn More &rarr;</a>
                </article>

                <article class="card">
                    <div class="ico">▤</div>
                    <h3>Business & Corporate Logistics</h3>
                    <p>Dedicated courier capacity, scheduled collections and scalable delivery support.</p>
                    <a href="<?= url('/services/business-logistics') ?>">Learn More &rarr;</a>
                </article>

                <article class="card">
                    <div class="ico">✈</div>
                    <h3>Worldwide International Shipping</h3>
                    <p>Worldwide parcel shipping with customs and documentation support.</p>
                    <a href="<?= url('/services/international-shipping') ?>">Learn More &rarr;</a>
                </article>

                <article class="card">
                    <div class="ico">▰</div>
                    <h3>UK & Europe Road Freight</h3>
                    <p>Scheduled transport and pallet shipping with flexible freight options.</p>
                    <a href="<?= url('/services/uk-europe-shipping') ?>">Learn More &rarr;</a>
                </article>

                <article class="card">
                    <div class="ico">▤</div>
                    <h3>Customs Clearance & Brokerage</h3>
                    <p>Professional customs and document support for international consignments.</p>
                    <a href="<?= url('/services/customs-clearance') ?>">Learn More &rarr;</a>
                </article>
            </div>
        </div>
    </section>

    <!-- 4-Step Process Section -->
    <section id="about">
        <div class="container">
            <div class="head">
                <div class="kicker">Simple 4-Step Process</div>
                <h2>How Rush Parcel Works</h2>
                <p>From instant quotation to final delivery, everything is designed to stay simple.</p>
            </div>
            <div class="process">
                <div class="step">
                    <div class="circle">01</div>
                    <div>
                        <h3>Calculate Your Quote</h3>
                        <p>Enter collection, destination, parcel dimensions and weight.</p>
                    </div>
                    <div class="arrow">&rarr;</div>
                </div>
                <div class="step">
                    <div class="circle">02</div>
                    <div>
                        <h3>Book Your Shipment</h3>
                        <p>Select your preferred service and collection window.</p>
                    </div>
                    <div class="arrow">&rarr;</div>
                </div>
                <div class="step">
                    <div class="circle">03</div>
                    <div>
                        <h3>Driver Collection</h3>
                        <p>Your assigned courier collects the shipment and updates its status.</p>
                    </div>
                    <div class="arrow">&rarr;</div>
                </div>
                <div class="step">
                    <div class="circle">04</div>
                    <div>
                        <h3>Track & Deliver</h3>
                        <p>Follow the shipment through delivery with proof of delivery.</p>
                    </div>
                    <div class="arrow">&check;</div>
                </div>
            </div>
        </div>
    </section>

    <!-- UK Coverage Section -->
    <section class="light" id="coverage">
        <div class="container cover">
            <div>
                <div class="kicker">UK Nationwide Coverage</div>
                <h2>Connected across cities, towns & remote postcodes.</h2>
                <p>Flexible service zones designed for reliable coverage across England, Scotland, Wales and Northern Ireland.</p>
                <div class="regions">
                    <div>Greater London & South East</div>
                    <div>Midlands & East Anglia</div>
                    <div>North West & Yorkshire</div>
                    <div>North East & Cumbria</div>
                    <div>Scotland & Highlands</div>
                    <div>Wales & South West</div>
                    <div>Northern Ireland</div>
                    <div>European Transit Hubs</div>
                </div>
                <a class="btn primary" style="margin-top: 24px;" href="<?= url('/quote') ?>">Check Delivery Price &rarr;</a>
            </div>

            <div class="map">
                <i class="mDot m1"></i>
                <i class="mDot m2"></i>
                <i class="mDot m3"></i>
                <i class="mDot m4"></i>
                <i class="mDot m5"></i>
                <div class="mapText">
                    <strong>UK-WIDE</strong>
                    <small>CONNECTED COURIER NETWORK</small>
                </div>
            </div>
        </div>
    </section>

    <!-- Business Logistics Banner -->
    <section class="business" id="business">
        <div class="container">
            <div class="businessCard">
                <div>
                    <div class="kicker" style="color: #49d7ff;">Business Logistics</div>
                    <h2>Need regular business logistics?</h2>
                    <p>Open a corporate account for scheduled collections, dedicated vehicle options and flexible invoicing terms.</p>
                    <a class="btn outline" style="margin-top: 19px;" href="<?= url('/contact') ?>">Open Business Account &rarr;</a>
                </div>
                <div class="stat">
                    <strong>Business Ready</strong>
                    <small>Dedicated support • Flexible invoicing • Scalable delivery</small>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Accordion Section -->
    <section id="faq">
        <div class="container">
            <div class="head">
                <div class="kicker">Frequently Asked Questions</div>
                <h2>Common Courier Questions</h2>
                <p>Everything you need to know before booking your next shipment.</p>
            </div>
            <div class="faq">
                <div class="faqItem">
                    <button class="faqQ" type="button">How does instant quote calculation work? <span class="plus">+</span></button>
                    <div class="faqA">Enter collection and delivery details, parcel dimensions, weight and service requirements. In the production system the final price is calculated securely on the PHP server using the configured Rush Parcel rate card.</div>
                </div>
                <div class="faqItem">
                    <button class="faqQ" type="button">What proof of delivery is provided? <span class="plus">+</span></button>
                    <div class="faqA">Depending on the service, delivery can record recipient details, time, signature and delivery photography.</div>
                </div>
                <div class="faqItem">
                    <button class="faqQ" type="button">Are invoices VAT-ready? <span class="plus">+</span></button>
                    <div class="faqA">The platform architecture supports configurable UK VAT information, invoice numbering, line items, payment status and downloadable PDF invoices.</div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Interactive Slider & FAQ Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = Array.from(document.querySelectorAll('.home-scope .slide'));
    const dots = Array.from(document.querySelectorAll('.home-scope .dot'));
    let current = 0;
    let timer = null;

    function showSlide(index) {
        current = index;
        slides.forEach((s, i) => s.classList.toggle('active', i === index));
        dots.forEach((d, i) => d.classList.toggle('active', i === index));
    }

    function startAutoPlay() {
        clearInterval(timer);
        timer = setInterval(() => {
            showSlide((current + 1) % slides.length);
        }, 5000);
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
            startAutoPlay();
        });
    });

    startAutoPlay();

    // FAQ Accordion Toggle
    document.querySelectorAll('.home-scope .faqQ').forEach(b => {
        b.addEventListener('click', function() {
            this.parentElement.classList.toggle('open');
        });
    });
});
</script>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
