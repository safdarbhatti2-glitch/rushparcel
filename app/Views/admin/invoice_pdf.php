<!DOCTYPE html>
<html lang="en-GB">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tax Invoice — <?= e($invoice['invoice_number']) ?></title>
<style>
:root {
  --blue-primary: #EA580C;
  --blue-dark: #C2410C;
  --blue-gradient: linear-gradient(135deg, #EA580C, #C2410C);
  --blue-light: #FFF7ED;
  --blue-light-bg: #FFF7ED;
  --blue-text: #EA580C;
  --navy: #0F172A;
  --navy2: #1E293B;
  --ink: #0F172A;
  --muted: #64748B;
  --line: #E2E8F0;
  --gold-bg: #FEF3C7;
  --gold-border: #FDE68A;
  --gold-text: #92400E;
}

* { box-sizing: border-box; margin: 0; padding: 0; }
body {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  color: var(--ink);
  background: #f8fafc;
  padding: 30px 15px;
  font-size: 12px;
  line-height: 1.4;
}

.invoice-wrapper {
  max-width: 850px;
  margin: 0 auto;
  background: #ffffff;
  border: 1px solid #cbd5e1;
  border-radius: 16px;
  box-shadow: 0 20px 40px rgba(4, 11, 24, 0.06);
  padding: 40px;
}

/* Header Section */
.header-grid {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding-bottom: 24px;
  border-bottom: 2px solid #f1f5f9;
}

.company-brand { display: flex; flex-direction: column; gap: 10px; align-items: flex-start; }
.invoice-logo-img {
  width: 215px; height: auto; display: block; margin-bottom: 6px; object-fit: contain;
}

.company-details h2 { font-size: 18px; font-weight: 900; color: var(--navy2); letter-spacing: -0.02em; }
.company-details .sub { font-size: 11px; color: var(--muted); font-weight: 600; margin-bottom: 6px; }
.company-details p { font-size: 11px; color: #475569; line-height: 1.5; }

.trn-badge {
  display: inline-flex; align-items: center; gap: 6px; background: var(--gold-bg); border: 1px solid var(--gold-border);
  color: var(--gold-text); font-size: 10px; font-weight: 800; padding: 4px 10px; border-radius: 20px; margin-top: 8px;
}

.invoice-title-block { text-align: right; }
.invoice-title-block h1 { font-size: 26px; font-weight: 900; color: var(--navy2); letter-spacing: -0.03em; }
.vat-tag {
  display: inline-block; background: var(--blue-light); color: var(--blue-text); font-size: 9px; font-weight: 800;
  padding: 3px 10px; border-radius: 12px; text-transform: uppercase; letter-spacing: 0.06em; margin-top: 4px; margin-bottom: 12px;
}

/* Header QR Verification Box */
.header-qr-box {
  display: flex;
  align-items: center;
  gap: 12px;
  background: var(--blue-light-bg);
  border: 1px solid #bae6fd;
  border-radius: 12px;
  padding: 8px 12px;
  margin-bottom: 12px;
  float: right;
  clear: right;
}
.header-qr-code {
  width: 58px; height: 58px;
  background: #ffffff;
  border: 1px solid #93c5fd;
  border-radius: 8px;
  padding: 4px;
  display: flex; flex-direction: column; justify-content: space-between; align-items: center;
}
.qr-matrix {
  width: 100%; height: 100%;
  background:
    radial-gradient(circle at 30% 30%, #040b18 20%, transparent 20%),
    radial-gradient(circle at 70% 30%, #040b18 20%, transparent 20%),
    radial-gradient(circle at 30% 70%, #040b18 20%, transparent 20%),
    linear-gradient(45deg, #040b18 25%, transparent 25%, transparent 75%, #040b18 75%),
    linear-gradient(45deg, #040b18 25%, #fff 25%, #fff 75%, #040b18 75%);
  background-size: 8px 8px, 8px 8px, 8px 8px, 12px 12px, 12px 12px;
  border-radius: 4px;
}
.header-qr-info { text-align: left; }
.header-qr-info b { font-size: 10px; color: var(--navy2); font-weight: 900; display: block; text-transform: uppercase; }
.header-qr-info p { font-size: 9px; color: #0369a1; font-weight: 700; margin-top: 1px; }

.meta-list { display: grid; gap: 3px; font-size: 11px; text-align: right; clear: both; }
.meta-list div span { color: var(--muted); }
.meta-list div b { color: var(--navy2); font-weight: 800; }
.meta-list .inv-no { font-size: 16px; color: var(--blue-dark); font-weight: 900; margin-bottom: 2px; }

/* 3-Column Info Cards Grid */
.cards-3col {
  display: grid; grid-template-columns: 1fr 1fr 1.1fr; gap: 16px; margin: 24px 0;
}
.info-box {
  background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px; position: relative;
}
.info-box-label { font-size: 9px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px; display: flex; align-items: center; gap: 4px; }
.info-box h4 { font-size: 13px; font-weight: 900; color: var(--navy2); margin-bottom: 4px; }
.info-box p { font-size: 11px; color: #475569; line-height: 1.5; }
.info-box .phone { display: flex; align-items: center; gap: 6px; font-size: 11px; font-weight: 800; color: var(--blue-dark); margin-top: 8px; }

.pay-badge { display: inline-flex; align-items: center; gap: 6px; background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 900; margin-bottom: 8px; }
.pay-pill { display: inline-block; background: #e0f2fe; color: #0369a1; font-size: 10px; font-weight: 800; padding: 2px 8px; border-radius: 6px; margin-bottom: 6px; }

/* Line Items Table */
.items-table { width: 100%; border-collapse: collapse; margin: 20px 0 10px 0; }
.items-table th { background: #f8fafc; border-bottom: 1.5px solid #e2e8f0; text-align: left; padding: 10px 12px; font-size: 10px; font-weight: 800; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em; }
.items-table td { padding: 12px; border-bottom: 1px solid #f1f5f9; font-size: 11px; color: #334155; vertical-align: top; }
.items-table td.center { text-align: center; }
.items-table td.right { text-align: right; }
.item-desc b { font-size: 12px; color: var(--navy2); font-weight: 800; display: block; }
.item-desc span { font-size: 10px; color: var(--muted); }

/* Totals Summary Block */
.totals-wrapper { display: flex; flex-direction: column; align-items: flex-end; margin: 10px 0 20px 0; }
.totals-table { width: 340px; margin-bottom: 10px; }
.tot-row { display: flex; justify-content: space-between; padding: 5px 0; font-size: 11px; color: #64748b; }
.tot-row b { color: var(--navy2); }

.total-due-navybox {
  width: 340px; background: linear-gradient(135deg, #091a30, #040b18); color: #ffffff; border-radius: 10px; padding: 12px 16px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 10px 25px rgba(4, 11, 24, 0.25); border: 1px solid #1e293b;
}
.total-due-navybox span { font-size: 13px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; color: var(--blue-primary); }
.total-due-navybox b { font-size: 20px; font-weight: 900; letter-spacing: -0.02em; color: #ffffff; }

.words-text { font-size: 10px; color: var(--muted); font-style: italic; margin-top: 6px; text-align: right; width: 340px; }

/* Yellow HMRC VAT Breakdown Box */
.vat-breakdown-box {
  background: var(--gold-bg); border: 1px solid var(--gold-border); border-radius: 12px; padding: 14px 18px; margin: 20px 0 14px 0;
}
.vat-box-title { font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.06em; color: var(--gold-text); margin-bottom: 10px; display: flex; align-items: center; gap: 6px; }
.vat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; }
.vat-col span { display: block; font-size: 9px; font-weight: 800; color: #b45309; text-transform: uppercase; }
.vat-col b { font-size: 14px; font-weight: 900; color: #78350f; }

/* Blue Compliance Box */
.compliance-box {
  background: var(--blue-light-bg); border: 1px solid #bae6fd; border-radius: 10px; padding: 12px 16px; font-size: 10px; color: #0369a1; line-height: 1.5; margin-bottom: 14px; display: flex; gap: 10px; align-items: flex-start;
}
.compliance-box b { font-weight: 800; color: #0284c7; }

/* Terms & Conditions Box */
.terms-box {
  border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 16px; margin-bottom: 24px;
}
.terms-title { font-size: 9px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px; }
.terms-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px 20px; font-size: 9px; color: #64748b; line-height: 1.4; }
.terms-grid li { margin-left: 12px; }

/* Footer */
.footer-row {
  border-top: 1px solid #e2e8f0; padding-top: 16px; display: flex; justify-content: space-between; align-items: center; font-size: 10px; color: var(--muted);
}
.footer-left p { line-height: 1.5; }
.verification-block { display: flex; align-items: center; gap: 14px; text-align: right; }

.footer-qr { width: 50px; height: 50px; background: var(--navy2); border-radius: 10px; padding: 3px; display: grid; place-items: center; }

.print-bar { text-align: center; margin-top: 24px; }
.print-btn { background: var(--blue-gradient); color: #fff; border: 0; padding: 12px 24px; font-size: 13px; font-weight: 800; border-radius: 10px; cursor: pointer; box-shadow: 0 10px 25px rgba(7, 157, 242, 0.3); }

@media print {
  body { background: #fff; padding: 0; }
  .invoice-wrapper { border: none; box-shadow: none; padding: 0; max-width: 100%; }
  .print-bar { display: none !important; }
}
</style>
</head>
<body>

<div class="invoice-wrapper">

  <!-- 1. Header Section -->
  <div class="header-grid">
    <div class="company-brand">
      <img src="<?= asset('brand/rushparcel-logo-invoice.png') ?>" alt="Rush Parcel" class="invoice-logo-img">
      <div class="company-details">
        <h2>Rush Parcel Logistics Ltd</h2>
        <div class="sub">UK's Premier Courier &amp; Logistics Partner</div>
        <p>
          100 Cannon Street, City of London, EC4N 6EU, UK<br>
          Tel: +44 20 7946 0980 &middot; Email: billing@rushparcel.co.uk<br>
          Web: www.rushparcel.co.uk
        </p>
        <div class="trn-badge">
          🔒 TRN: 10039857300003 &middot; VAT Reg: GB 998 2341 02
        </div>
      </div>
    </div>

    <div class="invoice-title-block">
      <h1>Tax Invoice</h1>
      <span class="vat-tag">VAT RECEIPT &middot; UK HMRC COMPLIANT</span>

      <?php
        $rawIssue = !empty($shipment['scheduled_pickup_at']) 
          ? $shipment['scheduled_pickup_at'] 
          : (!empty($invoice['issue_date']) ? $invoice['issue_date'] : $invoice['created_at']);
        
        $issueDateFormatted = date('d M Y', strtotime($rawIssue));

        $shipmentWeightKg = 0.0;
        if (!empty($shipment['items'])) {
            foreach ($shipment['items'] as $it) {
                $shipmentWeightKg += ((float)($it['weight_kg'] ?? 0) * (int)($it['quantity'] ?? 1));
            }
        }
        if ($shipmentWeightKg <= 0.0) {
            $shipmentWeightKg = !empty($invoice['weight_kg']) ? (float)$invoice['weight_kg'] : 2.50;
        }
      ?>

      <div class="meta-list">
        <div class="inv-no"><?= e($invoice['invoice_number']) ?></div>
        <div><span>Invoice Date:</span> <b><?= $issueDateFormatted ?></b></div>
        <div><span>Currency:</span> <b>Pound Sterling (GBP)</b></div>
        <div><span>Tracking:</span> <b><?= e($invoice['tracking_number'] ?? $shipment['tracking_number'] ?? 'UK8025667958') ?></b></div>
      </div>
    </div>
  </div>

  <!-- 2. 3-Column Info Cards Grid -->
  <div class="cards-3col">
    <!-- Col 1: SENDER (FROM) -->
    <div class="info-box">
      <div class="info-box-label">📍 SENDER (FROM)</div>
      <?php
        $senderName = !empty($shipment['pickup_address']['name']) && !in_array($shipment['pickup_address']['name'], ['Invoice Sender', 'Invoice Recipient', 'Sender Contact'])
          ? $shipment['pickup_address']['name']
          : (!empty($invoice['customer_name']) ? $invoice['customer_name'] : 'Sender');
        if (strtolower($senderName) === 'invoice sender') {
            $senderName = 'Sender';
        }

        $senderPhone = !empty($shipment['pickup_address']['phone'])
          ? $shipment['pickup_address']['phone']
          : (!empty($invoice['customer_phone']) ? $invoice['customer_phone'] : 'N/A');
      ?>
      <h4><?= e($senderName) ?></h4>
      <p>
        <?= e($shipment['pickup_address']['house_number'] ?? '') ?> <?= e($shipment['pickup_address']['street'] ?? 'London Road') ?><br>
        <?= e($shipment['pickup_address']['city'] ?? $shipment['pickup_address']['town'] ?? 'London') ?>, <?= e($shipment['pickup_address']['postcode'] ?? 'SW1A 1AA') ?><br>
        United Kingdom
      </p>
      <div class="phone">📞 <?= e($senderPhone) ?></div>
    </div>

    <!-- Col 2: RECEIVER (TO) -->
    <div class="info-box">
      <div class="info-box-label">🏁 RECEIVER (TO)</div>
      <?php
        $receiverName = !empty($shipment['delivery_address']['name']) && !in_array($shipment['delivery_address']['name'], ['Invoice Sender', 'Invoice Recipient'])
          ? $shipment['delivery_address']['name']
          : 'Receiver';
        if (strtolower($receiverName) === 'invoice recipient') {
            $receiverName = 'Receiver';
        }

        $receiverPhone = !empty($shipment['delivery_address']['phone'])
          ? $shipment['delivery_address']['phone']
          : 'N/A';
      ?>
      <h4><?= e($receiverName) ?></h4>
      <p>
        <?= e($shipment['delivery_address']['house_number'] ?? '') ?> <?= e($shipment['delivery_address']['street'] ?? 'High Street') ?><br>
        <?= e($shipment['delivery_address']['city'] ?? $shipment['delivery_address']['town'] ?? 'Manchester') ?>, <?= e($shipment['delivery_address']['postcode'] ?? 'M1 1AE') ?><br>
        United Kingdom
      </p>
      <div class="phone">📞 <?= e($receiverPhone) ?></div>
    </div>

    <!-- Col 3: PAYMENT & SPECS INFORMATION -->
    <div class="info-box">
      <div class="info-box-label">💳 PAYMENT &amp; SPECS</div>
      <?php $isPaid = ($invoice['status'] === 'paid'); ?>
      <div class="pay-badge" style="<?= $isPaid ? '' : 'background:#fef3c7; color:#b45309; border-color:#fde68a;' ?>">
        <?= $isPaid ? 'Payment Received ✓' : 'Payment Outstanding' ?>
      </div><br>
      <span class="pay-pill">💳 Credit Card / Online Bank</span>
      <p>
        <b>Ref:</b> TXN-<?= strtoupper(substr(md5($invoice['invoice_number']), 0, 12)) ?><br>
        <b>Date:</b> <?= $issueDateFormatted ?><br>
        <b>Status:</b> <b><?= $isPaid ? 'Paid in Full' : 'Issued &amp; Outstanding' ?></b>
      </p>
      <div style="margin-top: 8px; padding-top: 6px; border-top: 1px dashed #cbd5e1; font-size: 10px; color: #475569;">
        📦 <b>Shipment Weight:</b> <b style="color: #EA580C; font-size: 11px; font-weight: 900;"><?= number_format($shipmentWeightKg, 2) ?> kg</b>
      </div>
    </div>
  </div>

  <!-- 3. Line Items Table -->
  <table class="items-table">
    <thead>
      <tr>
        <th style="width:30px; text-align:center;">#</th>
        <th>Service Description</th>
        <th class="center" style="width:95px; text-align:center;">Weight</th>
        <th class="center" style="width:45px; text-align:center;">Qty</th>
        <th class="right" style="width:85px; text-align:right;">Unit Price</th>
        <th class="center" style="width:70px; text-align:center;">Discount</th>
        <th class="right" style="width:85px; text-align:right;">VAT (20%)</th>
        <th class="right" style="width:95px; text-align:right;">Total (GBP)</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $subtotal = (float)($invoice['subtotal'] ?? ($invoice['total'] / 1.20));
        $vatAmount = (float)($invoice['vat_amount'] ?? ($invoice['total'] - $subtotal));
        $total = (float)($invoice['total'] ?? 0.0);
        $serviceName = $shipment['service_name'] ?? 'Next-Day Express Courier Service';
        $pickupCity = $shipment['pickup_address']['city'] ?? 'London';
        $deliveryCity = $shipment['delivery_address']['city'] ?? 'Manchester';
      ?>
      <tr>
        <td style="text-align:center; vertical-align:middle;">1</td>
        <td class="item-desc" style="vertical-align:middle;">
          <b><?= e(ucwords(strtolower($serviceName))) ?> — <?= e($pickupCity) ?> to <?= e($deliveryCity) ?></b>
          <span>Door-to-door carriage</span>
        </td>
        <td class="center" style="text-align:center; vertical-align:middle;">
          <span style="display:inline-block; white-space:nowrap; background:#FFF7ED; border:1px solid #FFEDD5; padding:4px 10px; border-radius:6px; font-size:11px; color:#EA580C; font-weight:900; text-align:center;">
            <?= number_format($shipmentWeightKg, 2) ?> kg
          </span>
        </td>
        <td class="center" style="text-align:center; vertical-align:middle;">1</td>
        <td class="right" style="text-align:right; vertical-align:middle;">£<?= number_format($subtotal, 2) ?></td>
        <td class="center" style="text-align:center; vertical-align:middle;">&mdash;</td>
        <td class="right" style="text-align:right; vertical-align:middle;">£<?= number_format($vatAmount, 2) ?></td>
        <td class="right" style="text-align:right; vertical-align:middle;"><b>£<?= number_format($total, 2) ?></b></td>
      </tr>
    </tbody>
  </table>

  <!-- 4. Totals Summary -->
  <div class="totals-wrapper">
    <div class="totals-table">
      <div class="tot-row">
        <span>Subtotal (excl. VAT)</span>
        <b>£<?= number_format($subtotal, 2) ?></b>
      </div>
      <div class="tot-row">
        <span>VAT @ 20% (UK HMRC)</span>
        <b>+ £<?= number_format($vatAmount, 2) ?></b>
      </div>
    </div>

    <div class="total-due-navybox">
      <span>Total Amount Due</span>
      <b>GBP <?= number_format($total, 2) ?></b>
    </div>

    <div class="words-text">
      <i>Amount in words: <?= e(ucwords(number_to_words_gbp($total))) ?> Only</i>
    </div>
  </div>

  <!-- 5. Yellow UK HMRC VAT Breakdown Box -->
  <div class="vat-breakdown-box">
    <div class="vat-box-title">
      🔒 UK HMRC VAT BREAKDOWN &mdash; HM REVENUE &amp; CUSTOMS COMPLIANT
    </div>
    <div class="vat-grid">
      <div class="vat-col">
        <span>Taxable Amount</span>
        <b>£<?= number_format($subtotal, 2) ?></b>
      </div>
      <div class="vat-col">
        <span>VAT Rate</span>
        <b>20.00%</b>
      </div>
      <div class="vat-col">
        <span>VAT Amount</span>
        <b>£<?= number_format($vatAmount, 2) ?></b>
      </div>
      <div class="vat-col">
        <span>Total Inc. VAT</span>
        <b>£<?= number_format($total, 2) ?></b>
      </div>
    </div>
  </div>

  <!-- 6. Blue Compliance Box -->
  <div class="compliance-box">
    <div style="font-size:14px; font-weight:900;">UK</div>
    <div>
      <b>UK HMRC VAT Compliance:</b> This is a valid Tax Invoice issued under UK Value Added Tax Regulations 1995. VAT charged at 20% standard rate. Rush Parcel Logistics Ltd is registered with UK HMRC under TRN <b>10039857300003</b> &amp; VAT Reg <b>GB 998 2341 02</b>. This document must be retained for 6 years as required by UK tax law. VAT queries: <b>billing@rushparcel.co.uk</b>
    </div>
  </div>

  <!-- 7. Regulatory Terms & Conditions Box -->
  <div class="terms-box">
    <div class="terms-title">📋 TERMS &amp; CONDITIONS &mdash; UK REGULATORY COMPLIANCE</div>
    <div class="terms-grid">
      <ul>
        <li>Liability limited to £500 unless additional insurance purchased.</li>
        <li>Prohibited items: cash, firearms, narcotics, perishables, hazardous goods.</li>
        <li>All disputes subject to English Courts under UK Federal &amp; Common Law.</li>
        <li>By using Rush Parcel you agree to full Terms at rushparcel.co.uk/terms.</li>
      </ul>
      <ul>
        <li>Not liable for delays due to customs, force majeure, or incorrect address.</li>
        <li>Claims for loss/damage must be filed within 7 days of expected delivery.</li>
        <li>Refunds processed within 5-7 business days to original payment method.</li>
        <li>Computer-generated invoice valid without signature per UK e-commerce law.</li>
      </ul>
    </div>
  </div>

  <!-- 8. Footer -->
  <div class="footer-row">
    <div class="footer-left">
      <p>
        <b>Rush Parcel Logistics Ltd</b> &middot; 100 Cannon Street, City of London, EC4N 6EU<br>
        📞 +44 20 7946 0980 &middot; ✉ billing@rushparcel.co.uk &middot; 🌐 www.rushparcel.co.uk<br>
        Track: rushparcel.co.uk/track &middot; Receipt: <b><?= e($invoice['invoice_number']) ?></b>
      </p>
    </div>

    <div class="verification-block">
      <div style="font-size:9px; color:#64748b; text-align:right; line-height:1.4;">
        <b style="color:var(--navy2); font-size:10px;">VERIFY HMRC INVOICE</b><br>
        Scan QR Code to Open Invoice<br>
        <b><?= e($invoice['invoice_number']) ?></b>
      </div>
      <?php
        $trackingNum = $invoice['tracking_number'] ?? $shipment['tracking_number'] ?? '';
        $lanHost = $_SERVER['HTTP_HOST'] ?? '192.168.18.42:8000';
        if (str_contains($lanHost, 'localhost') || str_contains($lanHost, '127.0.0.1')) {
            $lanHost = '192.168.18.42:8000';
        }
        $targetUrl = !empty($trackingNum)
            ? "http://{$lanHost}/track/{$trackingNum}"
            : "http://{$lanHost}/admin/invoices/" . e($invoice['invoice_number']) . "/pdf";
      ?>
      <div class="footer-qr" style="width:76px; height:76px; background:#ffffff; border:1.5px solid #0764d7; border-radius:10px; padding:4px; box-shadow:0 4px 12px rgba(7, 100, 215, 0.15);">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=<?= urlencode($targetUrl) ?>" alt="Scannable Invoice Verification QR Code" style="width:100%; height:100%; object-fit:contain; border-radius:4px;">
      </div>
    </div>
  </div>

</div>

<div class="print-bar">
  <button class="print-btn" onclick="window.print()">🖨 Print / Save Tax Invoice (PDF)</button>
</div>

</body>
</html>

<?php
function number_to_words_gbp(float $amount): string {
    $whole = (int)floor($amount);
    $fraction = (int)round(($amount - $whole) * 100);

    if (class_exists('NumberFormatter')) {
        $f = new NumberFormatter('en_GB', NumberFormatter::SPELLOUT);
        $words = $f->format($whole) . ' pounds';
        if ($fraction > 0) {
            $words .= ' and ' . $f->format($fraction) . ' pence';
        }
        return $words;
    }

    return number_format($amount, 2) . ' pounds';
}
?>
