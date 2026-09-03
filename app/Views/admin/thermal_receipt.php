<!DOCTYPE html>
<html lang="en-GB">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thermal Receipt — <?= e($shipment['tracking_number'] ?? 'WAYBILL') ?></title>
<style>
@page {
  size: 100mm 150mm;
  margin: 0;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
body {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
  width: 100mm;
  min-height: 150mm;
  padding: 4mm;
  background: #fff;
  color: #000;
  font-size: 11px;
  line-height: 1.2;
}

.ticket {
  border: 2px solid #000;
  height: 142mm;
  padding: 3mm;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 2px solid #000;
  padding-bottom: 3mm;
}
.brand-title { font-size: 16px; font-weight: 900; letter-spacing: -0.03em; text-transform: uppercase; }
.brand-sub { font-size: 9px; font-weight: 700; text-transform: uppercase; }

.service-banner {
  background: #000;
  color: #fff;
  text-align: center;
  font-size: 14px;
  font-weight: 900;
  padding: 2mm 0;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin: 2mm 0;
}

.barcode-box {
  text-align: center;
  padding: 2mm 0;
  border-bottom: 1.5px dashed #000;
}
.barcode-lines {
  height: 14mm;
  background: repeating-linear-gradient(
    90deg,
    #000 0, #000 2px,
    #fff 2px, #fff 4px,
    #000 4px, #000 7px,
    #fff 7px, #fff 9px,
    #000 9px, #000 10px,
    #fff 10px, #fff 13px,
    #000 13px, #000 16px,
    #fff 16px, #fff 18px
  );
  width: 85%;
  margin: 0 auto 1mm auto;
}
.barcode-text { font-family: monospace; font-size: 13px; font-weight: 900; letter-spacing: 0.1em; }

.address-grid {
  display: grid;
  grid-template-rows: 1fr 1fr;
  gap: 2mm;
  margin: 2mm 0;
}

.add-box {
  border: 1px solid #000;
  padding: 2mm;
  border-radius: 1mm;
}
.add-label { font-size: 8px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.08em; text-decoration: underline; margin-bottom: 1mm; }
.add-name { font-size: 12px; font-weight: 900; }
.add-text { font-size: 10px; line-height: 1.3; }
.add-postcode { font-size: 14px; font-weight: 900; margin-top: 1mm; }

.specs-row {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  border: 1px solid #000;
  text-align: center;
  font-size: 9px;
}
.spec-col { padding: 1.5mm 0; border-right: 1px solid #000; }
.spec-col:last-child { border-right: 0; }
.spec-col span { display: block; font-size: 7px; font-weight: 800; text-transform: uppercase; }
.spec-col b { font-size: 11px; }

.footer-print {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-top: 2px solid #000;
  padding-top: 2mm;
  font-size: 8px;
}

.print-btn {
  background: #000;
  color: #fff;
  border: 0;
  padding: 6px 12px;
  font-weight: 900;
  border-radius: 4px;
  cursor: pointer;
}

@media print {
  .no-print { display: none !important; }
  body { padding: 0; }
  .ticket { border: none; height: 100%; }
}
</style>
</head>
<body>

<div class="no-print" style="margin-bottom: 12px; text-align: center;">
  <button class="print-btn" onclick="window.print()">🖨 Print 4x6 Thermal Receipt</button>
</div>

<div class="ticket">
  <div class="header">
    <div>
      <div class="brand-title">RUSH PARCEL</div>
      <div class="brand-sub">UK LOGISTICS WAYBILL</div>
    </div>
    <div style="text-align: right;">
      <div style="font-size: 8px; font-weight: 800;">HUB DEPOT</div>
      <div style="font-size: 12px; font-weight: 900;">BHM-01</div>
    </div>
  </div>

  <div class="service-banner">
    <?= e(strtoupper($shipment['service_name'] ?? 'STANDARD PARCEL 48H')) ?>
  </div>

  <div class="barcode-box">
    <div class="barcode-lines"></div>
    <div class="barcode-text">*<?= e($shipment['tracking_number'] ?? 'UK8025667958') ?>*</div>
  </div>

  <div class="address-grid">
    <!-- Sender -->
    <div class="add-box">
      <div class="add-label">FROM (SENDER):</div>
      <div class="add-name"><?= e($shipment['pickup_address']['name'] ?? 'Sender Contact') ?></div>
      <div class="add-text">
        Tel: <?= e($shipment['pickup_address']['phone'] ?? 'N/A') ?><br>
        <?= e($shipment['pickup_address']['street'] ?? '') ?>, <?= e($shipment['pickup_address']['city'] ?? '') ?>
      </div>
      <div class="add-postcode"><?= e($shipment['pickup_address']['postcode'] ?? 'SW1A 1AA') ?></div>
    </div>

    <!-- Receiver -->
    <div class="add-box" style="border-width: 2px;">
      <div class="add-label">TO (DELIVERY RECIPIENT):</div>
      <div class="add-name"><?= e($shipment['delivery_address']['name'] ?? 'Receiver Contact') ?></div>
      <div class="add-text">
        Tel: <?= e($shipment['delivery_address']['phone'] ?? 'N/A') ?><br>
        <?= e($shipment['delivery_address']['street'] ?? '') ?>, <?= e($shipment['delivery_address']['city'] ?? '') ?>
      </div>
      <div class="add-postcode"><?= e($shipment['delivery_address']['postcode'] ?? 'M1 1AE') ?></div>
    </div>
  </div>

  <div class="specs-row">
    <div class="spec-col">
      <span>WEIGHT</span>
      <b><?= e($shipment['items'][0]['weight_kg'] ?? '1.0') ?> KG</b>
    </div>
    <div class="spec-col">
      <span>PIECES</span>
      <b>1 / 1</b>
    </div>
    <div class="spec-col">
      <span>CHARGE</span>
      <b>£<?= number_format((float)($shipment['total_amount'] ?? 0.0), 2) ?></b>
    </div>
  </div>

  <div class="footer-print">
    <div>
      <b>REF:</b> <?= e($shipment['shipment_number'] ?? 'SH-2026') ?><br>
      <b>DATE:</b> <?= date('d/m/Y H:i') ?>
    </div>
    <div style="text-align: right;">
      <b>SIGNATURE:</b> _____________
    </div>
  </div>
</div>

</body>
</html>
