<?php ob_start(); ?>

<style>
.about-scope {
  --navy:#030914;--navy2:#07172d;--ink:#071426;--muted:#71839a;--blue:#079df2;--cyan:#2bdcff;--violet:#995cff;--green:#26d4aa;--bg:#f4f7fb;--white:#fff;--line:#dfe7ef;--shadow:0 24px 70px rgba(4,20,42,.12);
  margin: -1.5rem -1.25rem -5rem -1.25rem;
  background: var(--bg);
  color: var(--ink);
}
.about-scope .container { width: min(1180px, calc(100% - 40px)); margin: auto; }
.about-scope .hero {
  position: relative; overflow: hidden; min-height: 650px; padding: 60px 0 70px;
  background: linear-gradient(135deg,#030914 0%,#06152a 62%,#071f39); color: #fff;
}
.about-scope .hero:before {
  content: ""; position: absolute; inset: 0;
  background-image: linear-gradient(#2bdcff09 1px,transparent 1px),linear-gradient(90deg,#2bdcff09 1px,transparent 1px);
  background-size: 52px 52px; mask-image: linear-gradient(#000,transparent 92%);
}
.about-scope .heroGlow {
  position: absolute; width: 650px; height: 650px; border-radius: 50%; right: -250px; top: -170px;
  background: radial-gradient(circle,#079df21b,transparent 62%); filter: blur(5px);
}
.about-scope .heroGrid { position: relative; z-index: 2; display: grid; grid-template-columns: 1.05fr .95fr; gap: 60px; align-items: center; }
.about-scope .eyebrow {
  display: inline-flex; align-items: center; gap: 7px; padding: 7px 12px; border-radius: 99px; background: #06243a;
  border: 1px solid #1aa8e950; color: #32dcff; font-size: 8px; font-weight: 950; letter-spacing: .15em; text-transform: uppercase;
}
.about-scope .eyebrow i { width: 6px; height: 6px; border-radius: 50%; background: var(--green); box-shadow: 0 0 10px var(--green); }
.about-scope .hero h1 { font-size: 62px; line-height: .94; letter-spacing: -.075em; margin-top: 16px; color: #FFF; }
.about-scope .hero h1 span { color: var(--cyan); }
.about-scope .heroCopy { max-width: 560px; color: #899cb2; font-size: 13px; line-height: 1.8; margin-top: 16px; }
.about-scope .heroActions { display: flex; gap: 9px; margin-top: 24px; }
.about-scope .heroFacts { display: flex; gap: 25px; margin-top: 31px; }
.about-scope .heroFacts strong { font-size: 18px; display: block; color: #FFF; }
.about-scope .heroFacts small { font-size: 8px; color: #647d96; letter-spacing: .11em; }

/* Premium Story Visual */
.about-scope .storyVisual { height: 420px; position: relative; display: grid; place-items: center; }
.about-scope .halo { width: 300px; height: 300px; border-radius: 50%; border: 1px solid #2bdcff26; box-shadow: 0 0 90px #079df215,inset 0 0 70px #079df20b; position: relative; }
.about-scope .halo:before, .about-scope .halo:after { content: ""; position: absolute; inset: 24px; border: 1px solid #995cff22; border-radius: 50%; transform: rotate(35deg) scaleX(.55); }
.about-scope .halo:after { transform: rotate(-35deg) scaleX(.55); }
.about-scope .centerMark { position: absolute; left: 50%; top: 50%; transform: translate(-50%,-50%); width: 95px; height: 95px; border-radius: 26px; background: linear-gradient(135deg,#11a9fb,#0758d2); display: grid; place-items: center; font-size: 22px; font-weight: 950; box-shadow: 0 0 60px #079fff50; color: #FFF; }
.about-scope .orbit { position: absolute; inset: -18px; border-radius: 50%; border: 1px dashed #2bdcff25; animation: spin 16s linear infinite; }
.about-scope .orbit:after { content: ""; position: absolute; right: 12%; top: 0; width: 8px; height: 8px; border-radius: 50%; background: var(--cyan); box-shadow: 0 0 20px var(--cyan); }
@keyframes spin { to { transform: rotate(360deg); } }
.about-scope .signal { position: absolute; width: 190px; height: 1px; background: linear-gradient(90deg,transparent,#2bdcff,#995cff,transparent); box-shadow: 0 0 15px #2bdcff; }
.about-scope .s1 { left: 2%; top: 43%; transform: rotate(-18deg); }
.about-scope .s2 { right: 0; top: 56%; transform: rotate(20deg); }
.about-scope .chip { position: absolute; padding: 11px 13px; border-radius: 10px; background: #071a30e8; border: 1px solid #1d4669; backdrop-filter: blur(12px); box-shadow: 0 16px 40px #0006; }
.about-scope .chip small { display: block; color: #607994; font-size: 7px; }
.about-scope .chip strong { display: block; margin-top: 3px; font-size: 12px; color: #FFF; }
.about-scope .c1 { right: 1%; top: 10%; }
.about-scope .c2 { left: 0; top: 61%; }
.about-scope .c2 strong { color: var(--cyan); }
.about-scope .c3 { right: 6%; bottom: 3%; }
.about-scope .c3 strong { color: var(--green); }

/* Story Slider */
.about-scope .story { padding: 88px 0; background: #fff; }
.about-scope .heading { text-align: center; max-width: 710px; margin: 0 auto 35px; }
.about-scope .heading .eyebrow { color: #078fdd; background: #edfaff; border-color: #c4edff; }
.about-scope .heading h2 { font-size: 36px; letter-spacing: -.06em; margin-top: 11px; color: var(--ink); }
.about-scope .heading p { font-size: 11px; color: #7b8b9d; margin-top: 7px; }
.about-scope .slider { max-width: 1040px; margin: auto; }
.about-scope .viewport { overflow: hidden; border: 1px solid var(--line); border-radius: 20px; box-shadow: var(--shadow); }
.about-scope .track { display: flex; transition: transform .65s cubic-bezier(.2,.8,.2,1); }
.about-scope .slide { min-width: 100%; display: grid; grid-template-columns: 1fr .85fr; min-height: 350px; }
.about-scope .slideText { padding: 45px; }
.about-scope .slideNum { font-size: 9px; color: var(--blue); font-weight: 950; letter-spacing: .18em; }
.about-scope .slide h3 { font-size: 29px; letter-spacing: -.055em; margin-top: 11px; color: var(--ink); }
.about-scope .slide p { font-size: 11px; line-height: 1.8; color: #74869a; margin-top: 9px; }
.about-scope .slide ul { list-style: none; margin-top: 17px; display: grid; gap: 9px; }
.about-scope .slide li { font-size: 9px; color: #53677d; }
.about-scope .slide li:before { content: "✓"; color: #08b994; font-weight: 950; margin-right: 7px; }
.about-scope .slideArt { position: relative; display: grid; place-items: center; background: linear-gradient(135deg,#041021,#09243f); overflow: hidden; color: #fff; }
.about-scope .slideArt:before { content: ""; position: absolute; inset: 0; background-image: linear-gradient(#2bdcff0b 1px,transparent 1px),linear-gradient(90deg,#2bdcff0b 1px,transparent 1px); background-size: 35px 35px; }
.about-scope .bigWord { position: relative; font-size: 72px; font-weight: 950; letter-spacing: -.1em; color: rgba(255,255,255,0.08); }
.about-scope .artSymbol { position: absolute; font-size: 72px; color: var(--cyan); text-shadow: 0 0 45px #2bdcff77; }
.about-scope .slide:nth-child(2) .artSymbol { color: var(--violet); text-shadow: 0 0 45px #995cff77; }
.about-scope .slide:nth-child(3) .artSymbol { color: var(--green); text-shadow: 0 0 45px #26d4aa77; }
.about-scope .controls { display: flex; justify-content: space-between; align-items: center; margin-top: 12px; }
.about-scope .dots { display: flex; gap: 6px; }
.about-scope .dot { width: 26px; height: 4px; border: 0; border-radius: 5px; background: #d8e3eb; cursor: pointer; }
.about-scope .dot.active { background: var(--blue); box-shadow: 0 0 10px #079df255; }
.about-scope .arrows { display: flex; gap: 6px; }
.about-scope .arrow { width: 35px; height: 35px; border: 1px solid var(--line); border-radius: 9px; background: #fff; cursor: pointer; display: grid; place-items: center; }
.about-scope .arrow:hover { border-color: #9bdcff; color: var(--blue); }

/* Mission */
.about-scope .mission { padding: 90px 0; background: #f4f7fb; }
.about-scope .missionGrid { display: grid; grid-template-columns: .85fr 1.15fr; gap: 55px; align-items: center; }
.about-scope .missionLead .eyebrow { color: #078fdd; background: #edfaff; border-color: #c4edff; }
.about-scope .missionLead h2 { font-size: 41px; line-height: 1.02; letter-spacing: -.065em; margin-top: 12px; color: var(--ink); }
.about-scope .missionLead p { font-size: 11px; line-height: 1.8; color: #77899c; margin-top: 11px; }
.about-scope .missionCard { padding: 30px; border: 1px solid var(--line); border-radius: 17px; background: #fff; box-shadow: 0 20px 60px rgba(7,26,50,0.06); }
.about-scope .missionCard h3 { font-size: 18px; color: var(--ink); }
.about-scope .missionCard > p { font-size: 11px; line-height: 1.8; color: #75879b; margin-top: 8px; }
.about-scope .principles { display: grid; grid-template-columns: 1fr 1fr; gap: 9px; margin-top: 20px; }
.about-scope .principle { padding: 16px; border: 1px solid #e1e8ef; border-radius: 11px; }
.about-scope .principle b { font-size: 11px; color: var(--ink); }
.about-scope .principle p { font-size: 9px; line-height: 1.55; color: #7a8999; margin-top: 4px; }

/* Timeline */
.about-scope .timeline { padding: 90px 0; background: #fff; }
.about-scope .timelineWrap { max-width: 950px; margin: auto; position: relative; }
.about-scope .timelineWrap:before { content: ""; position: absolute; left: 50%; top: 10px; bottom: 10px; width: 1px; background: linear-gradient(#079df2,#995cff,#26d4aa); }
.about-scope .event { display: grid; grid-template-columns: 1fr 50px 1fr; align-items: center; min-height: 135px; }
.about-scope .event:nth-child(even) .eventCard { grid-column: 3; }
.about-scope .event:nth-child(odd) .eventCard { grid-column: 1; text-align: right; }
.about-scope .event:nth-child(even) .eventYear { grid-column: 2; grid-row: 1; }
.about-scope .event:nth-child(odd) .eventYear { grid-column: 2; grid-row: 1; }
.about-scope .eventCard { padding: 21px; border: 1px solid var(--line); border-radius: 13px; background: #fff; box-shadow: 0 14px 35px rgba(7,26,50,0.06); }
.about-scope .eventCard b { font-size: 9px; color: var(--blue); letter-spacing: .14em; }
.about-scope .eventCard h3 { font-size: 14px; margin-top: 6px; color: var(--ink); }
.about-scope .eventCard p { font-size: 9px; color: #7b8b9c; line-height: 1.65; margin-top: 4px; }
.about-scope .eventYear { width: 43px; height: 43px; border-radius: 50%; background: #06172c; color: #2bdcff; border: 1px solid #2bdcff66; display: grid; place-items: center; justify-self: center; z-index: 2; font-size: 9px; font-weight: 950; box-shadow: 0 0 20px #079df220; }

/* Stats & Difference */
.about-scope .stats { padding: 65px 0; background: #f4f7fb; }
.about-scope .statGrid { display: grid; grid-template-columns: repeat(4, 1fr); border: 1px solid var(--line); border-radius: 17px; overflow: hidden; background: #fff; box-shadow: 0 18px 50px rgba(7,26,50,0.08); }
.about-scope .stat { padding: 27px 15px; text-align: center; border-right: 1px solid var(--line); }
.about-scope .stat:last-child { border-right: 0; }
.about-scope .stat strong { display: block; color: #078fda; font-size: 30px; letter-spacing: -.05em; }
.about-scope .stat span { display: block; font-size: 9px; color: #6f8298; margin-top: 5px; font-weight: 800; }
.about-scope .stat small { display: block; font-size: 8px; color: #9aa7b5; margin-top: 4px; }

.about-scope .difference { padding: 85px 0; background: linear-gradient(135deg,#030914,#07182e); color: #fff; }
.about-scope .diffGrid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 13px; margin-top: 34px; }
.about-scope .diff { padding: 25px; border: 1px solid #183e60; border-radius: 14px; background: #071a30; }
.about-scope .diffIcon { font-size: 23px; color: var(--cyan); }
.about-scope .diff h3 { font-size: 14px; margin-top: 12px; color: #FFF; }
.about-scope .diff p { font-size: 10px; line-height: 1.7; color: #7c90a7; margin-top: 6px; }
.about-scope .difference .heading .eyebrow { background: #09263e; }
.about-scope .difference .heading h2 { color: #fff; }
.about-scope .difference .heading p { color: #8296ac; }

/* CTA */
.about-scope .cta { padding: 65px 0; background: #fff; }
.about-scope .ctaBox { padding: 32px 35px; border-radius: 17px; border: 1px solid #1d4d73; background: linear-gradient(120deg,#07182e,#0b2542); color: #fff; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 25px 65px rgba(7,26,50,0.08); }
.about-scope .ctaBox h2 { font-size: 24px; letter-spacing: -.04em; color: #FFF; }
.about-scope .ctaBox p { font-size: 10px; color: #8298ad; margin-top: 5px; }

@media(max-width:950px){
  .about-scope .heroGrid, .about-scope .missionGrid { grid-template-columns: 1fr; }
  .about-scope .storyVisual { order: -1; height: 330px; }
  .about-scope .slide { grid-template-columns: 1fr; }
  .about-scope .slideArt { min-height: 230px; }
  .about-scope .statGrid { grid-template-columns: 1fr 1fr; }
  .about-scope .diffGrid { grid-template-columns: 1fr 1fr; }
}
@media(max-width:620px){
  .about-scope .hero { padding-top: 30px; }
  .about-scope .hero h1 { font-size: 43px; }
  .about-scope .storyVisual { height: 285px; }
  .about-scope .halo { width: 205px; height: 205px; }
  .about-scope .chip, .about-scope .signal { display: none; }
  .about-scope .principles, .about-scope .diffGrid { grid-template-columns: 1fr; }
  .about-scope .timelineWrap:before { left: 22px; }
  .about-scope .event { grid-template-columns: 44px 1fr; gap: 12px; min-height: 155px; }
  .about-scope .eventCard, .about-scope .event:nth-child(even) .eventCard, .about-scope .event:nth-child(odd) .eventCard { grid-column: 2; text-align: left; }
  .about-scope .eventYear, .about-scope .event:nth-child(even) .eventYear, .about-scope .event:nth-child(odd) .eventYear { grid-column: 1; }
  .about-scope .statGrid { grid-template-columns: 1fr; }
  .about-scope .ctaBox { display: block; }
}
</style>

<div class="about-scope">
    <!-- Hero Section -->
    <section class="hero">
        <div class="heroGlow"></div>
        <div class="container heroGrid">
            <div>
                <div class="eyebrow"><i></i> About Rush Parcel</div>
                <h1>We move<br><span>what matters.</span></h1>
                <p class="heroCopy">Architected for Modern UK Logistics — Rush Parcel is a modern UK courier and logistics platform built around one idea: delivery should be faster, clearer and easier to manage. We connect people, businesses and delivery operations through a dependable digital experience.</p>
                <div class="heroActions">
                    <a class="btn primary" href="<?= url('/services') ?>">Explore Our Services &rarr;</a>
                    <a class="btn outline" href="#story">Our Story</a>
                </div>
                <div class="heroFacts">
                    <div>
                        <strong>99.4%</strong>
                        <small>ON-TIME DELIVERY</small>
                    </div>
                    <div>
                        <strong>24/7</strong>
                        <small>PLATFORM VISIBILITY</small>
                    </div>
                    <div>
                        <strong>UK</strong>
                        <small>LOGISTICS FOCUS</small>
                    </div>
                </div>
            </div>

            <!-- Brand Story Halo Visual -->
            <div class="storyVisual">
                <div class="signal s1"></div>
                <div class="signal s2"></div>
                <div class="halo">
                    <div class="orbit"></div>
                    <div class="centerMark">RP</div>
                </div>
                <div class="chip c1"><small>PLATFORM STATUS</small><strong>● ONLINE</strong></div>
                <div class="chip c2"><small>BUILT AROUND</small><strong>TRUST + SPEED</strong></div>
                <div class="chip c3"><small>OPERATING MODEL</small><strong>DIGITAL FIRST</strong></div>
            </div>
        </div>
    </section>

    <!-- The Rush Story Slider -->
    <section class="story" id="story">
        <div class="container">
            <div class="heading">
                <div class="eyebrow">The Rush Story</div>
                <h2>Built around a better delivery experience.</h2>
                <p>Our story is about removing friction from the journey — from the first quote to the final proof of delivery.</p>
            </div>

            <div class="slider">
                <div class="viewport">
                    <div class="track" id="storyTrack">
                        <article class="slide">
                            <div class="slideText">
                                <div class="slideNum">01 / THE BEGINNING</div>
                                <h3>Delivery should feel simple.</h3>
                                <p>Courier services can become complicated when customers have to jump between systems, unclear pricing and disconnected updates. Rush Parcel is designed to bring the experience together.</p>
                                <ul>
                                    <li>Simple digital booking</li>
                                    <li>Clear shipment information</li>
                                    <li>Designed around real customer needs</li>
                                </ul>
                            </div>
                            <div class="slideArt">
                                <div class="bigWord">SIMPLE</div>
                                <div class="artSymbol">↗</div>
                            </div>
                        </article>

                        <article class="slide">
                            <div class="slideText">
                                <div class="slideNum">02 / THE IDEA</div>
                                <h3>Visibility creates confidence.</h3>
                                <p>People should not have to wonder where a shipment is or what happens next. We make tracking, milestones and delivery information part of one connected experience.</p>
                                <ul>
                                    <li>Real-time milestone visibility</li>
                                    <li>Clear delivery communication</li>
                                    <li>Proof of delivery access</li>
                                </ul>
                            </div>
                            <div class="slideArt">
                                <div class="bigWord">CLEAR</div>
                                <div class="artSymbol">◎</div>
                            </div>
                        </article>

                        <article class="slide">
                            <div class="slideText">
                                <div class="slideNum">03 / THE FUTURE</div>
                                <h3>Logistics should keep getting smarter.</h3>
                                <p>We are building technology that can serve a single parcel just as naturally as a growing B2B operation — without losing the human experience.</p>
                                <ul>
                                    <li>Scalable logistics workflows</li>
                                    <li>Smarter operational tools</li>
                                    <li>Technology-led infrastructure</li>
                                </ul>
                            </div>
                            <div class="slideArt">
                                <div class="bigWord">FORWARD</div>
                                <div class="artSymbol">✦</div>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="controls">
                    <div class="dots">
                        <button class="dot active" data-i="0"></button>
                        <button class="dot" data-i="1"></button>
                        <button class="dot" data-i="2"></button>
                    </div>
                    <div class="arrows">
                        <button class="arrow" id="prevBtn">&larr;</button>
                        <button class="arrow" id="nextBtn">&rarr;</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission">
        <div class="container missionGrid">
            <div class="missionLead">
                <div class="eyebrow">Our Mission</div>
                <h2>Technology that makes logistics feel human.</h2>
                <p>We combine dependable delivery operations with modern digital experiences so sending and managing parcels feels less like administration and more like a service that simply works.</p>
            </div>
            <div class="missionCard">
                <h3>What drives Rush Parcel</h3>
                <p>Every part of the platform starts with the same question: can we make the next delivery easier to understand, easier to control and more dependable?</p>
                <div class="principles">
                    <div class="principle">
                        <b>01 · Reliability</b>
                        <p>Build processes customers and businesses can depend on.</p>
                    </div>
                    <div class="principle">
                        <b>02 · Transparency</b>
                        <p>Make shipment information clear at every stage.</p>
                    </div>
                    <div class="principle">
                        <b>03 · Speed</b>
                        <p>Remove unnecessary steps from quote to delivery.</p>
                    </div>
                    <div class="principle">
                        <b>04 · Security</b>
                        <p>Protect customer, shipment and operational data.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Journey Timeline -->
    <section class="timeline">
        <div class="container">
            <div class="heading">
                <div class="eyebrow">Our Journey</div>
                <h2>From a simple idea to a connected platform.</h2>
                <p>Milestone progression of our UK logistics infrastructure.</p>
            </div>
            <div class="timelineWrap">
                <div class="event">
                    <div class="eventCard">
                        <b>THE IDEA</b>
                        <h3>Make delivery easier.</h3>
                        <p>A customer-first vision for a simpler UK courier experience.</p>
                    </div>
                    <div class="eventYear">01</div>
                </div>
                <div class="event">
                    <div class="eventCard">
                        <b>THE PLATFORM</b>
                        <h3>Connect the journey.</h3>
                        <p>Quotes, bookings, tracking and delivery information brought together.</p>
                    </div>
                    <div class="eventYear">02</div>
                </div>
                <div class="event">
                    <div class="eventCard">
                        <b>THE NETWORK</b>
                        <h3>Serve more customers.</h3>
                        <p>Expanding delivery and drop-off capabilities across the UK.</p>
                    </div>
                    <div class="eventYear">03</div>
                </div>
                <div class="event">
                    <div class="eventCard">
                        <b>NEXT</b>
                        <h3>Build what's next.</h3>
                        <p>Smarter tools for individuals, businesses and logistics operations.</p>
                    </div>
                    <div class="eventYear">04</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="stats">
        <div class="container">
            <div class="statGrid">
                <div class="stat">
                    <strong>99.4%</strong>
                    <span>ON-TIME DELIVERY</span>
                    <small>Service performance target</small>
                </div>
                <div class="stat">
                    <strong>24/7</strong>
                    <span>PLATFORM ACCESS</span>
                    <small>Tracking & account visibility</small>
                </div>
                <div class="stat">
                    <strong>100%</strong>
                    <span>PRICE CONTROL</span>
                    <small>Server-side quote validation</small>
                </div>
                <div class="stat">
                    <strong>UK</strong>
                    <span>NATIONWIDE FOCUS</span>
                    <small>Built for UK logistics</small>
                </div>
            </div>
        </div>
    </section>

    <!-- The Rush Difference -->
    <section class="difference">
        <div class="container">
            <div class="heading">
                <div class="eyebrow">The Rush Difference</div>
                <h2>More than a courier. A better way to move.</h2>
                <p>Three principles shape how we build the Rush Parcel experience.</p>
            </div>
            <div class="diffGrid">
                <div class="diff">
                    <div class="diffIcon">⌁</div>
                    <h3>Customer First</h3>
                    <p>Clear interfaces, straightforward booking and useful information without unnecessary complexity.</p>
                </div>
                <div class="diff">
                    <div class="diffIcon">◈</div>
                    <h3>Digital by Design</h3>
                    <p>Modern systems connect quotes, bookings, tracking, invoices and operational workflows.</p>
                </div>
                <div class="diff">
                    <div class="diffIcon">✓</div>
                    <h3>Built for Business</h3>
                    <p>From one shipment to recurring B2B logistics, the platform is designed to scale with you.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <div class="ctaBox">
                <div>
                    <h2>Ready to move something forward?</h2>
                    <p>Explore Rush Parcel services or get a live UK delivery quote.</p>
                    <a class="btn primary" href="<?= url('/quote') ?>">Get an Instant Quote &rarr;</a>
                </div>
                <div style="font-size: 58px; color: #2bdcff; text-shadow: 0 0 32px #2bdcff77;">✦</div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const track = document.getElementById('storyTrack');
    const dots = Array.from(document.querySelectorAll('.about-scope .dot'));
    let current = 0;
    let timer = null;

    function go(i) {
        current = (i + 3) % 3;
        if (track) {
            track.style.transform = `translateX(-${current * 100}%)`;
        }
        dots.forEach((d, n) => d.classList.toggle('active', n === current));
    }

    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');

    if (nextBtn) nextBtn.addEventListener('click', () => go(current + 1));
    if (prevBtn) prevBtn.addEventListener('click', () => go(current - 1));

    dots.forEach(d => {
        d.addEventListener('click', function() {
            go(parseInt(this.dataset.i, 10));
        });
    });

    function autoplay() {
        clearInterval(timer);
        timer = setInterval(() => go(current + 1), 6500);
    }

    autoplay();

    const slider = document.querySelector('.about-scope .slider');
    if (slider) {
        slider.addEventListener('mouseenter', () => clearInterval(timer));
        slider.addEventListener('mouseleave', autoplay);
    }
});
</script>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
