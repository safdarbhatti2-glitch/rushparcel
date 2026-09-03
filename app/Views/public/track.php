<?php ob_start(); ?>

<style>
.track-scope {
  --bg:#F8FAFC;--panel:#FFFFFF;--panel2:#FFFFFF;--panel3:#F1F5F9;
  --blue:#EA580C;--cyan:#EA580C;--violet:#0284C7;--green:#16A34A;
  --white:#0F172A;--muted:#64748B;--line:#E2E8F0;--danger:#DC2626;
  margin: -1.5rem -1.25rem -5rem -1.25rem;
  background: var(--bg);
  color: var(--white);
  position: relative;
}
.track-scope:before {
  content: ""; position: absolute; inset: 0; pointer-events: none;
  background-image: linear-gradient(rgba(234,88,12,.035) 1px,transparent 1px),linear-gradient(90deg,rgba(234,88,12,.035) 1px,transparent 1px);
  background-size: 50px 50px; mask-image: linear-gradient(#000,transparent 80%); z-index: 1;
}
.track-scope .container { width: min(1220px, calc(100% - 40px)); margin: auto; position: relative; z-index: 2; }
.track-scope .hero {
  min-height: 520px;
  padding-top: 50px;
  padding-bottom: 60px;
  position: relative;
  overflow: hidden;
  background:
    radial-gradient(circle at 68% 40%,#EA580C10,transparent 27%),
    radial-gradient(circle at 90% 65%,#0284C710,transparent 25%),
    linear-gradient(180deg,#FFFFFF,#F8FAFC 65%,#FFF7ED);
  border-bottom: 1px solid #E2E8F0;
}
.track-scope .hero:after {
  content: ""; position: absolute; width: 650px; height: 650px; right: -300px; top: 100px; border-radius: 50%; background: rgba(234,88,12,0.04); filter: blur(50px);
}
.track-scope .heroHead { position: relative; z-index: 3; text-align: center; }
.track-scope .eyebrow {
  display: inline-flex; align-items: center; gap: 7px; border: 1px solid #FFEDD5; background: #FFF7ED; border-radius: 99px;
  padding: 7px 12px; color: #EA580C; font-size: 8px; font-weight: 950; letter-spacing: .15em; text-transform: uppercase;
}
.track-scope .eyebrow i { width: 6px; height: 6px; border-radius: 50%; background: #16A34A; box-shadow: 0 0 10px #16A34A; animation: pulse 1.6s infinite; }
@keyframes pulse { 50% { opacity: .35; } }

.track-scope .hero h1 { font-size: 48px; line-height: 1.02; letter-spacing: -.065em; margin-top: 15px; color: #0F172A; }
.track-scope .hero h1 em { font-style: normal; color: #EA580C; }
.track-scope .heroHead p { max-width: 650px; margin: 10px auto 0; color: #475569; font-size: 13px; line-height: 1.65; }

.track-scope .command { position: relative; z-index: 5; width: min(1050px,100%); margin: 32px auto 0; }
.track-scope .searchPanel { padding: 21px; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 16px; box-shadow: 0 10px 35px rgba(15,23,42,0.06); }
.track-scope .searchTop { display: flex; align-items: center; justify-content: space-between; }
.track-scope .searchTitle { display: flex; gap: 10px; align-items: center; }
.track-scope .searchIcon { width: 40px; height: 40px; border-radius: 11px; display: grid; place-items: center; color: #EA580C; border: 1px solid #FFEDD5; background: #FFF7ED; font-size: 18px; }
.track-scope .searchTitle h2 { font-size: 16px; color: #0F172A; }
.track-scope .searchTitle p { font-size: 9px; color: #64748B; margin-top: 2px; }
.track-scope .network { display: flex; align-items: center; gap: 7px; color: #16A34A; font-size: 8px; font-weight: 900; }
.track-scope .network i { width: 6px; height: 6px; border-radius: 50%; background: #16A34A; box-shadow: 0 0 12px #16A34A; }
.track-scope .form { display: grid; grid-template-columns: 1fr 155px; gap: 9px; margin-top: 16px; }
.track-scope .input { height: 51px; border: 1px solid #E2E8F0; background: #FFFFFF; border-radius: 9px; display: flex; align-items: center; padding: 0 14px; transition: .2s; box-shadow: var(--shadow-xs); }
.track-scope .input:focus-within { border-color: #EA580C; box-shadow: 0 0 0 3px rgba(234,88,12,0.15); }
.track-scope .input span { color: #64748B; font-size: 11px; margin-right: 8px; font-weight: 800; }
.track-scope .input input { width: 100%; border: 0; outline: 0; background: transparent; color: #0F172A; font-size: 12px; font-weight: 700; text-transform: uppercase; }
.track-scope .input input::placeholder { color: #94A3B8; text-transform: none; font-weight: 400; }
.track-scope .trackBtn { height: 51px; font-size: 11px; border-radius: 9px; font-weight: 900; border: 0; cursor: pointer; color: #fff; background: linear-gradient(135deg,#EA580C,#C2410C); box-shadow: 0 4px 14px rgba(234,88,12,0.25); transition: .25s; }
.track-scope .trackBtn:hover { transform: translateY(-2px); }
.track-scope .helper { display: flex; justify-content: space-between; color: #657b94; font-size: 8px; margin-top: 9px; }
.track-scope .demo { color: #32d8ff; cursor: pointer; font-weight: 850; }

.track-scope .dashboard { margin-top: 18px; display: grid; grid-template-columns: 1fr 310px; gap: 12px; }
.track-scope .map {
  min-height: 400px; border: 1px solid #E2E8F0; border-radius: 15px; position: relative; overflow: hidden;
  background: linear-gradient(135deg,#FFFFFF,#F8FAFC 55%,#FFF7ED);
  box-shadow: 0 4px 15px rgba(15,23,42,0.05);
}
.track-scope .map:before {
  content: ""; position: absolute; inset: 0; background-image: linear-gradient(rgba(234,88,12,0.05) 1px,transparent 1px),linear-gradient(90deg,rgba(234,88,12,0.05) 1px,transparent 1px); background-size: 45px 45px;
}
.track-scope .mapLabel { position: absolute; left: 20px; top: 18px; z-index: 4; font-size: 8px; color: #64748B; letter-spacing: .15em; font-weight: 900; }
.track-scope .mapLabel b { color: #EA580C; }
.track-scope .uk {
  position: absolute; width: 330px; height: 370px; left: 50%; top: 49%; transform: translate(-50%,-50%) rotate(8deg); filter: drop-shadow(0 4px 15px rgba(234,88,12,0.1));
}
.track-scope .uk:before {
  content: ""; position: absolute; inset: 0; background: linear-gradient(135deg,#FFF7ED,#FFEDD5);
  clip-path: polygon(49% 0,62% 7%,61% 15%,72% 22%,70% 30%,81% 39%,78% 47%,88% 54%,78% 61%,82% 72%,69% 75%,65% 89%,53% 100%,44% 91%,38% 83%,28% 82%,22% 72%,9% 69%,14% 58%,5% 48%,15% 38%,12% 28%,26% 23%,28% 13%,41% 12%);
  border: 1px solid #FED7AA;
}
.track-scope .uk:after {
  content: ""; position: absolute; inset: 14px; background-image: linear-gradient(35deg,transparent 47%,rgba(234,88,12,0.1) 48%,transparent 49%),linear-gradient(125deg,transparent 49%,rgba(234,88,12,0.08) 50%,transparent 51%); clip-path: inherit;
}
.track-scope .routeLine {
  position: absolute; left: 23%; right: 22%; top: 54%; height: 2px; background: linear-gradient(90deg,transparent,#EA580C,#F97316,transparent); box-shadow: 0 0 12px rgba(234,88,12,0.3); transform: rotate(-12deg); z-index: 5;
}
.track-scope .routeLine:before {
  content: ""; position: absolute; width: 9px; height: 9px; border-radius: 50%; background: #EA580C; box-shadow: 0 0 0 4px rgba(234,88,12,0.15),0 0 15px #EA580C; left: 47%; top: -4px;
}
.track-scope .routeLine:after {
  content: ""; position: absolute; width: 70px; height: 2px; left: 0; top: 0; background: #EA580C; box-shadow: 0 0 10px #EA580C; animation: travel 2.4s linear infinite;
}
@keyframes travel { from { left: 0; } to { left: 100%; } }

.track-scope .node { position: absolute; width: 9px; height: 9px; border-radius: 50%; background: #FFFFFF; border: 2px solid #EA580C; box-shadow: 0 0 10px rgba(234,88,12,0.3); z-index: 6; }
.track-scope .node span { position: absolute; white-space: nowrap; color: #475569; font-size: 8px; left: 13px; top: -3px; font-weight: 800; }
.track-scope .london { left: 47%; bottom: 20%; }
.track-scope .birmingham { left: 51%; top: 48%; }
.track-scope .manchester { left: 47%; top: 28%; }
.track-scope .leeds { left: 57%; top: 30%; }
.track-scope .bristol { left: 39%; top: 61%; }
.track-scope .scotland { left: 46%; top: 11%; }
.track-scope .pulseNode { animation: nodepulse 1.8s infinite; }
@keyframes nodepulse { 50% { box-shadow: 0 0 0 7px rgba(234,88,12,0.12),0 0 18px #EA580C; } }

.track-scope .mapControls { position: absolute; right: 16px; bottom: 16px; display: flex; gap: 5px; z-index: 7; }
.track-scope .mapControls button { height: 29px; width: 29px; border: 1px solid #E2E8F0; background: #FFFFFF; color: #0F172A; border-radius: 7px; cursor: pointer; box-shadow: var(--shadow-xs); }
.track-scope .mapLegend { position: absolute; left: 18px; bottom: 16px; color: #64748B; font-size: 8px; display: flex; gap: 13px; z-index: 7; }
.track-scope .legend { display: flex; gap: 5px; align-items: center; }
.track-scope .legend i { width: 6px; height: 6px; border-radius: 50%; background: #EA580C; }
.track-scope .legend .violet { background: #0284C7; }

/* Status Panel */
.track-scope .statusPanel { border: 1px solid #E2E8F0; border-radius: 15px; background: #FFFFFF; overflow: hidden; box-shadow: 0 4px 20px rgba(15,23,42,0.05); }
.track-scope .statusHead { padding: 18px; border-bottom: 1px solid #F1F5F9; display: flex; justify-content: space-between; }
.track-scope .statusHead small { display: block; color: #64748B; font-size: 7px; letter-spacing: .13em; font-weight: 900; }
.track-scope .statusHead strong { display: block; font-size: 14px; margin-top: 5px; color: #0F172A; }
.track-scope .statusLive { font-size: 7px; color: #16A34A; font-weight: 900; }
.track-scope .statusLive:before { content: "●"; margin-right: 5px; }

.track-scope .statusBody { padding: 18px; }
.track-scope .state { font-size: 10px; color: #EA580C; font-weight: 950; letter-spacing: .09em; }
.track-scope .stateText { font-size: 22px; font-weight: 900; margin-top: 3px; letter-spacing: -.04em; color: #0F172A; }
.track-scope .statusBody p { font-size: 9px; color: #475569; margin-top: 6px; line-height: 1.6; }

.track-scope .statusMetric { border-top: 1px solid #F1F5F9; padding: 13px 0; display: flex; justify-content: space-between; }
.track-scope .statusMetric small { font-size: 8px; color: #64748B; }
.track-scope .statusMetric strong { font-size: 9px; text-align: right; color: #0F172A; }
.track-scope .progress { height: 6px; background: #F1F5F9; border-radius: 99px; margin-top: 4px; overflow: hidden; }
.track-scope .progress i { display: block; width: 75%; height: 100%; background: linear-gradient(90deg,#EA580C,#F97316); }

/* Activity Timeline */
.track-scope .activity { margin-top: 12px; border: 1px solid #E2E8F0; border-radius: 15px; background: #FFFFFF; padding: 22px; box-shadow: 0 4px 20px rgba(15,23,42,0.04); }
.track-scope .activityHead { display: flex; justify-content: space-between; align-items: end; margin-bottom: 18px; }
.track-scope .activityHead h2 { font-size: 15px; color: #0F172A; }
.track-scope .activityHead p { font-size: 8px; color: #64748B; }
.track-scope .events { display: grid; grid-template-columns: repeat(4, 1fr); gap: 0; position: relative; }
.track-scope .events:before { content: ""; position: absolute; left: 7%; right: 7%; top: 13px; height: 2px; background: #E2E8F0; }
.track-scope .event { text-align: center; position: relative; z-index: 2; }
.track-scope .eventDot { width: 27px; height: 27px; margin: auto; border-radius: 50%; border: 1px solid #CBD5E1; background: #F8FAFC; display: grid; place-items: center; color: #64748B; font-size: 9px; }
.track-scope .event.done .eventDot { background: #16A34A; border-color: #16A34A; color: #fff; box-shadow: 0 0 0 4px rgba(22,163,74,0.15); }
.track-scope .event.current .eventDot { background: #EA580C; border-color: #EA580C; color: #fff; box-shadow: 0 0 0 4px rgba(234,88,12,0.18); }
.track-scope .event strong { display: block; font-size: 9px; margin-top: 9px; color: #0F172A; }
.track-scope .event small { display: block; color: #64748B; font-size: 7px; margin-top: 4px; }

/* Result Verification Bar */
.track-scope .resultBar { padding: 15px 18px; border: 1px solid #E2E8F0; border-radius: 12px; background: #F8FAFC; display: flex; justify-content: space-between; align-items: center; margin-top: 12px; }
.track-scope .resultBar strong { font-size: 12px; color: #0F172A; }
.track-scope .resultBar small { display: block; color: #64748B; font-size: 8px; margin-top: 3px; }
.track-scope .verified { color: #16A34A; font-size: 8px; font-weight: 900; }
.track-scope .verified i { display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: #16A34A; box-shadow: 0 0 8px #16A34A; margin-right: 5px; }

/* Intelligence */
.track-scope .intelligence { padding: 75px 0; background: #fff; color: #071426; margin-top: 40px; }
.track-scope .sectionHead { text-align: center; max-width: 650px; margin: auto auto 34px; }
.track-scope .sectionHead .eyebrow { color: #078fdd; background: #eefaff; border-color: #c4edff; }
.track-scope .sectionHead h2 { font-size: 31px; letter-spacing: -.05em; margin-top: 10px; color: #071426; }
.track-scope .sectionHead p { font-size: 11px; color: #7b899b; margin-top: 7px; }
.track-scope .intelGrid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 13px; }
.track-scope .intel { padding: 20px; border: 1px solid #e0e8f0; border-radius: 13px; background: #fff; transition: .25s; }
.track-scope .intel:hover { transform: translateY(-5px); box-shadow: 0 20px 45px rgba(8, 33, 58, 0.12); border-color: #b8e5fb; }
.track-scope .intelIcon { width: 39px; height: 39px; border-radius: 10px; background: #edf9ff; color: #078fdd; display: grid; place-items: center; }
.track-scope .intel:nth-child(2) .intelIcon { color: #8d52e9; background: #f6efff; }
.track-scope .intel:nth-child(3) .intelIcon { color: #10af8a; background: #edfff9; }
.track-scope .intel:nth-child(4) .intelIcon { color: #ed7b45; background: #fff5ee; }
.track-scope .intel h3 { font-size: 13px; margin-top: 14px; color: #071426; }
.track-scope .intel p { font-size: 10px; color: #7a899b; line-height: 1.65; margin-top: 5px; }

@media(max-width:1000px){
  .track-scope .dashboard { grid-template-columns: 1fr; }
  .track-scope .intelGrid { grid-template-columns: 1fr 1fr; }
  .track-scope .hero h1 { font-size: 41px; }
}
@media(max-width:650px){
  .track-scope .hero { padding-top: 30px; min-height: auto; }
  .track-scope .hero h1 { font-size: 34px; }
  .track-scope .searchTop { align-items: flex-start; }
  .track-scope .network { display: none; }
  .track-scope .form { grid-template-columns: 1fr; }
  .track-scope .map { min-height: 350px; }
  .track-scope .uk { transform: translate(-50%,-50%) scale(.85) rotate(8deg); }
  .track-scope .events { grid-template-columns: 1fr 1fr; gap: 20px; }
  .track-scope .events:before { display: none; }
  .track-scope .intelGrid { grid-template-columns: 1fr; }
}
</style>

<div class="track-scope">
    <section class="hero">
        <div class="container">
            <div class="heroHead">
                <div class="eyebrow"><i></i> Mission Control · Live Network</div>
                <h1>Track Your UK Shipment<br><em>In Real Time.</em></h1>
                <p>Enter your Rush Parcel reference to access live shipment intelligence, route visibility, milestone progress and delivery estimates.</p>
            </div>

            <?php if (!empty($error_message)): ?>
                <div class="alert alert-error" style="max-width: 1050px; margin: 1.5rem auto 0 auto;">
                    <span>⚠️</span>
                    <div><?= e($error_message) ?></div>
                </div>
            <?php endif; ?>

            <div class="command">
                <div class="searchPanel">
                    <div class="searchTop">
                        <div class="searchTitle">
                            <div class="searchIcon">⌁</div>
                            <div>
                                <h2>Shipment Command Centre</h2>
                                <p>Securely query your live UK delivery record.</p>
                            </div>
                        </div>
                        <div class="network"><i></i> NETWORK ONLINE</div>
                    </div>

                    <form class="form" action="<?= url('/track') ?>" method="GET">
                        <div class="input">
                            <span>RP / UK</span>
                            <input type="text" id="tracking_number" name="tracking_number" maxlength="25" autocomplete="off" placeholder="Enter tracking reference — e.g. UK9823410574" value="<?= e($search_tracking ?? '') ?>" required>
                        </div>
                        <button class="trackBtn" type="submit">Track Shipment &rarr;</button>
                    </form>

                    <div class="helper">
                        <span>Tracking references are case-insensitive · 12–20 characters</span>
                        <span class="demo" id="demoBtn">Load demo shipment</span>
                    </div>

                    <div class="dashboard">
                        <!-- Interactive Map Graphic -->
                        <div class="map">
                            <div class="mapLabel">UK NETWORK / <b>LIVE ROUTE</b></div>
                            <div class="uk"></div>
                            <div class="routeLine"></div>
                            <div class="node scotland"><span>SCOTLAND</span></div>
                            <div class="node manchester pulseNode"><span>MANCHESTER</span></div>
                            <div class="node leeds"><span>LEEDS</span></div>
                            <div class="node birmingham pulseNode"><span>BIRMINGHAM</span></div>
                            <div class="node bristol"><span>BRISTOL</span></div>
                            <div class="node london pulseNode"><span>LONDON</span></div>
                            <div class="mapLegend">
                                <div class="legend"><i></i> Active network</div>
                                <div class="legend"><i class="violet"></i> Route</div>
                            </div>
                            <div class="mapControls">
                                <button type="button" onclick="zoomMap(1.02)">+</button>
                                <button type="button" onclick="zoomMap(0.98)">−</button>
                                <button type="button" onclick="zoomMap(1)">⌖</button>
                            </div>
                        </div>

                        <!-- Live Status Panel -->
                        <aside class="statusPanel">
                            <div class="statusHead">
                                <div>
                                    <small>SHIPMENT REFERENCE</small>
                                    <strong><?= !empty($shipment) ? e($shipment['tracking_number']) : 'UK9823410574' ?></strong>
                                </div>
                                <div class="statusLive">LIVE</div>
                            </div>
                            <div class="statusBody">
                                <?php
                                  $isDelivered = (!empty($shipment['status']) && $shipment['status'] === 'delivered') ||
                                                 (!empty($shipment['scheduled_delivery_at']) && strtotime($shipment['scheduled_delivery_at']) <= time() && !in_array($shipment['status'] ?? '', ['cancelled', 'on_hold']));

                                  if (!empty($history)) {
                                      foreach ($history as $h) {
                                          if (($h['new_status'] ?? '') === 'delivered') {
                                              $isDelivered = true;
                                              break;
                                          }
                                      }
                                  }

                                  $effectiveStatus = $isDelivered ? 'delivered' : ($shipment['status'] ?? 'in_transit');
                                ?>
                                <div class="state">● CURRENT STATUS</div>
                                <div class="stateText"><?= !empty($shipment) ? e(ucwords(str_replace('_', ' ', $effectiveStatus))) : 'In Transit' ?></div>
                                <p><?= $isDelivered ? 'Shipment has been successfully delivered to the recipient address.' : 'Your parcel is moving through the Rush Parcel network toward its destination.' ?></p>
                                
                                <div class="statusMetric">
                                    <small>Service Speed</small>
                                    <strong><?= !empty($shipment) ? e($shipment['service_name']) : 'Next Day Parcel' ?></strong>
                                </div>

                                <?php
                                  $senderName = !empty($shipment['pickup_address']['name']) ? $shipment['pickup_address']['name'] : ($shipment['customer_name'] ?? 'Alice Sender');
                                  $senderLoc = trim(($shipment['pickup_address']['city'] ?? $shipment['pickup_address']['town'] ?? 'London') . ' ' . ($shipment['pickup_address']['postcode'] ?? 'SW1A 1AA'));
                                  
                                  $receiverName = !empty($shipment['delivery_address']['name']) ? $shipment['delivery_address']['name'] : 'Amazon Fulfillment Center';
                                  $receiverLoc = trim(($shipment['delivery_address']['city'] ?? $shipment['delivery_address']['town'] ?? 'Manchester') . ' ' . ($shipment['delivery_address']['postcode'] ?? 'M1 1AE'));

                                  $bookedEventDate = null;
                                  if (!empty($history)) {
                                      foreach ($history as $h) {
                                          if (($h['new_status'] ?? '') === 'booking_confirmed') {
                                              $bookedEventDate = $h['created_at'];
                                              break;
                                          }
                                      }
                                      if (!$bookedEventDate && !empty($history)) {
                                          $earliest = end($history);
                                          if (!empty($earliest['created_at'])) {
                                              $bookedEventDate = $earliest['created_at'];
                                          }
                                      }
                                  }
                                  if (!$bookedEventDate && !empty($shipment['scheduled_pickup_at'])) {
                                      $bookedEventDate = date('Y-m-d H:i:s', strtotime($shipment['scheduled_pickup_at'] . ' -2 hours'));
                                  }
                                  if (!$bookedEventDate && !empty($shipment['created_at'])) {
                                      $bookedEventDate = $shipment['created_at'];
                                  }
                                ?>
                                <div class="statusMetric" style="display:block; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 12px; margin-top: 8px;">
                                    <small style="color: #38c8ff; font-weight: 850; letter-spacing: 0.08em;">SENDER (PICKUP)</small>
                                    <strong style="display: block; font-size: 13px; color: #fff; margin-top: 3px; font-weight: 900; text-align: left;">
                                        <?= e($senderName) ?>
                                    </strong>
                                    <span style="display: block; font-size: 10px; color: #7f97b2; margin-top: 2px;">
                                        📍 <?= e($senderLoc) ?>
                                    </span>
                                </div>

                                <div class="statusMetric" style="display:block; padding-top: 10px; margin-top: 4px;">
                                    <small style="color: #38e0b8; font-weight: 850; letter-spacing: 0.08em;">RECEIVER (DELIVERY)</small>
                                    <strong style="display: block; font-size: 13px; color: #fff; margin-top: 3px; font-weight: 900; text-align: left;">
                                        <?= e($receiverName) ?>
                                    </strong>
                                    <span style="display: block; font-size: 10px; color: #7f97b2; margin-top: 2px;">
                                        🏁 <?= e($receiverLoc) ?>
                                    </span>
                                </div>

                                <div class="statusMetric">
                                    <small>Booked Date</small>
                                    <strong><?= !empty($bookedEventDate) ? date('d M Y, H:i', strtotime($bookedEventDate)) : '01 Sep · 08:10' ?></strong>
                                </div>
                                <div class="statusMetric">
                                    <small>Estimated Arrival</small>
                                    <strong><?= !empty($shipment) && !empty($shipment['scheduled_delivery_at']) ? date('d M Y, H:i', strtotime($shipment['scheduled_delivery_at'])) : 'Today · 14:00–18:00' ?></strong>
                                </div>
                                <div class="statusMetric" style="display:block">
                                    <small>Delivery Progress <b style="float:right;color:#2bdcff"><?= $isDelivered ? '100%' : '75%' ?></b></small>
                                    <div class="progress"><i style="width: <?= $isDelivered ? '100%' : '75%' ?>;"></i></div>
                                </div>
                            </div>
                        </aside>
                    </div>

                    <?php if (!empty($shipment)): ?>
                        <div class="resultBar">
                            <div>
                                <strong>✓ Tracking record verified in database</strong>
                                <small>Latest shipment information loaded for reference <span><?= e($shipment['tracking_number']) ?></span>.</small>
                            </div>
                            <div class="verified"><i></i> SECURE RECORD</div>
                        </div>
                    <?php endif; ?>

                    <!-- Activity Journey Milestones -->
                    <div class="activity">
                        <div class="activityHead">
                            <div>
                                <h2>Shipment Journey</h2>
                                <p>Milestone progress & history log</p>
                            </div>
                            <p>Updated just now</p>
                        </div>
                        
                        <div class="events">
                            <div class="event done">
                                <div class="eventDot">✓</div>
                                <strong>Booked</strong>
                                <small><?= !empty($bookedEventDate) ? date('d M · H:i', strtotime($bookedEventDate)) : '01 Sep · 08:10' ?></small>
                            </div>
                            <div class="event <?= ($isDelivered || (!empty($effectiveStatus) && in_array($effectiveStatus, ['collected', 'in_transit', 'out_for_delivery', 'delivered']))) ? 'done' : 'current' ?>">
                                <div class="eventDot"><?= ($isDelivered || (!empty($effectiveStatus) && in_array($effectiveStatus, ['collected', 'in_transit', 'out_for_delivery', 'delivered']))) ? '✓' : '●' ?></div>
                                <strong>Collected</strong>
                                <small>Courier Dispatch</small>
                            </div>
                            <div class="event <?= ($isDelivered || (!empty($effectiveStatus) && in_array($effectiveStatus, ['in_transit', 'out_for_delivery', 'delivered']))) ? 'done' : ((!empty($effectiveStatus) && $effectiveStatus === 'collected') ? 'current' : '') ?>">
                                <div class="eventDot"><?= ($isDelivered || (!empty($effectiveStatus) && in_array($effectiveStatus, ['in_transit', 'out_for_delivery', 'delivered']))) ? '✓' : '3' ?></div>
                                <strong>In Transit</strong>
                                <small>Fleet Routing</small>
                            </div>
                            <div class="event <?= $isDelivered ? 'done' : '' ?>">
                                <div class="eventDot"><?= $isDelivered ? '✓' : '4' ?></div>
                                <strong>Delivered</strong>
                                <small>POD Confirmed</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Shipment Intelligence Grid -->
    <section class="intelligence">
        <div class="container">
            <div class="sectionHead">
                <div class="eyebrow">Shipment Intelligence</div>
                <h2>Everything important. One screen.</h2>
                <p>A premium tracking experience built for customers who need fast answers without unnecessary clicks.</p>
            </div>
            <div class="intelGrid">
                <div class="intel">
                    <div class="intelIcon">◈</div>
                    <h3>Live Milestones</h3>
                    <p>See every important shipment event from booking through final delivery.</p>
                </div>
                <div class="intel">
                    <div class="intelIcon">⌖</div>
                    <h3>Route Visibility</h3>
                    <p>Understand where your shipment is travelling across the UK network.</p>
                </div>
                <div class="intel">
                    <div class="intelIcon">✓</div>
                    <h3>Proof of Delivery</h3>
                    <p>Secure delivery confirmation can be made available after completion.</p>
                </div>
                <div class="intel">
                    <div class="intelIcon">ϟ</div>
                    <h3>Fast Updates</h3>
                    <p>Latest carrier scans and delivery information presented clearly.</p>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.getElementById('demoBtn').addEventListener('click', function() {
    document.getElementById('tracking_number').value = 'UK9823410574';
});

function zoomMap(scale) {
    const map = document.querySelector('.track-scope .map');
    if (map) {
        map.style.transform = scale === 1 ? 'none' : `scale(${scale})`;
    }
}
</script>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
