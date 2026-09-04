<!DOCTYPE html>
<html lang="en-GB">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>POS Thermal Receipt — <?= e($shipment['tracking_number'] ?? $invoice['invoice_number'] ?? 'RECEIPT') ?></title>
<style>
@page {
  size: 80mm auto;
  margin: 0;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
body {
  font-family: "Courier New", Courier, Monaco, "Consolas", monospace;
  background: #f1f5f9;
  color: #000;
  font-size: 12px;
  line-height: 1.35;
  padding: 20px 10px;
}

.receipt-container {
  width: 320px;
  margin: 0 auto;
  background: #ffffff;
  padding: 16px 14px;
  border: 1px dashed #cbd5e1;
  box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.center { text-align: center; }
.right { text-align: right; }
.bold { font-weight: 900; }

.title-main {
  font-size: 15px;
  font-weight: 900;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  margin-bottom: 2px;
}
.title-sub {
  font-size: 13px;
  font-weight: 900;
  margin-bottom: 6px;
}
.company-info {
  font-size: 11px;
  line-height: 1.3;
  margin-bottom: 10px;
}

.divider-dash {
  border-top: 1px dashed #000;
  margin: 8px 0;
}
.divider-double {
  border-top: 3px double #000;
  margin: 8px 0;
}

.banner-box {
  margin: 6px 0;
}
.tracking-label {
  font-size: 13px;
  font-weight: 900;
  letter-spacing: 0.04em;
}
.service-name {
  font-size: 12px;
  font-weight: 900;
  text-transform: uppercase;
  margin-top: 2px;
}

.grid-2col {
  display: flex;
  justify-content: space-between;
  font-size: 11px;
  margin: 3px 0;
}

.timestamp {
  font-size: 11px;
  font-weight: 900;
  margin: 4px 0;
}

.table-charges {
  width: 100%;
  border-collapse: collapse;
  margin: 6px 0;
}
.table-charges td {
  padding: 2px 0;
  font-size: 11px;
}

.totals-block {
  margin: 6px 0;
}
.tot-line {
  display: flex;
  justify-content: space-between;
  font-size: 12px;
  margin: 2px 0;
}

.status-block {
  margin: 8px 0;
  text-align: center;
}
.status-tag {
  font-size: 12px;
  font-weight: 900;
  letter-spacing: 0.06em;
  text-transform: uppercase;
}
.weight-tag {
  font-size: 12px;
  font-weight: 900;
  margin-top: 3px;
}

.track-footer {
  margin-top: 8px;
  text-align: center;
  font-size: 11px;
}

.barcode-wrapper {
  margin: 10px 0 4px 0;
  text-align: center;
}
.barcode-visual {
  height: 48px;
  width: 90%;
  margin: 0 auto 4px auto;
  background: repeating-linear-gradient(
    90deg,
    #000 0, #000 3px,
    #fff 3px, #fff 5px,
    #000 5px, #000 9px,
    #fff 9px, #fff 11px,
    #000 11px, #000 13px,
    #fff 13px, #fff 16px,
    #000 16px, #000 20px,
    #fff 20px, #fff 22px
  );
}
.barcode-text {
  font-size: 12px;
  font-weight: 900;
  letter-spacing: 0.12em;
}

.print-bar {
  text-align: center;
  margin-bottom: 16px;
}
.print-btn {
  background: #000;
  color: #fff;
  border: 0;
  padding: 10px 20px;
  font-family: inherit;
  font-size: 12px;
  font-weight: 900;
  border-radius: 6px;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.print-btn:hover { background: #1e293b; }

@media print {
  body { background: #fff; padding: 0; }
  .no-print { display: none !important; }
  .receipt-container { border: 0; box-shadow: none; padding: 0; width: 100%; }
}
</style>
</head>
<body>

<div class="print-bar no-print">
  <button class="print-btn" onclick="window.print()">🖨 Print Thermal Receipt (80mm)</button>
</div>

<div class="receipt-container">
  <!-- COMPANY HEADER -->
  <div class="center">
    <div class="title-main">RUSH PARCEL LOGISTICS</div>
    <div class="title-sub">LTD.</div>
    <div class="company-info">
      100 Cannon Street, City of London<br>
      England, EC4N 6EU<br>
      Co. Reg No: 10039857<br>
      VAT Reg No: GB998234102<br>
      support@rushparcel.co.uk
    </div>
  </div>

  <div class="divider-dash"></div>

  <?php
    $trackingNo = !empty($shipment['tracking_number']) ? $shipment['tracking_number'] : (!empty($invoice['tracking_number']) ? $invoice['tracking_number'] : 'UK9823410574');
    $serviceName = !empty($shipment['service_name']) ? $shipment['service_name'] : 'NEXT DAY EXPRESS DELIVERY';
    $rawDate = !empty($shipment['created_at']) ? $shipment['created_at'] : (!empty($invoice['created_at']) ? $invoice['created_at'] : date('Y-m-d H:i:s'));
    $dateFormatted = date('d/m/Y', strtotime($rawDate));
    $timeFormatted = date('h:i A', strtotime($rawDate));
    $dateTimeFormatted = date('d/m/Y H:i', strtotime($rawDate));

    $weightKg = 0.0;
    if (!empty($shipment['items'])) {
        foreach ($shipment['items'] as $it) {
            $weightKg += ((float)($it['weight_kg'] ?? 0) * (int)($it['quantity'] ?? 1));
        }
    }
    if ($weightKg <= 0.0) {
        $weightKg = !empty($invoice['weight_kg']) ? (float)$invoice['weight_kg'] : 2.50;
    }

    $subtotal = (float)($invoice['subtotal'] ?? ($invoice['total'] ?? 38.50) / 1.20);
    $vatAmount = (float)($invoice['vat_amount'] ?? (($invoice['total'] ?? 38.50) - $subtotal));
    $total = (float)($invoice['total'] ?? $shipment['total_amount'] ?? 38.50);
  ?>

  <!-- TRACKING & SERVICE BANNER -->
  <div class="banner-box center">
    <div class="tracking-label">TRACKING #: <?= e($trackingNo) ?></div>
    <div class="service-name"><?= e(strtoupper($serviceName)) ?></div>
  </div>

  <div class="divider-dash"></div>

  <!-- OPERATIONAL DETAILS GRID -->
  <div class="grid-2col">
    <span>Pickup: <?= $timeFormatted ?></span>
    <span>Vehicle: VAN-110</span>
  </div>
  <div class="grid-2col">
    <span>Date: <?= $dateFormatted ?></span>
    <span>Route: UK-LND-01</span>
  </div>

  <div class="divider-dash"></div>

  <div class="center timestamp"><?= $dateTimeFormatted ?></div>

  <div class="divider-dash"></div>

  <!-- ITEMIZATION BREAKDOWN -->
  <table class="table-charges">
    <tr>
      <td>Standard Delivery</td>
      <td class="right">£<?= number_format($subtotal * 0.85, 2) ?></td>
    </tr>
    <tr>
      <td>Fuel Surcharge</td>
      <td class="right">£<?= number_format($subtotal * 0.10, 2) ?></td>
    </tr>
    <tr>
      <td>Signature Confirmation</td>
      <td class="right">£<?= number_format($subtotal * 0.05, 2) ?></td>
    </tr>
  </table>

  <div class="divider-double"></div>

  <!-- TOTALS BLOCK -->
  <div class="totals-block">
    <div class="tot-line">
      <span>Subtotal:</span>
      <span class="bold">£<?= number_format($subtotal, 2) ?></span>
    </div>
    <div class="tot-line">
      <span>Tax (VAT 20%):</span>
      <span class="bold">£<?= number_format($vatAmount, 2) ?></span>
    </div>
    <div class="tot-line" style="font-size: 13px; margin-top: 3px;">
      <span class="bold">Total:</span>
      <span class="bold">£<?= number_format($total, 2) ?></span>
    </div>
  </div>

  <div class="divider-dash"></div>

  <!-- PAYMENT METHOD -->
  <div class="tot-line">
    <span>Payment Method:</span>
    <span class="bold">Credit/Debit Card</span>
  </div>
  <div class="tot-line">
    <span>Amount Paid:</span>
    <span class="bold">£<?= number_format($total, 2) ?></span>
  </div>
  <div class="tot-line">
    <span>Change:</span>
    <span>0.00</span>
  </div>

  <div class="divider-dash"></div>

  <!-- STATUS & PACKAGE WEIGHT -->
  <div class="status-block">
    <div class="status-tag">SIGNATURE CONFIRMED</div>
    <div class="weight-tag">Package Weight: <?= number_format($weightKg, 2) ?> kg</div>
  </div>

  <div class="divider-dash"></div>

  <!-- BARCODE & FOOTER -->
  <div class="track-footer">
    Track online at:<br>
    <b style="font-size: 11px;">www.rushparcel.co.uk/track</b>
  </div>

  <div class="barcode-wrapper">
    <div class="barcode-visual"></div>
    <div class="barcode-text"><?= e($trackingNo) ?></div>
  </div>
</div>

</body>
</html>
