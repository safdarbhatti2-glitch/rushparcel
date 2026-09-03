<?php ob_start(); ?>

<style>
.dropoff-scope {
  --ink:#071426;--muted:#71839a;--blue:#079df2;--cyan:#2bdcff;--violet:#9858ff;
  --navy:#030914;--navy2:#07162a;--line:#dfe7ef;--bg:#f5f8fc;--white:#fff;
  --green:#22c99b;--shadow:0 24px 70px rgba(7,24,48,.12);
  margin: -1.5rem -1.25rem -5rem -1.25rem;
  background: var(--bg);
  color: var(--ink);
}
.dropoff-scope .container { width: min(1200px, calc(100% - 40px)); margin: auto; }
.dropoff-scope .hero {
  position: relative; overflow: hidden; min-height: 700px; padding: 60px 0 72px;
  background:
    radial-gradient(circle at 76% 43%,#0ca9ff16,transparent 23%),
    radial-gradient(circle at 85% 70%,#995cff12,transparent 25%),
    linear-gradient(135deg,#030914 0%,#06162b 60%,#071c34 100%);
  color: #fff;
}
.dropoff-scope .hero:before {
  content: ""; position: absolute; inset: 0;
  background-image: linear-gradient(#239bd60b 1px,transparent 1px),linear-gradient(90deg,#239bd60b 1px,transparent 1px);
  background-size: 52px 52px; mask-image: linear-gradient(#000,transparent 88%);
}
.dropoff-scope .hero:after {
  content: ""; position: absolute; width: 600px; height: 600px; right: -250px; top: -120px; border-radius: 50%;
  border: 1px solid #28dfff0b; box-shadow: 0 0 100px #079fff0a,inset 0 0 100px #079fff07;
}
.dropoff-scope .heroGrid { position: relative; z-index: 2; display: grid; grid-template-columns: 1fr 1fr; gap: 65px; align-items: center; }
.dropoff-scope .eyebrow {
  display: inline-flex; align-items: center; gap: 7px; padding: 7px 12px; border-radius: 99px; background: #06243a;
  border: 1px solid #1aa8e950; color: #32dcff; font-size: 8px; font-weight: 950; letter-spacing: .15em; text-transform: uppercase;
}
.dropoff-scope .eyebrow i { width: 6px; height: 6px; border-radius: 50%; background: #2de0b2; box-shadow: 0 0 10px #2de0b2; animation: pulse 1.5s infinite; }
@keyframes pulse { 50% { opacity: .35; } }

.dropoff-scope .hero h1 { font-size: 57px; line-height: .96; letter-spacing: -.07em; margin-top: 16px; color: #FFF; }
.dropoff-scope .hero h1 span { color: #2bdcff; }
.dropoff-scope .heroCopy { font-size: 13px; color: #879ab0; line-height: 1.75; max-width: 540px; margin-top: 14px; }
.dropoff-scope .heroActions { display: flex; gap: 9px; margin-top: 22px; }
.dropoff-scope .stats { display: flex; gap: 28px; margin-top: 30px; }
.dropoff-scope .stat strong { display: block; font-size: 20px; color: #FFF; }
.dropoff-scope .stat small { display: block; color: #627c96; font-size: 8px; letter-spacing: .1em; margin-top: 3px; }

/* Network Orbital Visual */
.dropoff-scope .networkVisual { height: 455px; position: relative; display: grid; place-items: center; }
.dropoff-scope .orb { width: 330px; height: 330px; border-radius: 50%; position: relative; border: 1px solid #27ddff39; box-shadow: 0 0 70px #079fff16,inset 0 0 65px #079fff0d; }
.dropoff-scope .orb:before, .dropoff-scope .orb:after { content: ""; position: absolute; border: 1px solid #27ddff24; border-radius: 50%; inset: 25px; transform: rotate(48deg) scaleX(.52); }
.dropoff-scope .orb:after { transform: rotate(-48deg) scaleX(.52); }
.dropoff-scope .orbGrid { position: absolute; inset: 48px; border: 1px solid #9a5cff18; border-radius: 50%; transform: rotate(60deg) scaleX(.55); }
.dropoff-scope .orbCore { position: absolute; left: 50%; top: 50%; transform: translate(-50%,-50%); width: 88px; height: 88px; border-radius: 50%; display: grid; place-items: center; background: radial-gradient(circle,#20cfff2b,#0b294800 68%); border: 1px solid #2bdcff55; box-shadow: 0 0 50px #20d5ff2b; color: #2bdcff; font-size: 32px; }
.dropoff-scope .orbit { position: absolute; inset: -16px; border: 1px solid #2bdcff18; border-radius: 50%; animation: spin 16s linear infinite; }
.dropoff-scope .orbit:before { content: ""; position: absolute; width: 9px; height: 9px; border-radius: 50%; background: #2bdcff; box-shadow: 0 0 18px #2bdcff; left: 50%; top: -5px; }
@keyframes spin { to { transform: rotate(360deg); } }

.dropoff-scope .city { position: absolute; display: flex; align-items: center; gap: 6px; color: #94abc2; font-size: 9px; font-weight: 800; }
.dropoff-scope .city i { width: 7px; height: 7px; border-radius: 50%; background: #0c2840; border: 1px solid #2bdcff; box-shadow: 0 0 12px #2bdcff; }
.dropoff-scope .city:nth-child(5) { left: 1%; top: 27%; }
.dropoff-scope .city:nth-child(6) { right: 2%; top: 34%; }
.dropoff-scope .city:nth-child(7) { left: 3%; bottom: 25%; }
.dropoff-scope .city:nth-child(8) { right: 5%; bottom: 21%; }

.dropoff-scope .floatCard { position: absolute; background: #071a30df; border: 1px solid #1e4567; border-radius: 10px; padding: 10px 12px; backdrop-filter: blur(12px); box-shadow: 0 15px 40px #0005; }
.dropoff-scope .floatCard small { display: block; color: #5f7c97; font-size: 7px; }
.dropoff-scope .floatCard strong { display: block; font-size: 12px; margin-top: 3px; color: #FFF; }
.dropoff-scope .fc1 { right: 0; top: 16%; }
.dropoff-scope .fc2 { left: -2%; top: 61%; }
.dropoff-scope .fc3 { right: 3%; bottom: 5%; }
.dropoff-scope .fc2 strong { color: #2bdcff; }
.dropoff-scope .fc3 strong { color: #39dfb5; }

/* Search Section */
.dropoff-scope .searchSection { margin-top: -1px; background: #fff; color: var(--ink); padding: 70px 0; }
.dropoff-scope .searchHead { text-align: center; max-width: 680px; margin: auto; }
.dropoff-scope .searchHead .eyebrow { color: #078fdd; background: #edfaff; border-color: #c4edff; }
.dropoff-scope .searchHead h2 { font-size: 31px; letter-spacing: -.05em; margin-top: 10px; color: var(--ink); }
.dropoff-scope .searchHead p { font-size: 11px; color: #7b8a9c; margin-top: 7px; }
.dropoff-scope .searchCard { width: min(940px,100%); margin: 28px auto 0; padding: 24px; border: 1px solid #dce5ee; border-radius: 16px; background: #fff; box-shadow: var(--shadow); }
.dropoff-scope .searchForm { display: grid; grid-template-columns: 1fr 155px; gap: 9px; }
.dropoff-scope .searchInput { height: 51px; border: 1px solid #dbe4ed; border-radius: 9px; display: flex; align-items: center; padding: 0 14px; background: #f9fbfd; }
.dropoff-scope .searchInput span { color: #079df2; margin-right: 8px; font-size: 16px; }
.dropoff-scope .searchInput input { width: 100%; border: 0; outline: 0; background: transparent; color: var(--ink); font-size: 11px; }
.dropoff-scope .searchInput input::placeholder { color: #8b99a9; }
.dropoff-scope .searchBtn { height: 51px; border-radius: 9px; font-weight: 900; font-size: 11px; border: 0; cursor: pointer; color: #fff; background: linear-gradient(135deg,#10a9fb,#075fd6); box-shadow: 0 12px 30px #008fff3c; transition: .25s; }
.dropoff-scope .searchBtn:hover { transform: translateY(-2px); }
.dropoff-scope .searchMeta { display: flex; justify-content: space-between; margin-top: 9px; color: #8190a1; font-size: 9px; }
.dropoff-scope .use { color: #078fdd; font-weight: 850; cursor: pointer; }

/* How Steps */
.dropoff-scope .how { padding: 82px 0; background: #f6f9fc; }
.dropoff-scope .sectionTitle { text-align: center; max-width: 670px; margin: auto auto 38px; }
.dropoff-scope .sectionTitle .eyebrow { color: #078fdd; background: #edfaff; border-color: #c4edff; }
.dropoff-scope .sectionTitle h2 { font-size: 31px; letter-spacing: -.05em; margin-top: 10px; color: var(--ink); }
.dropoff-scope .sectionTitle p { font-size: 11px; color: #7c8c9e; margin-top: 7px; }
.dropoff-scope .steps { display: grid; grid-template-columns: repeat(4, 1fr); position: relative; gap: 15px; }
.dropoff-scope .steps:before { content: ""; position: absolute; top: 23px; left: 10%; right: 10%; height: 1px; background: linear-gradient(90deg,#cbd9e5,#079fff,#cbd9e5); }
.dropoff-scope .step { text-align: center; position: relative; z-index: 2; }
.dropoff-scope .stepNum { width: 47px; height: 47px; margin: auto; border-radius: 50%; display: grid; place-items: center; background: #fff; border: 1px solid #cfe0eb; color: #078fdd; font-size: 12px; font-weight: 950; box-shadow: 0 0 0 7px #f6f9fc; }
.dropoff-scope .step h3 { font-size: 13px; margin-top: 15px; color: var(--ink); }
.dropoff-scope .step p { font-size: 10px; color: #7d8c9d; line-height: 1.65; margin-top: 5px; }

/* Location Network */
.dropoff-scope .networkSection { padding: 85px 0; background: #fff; }
.dropoff-scope .networkGrid { display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center; }
.dropoff-scope .networkText .eyebrow { color: #078fdd; background: #edfaff; border-color: #c4edff; }
.dropoff-scope .networkText h2 { font-size: 35px; letter-spacing: -.055em; margin-top: 11px; line-height: 1.08; color: var(--ink); }
.dropoff-scope .networkText > p { font-size: 11px; color: #7a899b; line-height: 1.75; margin-top: 9px; max-width: 510px; }
.dropoff-scope .regions { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-top: 20px; }
.dropoff-scope .region { padding: 11px 13px; border: 1px solid #e0e8ef; border-radius: 999px; background: #fbfdff; font-size: 9px; color: #53677d; transition: .2s; }
.dropoff-scope .region:hover { border-color: #9fdcff; transform: translateX(3px); }
.dropoff-scope .region b { display: block; color: var(--ink); font-size: 10px; margin-bottom: 3px; }
.dropoff-scope .region b:before { content: "✓"; color: #0cbb92; margin-right: 5px; font-weight: 900; }

.dropoff-scope .ukMap { height: 390px; position: relative; border-radius: 17px; overflow: hidden; background: radial-gradient(circle at 50% 50%,#0ca9ff16,transparent 30%),linear-gradient(135deg,#041123,#071a30); border: 1px solid #1a4263; box-shadow: 0 20px 55px rgba(3, 21, 43, 0.25); }
.dropoff-scope .ukMap:before { content: ""; position: absolute; inset: 0; background-image: linear-gradient(#2bdcff09 1px,transparent 1px),linear-gradient(90deg,#2bdcff09 1px,transparent 1px); background-size: 40px 40px; }
.dropoff-scope .mapShape { position: absolute; width: 235px; height: 285px; left: 50%; top: 50%; transform: translate(-50%,-50%) rotate(8deg); background: linear-gradient(145deg,#0c3554,#08243f); clip-path: polygon(49% 0,62% 7%,61% 15%,72% 22%,70% 30%,81% 39%,78% 47%,88% 54%,78% 61%,82% 72%,69% 75%,65% 89%,53% 100%,44% 91%,38% 83%,28% 82%,22% 72%,9% 69%,14% 58%,5% 48%,15% 38%,12% 28%,26% 23%,28% 13%,41% 12%); box-shadow: 0 0 50px #079fff20; }
.dropoff-scope .mapShape:after { content: ""; position: absolute; inset: 12px; background-image: linear-gradient(35deg,transparent 47%,#2bdcff2a 48%,transparent 49%),linear-gradient(125deg,transparent 49%,#2bdcff20 50%,transparent 51%); clip-path: inherit; }
.dropoff-scope .mapPoint { position: absolute; width: 9px; height: 9px; border-radius: 50%; background: #071b30; border: 2px solid #2bdcff; box-shadow: 0 0 16px #2bdcff; z-index: 3; }
.dropoff-scope .mapPoint span { position: absolute; white-space: nowrap; color: #91a8be; font-size: 8px; left: 13px; top: -3px; font-weight: 800; }
.dropoff-scope .mp1 { left: 48%; top: 61%; }
.dropoff-scope .mp2 { left: 51%; top: 44%; }
.dropoff-scope .mp3 { left: 49%; top: 28%; }
.dropoff-scope .mp4 { left: 58%; top: 31%; }
.dropoff-scope .mp5 { left: 40%; top: 66%; }
.dropoff-scope .mp6 { left: 46%; top: 12%; }
.dropoff-scope .mapLine { position: absolute; height: 1px; background: linear-gradient(90deg,transparent,#2bdcff,#9d5cff,#2bdcff,transparent); box-shadow: 0 0 13px #2bdcff; z-index: 2; transform-origin: left; }
.dropoff-scope .ml1 { width: 145px; left: 40%; top: 62%; transform: rotate(-34deg); }
.dropoff-scope .ml2 { width: 125px; left: 50%; top: 45%; transform: rotate(17deg); }
.dropoff-scope .ml3 { width: 140px; left: 50%; top: 30%; transform: rotate(73deg); }

/* Commercial CTA */
.dropoff-scope .cta { padding: 65px 0; background: linear-gradient(135deg,#040d1d,#081d36); color: #fff; }
.dropoff-scope .ctaBox { border: 1px solid #1c4b70; border-radius: 17px; padding: 30px 35px; display: flex; justify-content: space-between; align-items: center; background: radial-gradient(circle at 90% 50%,#0ca9ff14,transparent 25%),#071a30; }
.dropoff-scope .ctaBox h2 { font-size: 23px; letter-spacing: -.04em; color: #FFF; }
.dropoff-scope .ctaBox p { font-size: 10px; color: #8195ad; margin-top: 5px; }

@media(max-width:950px){
  .dropoff-scope .heroGrid, .dropoff-scope .networkGrid { grid-template-columns: 1fr; }
  .dropoff-scope .networkVisual { order: -1; height: 360px; }
  .dropoff-scope .orb { width: 270px; height: 270px; }
  .dropoff-scope .steps { grid-template-columns: 1fr 1fr; }
  .dropoff-scope .steps:before { display: none; }
}
@media(max-width:620px){
  .dropoff-scope .hero { padding-top: 40px; }
  .dropoff-scope .hero h1 { font-size: 40px; }
  .dropoff-scope .searchForm { grid-template-columns: 1fr; }
  .dropoff-scope .searchMeta { display: block; line-height: 1.8; }
  .dropoff-scope .steps { grid-template-columns: 1fr 1fr; }
  .dropoff-scope .regions { grid-template-columns: 1fr; }
  .dropoff-scope .ukMap { height: 340px; }
  .dropoff-scope .ctaBox { display: block; }
}
</style>

<div class="dropoff-scope">
    <!-- Hero Section -->
    <section class="hero">
        <div class="container heroGrid">
            <div>
                <div class="eyebrow"><i></i> Rush Parcel Network</div>
                <h1>Your parcel's<br><span>next stop.</span></h1>
                <p class="heroCopy">UK Parcel Drop-off Locations — Find a convenient Rush Parcel drop-off point anywhere across the UK. From local parcel shops to 24/7 smart lockers and commercial freight depots.</p>
                <div class="heroActions">
                    <a class="btn primary" href="#finder">Find a Location &rarr;</a>
                    <a class="btn outline" href="#network">Explore Network</a>
                </div>
                <div class="stats">
                    <div class="stat">
                        <strong>1,240+</strong>
                        <small>LOCATIONS</small>
                    </div>
                    <div class="stat">
                        <strong>680+</strong>
                        <small>SMART LOCKERS</small>
                    </div>
                    <div class="stat">
                        <strong>98%</strong>
                        <small>UK COVERAGE</small>
                    </div>
                </div>
            </div>

            <!-- Orbital Network Sculpture -->
            <div class="networkVisual">
                <div class="orb">
                    <div class="orbit"></div>
                    <div class="orbGrid"></div>
                    <div class="orbCore">⌖</div>
                </div>
                <div class="city"><i></i> Glasgow</div>
                <div class="city"><i></i> Leeds</div>
                <div class="city"><i></i> Bristol</div>
                <div class="city"><i></i> London</div>
                <div class="floatCard fc1"><small>NETWORK STATUS</small><strong>● ONLINE</strong></div>
                <div class="floatCard fc2"><small>ACTIVE LOCATIONS</small><strong>1,240+</strong></div>
                <div class="floatCard fc3"><small>SMART ACCESS</small><strong>24 / 7</strong></div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="searchSection" id="finder">
        <div class="container">
            <div class="searchHead">
                <div class="eyebrow">Find Your Point</div>
                <h2>One search. Your nearest location.</h2>
                <p>Enter a UK postcode, town or city and discover Rush Parcel locations, opening hours and available services.</p>
            </div>

            <div class="searchCard">
                <form class="searchForm" id="searchForm" action="<?= url('/drop-off') ?>" method="GET">
                    <div class="searchInput">
                        <span>⌖</span>
                        <input type="text" id="query" name="q" required placeholder="Enter postcode, town or city — e.g. M1 1AE or London">
                    </div>
                    <button class="searchBtn" type="submit">Find Locations &rarr;</button>
                </form>
                <div class="searchMeta">
                    <span>Search across the Rush Parcel UK network · Locations shown by proximity</span>
                    <span class="use" id="useLocationBtn">◎ Use my current location</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 4-Step Process -->
    <section class="how">
        <div class="container">
            <div class="sectionTitle">
                <div class="eyebrow">Simple Drop-off</div>
                <h2>Four steps. Zero friction.</h2>
                <p>We designed the Rush Parcel drop-off experience to be quick, clear and convenient.</p>
            </div>
            <div class="steps">
                <div class="step">
                    <div class="stepNum">01</div>
                    <h3>Search</h3>
                    <p>Enter your postcode or town to find nearby points.</p>
                </div>
                <div class="step">
                    <div class="stepNum">02</div>
                    <h3>Choose</h3>
                    <p>Compare distance, opening hours and services.</p>
                </div>
                <div class="step">
                    <div class="stepNum">03</div>
                    <h3>Drop Off</h3>
                    <p>Hand over your labelled parcel securely.</p>
                </div>
                <div class="step">
                    <div class="stepNum">04</div>
                    <h3>Track</h3>
                    <p>Use your reference to follow the shipment.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Infrastructure Grid & UK Map -->
    <section class="networkSection" id="network">
        <div class="container networkGrid">
            <div class="networkText">
                <div class="eyebrow">UK-Wide Infrastructure</div>
                <h2>Connected across the UK.</h2>
                <p>Our location network brings parcel shops, smart lockers and freight facilities together so customers can choose the handover option that works best for them.</p>
                <div class="regions">
                    <div class="region"><b>London & South East</b>Extensive parcel shop coverage</div>
                    <div class="region"><b>Midlands</b>Major hub & locker network</div>
                    <div class="region"><b>North West</b>Dense urban coverage</div>
                    <div class="region"><b>Yorkshire & North East</b>Regional drop-off network</div>
                    <div class="region"><b>South West</b>Local partner locations</div>
                    <div class="region"><b>Scotland & Wales</b>Connected regional routes</div>
                </div>
            </div>

            <div class="ukMap">
                <div class="mapShape"></div>
                <div class="mapLine ml1"></div>
                <div class="mapLine ml2"></div>
                <div class="mapLine ml3"></div>
                <div class="mapPoint mp1"><span>London</span></div>
                <div class="mapPoint mp2"><span>Birmingham</span></div>
                <div class="mapPoint mp3"><span>Manchester</span></div>
                <div class="mapPoint mp4"><span>Leeds</span></div>
                <div class="mapPoint mp5"><span>Bristol</span></div>
                <div class="mapPoint mp6"><span>Glasgow</span></div>
            </div>
        </div>
    </section>

    <!-- Commercial CTA Banner -->
    <section class="cta">
        <div class="container">
            <div class="ctaBox">
                <div>
                    <h2>Need a commercial drop-off solution?</h2>
                    <p>Ask our logistics team about dedicated depot access, scheduled collections and business shipping support.</p>
                    <a class="btn primary" href="<?= url('/contact') ?>">Talk to Our Team &rarr;</a>
                </div>
                <div style="font-size: 55px; color: #2bdcff; text-shadow: 0 0 30px #2bdcff77;">⌖</div>
            </div>
        </div>
    </section>
</div>

<script>
document.getElementById('useLocationBtn').addEventListener('click', function() {
    if (!navigator.geolocation) {
        alert('Geolocation is not supported by your browser.');
        return;
    }
    navigator.geolocation.getCurrentPosition(function(pos) {
        document.getElementById('query').value = pos.coords.latitude.toFixed(4) + ', ' + pos.coords.longitude.toFixed(4);
    }, function() {
        alert('Location access unavailable. Please enter a postcode manually.');
    });
});
</script>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
