<?php ob_start(); ?>

<style>
.create-shipment-scope {
  --blue: #079df2;
  --cyan: #2bdcff;
  --ink: #102038;
  --muted: #71839a;
  --line: #dfe8f0;
  --shadow: 0 20px 55px rgba(8,25,48,.08);
}

.create-shipment-scope .breadcrumb { font-size: 10px; color: #7890a7; margin-bottom: 9px; }
.create-shipment-scope .breadcrumb span { color: #0795e7; font-weight: 800; }
.create-shipment-scope .heading { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 21px; }
.create-shipment-scope .heading h2 { font-size: 22px; letter-spacing: -.05em; color: var(--n2, #0a1a31); }
.create-shipment-scope .heading p { font-size: 10px; color: var(--muted); margin-top: 5px; }
.create-shipment-scope .secure { font-size: 9px; color: #078fd8; background: #eaf8ff; border: 1px solid #c9edff; border-radius: 20px; padding: 7px 12px; font-weight: 800; }

.create-shipment-scope .layout { display: grid; grid-template-columns: minmax(0, 1fr) 300px; gap: 18px; align-items: start; }
.create-shipment-scope .formShell { background: #fff; border: 1px solid var(--line); border-radius: 18px; box-shadow: var(--shadow); overflow: hidden; }

/* 5-Step Header */
.create-shipment-scope .stepper { display: flex; background: linear-gradient(135deg,#07172c,#0a213b); padding: 18px 24px; gap: 5px; }
.create-shipment-scope .step { flex: 1; display: flex; align-items: center; gap: 8px; color: #718aa2; font-size: 9px; font-weight: 850; position: relative; }
.create-shipment-scope .step:not(:last-child):after { content: ""; height: 1px; background: #31506c; flex: 1; margin-left: 4px; }
.create-shipment-scope .step.done, .create-shipment-scope .step.current { color: #fff; }
.create-shipment-scope .num { width: 27px; height: 27px; border-radius: 50%; display: grid; place-items: center; background: #132c47; border: 1px solid #31506c; color: #8ba5bc; font-size: 10px; flex: none; }
.create-shipment-scope .current .num { background: linear-gradient(135deg,#10adff,#075fd6); border-color: #2bdcff; box-shadow: 0 0 20px rgba(7,157,242,0.4); color: #fff; }
.create-shipment-scope .done .num { background: #123e39; border-color: #20d0a4; color: #31e0b5; }

.create-shipment-scope .formBody { padding: 25px; }
.create-shipment-scope .section { padding-bottom: 27px; margin-bottom: 25px; border-bottom: 1px solid #edf1f5; }
.create-shipment-scope .section:last-of-type { border-bottom: 0; margin-bottom: 0; }
.create-shipment-scope .sectionHead { display: flex; gap: 11px; align-items: flex-start; margin-bottom: 17px; }
.create-shipment-scope .sectionIcon { width: 35px; height: 35px; border-radius: 10px; background: #edf8ff; color: #078fd9; display: grid; place-items: center; font-size: 13px; font-weight: 900; flex: none; }
.create-shipment-scope .section:nth-of-type(2) .sectionIcon { background: #ecfbf6; color: #0cae87; }
.create-shipment-scope .section:nth-of-type(3) .sectionIcon { background: #fff6e9; color: #e48727; }
.create-shipment-scope .section:nth-of-type(4) .sectionIcon { background: #f3edff; color: #8051df; }
.create-shipment-scope .section:nth-of-type(5) .sectionIcon { background: #e0f2fe; color: #0284c7; }

.create-shipment-scope .sectionHead h3 { font-size: 14px; letter-spacing: -.02em; color: var(--n2, #0a1a31); }
.create-shipment-scope .sectionHead p { font-size: 10px; color: var(--muted); margin-top: 3px; }

.create-shipment-scope .grid2, .create-shipment-scope .grid3 { display: grid; gap: 12px; }
.create-shipment-scope .grid2 { grid-template-columns: 1fr 1fr; }
.create-shipment-scope .grid3 { grid-template-columns: 1fr 1fr 1fr; }

.create-shipment-scope .field { display: grid; gap: 6px; margin-bottom: 11px; }
.create-shipment-scope .field:last-child { margin-bottom: 0; }
.create-shipment-scope .field label { font-size: 10px; font-weight: 850; color: #24364d; }
.create-shipment-scope .req { color: #078fd9; }
.create-shipment-scope .field input, 
.create-shipment-scope .field select, 
.create-shipment-scope .field textarea {
  width: 100%; border: 1px solid #dbe5ee; border-radius: 8px; background: #fbfdff; padding: 11px 12px; color: #1a2c42; font-size: 11px; outline: 0; transition: .2s;
}
.create-shipment-scope .field textarea { min-height: 84px; resize: vertical; }
.create-shipment-scope .field input:focus, 
.create-shipment-scope .field select:focus, 
.create-shipment-scope .field textarea:focus { border-color: #58c7fa; box-shadow: 0 0 0 3px rgba(7,157,242,0.08); background: #fff; }

.create-shipment-scope .inputPrefix { position: relative; }
.create-shipment-scope .inputPrefix span { position: absolute; left: 12px; top: 11px; font-size: 11px; color: #8292a5; font-weight: 700; }
.create-shipment-scope .inputPrefix input { padding-left: 26px; }

/* Courier Service Speed Selector Cards */
.create-shipment-scope .serviceGrid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
.create-shipment-scope .service { position: relative; }
.create-shipment-scope .service input { position: absolute; opacity: 0; }
.create-shipment-scope .service label { display: block; border: 1px solid #dfe7ee; border-radius: 10px; padding: 14px; cursor: pointer; height: 100%; transition: .2s; }
.create-shipment-scope .service label:hover { border-color: #74cafa; }
.create-shipment-scope .service input:checked + label { border-color: #079df2; background: #edf9ff; box-shadow: inset 0 0 0 1px #079df2; }
.create-shipment-scope .service strong { display: block; font-size: 11px; color: var(--n2, #0a1a31); }
.create-shipment-scope .service small { display: block; color: #7d8da0; font-size: 9px; line-height: 1.5; margin-top: 4px; }
.create-shipment-scope .service b { display: block; color: #078fd9; font-size: 13px; font-weight: 900; margin-top: 9px; }

.create-shipment-scope .checks { display: flex; gap: 14px; margin-top: 11px; flex-wrap: wrap; }
.create-shipment-scope .check { display: flex; align-items: center; gap: 6px; font-size: 10px; color: #5f7287; font-weight: 700; cursor: pointer; }
.create-shipment-scope .check input { accent-color: #079df2; width: 16px; height: 16px; }

.create-shipment-scope .formFooter { padding: 18px 25px; background: #fafcfe; border-top: 1px solid #edf1f5; display: flex; justify-content: space-between; align-items: center; }
.create-shipment-scope .draft { font-size: 10px; color: #8292a4; }
.create-shipment-scope .footerActions { display: flex; gap: 8px; }

/* Right Sidebar Preview Cards */
.create-shipment-scope .sideRight { display: grid; gap: 14px; }
.create-shipment-scope .sideCard { background: #fff; border: 1px solid var(--line); border-radius: 15px; box-shadow: var(--shadow); padding: 19px; }
.create-shipment-scope .sideHead { display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; }
.create-shipment-scope .sideHead h3 { font-size: 12px; color: var(--n2, #0a1a31); }
.create-shipment-scope .sideHead span { font-size: 9px; color: #078fd9; font-weight: 900; letter-spacing: 0.05em; }

.create-shipment-scope .preview { border-radius: 11px; background: linear-gradient(145deg,#061329,#0b2541); padding: 16px; color: #fff; position: relative; overflow: hidden; }
.create-shipment-scope .preview:after { content: ""; position: absolute; width: 100px; height: 100px; right: -45px; top: -40px; border-radius: 50%; background: rgba(7,157,242,0.1); }
.create-shipment-scope .preview .ref { font-size: 9px; color: #68dfff; letter-spacing: .12em; font-weight: 900; }
.create-shipment-scope .preview h4 { font-size: 15px; margin-top: 5px; color: #fff; }
.create-shipment-scope .route { display: flex; align-items: center; gap: 6px; margin: 16px 0 11px; }
.create-shipment-scope .dot { width: 7px; height: 7px; border-radius: 50%; background: #2bdcff; box-shadow: 0 0 10px #2bdcff; }
.create-shipment-scope .routeLine { height: 1px; flex: 1; background: linear-gradient(90deg,#2bdcff,#9561ff); }
.create-shipment-scope .preview small { color: #8298af; font-size: 9px; font-weight: 700; }

.create-shipment-scope .summary { display: grid; gap: 10px; }
.create-shipment-scope .sum { display: flex; justify-content: space-between; font-size: 11px; }
.create-shipment-scope .sum span { color: #77899c; }
.create-shipment-scope .sum strong { font-size: 11px; color: var(--n2, #0a1a31); }
.create-shipment-scope .total { padding-top: 11px; border-top: 1px solid #e9eef3; margin-top: 2px; }
.create-shipment-scope .total strong { font-size: 20px; color: #078fd9; font-weight: 950; }

.create-shipment-scope .tip { background: linear-gradient(135deg,#edf9ff,#f7f3ff); border: 1px solid #d8eaf7; border-radius: 12px; padding: 14px; }
.create-shipment-scope .tip b { font-size: 11px; color: #078fd9; }
.create-shipment-scope .tip p { font-size: 10px; color: #71849a; line-height: 1.6; margin-top: 4px; }

.create-shipment-scope .timeline { display: grid; gap: 10px; }
.create-shipment-scope .tl { display: grid; grid-template-columns: 22px 1fr; gap: 8px; }
.create-shipment-scope .tlDot { width: 20px; height: 20px; border-radius: 50%; display: grid; place-items: center; background: #eaf8ff; color: #078fd9; font-size: 10px; font-weight: 900; }
.create-shipment-scope .tl b { font-size: 11px; color: var(--n2, #0a1a31); }
.create-shipment-scope .tl span { display: block; font-size: 9px; color: #8796a7; margin-top: 2px; }

@media(max-width:1050px){
  .create-shipment-scope .layout { grid-template-columns: 1fr; }
  .create-shipment-scope .sideRight { grid-template-columns: repeat(3,1fr); }
}
@media(max-width:780px){
  .create-shipment-scope .grid2, .create-shipment-scope .grid3, .create-shipment-scope .serviceGrid { grid-template-columns: 1fr; }
  .create-shipment-scope .sideRight { grid-template-columns: 1fr; }
  .create-shipment-scope .stepper { overflow-x: auto; }
  .create-shipment-scope .step { min-width: 120px; }
}
</style>

<div class="create-shipment-scope">
    <div class="breadcrumb">Shipments <b>&rsaquo;</b> <span>Create New Shipment</span></div>
    <div class="heading">
        <div>
            <h2>New shipment workspace</h2>
            <p>Complete the details below. Required fields are marked with an asterisk (*).</p>
        </div>
        <div class="secure">&bull; Secure UK Operations</div>
    </div>

    <?php if (!empty($error_message)): ?>
        <div class="admin-alert admin-alert-error" style="margin-bottom: 20px;">
            <span>⚠️</span>
            <div><?= e($error_message) ?></div>
        </div>
    <?php endif; ?>

    <div class="layout">
        <!-- 5-Step Form Workspace -->
        <section class="formShell">
            <div class="stepper">
                <div class="step current"><span class="num">01</span>Sender</div>
                <div class="step"><span class="num">02</span>Receiver</div>
                <div class="step"><span class="num">03</span>Package</div>
                <div class="step"><span class="num">04</span>Service</div>
                <div class="step"><span class="num">05</span>Schedule</div>
            </div>

            <form id="shipmentForm" action="<?= url('/admin/shipments/create') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="formBody">
                    <!-- SECTION 01: SENDER DETAILS -->
                    <section class="section">
                        <div class="sectionHead">
                            <div class="sectionIcon">01</div>
                            <div>
                                <h3>Sender details</h3>
                                <p>Pickup contact and collection address.</p>
                            </div>
                        </div>

                        <div class="grid2">
                            <div class="field">
                                <label for="senderName">Sender name <span class="req">*</span></label>
                                <input type="text" id="senderName" name="sender_name" placeholder="e.g. John Smith" value="<?= e($input['sender_name'] ?? '') ?>" required>
                            </div>
                            <div class="field">
                                <label for="senderPhone">Contact phone <span class="req">*</span></label>
                                <input type="text" id="senderPhone" name="sender_phone" placeholder="e.g. 07700 900123" value="<?= e($input['sender_phone'] ?? '') ?>" required>
                            </div>
                            <div class="field">
                                <label for="senderStreet">Street / house number <span class="req">*</span></label>
                                <input type="text" id="senderStreet" name="sender_street" placeholder="e.g. 42 High Street" value="<?= e($input['sender_street'] ?? '') ?>" required>
                            </div>
                            <div class="field">
                                <label for="senderCity">City / Town <span class="req">*</span></label>
                                <input type="text" id="senderCity" name="sender_city" placeholder="e.g. London" value="<?= e($input['sender_city'] ?? '') ?>" required>
                            </div>
                            <div class="field">
                                <label for="senderPostcode">UK postcode <span class="req">*</span></label>
                                <input type="text" id="senderPostcode" name="sender_postcode" placeholder="e.g. SW1A 1AA" value="<?= e($input['sender_postcode'] ?? '') ?>" required>
                            </div>
                        </div>
                    </section>

                    <!-- SECTION 02: RECEIVER DETAILS -->
                    <section class="section">
                        <div class="sectionHead">
                            <div class="sectionIcon">02</div>
                            <div>
                                <h3>Receiver details</h3>
                                <p>Delivery contact and destination address.</p>
                            </div>
                        </div>

                        <div class="grid2">
                            <div class="field">
                                <label for="receiverName">Receiver name <span class="req">*</span></label>
                                <input type="text" id="receiverName" name="receiver_name" placeholder="e.g. Sarah Jenkins" value="<?= e($input['receiver_name'] ?? '') ?>" required>
                            </div>
                            <div class="field">
                                <label for="receiverPhone">Contact phone <span class="req">*</span></label>
                                <input type="text" id="receiverPhone" name="receiver_phone" placeholder="e.g. 07700 900456" value="<?= e($input['receiver_phone'] ?? '') ?>" required>
                            </div>
                            <div class="field">
                                <label for="receiverStreet">Street / house number <span class="req">*</span></label>
                                <input type="text" id="receiverStreet" name="receiver_street" placeholder="e.g. 15 Park Lane" value="<?= e($input['receiver_street'] ?? '') ?>" required>
                            </div>
                            <div class="field">
                                <label for="receiverCity">City / Town <span class="req">*</span></label>
                                <input type="text" id="receiverCity" name="receiver_city" placeholder="e.g. Manchester" value="<?= e($input['receiver_city'] ?? '') ?>" required>
                            </div>
                            <div class="field">
                                <label for="receiverPostcode">UK postcode <span class="req">*</span></label>
                                <input type="text" id="receiverPostcode" name="receiver_postcode" placeholder="e.g. M1 1AE" value="<?= e($input['receiver_postcode'] ?? '') ?>" required>
                            </div>
                        </div>
                    </section>

                    <!-- SECTION 03: PACKAGE & ITEM DETAILS -->
                    <section class="section">
                        <div class="sectionHead">
                            <div class="sectionIcon">03</div>
                            <div>
                                <h3>Package &amp; item details</h3>
                                <p>Accurate weight helps calculate the correct shipping charge.</p>
                            </div>
                        </div>

                        <div class="grid2">
                            <div class="field">
                                <label for="item">Item name / description <span class="req">*</span></label>
                                <input type="text" id="item" name="item_name" placeholder="e.g. Electronics &amp; documents" value="<?= e($input['item_name'] ?? '') ?>" required>
                            </div>
                            <div class="field">
                                <label for="weight">Weight (kg) <span class="req">*</span></label>
                                <input type="number" step="0.1" min="0.1" id="weight" name="weight_kg" value="<?= e($input['weight_kg'] ?? '2.5') ?>" required>
                            </div>
                        </div>

                        <div class="grid2" style="margin-top:12px">
                            <div class="field">
                                <label for="cargo">Declared cargo value (GBP)</label>
                                <div class="inputPrefix">
                                    <span>£</span>
                                    <input type="number" step="0.01" min="0" id="cargo" name="declared_value" value="<?= e($input['declared_value'] ?? '150.00') ?>">
                                </div>
                            </div>
                        </div>

                        <div class="field" style="margin-top:12px">
                            <label for="instructions">Delivery notes / special instructions</label>
                            <textarea id="instructions" name="special_instructions" placeholder="Fragile handling, gate code, delivery restrictions, etc."><?= e($input['special_instructions'] ?? '') ?></textarea>
                        </div>

                        <div class="checks">
                            <label class="check"><input type="checkbox" name="opt_fragile" value="1"> Fragile handling</label>
                            <label class="check"><input type="checkbox" name="opt_signature" value="1" checked> Signature required</label>
                            <label class="check"><input type="checkbox" name="opt_photo_pod" value="1" checked> Photo proof of delivery</label>
                        </div>
                    </section>

                    <!-- SECTION 04: COURIER SERVICE & PRICING -->
                    <section class="section">
                        <div class="sectionHead">
                            <div class="sectionIcon">04</div>
                            <div>
                                <h3>Courier service &amp; pricing</h3>
                                <p>Select a delivery service. Pricing can be calculated or manually overridden by an authorised admin.</p>
                            </div>
                        </div>

                        <div class="serviceGrid">
                            <?php foreach ($services as $idx => $srv): ?>
                                <?php
                                    $defaultPrices = [1 => 24.50, 2 => 38.00, 3 => 65.00];
                                    $p = $defaultPrices[$srv['id']] ?? 29.99;
                                ?>
                                <div class="service">
                                    <input type="radio" name="service_id" id="s<?= $srv['id'] ?>" value="<?= $srv['id'] ?>" data-price="<?= number_format($p, 2, '.', '') ?>" <?= ($idx === 0) ? 'checked' : '' ?>>
                                    <label for="s<?= $srv['id'] ?>">
                                        <strong><?= e($srv['name']) ?></strong>
                                        <small><?= e($srv['description']) ?></small>
                                        <b>£<?= number_format($p, 2) ?></b>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="grid2" style="margin-top:15px">
                            <div class="field">
                                <label for="override">Manual shipping charge override (GBP)</label>
                                <div class="inputPrefix">
                                    <span>£</span>
                                    <input type="number" step="0.01" min="0" id="override" name="manual_amount" placeholder="Leave blank for service price" value="<?= e($input['manual_amount'] ?? '') ?>">
                                </div>
                            </div>
                            <div class="field">
                                <label for="vatSelect">VAT treatment</label>
                                <select id="vatSelect" name="vat_treatment">
                                    <option value="standard">Standard VAT — 20%</option>
                                    <option value="exempt">VAT exempt</option>
                                    <option value="zero">Zero rated</option>
                                </select>
                            </div>
                        </div>
                    </section>

                    <!-- SECTION 05: SCHEDULE & INVOICE DATE -->
                    <section class="section">
                        <div class="sectionHead">
                            <div class="sectionIcon">05</div>
                            <div>
                                <h3>Invoice Date &amp; Schedule</h3>
                                <p>Set invoice issue date (backdates allowed) and initial operational status.</p>
                            </div>
                        </div>

                        <div class="grid2">
                            <div class="field">
                                <label for="pickup">Invoice Date <span class="req">*</span> <small style="color:#0284c7; text-transform:none; font-weight:bold;">(Can select backdate)</small></label>
                                <input type="datetime-local" id="pickup" name="scheduled_pickup_at" value="<?= e($input['scheduled_pickup_at'] ?? date('Y-m-d\TH:i')) ?>" required>
                                <input type="hidden" name="auto_generate_events" value="1">
                            </div>
                            <div class="field">
                                <label for="initial_status">Initial Operational Status</label>
                                <select id="initial_status" name="initial_status">
                                    <option value="booking_confirmed">Booking Confirmed</option>
                                    <option value="collection_scheduled">Collection Scheduled</option>
                                    <option value="collected">Collected / Picked Up</option>
                                    <option value="in_transit" selected>In Transit</option>
                                    <option value="delivered">Delivered</option>
                                </select>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="formFooter">
                    <span class="draft">All monetary values are in GBP (£).</span>
                    <div class="footerActions">
                        <a href="<?= url('/admin/shipments') ?>" class="btn">Cancel</a>
                        <button type="submit" class="btn primary">Create Shipment &amp; Tracking &rarr;</button>
                    </div>
                </div>
            </form>
        </section>

        <!-- Right Side Preview Sidebar -->
        <aside class="sideRight">
            <div class="sideCard">
                <div class="sideHead">
                    <h3>Shipment Preview</h3>
                    <span>LIVE</span>
                </div>
                <div class="preview">
                    <span class="ref">RUSH PARCEL</span>
                    <h4 id="previewName">New Shipment</h4>
                    <div class="route">
                        <div class="dot"></div>
                        <div class="routeLine"></div>
                        <div class="dot" style="background:#9561ff;box-shadow:0 0 10px #9561ff"></div>
                    </div>
                    <small id="previewRoute">UK PICKUP &rarr; UK DELIVERY</small>
                </div>
            </div>

            <div class="sideCard">
                <div class="sideHead">
                    <h3>Price Summary</h3>
                    <span>GBP</span>
                </div>
                <div class="summary">
                    <div class="sum">
                        <span>Service</span>
                        <strong id="sumService">Standard Service</strong>
                    </div>
                    <div class="sum">
                        <span>Shipping</span>
                        <strong id="sumShipping">£24.50</strong>
                    </div>
                    <div class="sum">
                        <span>VAT estimate (20%)</span>
                        <strong id="sumVat">£4.90</strong>
                    </div>
                    <div class="sum total">
                        <span>Estimated total</span>
                        <strong id="sumTotal">£29.40</strong>
                    </div>
                </div>
            </div>

            <div class="sideCard">
                <div class="sideHead">
                    <h3>Automatic Events</h3>
                    <span>5 MILESTONES</span>
                </div>
                <div class="timeline">
                    <div class="tl">
                        <div class="tlDot">1</div>
                        <div><b>Booked</b><span>Shipment created</span></div>
                    </div>
                    <div class="tl">
                        <div class="tlDot">2</div>
                        <div><b>Picked Up</b><span>Courier collects parcel</span></div>
                    </div>
                    <div class="tl">
                        <div class="tlDot">3</div>
                        <div><b>In Transit</b><span>Shipment moving through network</span></div>
                    </div>
                    <div class="tl">
                        <div class="tlDot">4</div>
                        <div><b>Out for Delivery</b><span>Final-mile delivery</span></div>
                    </div>
                    <div class="tl">
                        <div class="tlDot">5</div>
                        <div><b>Delivered</b><span>Proof of delivery recorded</span></div>
                    </div>
                </div>
            </div>

            <div class="tip">
                <b>🔐 Admin control</b>
                <p>Final pricing, invoice generation and tracking events are validated server-side before being committed to MySQL.</p>
            </div>
        </aside>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('senderName');
    const receiverCityInput = document.getElementById('receiverCity');
    const senderCityInput = document.getElementById('senderCity');
    const override = document.getElementById('override');
    const services = Array.from(document.querySelectorAll('input[name="service_id"]'));

    function money(n) {
        return '£' + Number(n).toFixed(2);
    }

    function selectedService() {
        return services.find(x => x.checked) || services[0];
    }

    function updateSummary() {
        const s = selectedService();
        if (!s) return;
        const basePrice = Number(s.dataset.price || 24.50);
        const overrideVal = override.value.trim();
        const base = overrideVal !== '' ? Number(overrideVal) : basePrice;
        const vat = base * 0.20;

        const sLabel = s.nextElementSibling ? s.nextElementSibling.querySelector('strong').textContent : 'Selected Service';
        
        document.getElementById('sumService').textContent = sLabel;
        document.getElementById('sumShipping').textContent = money(base);
        document.getElementById('sumVat').textContent = money(vat);
        document.getElementById('sumTotal').textContent = money(base + vat);

        const senderName = nameInput ? nameInput.value.trim() : '';
        document.getElementById('previewName').textContent = senderName || 'New Shipment';

        const sCity = senderCityInput && senderCityInput.value.trim() ? senderCityInput.value.trim().toUpperCase() : 'UK PICKUP';
        const rCity = receiverCityInput && receiverCityInput.value.trim() ? receiverCityInput.value.trim().toUpperCase() : 'UK DELIVERY';
        document.getElementById('previewRoute').textContent = sCity + ' → ' + rCity;
    }

    services.forEach(x => x.addEventListener('change', updateSummary));
    if (override) override.addEventListener('input', updateSummary);
    if (nameInput) nameInput.addEventListener('input', updateSummary);
    if (senderCityInput) senderCityInput.addEventListener('input', updateSummary);
    if (receiverCityInput) receiverCityInput.addEventListener('input', updateSummary);

    updateSummary();
});
</script>

<?php $header_title = 'Create New Shipment'; ?>
<?php $header_subtitle = 'Schedule collection, capture parcel details and create your tracking record.'; ?>
<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/admin.php'; ?>
