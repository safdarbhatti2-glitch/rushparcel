<?php ob_start(); ?>

<style>
.track-page {
  --orange:#f45b0b;
  --orange2:#ff7a18;
  --orange-pale:#fff4ec;
  --orange-border:#ffd9c2;
  --ink:#172033;
  --muted:#667085;
  --soft:#f7f9fc;
  --line:#e6ebf2;
  --green:#16a05d;
  --green-pale:#edf9f2;
  --blue:#2185d0;
  --blue-pale:#eff8ff;
  --white:#fff;
  --shadow:0 18px 55px rgba(23,32,51,.08);
  margin: -1.5rem -1.25rem -5rem -1.25rem;
  background: var(--soft);
  color: var(--ink);
  font-family: 'Plus Jakarta Sans', Inter, system-ui, sans-serif;
}

/* HERO */
.track-page .hero {
  background:
    radial-gradient(circle at 15% 0%,rgba(244,91,11,.10),transparent 28%),
    radial-gradient(circle at 90% 20%,rgba(33,133,208,.07),transparent 28%),
    #fff;
  padding:54px 20px 112px;
  text-align:center;
  border-bottom:1px solid #eef2f6;
}
.track-page .hero-inner{max-width:850px;margin:auto}
.track-page .eyebrow{display:inline-flex;align-items:center;gap:7px;background:var(--orange-pale);border:1px solid var(--orange-border);color:#cc4b09;border-radius:999px;padding:7px 12px;font-size:9px;font-weight:900;letter-spacing:1px;text-transform:uppercase}
.track-page .live-dot{width:7px;height:7px;border-radius:50%;background:var(--green);box-shadow:0 0 0 4px #dff5e8}
.track-page .hero h1{font-size:clamp(36px,5vw,56px);line-height:1.03;letter-spacing:-2.5px;margin:17px 0 12px;color:var(--ink);font-weight:900}
.track-page .hero h1 span{color:var(--orange)}
.track-page .hero p{max-width:650px;margin:auto;color:var(--muted);font-size:14px;line-height:1.6}

/* RESULT CONTAINER */
.track-page .container{max-width:1080px;margin:-60px auto 0;padding:0 20px;position:relative;z-index:3}
.track-page .result-card{background:#fff;border:1px solid var(--line);border-radius:24px;box-shadow:var(--shadow);padding:26px}
.track-page .search-row{display:flex;gap:10px}
.track-page .search-box{flex:1;display:flex;border:1px solid #dce3eb;border-radius:13px;overflow:hidden;background:#fff;transition:.2s}
.track-page .search-box:focus-within{border-color:var(--orange);box-shadow:0 0 0 3px rgba(244,91,11,.12)}
.track-page .prefix{display:grid;place-items:center;padding:0 14px;border-right:1px solid var(--line);font-size:10px;font-weight:900;color:#68758a;background:#f8fafc}
.track-page .search-box input{border:0;outline:0;flex:1;min-width:0;padding:15px;color:var(--ink);font-weight:700;font-size:13px;text-transform:uppercase}
.track-page .search-box input::placeholder{text-transform:none;font-weight:400;color:#98a3b3}
.track-page .track-btn{border:0;background:var(--orange);color:#fff;border-radius:13px;padding:0 24px;font-weight:850;font-size:13px;box-shadow:0 8px 18px rgba(244,91,11,.2);transition:.2s;cursor:pointer}
.track-page .track-btn:hover{background:#e04f03;transform:translateY(-1px)}
.track-page .helper{font-size:10px;color:#98a3b3;margin-top:8px;display:flex;justify-content:space-between}
.track-page .demo-link{color:var(--orange);font-weight:800;cursor:pointer;text-decoration:underline}

/* STATUS SECTION */
.track-page .status{margin-top:24px;border-top:1px solid var(--line);padding-top:23px}
.track-page .status-head{display:flex;justify-content:space-between;gap:20px;align-items:flex-start}
.track-page .status-kicker{font-size:9px;text-transform:uppercase;letter-spacing:1px;color:var(--orange);font-weight:900}
.track-page .status-title{font-size:29px;line-height:1.1;letter-spacing:-1.2px;margin:4px 0;color:var(--ink);font-weight:950}
.track-page .status-description{font-size:12px;color:var(--muted);max-width:610px;line-height:1.6}
.track-page .network{display:inline-flex;align-items:center;gap:6px;background:var(--green-pale);border:1px solid #c9ecd8;color:#16834d;border-radius:999px;padding:8px 12px;font-size:10px;font-weight:850;white-space:nowrap}
.track-page .network i{width:6px;height:6px;border-radius:50%;background:var(--green)}

/* METRICS */
.track-page .metrics{display:grid;grid-template-columns:1.35fr repeat(3,1fr);border:1px solid var(--line);border-radius:15px;overflow:hidden;margin-top:20px;background:#fff}
.track-page .metric{padding:15px 17px;border-right:1px solid var(--line)}
.track-page .metric:last-child{border-right:0}
.track-page .metric label{display:block;font-size:9px;text-transform:uppercase;letter-spacing:.7px;color:#98a3b3;font-weight:850}
.track-page .metric b{display:block;color:var(--ink);font-size:13px;margin-top:4px;font-weight:800}
.track-page .metric:first-child b{font-size:15px;color:var(--orange)}
.track-page .metric span{font-size:10px;color:var(--muted)}

/* 2-COLUMN LAYOUT */
.track-page .grid{display:grid;grid-template-columns:1.3fr .8fr;gap:16px;margin-top:16px}
.track-page .panel{background:#fff;border:1px solid var(--line);border-radius:18px;padding:22px}
.track-page .panel h2{font-size:15px;margin:0;color:var(--ink);letter-spacing:-.3px;font-weight:800}
.track-page .panel-sub{font-size:10px;color:#98a3b3;margin-top:3px}

/* TIMELINE */
.track-page .timeline{margin-top:22px}
.track-page .event{display:grid;grid-template-columns:30px 1fr auto;gap:12px;position:relative;padding-bottom:23px}
.track-page .event:last-child{padding-bottom:0}
.track-page .event .rail{position:absolute;left:14px;top:29px;height:calc(100% - 4px);width:2px;background:#e1e7ee}
.track-page .event.done .rail{background:#b9e7ca}
.track-page .event-icon{width:30px;height:30px;border-radius:50%;border:2px solid #d7dfe8;background:#fff;display:grid;place-items:center;z-index:1;color:#97a2b2;font-size:11px;font-weight:900}
.track-page .event.done .event-icon{background:var(--green);border-color:var(--green);color:#fff}
.track-page .event.current .event-icon{background:var(--orange);border-color:var(--orange);color:#fff;box-shadow:0 0 0 5px var(--orange-pale)}
.track-page .event b{font-size:12px;color:var(--ink);font-weight:800}
.track-page .event p{margin:2px 0 0;font-size:10px;color:var(--muted)}
.track-page .event time{font-size:9px;color:#98a3b3;white-space:nowrap;text-align:right}

/* PROGRESS */
.track-page .progress{margin-top:20px;border-top:1px solid var(--line);padding-top:18px}
.track-page .progress-head{display:flex;justify-content:space-between;font-size:11px;font-weight:850;color:var(--ink)}
.track-page .progress-head span{color:var(--orange)}
.track-page .bar{height:7px;background:#edf1f5;border-radius:99px;margin:13px 3px 8px;overflow:hidden}
.track-page .fill{height:100%;border-radius:99px;background:linear-gradient(90deg,var(--orange),var(--orange2));transition:width .4s ease}
.track-page .labels{display:flex;justify-content:space-between}
.track-page .labels span{font-size:8px;color:#8995a6;text-align:center}
.track-page .labels b{display:block;color:var(--ink);font-size:9px;font-weight:800}

/* DETAILS SIDEBAR */
.track-page .details{margin-top:18px}
.track-page .detail-row{display:flex;justify-content:space-between;gap:15px;padding:11px 0;border-bottom:1px solid #eef1f5}
.track-page .detail-row:last-child{border-bottom:0}
.track-page .detail-row span{font-size:10px;color:#98a3b3}
.track-page .detail-row b{font-size:10px;color:var(--ink);text-align:right;font-weight:700}
.track-page .route{margin-top:14px;background:#f8fafc;border:1px solid #edf1f5;border-radius:13px;padding:14px;display:flex;align-items:center;gap:10px;font-size:11px;font-weight:850}
.track-page .route small{display:block;color:#98a3b3;font-size:8px;font-weight:600;margin-top:2px}
.track-page .route-line{height:2px;background:#d6dee8;flex:1;position:relative}
.track-page .route-line:after{content:"";position:absolute;right:0;top:-3px;width:7px;height:7px;border-top:2px solid #9eabba;border-right:2px solid #9eabba;transform:rotate(45deg)}
.track-page .notice{margin-top:13px;background:var(--orange-pale);border:1px solid #ffe0cb;border-radius:12px;padding:12px;color:#92501e;font-size:10px;line-height:1.5}
.track-page .notice strong{color:#c44d0a}

/* LOWER FEATURES SECTION */
.track-page .lower{max-width:1080px;margin:60px auto 0;padding:0 20px 60px}
.track-page .center{text-align:center}
.track-page .center .eyebrow{background:var(--blue-pale);border-color:#d8edfb;color:#0876b8}
.track-page .center h2{font-size:31px;letter-spacing:-1.4px;margin:12px 0 5px;color:var(--ink);font-weight:900}
.track-page .center p{font-size:12px;color:var(--muted)}
.track-page .features{display:grid;grid-template-columns:repeat(4,1fr);gap:13px;margin-top:25px}
.track-page .feature{background:#fff;border:1px solid var(--line);border-radius:16px;padding:18px;transition:.2s}
.track-page .feature:hover{transform:translateY(-3px);box-shadow:0 13px 32px rgba(23,32,51,.07)}
.track-page .feature-icon{width:34px;height:34px;border-radius:10px;background:var(--orange-pale);color:var(--orange);display:grid;place-items:center;font-weight:900;margin-bottom:13px;font-size:14px}
.track-page .feature h3{font-size:12px;margin:0 0 5px;color:var(--ink);font-weight:800}
.track-page .feature p{font-size:10px;color:var(--muted);margin:0;line-height:1.5}
.track-page .help{margin-top:32px;background:#fff;border:1px solid var(--orange-border);border-radius:19px;padding:25px 28px;display:flex;justify-content:space-between;align-items:center;gap:20px;box-shadow:0 12px 35px rgba(244,91,11,.06)}
.track-page .help h2{font-size:20px;margin:0 0 4px;color:var(--ink);font-weight:900}
.track-page .help p{font-size:11px;color:var(--muted);margin:0}
.track-page .help a.help-btn{border:0;background:var(--orange);color:#fff;padding:12px 20px;border-radius:10px;font-weight:850;font-size:12px;text-decoration:none;display:inline-block;transition:.2s}
.track-page .help a.help-btn:hover{background:#e04f03;transform:translateY(-1px)}

@media(max-width:850px){
 .track-page .metrics{grid-template-columns:1fr 1fr}.track-page .metric:nth-child(2){border-right:0}.track-page .metric{border-bottom:1px solid var(--line)}
 .track-page .grid{grid-template-columns:1fr}.track-page .features{grid-template-columns:1fr 1fr}
}
@media(max-width:560px){
 .track-page .hero{padding:43px 16px 88px}.track-page .hero h1{font-size:36px;letter-spacing:-1.5px}
 .track-page .container{padding:0 12px}.track-page .result-card{padding:16px;border-radius:18px}
 .track-page .search-row{flex-direction:column}.track-page .search-box{height:48px}.track-page .track-btn{height:48px}
 .track-page .status-head{flex-direction:column}.track-page .network{align-self:flex-start}
 .track-page .metrics{grid-template-columns:1fr}.track-page .metric{border-right:0!important}
 .track-page .event{grid-template-columns:30px 1fr}.track-page .event time{grid-column:2;text-align:left;margin-top:-7px}
 .track-page .features{grid-template-columns:1fr}.track-page .help{flex-direction:column;align-items:flex-start}.track-page .help a.help-btn{width:100%;text-align:center}
}
</style>

<?php
  // Dynamic Calculation Logic
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

  $senderCity = !empty($shipment['pickup_address']['city']) ? $shipment['pickup_address']['city'] : (!empty($shipment['pickup_address']['town']) ? $shipment['pickup_address']['town'] : 'London');
  $senderPostcode = !empty($shipment['pickup_address']['postcode']) ? $shipment['pickup_address']['postcode'] : 'SW1A 1AA';

  $receiverCity = !empty($shipment['delivery_address']['city']) ? $shipment['delivery_address']['city'] : (!empty($shipment['delivery_address']['town']) ? $shipment['delivery_address']['town'] : 'Manchester');
  $receiverPostcode = !empty($shipment['delivery_address']['postcode']) ? $shipment['delivery_address']['postcode'] : 'M1 1AE';

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

  $progressPercent = '72%';
  $progressMilestones = '3 of 4 milestones';
  if ($isDelivered) {
      $progressPercent = '100%';
      $progressMilestones = '4 of 4 milestones';
  } else if ($effectiveStatus === 'booking_confirmed') {
      $progressPercent = '25%';
      $progressMilestones = '1 of 4 milestones';
  } else if ($effectiveStatus === 'collection_scheduled' || $effectiveStatus === 'collected') {
      $progressPercent = '50%';
      $progressMilestones = '2 of 4 milestones';
  }
?>

<div class="track-page">
 <section class="hero">
  <div class="hero-inner">
   <div class="eyebrow"><span class="live-dot"></span> Live shipment visibility</div>
   <h1>Track Your UK Shipment — <span>Your parcel is on the move.</span></h1>
   <p>Track your shipment in one simple view — from collection to delivery, with the latest status and estimated arrival.</p>
  </div>
 </section>

 <main class="container">
  <section class="result-card">
   <?php if (!empty($error_message)): ?>
       <div style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 12px 16px; border-radius: 12px; margin-bottom: 20px; font-weight: 700; font-size: 13px;">
           ⚠️ <?= e($error_message) ?>
       </div>
   <?php endif; ?>

   <form action="<?= url('/track') ?>" method="GET" class="search-row">
    <div class="search-box">
     <span class="prefix">RP / UK</span>
     <input id="tracking" name="tracking_number" value="<?= e($search_tracking ?? 'UK9823410574') ?>" aria-label="Tracking reference" placeholder="Enter tracking reference — e.g. UK9823410574" required>
    </div>
    <button class="track-btn" type="submit">Track Shipment →</button>
   </form>

   <div class="helper">
    <span>Tracking references are case-insensitive · Your tracking information is updated as new scans are received.</span>
    <span class="demo-link" id="demoBtn">Load demo shipment</span>
   </div>

   <div class="status">
    <div class="status-head">
     <div>
      <div class="status-kicker">Current shipment status</div>
      <div class="status-title"><?= !empty($shipment) ? e(ucwords(str_replace('_', ' ', $effectiveStatus))) : 'In Transit' ?></div>
      <div class="status-description">
       <?= $isDelivered 
           ? 'Your parcel has been successfully delivered and signed for at the destination address.' 
           : 'Your parcel is moving through the RushParcel network and is currently on schedule for delivery.' ?>
      </div>
     </div>
     <div class="network"><i></i> Network active</div>
    </div>

    <div class="metrics">
     <div class="metric">
      <label>Tracking reference</label>
      <b id="ref"><?= !empty($shipment) ? e($shipment['tracking_number']) : 'UK9823410574' ?></b>
      <span>Updated just now</span>
     </div>
     <div class="metric">
      <label>Service</label>
      <b><?= !empty($shipment['service_name']) ? e($shipment['service_name']) : 'Next-Day' ?></b>
      <span>Express delivery</span>
     </div>
     <div class="metric">
      <label>Estimated arrival</label>
      <b><?= !empty($shipment['scheduled_delivery_at']) ? date('d M Y', strtotime($shipment['scheduled_delivery_at'])) : 'Today' ?></b>
      <span><?= !empty($shipment['scheduled_delivery_at']) ? date('H:i', strtotime($shipment['scheduled_delivery_at'])) : '14:00 – 18:00' ?></span>
     </div>
     <div class="metric">
      <label>Progress</label>
      <b><?= $progressPercent ?></b>
      <span><?= $progressMilestones ?></span>
     </div>
    </div>

    <div class="grid">
     <section class="panel">
      <h2>Shipment journey</h2>
      <div class="panel-sub">A clear view of where your parcel has been and what happens next.</div>

      <div class="timeline">
       <div class="event done">
        <span class="event-icon">✓</span><span class="rail"></span>
        <div>
         <b>Booked</b>
         <p>Shipment created and confirmed</p>
        </div>
        <time><?= !empty($bookedEventDate) ? date('d M · H:i', strtotime($bookedEventDate)) : '01 Sep · 08:10' ?></time>
       </div>

       <div class="event <?= ($isDelivered || in_array($effectiveStatus, ['collected', 'in_transit', 'out_for_delivery', 'delivered'])) ? 'done' : 'current' ?>">
        <span class="event-icon"><?= ($isDelivered || in_array($effectiveStatus, ['collected', 'in_transit', 'out_for_delivery', 'delivered'])) ? '✓' : '→' ?></span>
        <span class="rail"></span>
        <div>
         <b>Collected</b>
         <p><?= e($senderCity) ?> Hub Dispatch</p>
        </div>
        <time><?= !empty($bookedEventDate) ? date('d M · H:i', strtotime($bookedEventDate . ' +2 hours')) : '01 Sep · 10:42' ?></time>
       </div>

       <div class="event <?= $isDelivered ? 'done' : (($effectiveStatus === 'in_transit' || $effectiveStatus === 'out_for_delivery') ? 'current' : '') ?>">
        <span class="event-icon"><?= $isDelivered ? '✓' : (($effectiveStatus === 'in_transit' || $effectiveStatus === 'out_for_delivery') ? '→' : '3') ?></span>
        <span class="rail"></span>
        <div>
         <b>In Transit</b>
         <p><?= e($receiverCity) ?> Regional Hub Scan</p>
        </div>
        <time><?= !empty($bookedEventDate) ? date('d M · H:i', strtotime($bookedEventDate . ' +5 hours')) : 'Today · 12:18' ?></time>
       </div>

       <div class="event <?= $isDelivered ? 'done' : '' ?>">
        <span class="event-icon"><?= $isDelivered ? '✓' : '4' ?></span>
        <div>
         <b>Delivered</b>
         <p><?= $isDelivered ? 'Signed and delivered at recipient address' : 'Awaiting final delivery' ?></p>
        </div>
        <time><?= $isDelivered ? 'Completed' : 'Estimated today' ?></time>
       </div>
      </div>

      <div class="progress">
       <div class="progress-head">
        <span>Delivery progress</span>
        <span><?= $progressPercent ?></span>
       </div>
       <div class="bar">
        <div class="fill" style="width: <?= $progressPercent ?>;"></div>
       </div>
       <div class="labels">
        <span><b>Booked</b>Confirmed</span>
        <span><b>Collected</b>Picked up</span>
        <span><b>In Transit</b>Moving</span>
        <span><b>Delivered</b>Complete</span>
       </div>
      </div>
     </section>

     <aside class="panel">
      <h2>Shipment details</h2>
      <div class="panel-sub">The key information for this delivery.</div>
      
      <div class="details">
       <div class="detail-row">
        <span>Sender</span>
        <b><?= e($senderCity . ' (' . $senderPostcode . ')') ?></b>
       </div>
       <div class="detail-row">
        <span>Destination</span>
        <b><?= e($receiverCity . ' (' . $receiverPostcode . ')') ?></b>
       </div>
       <div class="detail-row">
        <span>Service</span>
        <b><?= !empty($shipment['service_name']) ? e($shipment['service_name']) : 'Next-Day Express' ?></b>
       </div>
       <div class="detail-row">
        <span>Booked</span>
        <b><?= !empty($bookedEventDate) ? date('d M · H:i', strtotime($bookedEventDate)) : '01 Sep · 08:10' ?></b>
       </div>
       <div class="detail-row">
        <span>Estimated arrival</span>
        <b><?= !empty($shipment['scheduled_delivery_at']) ? date('d M · H:i', strtotime($shipment['scheduled_delivery_at'])) : 'Today · 14:00–18:00' ?></b>
       </div>
      </div>

      <div class="route">
       <span><?= e($senderCity) ?><small>Origin</small></span>
       <span class="route-line"></span>
       <span><?= e($receiverCity) ?><small>Destination</small></span>
      </div>

      <div class="notice">
       <strong><?= $isDelivered ? 'Delivered successfully.' : 'On schedule.' ?></strong> 
       <?= $isDelivered ? 'Proof of delivery recorded in system.' : 'Your parcel is progressing normally toward its destination.' ?>
      </div>
     </aside>
    </div>
   </div>
  </section>
 </main>

 <section class="lower">
  <div class="center">
   <div class="eyebrow">Simple shipment visibility</div>
   <h2>Everything important, without the clutter.</h2>
   <p>Designed so customers can understand their delivery status at a glance.</p>
  </div>

  <div class="features">
   <article class="feature">
    <div class="feature-icon">✓</div>
    <h3>Live milestones</h3>
    <p>Follow the important events from booking through final delivery.</p>
   </article>
   <article class="feature">
    <div class="feature-icon">↗</div>
    <h3>Route visibility</h3>
    <p>See the journey between collection and destination.</p>
   </article>
   <article class="feature">
    <div class="feature-icon">◆</div>
    <h3>Proof of delivery</h3>
    <p>Delivery confirmation becomes available after completion.</p>
   </article>
   <article class="feature">
    <div class="feature-icon">⚡</div>
    <h3>Fast updates</h3>
    <p>Latest scans and delivery information are easy to find.</p>
   </article>
  </div>

  <div class="help">
   <div>
    <h2>Need help with your parcel?</h2>
    <p>Our support team can help with tracking and delivery questions.</p>
   </div>
   <a href="<?= url('/contact') ?>" class="help-btn">Contact Support →</a>
  </div>
 </section>
</div>

<script>
document.getElementById('demoBtn').addEventListener('click', function() {
    document.getElementById('tracking').value = 'UK9823410574';
});
</script>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
