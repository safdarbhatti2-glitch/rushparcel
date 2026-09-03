<?php ob_start(); ?>

<style>
:root{
  --navy:#06101f;--navy2:#0b1b31;--blue:#078ff0;--cyan:#24d9ff;
  --ink:#10223a;--muted:#71849a;--bg:#f4f8fc;--card:#fff;--line:#dce7f0;
  --green:#10b889;--orange:#ff9a45;--violet:#8758ed;--red:#df5e6b;
}

.edit-shipment-page { max-width: 1320px; margin: auto; padding: 10px 10px 50px; font-family: Inter, ui-sans-serif, system-ui, -apple-system, sans-serif; color: var(--ink); }
.edit-shipment-page button, .edit-shipment-page input, .edit-shipment-page select, .edit-shipment-page textarea { font: inherit; }
.edit-shipment-page button { cursor: pointer; }
.edit-shipment-page .crumb { font-size: 11px; color: #7b8da0; margin-bottom: 13px; font-weight: 700; }
.edit-shipment-page .crumb a { color: #078ff0; text-decoration: none; font-weight: 850; }
.edit-shipment-page .hero { display: flex; justify-content: space-between; gap: 20px; align-items: flex-end; margin-bottom: 22px; }
.edit-shipment-page .hero h1 { margin: 0; font-size: 27px; letter-spacing: -.055em; color: var(--n2); }
.edit-shipment-page .hero p { margin: 6px 0 0; color: var(--muted); font-size: 11px; }
.edit-shipment-page .identity { display: flex; align-items: center; gap: 10px; }
.edit-shipment-page .ref { font-size: 12px; font-weight: 950; color: #078ff0; background: #eaf8ff; border: 1px solid #c8ecfb; padding: 9px 14px; border-radius: 9px; }
.edit-shipment-page .status { font-size: 11px; font-weight: 950; color: #078c6d; background: #e7faf4; border-radius: 99px; padding: 8px 14px; text-transform: uppercase; }

.edit-shipment-page .layout { display: grid; grid-template-columns: minmax(0,1fr) 340px; gap: 20px; align-items: start; }
.edit-shipment-page .panel { background: var(--card); border: 1px solid var(--line); border-radius: 18px; box-shadow: 0 20px 55px rgba(10,35,65,.075); overflow: hidden; }
.edit-shipment-page .notice { margin: 20px 22px 0; padding: 14px 16px; border: 1px solid #cbe9f8; background: linear-gradient(90deg,#effaff,#f8fdff); border-radius: 11px; font-size: 11px; color: #587187; }
.edit-shipment-page .notice b { color: #0789d5; }
.edit-shipment-page .form { padding: 24px; }
.edit-shipment-page .section { padding: 0 0 25px; margin: 0 0 25px; border-bottom: 1px solid #edf2f6; }
.edit-shipment-page .section:last-child { border-bottom: 0; margin-bottom: 0; padding-bottom: 0; }
.edit-shipment-page .sectionHead { display: flex; gap: 14px; margin-bottom: 18px; }
.edit-shipment-page .badge { width: 38px; height: 38px; border-radius: 11px; background: #eaf8ff; color: #078ff0; display: grid; place-items: center; font-size: 12px; font-weight: 950; flex: none; }
.edit-shipment-page .section:nth-of-type(2) .badge { background: #eafaf5; color: #0baf84; }
.edit-shipment-page .section:nth-of-type(3) .badge { background: #fff5e9; color: #e68629; }
.edit-shipment-page .section:nth-of-type(4) .badge { background: #f2edff; color: #8055df; }
.edit-shipment-page .sectionHead h2 { font-size: 15px; font-weight: 900; margin: 1px 0 0; color: var(--n2); }
.edit-shipment-page .sectionHead p { font-size: 11px; color: var(--muted); margin: 4px 0 0; }

.edit-shipment-page .grid2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.edit-shipment-page .address { padding: 18px; border: 1px solid #e3ebf2; border-radius: 14px; background: linear-gradient(180deg,#fcfdff,#f9fbfd); }
.edit-shipment-page .addressTitle { display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; }
.edit-shipment-page .addressTitle strong { font-size: 10px; font-weight: 900; letter-spacing: .09em; text-transform: uppercase; color: #34475c; }
.edit-shipment-page .addressTitle span { font-size: 9px; color: #078ff0; font-weight: 900; background: #eaf8ff; padding: 5px 9px; border-radius: 99px; }

.edit-shipment-page .field { display: grid; gap: 5px; margin-bottom: 12px; }
.edit-shipment-page .field label { font-size: 10px; font-weight: 850; color: #34475c; text-transform: uppercase; }
.edit-shipment-page .field label em { font-style: normal; color: #078ff0; }
.edit-shipment-page .field input, .edit-shipment-page .field select, .edit-shipment-page .field textarea {
  width: 100%; border: 1px solid #dbe5ee; border-radius: 9px; background: #fff; color: #172b42;
  padding: 11px 12px; font-size: 11px; outline: 0; transition: .18s;
}
.edit-shipment-page .field textarea { min-height: 75px; resize: vertical; }
.edit-shipment-page .field input:focus, .edit-shipment-page .field select:focus, .edit-shipment-page .field textarea:focus { border-color: #4dc5fa; box-shadow: 0 0 0 3px rgba(7,143,240,0.12); }

.edit-shipment-page .services { display: grid; grid-template-columns: repeat(3,1fr); gap: 12px; }
.edit-shipment-page .service { position: relative; }
.edit-shipment-page .service input { position: absolute; opacity: 0; }
.edit-shipment-page .service label { display: block; padding: 16px; border: 1px solid #dce6ee; border-radius: 14px; height: 100%; cursor: pointer; transition: .2s; }
.edit-shipment-page .service input:checked + label { border-color: #078ff0; background: #effaff; box-shadow: inset 0 0 0 1px #078ff0, 0 8px 25px rgba(7,143,240,0.1); }
.edit-shipment-page .service strong { font-size: 12px; display: block; color: var(--n2); }
.edit-shipment-page .service small { font-size: 10px; color: #77899a; display: block; line-height: 1.5; margin-top: 5px; }
.edit-shipment-page .service b { font-size: 14px; color: #078ff0; display: block; margin-top: 10px; font-weight: 900; }

.edit-shipment-page .options { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 8px; }
.edit-shipment-page .option { font-size: 10px; color: #63778c; border: 1px solid #dce6ee; padding: 7px 11px; border-radius: 99px; background: #fff; cursor: pointer; display: inline-flex; align-items: center; gap: 5px; }
.edit-shipment-page .option input { accent-color: #078ff0; }

.edit-shipment-page .footer { display: flex; justify-content: space-between; align-items: center; gap: 15px; padding: 18px 24px; background: #fafcfe; border-top: 1px solid #edf2f6; }
.edit-shipment-page .footerNote { font-size: 10px; color: #8796a5; }
.edit-shipment-page .actions { display: flex; gap: 10px; }

.edit-shipment-page .side { display: grid; gap: 16px; }
.edit-shipment-page .card { background: #fff; border: 1px solid var(--line); border-radius: 16px; box-shadow: 0 18px 48px rgba(10,35,65,.06); padding: 20px; }
.edit-shipment-page .cardHead { display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; }
.edit-shipment-page .cardHead h3 { font-size: 13px; margin: 0; font-weight: 900; color: var(--n2); }
.edit-shipment-page .cardHead span { font-size: 9px; color: #078ff0; font-weight: 950; letter-spacing: .08em; }

.edit-shipment-page .statusCard { background: linear-gradient(135deg,#061329,#0a2644); color: #fff; border: 0; overflow: hidden; position: relative; }
.edit-shipment-page .statusCard:after { content: ""; position: absolute; width: 150px; height: 150px; border-radius: 50%; right: -85px; top: -90px; background: rgba(36,217,255,0.08); }
.edit-shipment-page .tracking { font-size: 10px; color: #7d9bb5; }
.edit-shipment-page .statusText { font-size: 20px; font-weight: 950; margin: 4px 0 13px; letter-spacing: -.04em; color: #ffffff; }
.edit-shipment-page .bar { height: 6px; background: rgba(255,255,255,0.12); border-radius: 99px; overflow: hidden; }
.edit-shipment-page .bar span { display: block; width: 67%; height: 100%; background: linear-gradient(90deg,#079ff3,#24d9ff); box-shadow: 0 0 15px #24d9ff; }
.edit-shipment-page .route { display: flex; justify-content: space-between; margin-top: 14px; }
.edit-shipment-page .route div { width: 10px; height: 10px; border-radius: 50%; background: #274862; border: 2px solid #17354e; }
.edit-shipment-page .route .done { background: #15bd90; border-color: #15bd90; }
.edit-shipment-page .route .current { background: #24d9ff; border-color: #24d9ff; }

.edit-shipment-page .kv { display: grid; gap: 12px; }
.edit-shipment-page .kv div { display: flex; justify-content: space-between; font-size: 11px; }
.edit-shipment-page .kv span { color: #7b8da0; }
.edit-shipment-page .total { border-top: 1px solid #edf2f6; padding-top: 12px; margin-top: 4px; }
.edit-shipment-page .total b { font-size: 22px; color: #078ff0; font-weight: 950; }

.edit-shipment-page .audit { display: grid; gap: 14px; }
.edit-shipment-page .auditItem { display: grid; grid-template-columns: 26px 1fr; gap: 10px; }
.edit-shipment-page .auditIcon { width: 26px; height: 26px; border-radius: 8px; background: #eef8ff; color: #078ff0; display: grid; place-items: center; font-size: 10px; font-weight: 900; }
.edit-shipment-page .auditItem b { font-size: 11px; color: var(--n2); display: block; }
.edit-shipment-page .auditItem span { display: block; color: #8997a5; font-size: 9px; margin-top: 2px; }

.edit-shipment-page .btn { border: 1px solid var(--line); background: #fff; color: var(--ink); border-radius: 9px; padding: 10px 16px; font-size: 11px; font-weight: 850; transition: .2s; text-decoration: none; cursor: pointer; }
.edit-shipment-page .btn:hover { transform: translateY(-1px); }
.edit-shipment-page .btn.primary { color: #fff; border: 0; background: linear-gradient(135deg,#0daafc,#0764d7); box-shadow: 0 10px 26px rgba(7,143,240,0.25); }

@media(max-width:1050px){ .edit-shipment-page .layout { grid-template-columns: 1fr; } }
@media(max-width:720px){ .edit-shipment-page .grid2, .edit-shipment-page .services { grid-template-columns: 1fr; } }
</style>

<div class="edit-shipment-page">
  <div class="crumb">
    <a href="<?= url('/admin/shipments') ?>">Shipments</a> &rsaquo; 
    <a href="<?= url('/admin/shipments/' . e($shipment['shipment_number'])) ?>"><?= e($shipment['shipment_number']) ?></a> &rsaquo; 
    Edit
  </div>

  <div class="hero">
    <div>
      <h1>Edit Shipment</h1>
      <p>Update operational details while protecting shipment history and financial records.</p>
    </div>
    <div class="identity">
      <span class="ref"><?= e($shipment['shipment_number']) ?></span>
      <span class="status">● <?= e(str_replace('_', ' ', strtoupper($shipment['status']))) ?></span>
      <button type="submit" form="editForm" class="btn primary" style="background: linear-gradient(135deg,#0daafc,#0764d7); box-shadow: 0 10px 25px rgba(7,143,240,0.3); font-size: 12px; font-weight: 900; padding: 10px 20px; margin-left: 8px;">
        💾 Save Changes &rarr;
      </button>
    </div>
  </div>

  <?php if (!empty($error_message)): ?>
    <div style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 14px 18px; border-radius: 11px; font-size: 11px; font-weight: 700; margin-bottom: 20px;">
      ⚠️ <?= e($error_message) ?>
    </div>
  <?php endif; ?>

  <div class="layout">
    <section class="panel">
      <div class="notice" style="display: flex; justify-content: space-between; align-items: center; gap: 15px;">
        <div>
          <b>Tracking reference:</b> <?= e($shipment['tracking_number']) ?> &nbsp;&middot;&nbsp; Changes made here will be recorded against the operational audit log.
        </div>
        <div>
          <button type="submit" form="editForm" class="btn primary" style="background: linear-gradient(135deg, #0daafc, #0764d7); color: #fff; font-weight: 900; font-size: 11px; padding: 8px 16px; border-radius: 8px; flex: none;">
            💾 Save Changes &rarr;
          </button>
        </div>
      </div>

      <?php
        $pickup = $shipment['pickup_address'] ?? [];
        $delivery = $shipment['delivery_address'] ?? [];
        $item = $shipment['items'][0] ?? [];
      ?>

      <form action="<?= url('/admin/shipments/' . e($shipment['shipment_number']) . '/edit') ?>" method="POST" id="editForm">
        <?= csrf_field() ?>

        <div class="form">

          <!-- Section 01: Sender & Receiver -->
          <section class="section">
            <div class="sectionHead">
              <div class="badge">01</div>
              <div>
                <h2>Sender &amp; Receiver</h2>
                <p>Update pickup and delivery contacts and addresses.</p>
              </div>
            </div>
            <?php
              $sNameVal = !empty($pickup['name']) ? $pickup['name'] : ($shipment['customer_name'] ?? '');
              $rNameVal = $delivery['name'] ?? '';
            ?>
            <div class="grid2">
              <div class="address">
                <div class="addressTitle"><strong>SENDER &middot; PICKUP</strong><span>ORIGIN</span></div>
                <div class="field"><label>Sender name <em>*</em></label><input type="text" name="sender_name" required value="<?= e($sNameVal) ?>"></div>
                <div class="grid2">
                  <div class="field"><label>Phone <em>*</em></label><input type="text" name="sender_phone" required value="<?= e($pickup['phone'] ?? '') ?>"></div>
                  <div class="field"><label>House / building</label><input type="text" name="sender_house_number" value="<?= e($pickup['house_number'] ?? '') ?>"></div>
                </div>
                <div class="field"><label>Street address</label><input type="text" name="sender_street" required value="<?= e($pickup['street'] ?? '') ?>"></div>
                <div class="grid2">
                  <div class="field"><label>City / Town</label><input type="text" name="sender_city" required value="<?= e($pickup['city'] ?? $pickup['town'] ?? '') ?>"></div>
                  <div class="field"><label>UK postcode <em>*</em></label><input type="text" name="sender_postcode" required style="text-transform:uppercase;" value="<?= e($pickup['postcode'] ?? '') ?>"></div>
                </div>
              </div>

              <div class="address">
                <div class="addressTitle"><strong>RECEIVER &middot; DELIVERY</strong><span>DESTINATION</span></div>
                <div class="field"><label>Receiver name <em>*</em></label><input type="text" name="receiver_name" required value="<?= e($rNameVal) ?>"></div>
                <div class="grid2">
                  <div class="field"><label>Phone <em>*</em></label><input type="text" name="receiver_phone" required value="<?= e($delivery['phone'] ?? '') ?>"></div>
                  <div class="field"><label>House / building</label><input type="text" name="receiver_house_number" value="<?= e($delivery['house_number'] ?? '') ?>"></div>
                </div>
                <div class="field"><label>Street address</label><input type="text" name="receiver_street" required value="<?= e($delivery['street'] ?? '') ?>"></div>
                <div class="grid2">
                  <div class="field"><label>City / Town</label><input type="text" name="receiver_city" required value="<?= e($delivery['city'] ?? $delivery['town'] ?? '') ?>"></div>
                  <div class="field"><label>UK postcode <em>*</em></label><input type="text" name="receiver_postcode" required style="text-transform:uppercase;" value="<?= e($delivery['postcode'] ?? '') ?>"></div>
                </div>
              </div>
            </div>
          </section>

          <!-- Section 02: Package & Shipping -->
          <section class="section">
            <div class="sectionHead">
              <div class="badge">02</div>
              <div>
                <h2>Package &amp; Specifications</h2>
                <p>Review package specifications and special handling requirements.</p>
              </div>
            </div>
            <div class="grid2">
              <div class="field"><label>Item / description <em>*</em></label><input type="text" name="item_name" required value="<?= e($item['description'] ?? 'General Cargo') ?>"></div>
              <div class="field"><label>Package type</label>
                <select name="package_type">
                  <option value="parcel" <?= ($item['package_type'] ?? '') === 'parcel' ? 'selected' : '' ?>>Parcel / Box</option>
                  <option value="document" <?= ($item['package_type'] ?? '') === 'document' ? 'selected' : '' ?>>Envelope / Document</option>
                  <option value="pallet" <?= ($item['package_type'] ?? '') === 'pallet' ? 'selected' : '' ?>>Crate / Pallet</option>
                </select>
              </div>
              <div class="field"><label>Weight (kg) <em>*</em></label><input type="number" step="0.1" name="weight_kg" required value="<?= e($item['weight_kg'] ?? 1.0) ?>"></div>
              <div class="field"><label>Declared value (GBP)</label><input type="number" step="0.01" name="declared_value" value="<?= e($shipment['declared_value'] ?? 0.0) ?>"></div>
            </div>
            <div class="grid2">
              <div class="field"><label>Length (cm)</label><input type="number" step="0.1" name="length_cm" value="<?= e($item['length_cm'] ?? 10.0) ?>"></div>
              <div class="field"><label>Width &amp; Height (cm)</label>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:8px;">
                  <input type="number" step="0.1" name="width_cm" placeholder="Width" value="<?= e($item['width_cm'] ?? 10.0) ?>">
                  <input type="number" step="0.1" name="height_cm" placeholder="Height" value="<?= e($item['height_cm'] ?? 10.0) ?>">
                </div>
              </div>
            </div>
            <div class="field"><label>Delivery notes / special instructions</label><textarea name="special_instructions" placeholder="Leave with reception if recipient is unavailable."><?= e($shipment['special_instructions'] ?? '') ?></textarea></div>
            <div class="options">
              <label class="option"><input type="checkbox" checked> Signature required</label>
              <label class="option"><input type="checkbox" checked> Photo proof</label>
              <label class="option"><input type="checkbox"> Fragile handling</label>
            </div>
          </section>

          <!-- Section 03: Courier Service & Charges -->
          <section class="section">
            <div class="sectionHead">
              <div class="badge">03</div>
              <div>
                <h2>Courier Service &amp; Charges</h2>
                <p>Select the courier service and verify GBP billing amounts.</p>
              </div>
            </div>
            <div class="services">
              <?php foreach ($services as $srv): ?>
                <?php $isSelected = ($shipment['service_id'] == $srv['id']); ?>
                <div class="service">
                  <input id="srv_<?= $srv['id'] ?>" name="service_id" type="radio" value="<?= $srv['id'] ?>" data-price="<?= number_format($srv['base_price'], 2, '.', '') ?>" <?= $isSelected ? 'checked' : '' ?>>
                  <label for="srv_<?= $srv['id'] ?>">
                    <strong><?= e($srv['name']) ?></strong>
                    <small>Door-to-door UK delivery service</small>
                    <b>£<?= number_format($srv['base_price'], 2) ?></b>
                  </label>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="grid2" style="margin-top:14px">
              <div class="field">
                <label>Manual charge override (GBP Total)</label>
                <input id="override" type="number" step="0.01" name="total_amount" value="<?= e($shipment['total_amount'] ?? 0.0) ?>" placeholder="Leave blank to use service price">
              </div>
              <div class="field">
                <label>VAT treatment</label>
                <select><option>Standard UK VAT — 20%</option><option>VAT exempt</option><option>Zero rated</option></select>
              </div>
            </div>
          </section>

          <!-- Section 04: Schedule & Operational Status -->
          <section class="section">
            <div class="sectionHead">
              <div class="badge">04</div>
              <div>
                <h2>Schedule &amp; Operational Status</h2>
                <p>Update planned pickup/delivery dates and the current shipment state.</p>
              </div>
            </div>
            <div class="grid2">
              <div class="field"><label style="display:flex; justify-content:space-between; align-items:center;"><span>Invoice Date <em>*</em></span> <em style="color:#0284c7; font-style:normal; font-size:9px; text-transform:none;">(Can select backdate)</em></label><input type="datetime-local" name="scheduled_pickup_at" value="<?= !empty($shipment['scheduled_pickup_at']) ? date('Y-m-d\TH:i', strtotime($shipment['scheduled_pickup_at'])) : '' ?>" required></div>
              <div class="field"><label>Current status</label>
                <select name="status">
                  <option value="booking_confirmed" <?= $shipment['status'] === 'booking_confirmed' ? 'selected' : '' ?>>Booking Confirmed</option>
                  <option value="collection_scheduled" <?= $shipment['status'] === 'collection_scheduled' ? 'selected' : '' ?>>Collection Scheduled</option>
                  <option value="driver_assigned" <?= $shipment['status'] === 'driver_assigned' ? 'selected' : '' ?>>Driver Assigned</option>
                  <option value="collected" <?= $shipment['status'] === 'collected' ? 'selected' : '' ?>>Collected / Picked Up</option>
                  <option value="in_transit" <?= $shipment['status'] === 'in_transit' ? 'selected' : '' ?>>In Transit</option>
                  <option value="out_for_delivery" <?= $shipment['status'] === 'out_for_delivery' ? 'selected' : '' ?>>Out for Delivery</option>
                  <option value="delivered" <?= $shipment['status'] === 'delivered' ? 'selected' : '' ?>>Delivered</option>
                  <option value="delivery_failed" <?= $shipment['status'] === 'delivery_failed' ? 'selected' : '' ?>>Delivery Failed</option>
                  <option value="on_hold" <?= $shipment['status'] === 'on_hold' ? 'selected' : '' ?>>On Hold</option>
                  <option value="cancelled" <?= $shipment['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>
              </div>
              <div class="field"><label>Current location label</label><input type="text" value="<?= e($shipment['pickup_address']['city'] ?? 'UK Central Hub') ?>"></div>
            </div>
          </section>

          <!-- Section 05: Confirmation & Verification -->
          <section class="section" style="background: linear-gradient(180deg, #f8fafc, #eff6ff); padding: 20px; border-radius: 14px; border: 1px solid #bfdbfe; margin-top: 10px;">
            <div class="sectionHead" style="margin-bottom: 12px;">
              <div class="badge" style="background:#1d4ed8; color:#ffffff;">05</div>
              <div>
                <h2 style="color: #1e3a8a;">Confirm &amp; Verification</h2>
                <p style="color: #3b82f6;">Confirm all updated operational details before committing changes to MySQL.</p>
              </div>
            </div>
            <div style="display: flex; flex-direction: column; gap: 12px; margin-top: 10px;">
              <label class="option" style="background: #ffffff; padding: 12px 16px; border-radius: 10px; border: 1px solid #93c5fd; font-size: 11px; font-weight: 700; color: #1e293b;">
                <input type="checkbox" required checked id="confirm_check">
                I confirm that all sender, receiver, package, pricing, and schedule details have been verified.
              </label>
              <div style="display: flex; gap: 12px; justify-content: flex-end; align-items: center; margin-top: 6px;">
                <a href="<?= url('/admin/shipments/' . e($shipment['shipment_number'])) ?>" class="btn" style="background:#ffffff; color:#475569;">Cancel</a>
                <button type="submit" class="btn primary" style="background: linear-gradient(135deg, #1d4ed8, #0284c7); padding: 12px 24px; font-size: 13px; font-weight: 900; box-shadow: 0 10px 25px rgba(29, 78, 216, 0.3);">
                  ✓ Confirm &amp; Save Changes &rarr;
                </button>
              </div>
            </div>
          </section>

        </div>

        <div class="footer">
          <span class="footerNote">Last updated: <?= date('d M Y &middot; H:i') ?> &middot; Changes will be audit logged.</span>
          <div class="actions">
            <a href="<?= url('/admin/shipments/' . e($shipment['shipment_number'])) ?>" class="btn">Cancel</a>
            <button class="btn primary" type="submit" style="background: linear-gradient(135deg, #1d4ed8, #0284c7);">✓ Confirm &amp; Save Changes &rarr;</button>
          </div>
        </div>
      </form>
    </section>

    <!-- RIGHT SIDEBAR -->
    <aside class="side">
      <!-- Status Card -->
      <div class="card statusCard">
        <div class="cardHead"><h3>Shipment Status</h3><span style="color:#24d9ff">LIVE</span></div>
        <div class="tracking"><?= e($shipment['tracking_number']) ?></div>
        <div class="statusText"><?= e(ucwords(str_replace('_', ' ', $shipment['status']))) ?></div>
        <div class="bar"><span></span></div>
        <div class="route">
          <div class="done"></div>
          <div class="done"></div>
          <div class="current"></div>
          <div></div>
          <div></div>
        </div>
      </div>

      <!-- Charge Summary Card -->
      <div class="card">
        <div class="cardHead"><h3>Charge Summary</h3><span>GBP (£)</span></div>
        <div class="kv">
          <div><span>Service</span><b id="serviceName"><?= e($shipment['service_name']) ?></b></div>
          <div><span>Shipping Subtotal</span><b id="shipping">£<?= number_format((float)($shipment['total_amount'] / 1.20), 2) ?></b></div>
          <div><span>VAT 20%</span><b id="vat">£<?= number_format((float)($shipment['total_amount'] - ($shipment['total_amount'] / 1.20)), 2) ?></b></div>
          <div class="total"><span>Total (GBP)</span><b id="total">£<?= number_format((float)$shipment['total_amount'], 2) ?></b></div>
        </div>
      </div>

      <!-- Audit Activity Card -->
      <div class="card">
        <div class="cardHead"><h3>Audit Activity</h3><span>SECURE LOG</span></div>
        <div class="audit">
          <div class="auditItem">
            <div class="auditIcon">✓</div>
            <div><b>Shipment created</b><span><?= date('d M Y', strtotime($shipment['created_at'])) ?> &middot; System</span></div>
          </div>
          <?php if (!empty($shipment['history'])): ?>
            <?php foreach (array_slice($shipment['history'], 0, 2) as $h): ?>
              <div class="auditItem">
                <div class="auditIcon">↻</div>
                <div><b><?= e($h['public_message']) ?></b><span><?= date('d M Y', strtotime($h['created_at'])) ?> &middot; Ops</span></div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
          <div class="auditItem">
            <div class="auditIcon">●</div>
            <div><b>Editing session active</b><span>Unsaved changes are not yet committed.</span></div>
          </div>
        </div>
      </div>

      <!-- Danger Zone -->
      <div class="card" style="border-color:#efd9dc; background:#fffafb;">
        <div class="cardHead"><h3 style="color:#c94c5b;">Danger Zone</h3><span style="color:#d35a67">RESTRICTED</span></div>
        <p style="font-size:10px; line-height:1.6; color:#806f74; margin:0 0 12px;">Shipment deletion requires elevated administrator permissions. Operational history is preserved.</p>
        <button type="button" class="btn" style="color:#c94c5b; border-color:#efd9dc;" onclick="alert('Shipment cancellation can be done via Status dropdown setting status to Cancelled.')">Cancel Shipment</button>
      </div>
    </aside>
  </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(6,16,31,0.75); backdrop-filter:blur(6px); z-index:9999; justify-content:center; align-items:center;">
  <div style="background:#ffffff; border-radius:18px; max-width:520px; width:90%; padding:24px; box-shadow:0 25px 60px rgba(0,0,0,0.35); border:1px solid #dce7f0;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; border-bottom:1px solid #f1f5f9; padding-bottom:12px;">
      <h3 style="margin:0; font-size:16px; font-weight:900; color:#06101f; display:flex; align-items:center; gap:8px;">
        <span style="background:#e0f2fe; color:#0284c7; padding:6px 10px; border-radius:8px; font-size:14px;">🔒</span> Confirm Shipment Updates
      </h3>
      <button type="button" onclick="closeConfirmModal()" style="border:0; background:none; font-size:22px; color:#64748b; cursor:pointer;">&times;</button>
    </div>
    <p style="font-size:12px; color:#475569; margin-bottom:16px; line-height:1.5;">
      Please review the summary below before committing these changes to MySQL:
    </p>

    <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:14px; display:grid; gap:10px; font-size:11px; margin-bottom:20px;">
      <div style="display:flex; justify-content:space-between;">
        <span style="color:#64748b; font-weight:600;">Sender:</span>
        <strong id="modalSender" style="color:#0f172a;">-</strong>
      </div>
      <div style="display:flex; justify-content:space-between;">
        <span style="color:#64748b; font-weight:600;">Receiver:</span>
        <strong id="modalReceiver" style="color:#0f172a;">-</strong>
      </div>
      <div style="display:flex; justify-content:space-between;">
        <span style="color:#64748b; font-weight:600;">Service &amp; Amount:</span>
        <strong id="modalService" style="color:#0284c7;">-</strong>
      </div>
      <div style="display:flex; justify-content:space-between;">
        <span style="color:#64748b; font-weight:600;">Status:</span>
        <strong id="modalStatus" style="color:#16a34a; text-transform:uppercase;">-</strong>
      </div>
    </div>

    <div style="display:flex; gap:10px; justify-content:flex-end;">
      <button type="button" class="btn" onclick="closeConfirmModal()" style="padding:10px 18px;">Keep Editing</button>
      <button type="button" class="btn primary" onclick="submitEditFormReal()" style="background:linear-gradient(135deg, #16a34a, #15803d); padding:10px 22px; font-weight:900; font-size:12px;">
        ✓ Confirm &amp; Save Changes
      </button>
    </div>
  </div>
</div>

<script>
const radios = [...document.querySelectorAll('input[name="service_id"]')], override = document.getElementById('override');
function updatePrice(){
  const r = radios.find(x => x.checked);
  if (!r) return;
  const base = override && override.value !== '' ? Number(override.value) : Number(r.dataset.price);
  const subtotal = base / 1.20;
  const vat = base - subtotal;
  const labelEl = r.nextElementSibling.querySelector('strong');
  if (labelEl) {
    document.getElementById('serviceName').textContent = labelEl.textContent;
  }
  document.getElementById('shipping').textContent = '£' + subtotal.toFixed(2);
  document.getElementById('vat').textContent = '£' + vat.toFixed(2);
  document.getElementById('total').textContent = '£' + base.toFixed(2);
}
radios.forEach(r => r.addEventListener('change', updatePrice));
if (override) override.addEventListener('input', updatePrice);
updatePrice();

let isConfirmed = false;
const editForm = document.getElementById('editForm');
const confirmModal = document.getElementById('confirmModal');

editForm.addEventListener('submit', function(e) {
  if (!isConfirmed) {
    e.preventDefault();
    const senderName = document.querySelector('input[name="sender_name"]').value;
    const senderCity = document.querySelector('input[name="sender_city"]').value;
    const receiverName = document.querySelector('input[name="receiver_name"]').value;
    const receiverCity = document.querySelector('input[name="receiver_city"]').value;
    const totalAmount = document.getElementById('total').textContent;
    const statusSelect = document.querySelector('select[name="status"]');
    const statusText = statusSelect.options[statusSelect.selectedIndex].text;

    document.getElementById('modalSender').textContent = senderName + ' (' + senderCity + ')';
    document.getElementById('modalReceiver').textContent = receiverName + ' (' + receiverCity + ')';
    document.getElementById('modalService').textContent = document.getElementById('serviceName').textContent + ' — ' + totalAmount;
    document.getElementById('modalStatus').textContent = statusText;

    confirmModal.style.display = 'flex';
  }
});

function closeConfirmModal() {
  confirmModal.style.display = 'none';
}

function submitEditFormReal() {
  isConfirmed = true;
  confirmModal.style.display = 'none';
  editForm.submit();
}
</script>

<?php $header_title = "Edit Shipment " . e($shipment['shipment_number']); ?>
<?php $header_subtitle = "Update operational contacts, pricing, dates & status"; ?>
<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/admin.php'; ?>
