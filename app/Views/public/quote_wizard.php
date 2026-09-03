<?php ob_start(); ?>

<style>
.quote-page {
  --navy:#0F172A;--navy2:#1E293B;--blue:#EA580C;--cyan:#EA580C;--purple:#0284C7;
  --ink:#0F172A;--muted:#64748B;--line:#E2E8F0;--bg:#F8FAFC;--white:#fff;
  --green:#16A34A;--shadow:0 10px 30px rgba(15,23,42,.06);
  background: var(--bg);
  color: var(--ink);
}
.quote-page .hero {
  padding-top: 50px;
  padding-bottom: 56px;
  position: relative;
  overflow: hidden;
  background: radial-gradient(circle at 70% 50%,#EA580C0e,transparent 30%),linear-gradient(#FFFFFF,#F8FAFC);
  border-bottom: 1px solid #E2E8F0;
}
.quote-page .hero:before {
  content: "";
  position: absolute;
  inset: 0;
  background-image: linear-gradient(#EA580C08 1px,transparent 1px),linear-gradient(90deg,#EA580C08 1px,transparent 1px);
  background-size: 52px 52px;
  mask-image: linear-gradient(#000,transparent 80%);
}
.quote-page .heroHead { position: relative; text-align: center; z-index: 2; }
.quote-page .kicker {
  display: inline-flex;
  padding: 7px 12px;
  border-radius: 99px;
  background: #FFF7ED;
  color: #EA580C;
  border: 1px solid #FFEDD5;
  font-size: 9px;
  font-weight: 900;
  letter-spacing: .13em;
  text-transform: uppercase;
}
.quote-page .hero h1 { font-size: 40px; letter-spacing: -.055em; line-height: 1.08; margin-top: 12px; color: var(--navy); }
.quote-page .heroHead p { font-size: 12px; color: #64748B; max-width: 650px; margin: 7px auto 0; line-height: 1.65; }

.quote-page .quoteWrap { position: relative; z-index: 3; width: min(900px, 100%); margin: 34px auto 0; }
.quote-page .quoteCard { background: #fff; border: 1px solid #E2E8F0; border-radius: 17px; box-shadow: var(--shadow); padding: 28px 34px; }
.quote-page .sectionTitle { font-size: 16px; font-weight: 900; padding-bottom: 12px; border-bottom: 1px solid var(--line); margin-bottom: 17px; color: var(--navy); }
.quote-page .sectionTitle span { color: #EA580C; margin-right: 7px; }

.quote-page .formSection { margin-bottom: 28px; }
.quote-page .grid2 { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
.quote-page .grid4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; }
.quote-page .field label { display: block; font-size: 9px; font-weight: 800; margin-bottom: 7px; color: #0F172A; }
.quote-page .required { color: #DC2626; }
.quote-page .field input, .quote-page .field select {
  width: 100%; height: 43px; border: 1px solid #E2E8F0; border-radius: 99px; background: #fff; color: #0F172A; padding: 0 16px; outline: none; font-size: 11px; font-weight: 600; transition: .2s; box-shadow: var(--shadow-xs);
}
.quote-page .field input::placeholder { color: #94A3B8; font-weight: 400; }
.quote-page .field input:focus, .quote-page .field select:focus { border-color: #EA580C; box-shadow: 0 0 0 3px rgba(234,88,12,0.15); }

.quote-page .serviceRow { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; align-items: end; }
.quote-page .options { height: 43px; display: flex; align-items: center; gap: 18px; }
.quote-page .check { display: flex; align-items: center; gap: 6px; font-size: 10px; color: #334155; cursor: pointer; font-weight: 600; }
.quote-page .check input { width: 14px; height: 14px; accent-color: #EA580C; }

.quote-page .calculate {
  width: 100%; height: 48px; border-radius: 9px; font-size: 12px; font-weight: 850; margin-top: 2px; position: relative; overflow: hidden;
  color: #fff; background: linear-gradient(135deg,#EA580C,#C2410C); border: 0; cursor: pointer; box-shadow: 0 4px 14px rgba(234,88,12,0.25); transition: .25s;
}
.quote-page .calculate:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(234,88,12,0.35); }
.quote-page .calculate:hover { transform: translateY(-2px); }
.quote-page .calculate:after {
  content: ""; position: absolute; top: 0; bottom: 0; width: 45%; left: -55%; background: linear-gradient(90deg,transparent,#ffffff44,transparent); transform: skewX(-20deg); animation: shine 3s infinite;
}
@keyframes shine { 0%, 55% { left: -55%; } 100% { left: 120%; } }

.quote-page .resultCard {
  margin-top: 22px; border: 1px solid #bfe8ff; border-radius: 15px; background: linear-gradient(135deg,#f4fbff,#fff); padding: 24px; box-shadow: var(--shadow);
}
.quote-page .resultHead { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--line); padding-bottom: 14px; margin-bottom: 16px; }
.quote-page .price { font-size: 32px; font-weight: 950; color: #078fe9; }

.quote-page .trust { margin-top: 28px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
.quote-page .trustCard { background: #fff; border: 1px solid #e3eaf1; border-radius: 12px; padding: 14px; text-align: center; }
.quote-page .trustCard strong { display: block; font-size: 12px; color: var(--navy); }
.quote-page .trustCard small { color: #7c8b9e; font-size: 9px; }

@media(max-width:900px){
  .quote-page .grid4 { grid-template-columns: 1fr 1fr; }
  .quote-page .hero h1 { font-size: 35px; }
}
@media(max-width:600px){
  .quote-page .hero { padding-top: 30px; }
  .quote-page .hero h1 { font-size: 31px; }
  .quote-page .quoteCard { padding: 22px 18px; }
  .quote-page .grid2, .quote-page .serviceRow { grid-template-columns: 1fr; }
  .quote-page .grid4 { grid-template-columns: 1fr 1fr; }
  .quote-page .options { height: auto; flex-wrap: wrap; padding: 5px 0; }
  .quote-page .trust { grid-template-columns: 1fr; }
}
</style>

<div class="quote-page">
    <section class="hero">
        <div class="container">
            <div class="heroHead">
                <div class="kicker">Instant Quote Engine</div>
                <h1>UK Freight & Courier Quote Calculator</h1>
                <p>Enter collection and delivery UK postcodes, package measurements, and service speed to get an instant server-verified price breakdown.</p>
            </div>

            <?php if (!empty($error_message)): ?>
                <div class="alert alert-error" style="max-width: 900px; margin: 1.5rem auto 0 auto;">
                    <span>⚠️</span>
                    <div><?= e($error_message) ?></div>
                </div>
            <?php endif; ?>

            <div class="quoteWrap">
                <form class="quoteCard" action="<?= url('/quote/calculate') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="formSection">
                        <div class="sectionTitle"><span>01</span>Route Details</div>
                        <div class="grid2">
                            <div class="field">
                                <label for="pickup_postcode">Collection UK Postcode <i class="required">*</i></label>
                                <input type="text" id="pickup_postcode" name="pickup_postcode" placeholder="e.g. SW1A 1AA" maxlength="8" autocomplete="postal-code" value="<?= e($input['pickup_postcode'] ?? '') ?>" required>
                            </div>
                            <div class="field">
                                <label for="delivery_postcode">Destination UK Postcode <i class="required">*</i></label>
                                <input type="text" id="delivery_postcode" name="delivery_postcode" placeholder="e.g. EH1 1YZ or BT1 1AA" maxlength="8" autocomplete="postal-code" value="<?= e($input['delivery_postcode'] ?? '') ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="formSection">
                        <div class="sectionTitle"><span>02</span>Package Measurements</div>
                        <div class="grid4">
                            <div class="field">
                                <label for="weight_kg">Weight (kg) <i class="required">*</i></label>
                                <input type="number" step="0.1" min="0.1" max="1000" id="weight_kg" name="weight_kg" value="<?= e($input['weight_kg'] ?? '2.5') ?>" required>
                            </div>
                            <div class="field">
                                <label for="length_cm">Length (cm)</label>
                                <input type="number" step="1" min="1" max="300" id="length_cm" name="length_cm" value="<?= e($input['length_cm'] ?? '30') ?>" required>
                            </div>
                            <div class="field">
                                <label for="width_cm">Width (cm)</label>
                                <input type="number" step="1" min="1" max="300" id="width_cm" name="width_cm" value="<?= e($input['width_cm'] ?? '20') ?>" required>
                            </div>
                            <div class="field">
                                <label for="height_cm">Height (cm)</label>
                                <input type="number" step="1" min="1" max="300" id="height_cm" name="height_cm" value="<?= e($input['height_cm'] ?? '15') ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="formSection">
                        <div class="sectionTitle"><span>03</span>Select Courier Service & Options</div>
                        <div class="serviceRow">
                            <div class="field">
                                <label for="service_id">Courier Service Speed <i class="required">*</i></label>
                                <select id="service_id" name="service_id" required>
                                    <?php foreach ($services as $srv): ?>
                                        <option value="<?= $srv['id'] ?>" <?= ($input['service_id'] ?? 1) == $srv['id'] ? 'selected' : '' ?>>
                                            <?= e($srv['name']) ?> — <?= e($srv['description']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="field">
                                <label>Special Options</label>
                                <div class="options">
                                    <label class="check">
                                        <input type="checkbox" name="is_fragile" value="1" <?= !empty($input['is_fragile']) ? 'checked' : '' ?>> Fragile Handling (+£5.00)
                                    </label>
                                    <label class="check">
                                        <input type="checkbox" name="signature_required" value="1" <?= !empty($input['signature_required']) ? 'checked' : '' ?>> Signature (+£2.50)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="calculate" type="submit">Calculate Price Breakdown &rarr;</button>
                </form>

                <?php if (!empty($calculation)): ?>
                    <div class="resultCard">
                        <div class="resultHead">
                            <div>
                                <span class="badge badge-info"><?= e($calculation['service']['name']) ?></span>
                                <h3 style="margin-top: 0.5rem; color: var(--navy);">Verified Freight Price Breakdown</h3>
                                <p class="text-muted" style="font-size: 0.85rem; margin-bottom: 0;">
                                    Route: <strong><?= e($calculation['route']['pickup_postcode']) ?></strong> (<?= e($calculation['route']['pickup_zone']) ?>) &rarr; 
                                    <strong><?= e($calculation['route']['delivery_postcode']) ?></strong> (<?= e($calculation['route']['delivery_zone']) ?>)
                                </p>
                            </div>
                            <div class="text-right">
                                <span class="text-muted" style="font-size: 0.85rem;">Grand Total (inc. VAT)</span>
                                <div class="price"><?= money_format_gbp($calculation['pricing']['total']) ?></div>
                            </div>
                        </div>

                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 1.5rem;">
                            <thead>
                                <tr style="border-bottom: 2px solid var(--line); text-align: left;">
                                    <th style="padding: 0.75rem 0; font-size: 0.9rem;">Item Description</th>
                                    <th style="padding: 0.75rem 0; text-align: right; font-size: 0.9rem;">Amount (GBP)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($calculation['pricing']['line_items'] as $line): ?>
                                    <tr style="border-bottom: 1px solid #f0f4f8;">
                                        <td style="padding: 0.65rem 0; font-size: 0.85rem;"><?= e($line['description']) ?></td>
                                        <td style="padding: 0.65rem 0; text-align: right; font-weight: 600; font-size: 0.85rem;"><?= money_format_gbp($line['amount']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr style="border-bottom: 1px solid #f0f4f8;">
                                    <td style="padding: 0.65rem 0; font-weight: 600; font-size: 0.85rem;">Net Subtotal</td>
                                    <td style="padding: 0.65rem 0; text-align: right; font-weight: 600; font-size: 0.85rem;"><?= money_format_gbp($calculation['pricing']['subtotal']) ?></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #f0f4f8;">
                                    <td style="padding: 0.65rem 0; font-size: 0.85rem;">UK VAT (<?= e($calculation['pricing']['vat_rate']) ?>%)</td>
                                    <td style="padding: 0.65rem 0; text-align: right; font-size: 0.85rem;"><?= money_format_gbp($calculation['pricing']['vat_amount']) ?></td>
                                </tr>
                                <tr style="font-size: 1.1rem; font-weight: 800;">
                                    <td style="padding: 0.85rem 0; color: var(--navy);">Grand Total</td>
                                    <td style="padding: 0.85rem 0; text-align: right; color: #078fe9;"><?= money_format_gbp($calculation['pricing']['total']) ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <form action="<?= url('/quote') ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="pickup_postcode" value="<?= e($input['pickup_postcode']) ?>">
                            <input type="hidden" name="delivery_postcode" value="<?= e($input['delivery_postcode']) ?>">
                            <input type="hidden" name="service_id" value="<?= e($input['service_id']) ?>">
                            <input type="hidden" name="weight_kg" value="<?= e($input['weight_kg']) ?>">
                            <input type="hidden" name="length_cm" value="<?= e($input['length_cm']) ?>">
                            <input type="hidden" name="width_cm" value="<?= e($input['width_cm']) ?>">
                            <input type="hidden" name="height_cm" value="<?= e($input['height_cm']) ?>">
                            <input type="hidden" name="is_fragile" value="<?= !empty($input['is_fragile']) ? 1 : 0 ?>">
                            <input type="hidden" name="signature_required" value="<?= !empty($input['signature_required']) ? 1 : 0 ?>">

                            <div class="grid2" style="gap: 1rem;">
                                <input type="email" name="guest_email" placeholder="Enter email to save & send quote" required style="height: 48px; border-radius: 9px;">
                                <button type="submit" class="btn primary" style="height: 48px; font-size: 12px; width: 100%;">Save & Generate Quote Document &rarr;</button>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>

                <div class="trust">
                    <div class="trustCard">
                        <strong>✓ Transparent Pricing</strong>
                        <small>No hidden checkout surprises</small>
                    </div>
                    <div class="trustCard">
                        <strong>◈ Live Tracking</strong>
                        <small>Follow every shipment</small>
                    </div>
                    <div class="trustCard">
                        <strong>▣ VAT Ready</strong>
                        <small>UK GBP invoicing support</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
