<?php ob_start(); ?>

<style>
.contact-scope {
  --navy:#0F172A;--navy2:#1E293B;--ink:#0F172A;--muted:#64748B;--blue:#EA580C;--cyan:#EA580C;--violet:#0284C7;--green:#16A34A;--pink:#EA580C;--bg:#F8FAFC;--white:#fff;--line:#E2E8F0;--shadow:0 10px 30px rgba(15,23,42,.06);
  margin: -1.5rem -1.25rem -5rem -1.25rem;
  background: var(--bg);
  color: var(--ink);
}
.contact-scope .container { width: min(1180px, calc(100% - 40px)); margin: auto; }
.contact-scope .hero {
  position: relative; overflow: hidden; min-height: 440px; padding: 60px 0 68px;
  background: linear-gradient(135deg,#FFFFFF,#F8FAFC 65%,#FFF7ED); color: #0F172A;
  border-bottom: 1px solid #E2E8F0;
}
.contact-scope .hero:before {
  content: ""; position: absolute; inset: 0;
  background-image: linear-gradient(#EA580C09 1px,transparent 1px),linear-gradient(90deg,#EA580C09 1px,transparent 1px);
  background-size: 52px 52px; mask-image: linear-gradient(#000,transparent 90%);
}
.contact-scope .heroGlow {
  position: absolute; width: 650px; height: 650px; right: -270px; top: -250px; border-radius: 50%;
  background: radial-gradient(circle,#EA580C14,transparent 63%);
}
.contact-scope .heroGrid { position: relative; z-index: 2; display: grid; grid-template-columns: 1fr .75fr; gap: 65px; align-items: center; }
.contact-scope .eyebrow {
  display: inline-flex; align-items: center; gap: 7px; padding: 7px 12px; border-radius: 99px; background: #FFF7ED;
  border: 1px solid #FFEDD5; color: #EA580C; font-size: 8px; font-weight: 950; letter-spacing: .15em; text-transform: uppercase;
}
.contact-scope .eyebrow i { width: 6px; height: 6px; border-radius: 50%; background: var(--green); box-shadow: 0 0 10px var(--green); }
.contact-scope .hero h1 { font-size: 56px; line-height: 1.0; letter-spacing: -.05em; margin-top: 16px; color: #0F172A; }
.contact-scope .hero h1 span { color: #EA580C; }
.contact-scope .hero p { max-width: 590px; color: #475569; font-size: 14px; line-height: 1.8; margin-top: 15px; }
.contact-scope .heroStats { display: flex; gap: 28px; margin-top: 28px; }
.contact-scope .heroStats strong { display: block; font-size: 18px; color: #0F172A; }
.contact-scope .heroStats small { display: block; color: #64748B; font-size: 8px; letter-spacing: .1em; margin-top: 3px; }

/* Contact Command Visual */
.contact-scope .command { height: 300px; position: relative; display: grid; place-items: center; }
.contact-scope .pulseRing { width: 205px; height: 205px; border-radius: 50%; border: 1px solid #2bdcff30; box-shadow: 0 0 70px #079df218,inset 0 0 50px #079df20b; position: relative; }
.contact-scope .pulseRing:before, .contact-scope .pulseRing:after { content: ""; position: absolute; inset: 18px; border-radius: 50%; border: 1px solid #995cff24; animation: pulseRing 3.5s ease-in-out infinite; }
.contact-scope .pulseRing:after { inset: 39px; border-color: #2bdcff1b; animation-delay: 1s; }
@keyframes pulseRing { 50% { transform: scale(1.08); opacity: .35; } }
.contact-scope .commandCore { position: absolute; left: 50%; top: 50%; transform: translate(-50%,-50%); width: 76px; height: 76px; border-radius: 22px; background: linear-gradient(135deg,#11a9fb,#0758d2); display: grid; place-items: center; font-size: 25px; font-weight: 950; box-shadow: 0 0 55px #079fff55; color: #FFF; }
.contact-scope .beam { position: absolute; width: 270px; height: 1px; background: linear-gradient(90deg,transparent,#2bdcff,#995cff,transparent); box-shadow: 0 0 15px #2bdcff; }
.contact-scope .b1 { transform: rotate(25deg); }
.contact-scope .b2 { transform: rotate(-25deg); }
.contact-scope .status { position: absolute; padding: 10px 12px; background: #071a30e8; border: 1px solid #1d4669; border-radius: 10px; backdrop-filter: blur(12px); box-shadow: 0 15px 35px #0006; }
.contact-scope .status small { display: block; color: #607994; font-size: 7px; }
.contact-scope .status strong { display: block; font-size: 11px; margin-top: 3px; color: #FFF; }
.contact-scope .st1 { right: 0; top: 8%; }
.contact-scope .st1 strong { color: var(--green); }
.contact-scope .st2 { left: 0; bottom: 9%; }
.contact-scope .st2 strong { color: var(--cyan); }

/* Main Contact Section */
.contact-scope .contactSection { padding: 78px 0 90px; background: var(--bg); }
.contact-scope .intro { text-align: center; max-width: 700px; margin: 0 auto 38px; }
.contact-scope .intro .eyebrow { color: #078fdd; background: #edfaff; border-color: #c4edff; }
.contact-scope .intro h2 { font-size: 33px; letter-spacing: -.055em; margin-top: 10px; color: var(--ink); }
.contact-scope .intro p { font-size: 11px; color: #7b8b9d; margin-top: 7px; }
.contact-scope .contactGrid { display: grid; grid-template-columns: 1.05fr .8fr; gap: 18px; align-items: start; }

.contact-scope .formCard, .contact-scope .infoCard { background: #fff; border: 1px solid var(--line); border-radius: 17px; box-shadow: var(--shadow); }
.contact-scope .formCard { padding: 28px; }
.contact-scope .cardTitle { display: flex; align-items: flex-start; justify-content: space-between; gap: 15px; margin-bottom: 20px; }
.contact-scope .cardTitle h3 { font-size: 19px; letter-spacing: -.03em; color: var(--ink); }
.contact-scope .cardTitle p { font-size: 9px; color: #8795a5; margin-top: 4px; }
.contact-scope .secure { font-size: 8px; color: #078fdd; background: #edfaff; border: 1px solid #c9efff; padding: 6px 8px; border-radius: 7px; white-space: nowrap; font-weight: 800; }

.contact-scope .form { display: grid; gap: 14px; }
.contact-scope .row { display: grid; grid-template-columns: 1fr 1fr; gap: 11px; }
.contact-scope .field { display: grid; gap: 6px; }
.contact-scope .field label { font-size: 9px; font-weight: 850; color: var(--ink); }
.contact-scope .field input, .contact-scope .field select, .contact-scope .field textarea {
  width: 100%; border: 1px solid #dce5ed; border-radius: 9px; background: #fbfdff; color: var(--ink); outline: 0; padding: 12px; font-size: 10px; transition: .2s;
}
.contact-scope .field textarea { min-height: 125px; resize: vertical; }
.contact-scope .field input:focus, .contact-scope .field select:focus, .contact-scope .field textarea:focus { border-color: #62c8fa; box-shadow: 0 0 0 3px rgba(7,157,242,0.08); }
.contact-scope .formBtn {
  width: 100%; height: 48px; margin-top: 2px; font-size: 11px; font-weight: 900; border-radius: 9px; border: 0; cursor: pointer; color: #fff; background: linear-gradient(135deg,#10a9fb,#075fd6); box-shadow: 0 12px 30px #008fff3b; transition: .25s;
}
.contact-scope .formBtn:hover { transform: translateY(-2px); }
.contact-scope .formNote { font-size: 8px; color: #8a98a7; text-align: center; }
.contact-scope .formNote a { color: #078fdd; }

.contact-scope .infoStack { display: grid; gap: 13px; }
.contact-scope .infoCard { padding: 22px; }
.contact-scope .infoIcon { width: 37px; height: 37px; border-radius: 10px; display: grid; place-items: center; background: #edfaff; color: #078fdd; font-size: 17px; }
.contact-scope .infoCard h3 { font-size: 14px; margin-top: 12px; color: var(--ink); }
.contact-scope .infoCard p { font-size: 10px; color: #71849a; line-height: 1.75; margin-top: 5px; }
.contact-scope .infoCard a { color: #078fdd; font-weight: 850; }
.contact-scope .hours { display: grid; gap: 5px; margin-top: 11px; border-top: 1px solid #edf1f5; padding-top: 11px; }
.contact-scope .hours div { display: flex; justify-content: space-between; font-size: 9px; color: #71849a; }
.contact-scope .hours b { color: var(--ink); }
.contact-scope .online { color: #09ae8e !important; font-weight: 800; }

/* Support Strip */
.contact-scope .supportSection { padding: 0 0 85px; background: var(--bg); }
.contact-scope .supportGrid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 13px; }
.contact-scope .supportCard { padding: 21px; background: linear-gradient(135deg,#07182e,#0a2038); border: 1px solid #183d5d; border-radius: 14px; color: #fff; }
.contact-scope .supportCard .icon { font-size: 20px; color: var(--cyan); }
.contact-scope .supportCard h3 { font-size: 13px; margin-top: 10px; color: #FFF; }
.contact-scope .supportCard p { font-size: 9px; line-height: 1.7; color: #8297ad; margin-top: 5px; }
.contact-scope .supportCard a { display: inline-block; color: var(--cyan); font-size: 9px; font-weight: 900; margin-top: 10px; }

/* Office Hub Visual */
.contact-scope .officeSection { padding: 80px 0; background: #fff; }
.contact-scope .officeGrid { display: grid; grid-template-columns: .85fr 1.15fr; gap: 40px; align-items: center; }
.contact-scope .officeText .eyebrow { color: #078fdd; background: #edfaff; border-color: #c4edff; }
.contact-scope .officeText h2 { font-size: 34px; letter-spacing: -.055em; margin-top: 11px; color: var(--ink); }
.contact-scope .officeText p { font-size: 11px; color: #788a9d; line-height: 1.8; margin-top: 8px; }
.contact-scope .address { margin-top: 19px; padding: 17px; border: 1px solid var(--line); border-radius: 12px; background: #f9fbfd; }
.contact-scope .address b { font-size: 11px; color: var(--ink); }
.contact-scope .address p { font-size: 9px; line-height: 1.7; margin-top: 5px; color: #788a9d; }

.contact-scope .officeVisual { height: 285px; border-radius: 17px; background: linear-gradient(135deg,#040f20,#09243d); border: 1px solid #1b4667; position: relative; overflow: hidden; box-shadow: 0 22px 60px rgba(7,26,50,0.08); }
.contact-scope .officeVisual:before { content: ""; position: absolute; inset: 0; background-image: linear-gradient(#2bdcff0b 1px,transparent 1px),linear-gradient(90deg,#2bdcff0b 1px,transparent 1px); background-size: 37px 37px; }
.contact-scope .building { position: absolute; left: 50%; top: 50%; transform: translate(-50%,-50%); width: 200px; height: 135px; background: linear-gradient(145deg,#0c3554,#092640); border: 1px solid #2bdcff44; clip-path: polygon(10% 28%,90% 28%,100% 100%,0 100%); }
.contact-scope .building:before { content: ""; position: absolute; left: 50%; top: -45px; transform: translateX(-50%); border-left: 100px solid transparent; border-right: 100px solid transparent; border-bottom: 48px solid #0c3554; }
.contact-scope .building:after { content: "RP"; position: absolute; left: 50%; top: 48%; transform: translate(-50%,-50%); color: #2bdcff; font-weight: 950; font-size: 20px; text-shadow: 0 0 18px #2bdcff; }
.contact-scope .pin { position: absolute; left: 50%; top: 29%; width: 14px; height: 14px; border-radius: 50%; background: var(--cyan); box-shadow: 0 0 25px var(--cyan); animation: float 2.8s ease-in-out infinite; }
@keyframes float { 50% { transform: translateY(-9px); } }
.contact-scope .routeLine { position: absolute; width: 210px; height: 1px; left: 20%; top: 57%; background: linear-gradient(90deg,transparent,#2bdcff,#995cff,transparent); transform: rotate(-19deg); box-shadow: 0 0 13px #2bdcff; }

/* CTA Section */
.contact-scope .cta { padding: 60px 0; background: #f4f7fb; }
.contact-scope .ctaBox { padding: 31px 35px; border-radius: 17px; background: linear-gradient(120deg,#07182e,#0b2542); border: 1px solid #1d4d73; color: #fff; display: flex; align-items: center; justify-content: space-between; }
.contact-scope .ctaBox h2 { font-size: 23px; letter-spacing: -.04em; color: #FFF; }
.contact-scope .ctaBox p { font-size: 10px; color: #8298ad; margin-top: 5px; }

@media(max-width:950px){
  .contact-scope .heroGrid, .contact-scope .contactGrid, .contact-scope .officeGrid { grid-template-columns: 1fr; }
  .contact-scope .command { order: -1; height: 300px; }
  .contact-scope .supportGrid { grid-template-columns: 1fr 1fr; }
}
@media(max-width:620px){
  .contact-scope .hero { padding-top: 30px; }
  .contact-scope .hero h1 { font-size: 42px; }
  .contact-scope .row { grid-template-columns: 1fr; }
  .contact-scope .formCard { padding: 21px; }
  .contact-scope .supportGrid { grid-template-columns: 1fr; }
  .contact-scope .officeVisual { height: 250px; }
  .contact-scope .ctaBox { display: block; }
}
</style>

<div class="contact-scope">
    <!-- Hero Section -->
    <section class="hero">
        <div class="heroGlow"></div>
        <div class="container heroGrid">
            <div>
                <div class="eyebrow"><i></i> Get in Touch</div>
                <h1>Let's move<br><span>things forward.</span></h1>
                <p>Contact Rush Parcel Support & Sales — Whether you need help with a shipment, want to discuss business logistics or simply have a question, the Rush Parcel team is ready to help.</p>
                <div class="heroStats">
                    <div>
                        <strong>0800 123 4567</strong>
                        <small>UK SUPPORT</small>
                    </div>
                    <div>
                        <strong>24/7</strong>
                        <small>ONLINE PLATFORM</small>
                    </div>
                    <div>
                        <strong>UK</strong>
                        <small>OPERATIONS</small>
                    </div>
                </div>
            </div>

            <div class="command">
                <div class="beam b1"></div>
                <div class="beam b2"></div>
                <div class="pulseRing">
                    <div class="commandCore">RP</div>
                </div>
                <div class="status st1"><small>SUPPORT STATUS</small><strong>● AVAILABLE</strong></div>
                <div class="status st2"><small>RESPONSE CHANNEL</small><strong>DIRECT</strong></div>
            </div>
        </div>
    </section>

    <!-- Main Contact Form & Info Cards -->
    <section class="contactSection">
        <div class="container">
            <div class="intro">
                <div class="eyebrow">Contact Centre</div>
                <h2>How can we help?</h2>
                <p>Send us a message and we'll route your enquiry to the right Rush Parcel team.</p>
            </div>

            <div class="contactGrid">
                <!-- Form Card -->
                <div class="formCard">
                    <div class="cardTitle">
                        <div>
                            <h3>Send us a message</h3>
                            <p>Typical response during support hours: as soon as possible.</p>
                        </div>
                        <span class="secure">🔒 SECURE FORM</span>
                    </div>

                    <form class="form" action="<?= url('/contact') ?>" method="POST">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="field">
                                <label for="name">Full Name *</label>
                                <input type="text" id="name" name="name" required placeholder="e.g. Sarah Jenkins">
                            </div>
                            <div class="field">
                                <label for="company">Company</label>
                                <input type="text" id="company" name="company" placeholder="Company name (optional)">
                            </div>
                        </div>

                        <div class="row">
                            <div class="field">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" name="email" required placeholder="you@example.co.uk">
                            </div>
                            <div class="field">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone" placeholder="e.g. 07700 900123">
                            </div>
                        </div>

                        <div class="field">
                            <label for="subject">What can we help with? *</label>
                            <select id="subject" name="subject" required>
                                <option value="">Select an enquiry type</option>
                                <option value="Parcel / Delivery Support">Parcel / Delivery Support</option>
                                <option value="Get a Quote">Get a Quote</option>
                                <option value="Business / Corporate Account">Business / Corporate Account</option>
                                <option value="Tracking Support">Tracking Support</option>
                                <option value="Billing / Invoice">Billing / Invoice</option>
                                <option value="General Enquiry">General Enquiry</option>
                            </select>
                        </div>

                        <div class="field">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" required placeholder="Tell us how we can help..."></textarea>
                        </div>

                        <button class="formBtn" type="submit">Send Message &rarr;</button>
                        <div class="formNote">By submitting this form you agree to our <a href="<?= url('/privacy') ?>">Privacy Policy</a>.</div>
                    </form>
                </div>

                <!-- Info Cards Stack -->
                <div class="infoStack">
                    <div class="infoCard">
                        <div class="infoIcon">☎</div>
                        <h3>Phone Support</h3>
                        <p>Speak directly with our UK customer support team.</p>
                        <p><a href="tel:08001234567">0800 123 4567</a></p>
                        <div class="hours">
                            <div><span>Mon – Fri</span><b>07:30 – 19:00</b></div>
                            <div><span>Saturday</span><b>08:00 – 13:00</b></div>
                            <div><span>Sunday</span><b>Online support</b></div>
                        </div>
                    </div>

                    <div class="infoCard">
                        <div class="infoIcon">✉</div>
                        <h3>Email Support</h3>
                        <p>Customer Services: <a href="mailto:support@rushparcel.co.uk">support@rushparcel.co.uk</a></p>
                        <p>Corporate Accounts: <a href="mailto:sales@rushparcel.co.uk">sales@rushparcel.co.uk</a></p>
                    </div>

                    <div class="infoCard">
                        <div class="infoIcon">⌖</div>
                        <h3>Operations Hub</h3>
                        <p>Rush Parcel Platform Logistics Centre<br>100 Express Way, Park Royal<br>London NW10 7XQ<br>United Kingdom</p>
                        <p class="online">● UK operations hub</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Support Strip -->
    <section class="supportSection">
        <div class="container">
            <div class="supportGrid">
                <div class="supportCard">
                    <div class="icon">⚡</div>
                    <h3>Need a quick quote?</h3>
                    <p>Get a server-verified UK delivery price in minutes.</p>
                    <a href="<?= url('/quote') ?>">Get a Quote &rarr;</a>
                </div>
                <div class="supportCard">
                    <div class="icon">◎</div>
                    <h3>Looking for a parcel?</h3>
                    <p>Enter your shipment reference and see the latest status.</p>
                    <a href="<?= url('/track') ?>">Track Parcel &rarr;</a>
                </div>
                <div class="supportCard">
                    <div class="icon">▣</div>
                    <h3>Business logistics?</h3>
                    <p>Talk to our team about recurring shipments and corporate solutions.</p>
                    <a href="#contactForm">Speak to Sales &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Office Hub Location Section -->
    <section class="officeSection">
        <div class="container officeGrid">
            <div class="officeText">
                <div class="eyebrow">UK Operations</div>
                <h2>Built close to the action.</h2>
                <p>Our UK-focused operation is designed around responsive customer support and dependable courier coordination.</p>
                <div class="address">
                    <b>Rush Parcel Platform Logistics Centre</b>
                    <p>100 Express Way, Park Royal<br>London NW10 7XQ<br>United Kingdom</p>
                </div>
            </div>

            <div class="officeVisual">
                <div class="routeLine"></div>
                <div class="pin"></div>
                <div class="building"></div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <div class="ctaBox">
                <div>
                    <h2>Prefer to start online?</h2>
                    <p>Get your UK courier price or track an existing shipment instantly.</p>
                    <a class="btn primary" href="<?= url('/quote') ?>">Get an Instant Quote &rarr;</a>
                </div>
                <div style="font-size: 55px; color: #2bdcff; text-shadow: 0 0 30px #2bdcff77;">✦</div>
            </div>
        </div>
    </section>
</div>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
