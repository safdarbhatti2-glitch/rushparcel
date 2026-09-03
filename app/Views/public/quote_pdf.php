<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>QUOTATION — <?= e($quote['quote_number']) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #1E293B;
            margin: 0;
            padding: 40px;
            background-color: #FFF;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #0F172A;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .title {
            font-size: 28px;
            font-weight: bold;
            color: #0F172A;
        }
        .watermark {
            font-size: 40px;
            font-weight: 900;
            color: #E2E8F0;
            letter-spacing: 5px;
            margin-bottom: 20px;
        }
        .info-grid {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            background-color: #F8FAFC;
            padding: 20px;
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            padding: 12px 10px;
            border-bottom: 1px solid #E2E8F0;
            text-align: left;
        }
        th {
            background-color: #F1F5F9;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .total-row {
            font-size: 16px;
            font-weight: bold;
        }
        .disclaimer {
            margin-top: 40px;
            font-size: 11px;
            color: #64748B;
            border-top: 1px solid #E2E8F0;
            padding-top: 15px;
        }
        @media print {
            body { padding: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 14px; background-color: #0284C7; color: #FFF; border: none; border-radius: 6px; cursor: pointer;">Print Document</button>
    </div>

    <div class="header">
        <div>
            <div class="title">RUSH PARCEL</div>
            <div style="color: #64748B; margin-top: 5px;">Logistics Centre, Park Royal, London NW10 7XQ</div>
            <div style="color: #64748B;">support@rushparcel.co.uk | 0800 123 4567</div>
        </div>
        <div class="text-right">
            <div class="watermark">QUOTATION</div>
            <div><strong>Quote Ref:</strong> <?= e($quote['quote_number']) ?></div>
            <div><strong>Date:</strong> <?= date('d/m/Y', strtotime($quote['created_at'])) ?></div>
            <div><strong>Valid Until:</strong> <?= date('d/m/Y', strtotime($quote['valid_until'])) ?></div>
        </div>
    </div>

    <div class="info-grid">
        <div>
            <strong>Collection Details:</strong><br>
            Postcode: <?= e($quote['pickup_snapshot']['postcode'] ?? 'N/A') ?><br>
            Zone: <?= e($quote['pickup_snapshot']['zone'] ?? 'UK Mainland') ?>
        </div>
        <div>
            <strong>Destination Details:</strong><br>
            Postcode: <?= e($quote['delivery_snapshot']['postcode'] ?? 'N/A') ?><br>
            Zone: <?= e($quote['delivery_snapshot']['zone'] ?? 'UK Mainland') ?>
        </div>
        <div>
            <strong>Service Speed:</strong><br>
            <?= e($quote['service_name']) ?><br>
            Status: <?= e(strtoupper($quote['status'])) ?>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Item Description</th>
                <th class="text-right">Amount (GBP)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quote['items'] as $item): ?>
                <tr>
                    <td><?= e($item['description']) ?></td>
                    <td class="text-right"><?= money_format_gbp($item['line_total']) ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td><strong>Subtotal</strong></td>
                <td class="text-right"><strong><?= money_format_gbp($quote['subtotal']) ?></strong></td>
            </tr>
            <tr>
                <td>UK VAT (<?= e($quote['vat_rate']) ?>%)</td>
                <td class="text-right"><?= money_format_gbp($quote['vat_amount']) ?></td>
            </tr>
            <tr class="total-row">
                <td><strong>Grand Total</strong></td>
                <td class="text-right" style="color: #0284C7;"><strong><?= money_format_gbp($quote['total']) ?></strong></td>
            </tr>
        </tbody>
    </table>

    <div class="disclaimer">
        <strong>NOTICE:</strong> This document is an estimate and official QUOTATION only. It is NOT a VAT Invoice. Rates are valid until the specified expiry date. Standard UK Delivery terms and conditions apply.
    </div>

</body>
</html>
