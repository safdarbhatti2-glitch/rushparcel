<?php ob_start(); ?>

<section class="section">
    <div class="container" style="max-width: 900px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <a href="<?= url('/quote') ?>" class="text-muted" style="font-size: 0.9rem;">&larr; Calculate New Quote</a>
            <div style="display: flex; gap: 0.75rem;">
                <a href="<?= url("/quote/{$quote['quote_number']}/pdf") ?>" target="_blank" class="btn btn-outline btn-sm">🖨️ Print / Download PDF</a>
            </div>
        </div>

        <div class="card" style="padding: 3rem; position: relative;">
            <div style="position: absolute; top: 1.5rem; right: 2rem; opacity: 0.15; font-size: 2rem; font-weight: 900; letter-spacing: 0.2em; color: var(--color-accent-blue); pointer-events: none;">
                OFFICIAL QUOTATION
            </div>

            <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 2.5rem; border-bottom: 2px solid var(--color-border); padding-bottom: 1.5rem;">
                <div>
                    <span class="text-muted" style="font-size: 0.85rem;">Official Freight Quotation</span>
                    <h1 style="font-size: 2rem; color: var(--color-primary-navy); margin: 0.2rem 0;"><?= e($quote['quote_number']) ?></h1>
                    <div style="font-size: 0.9rem; color: var(--color-text-muted);">
                        Service: <strong><?= e($quote['service_name']) ?></strong> | Issued: <?= date('d M Y, H:i', strtotime($quote['created_at'])) ?>
                    </div>
                </div>

                <div class="text-right">
                    <span class="badge <?= $quote['status'] === 'accepted' ? 'badge-success' : ($quote['status'] === 'expired' ? 'badge-danger' : 'badge-info') ?>" style="font-size: 1rem; padding: 0.5rem 1rem;">
                        Status: <?= e(strtoupper($quote['status'])) ?>
                    </span>
                    <div style="font-size: 0.85rem; color: var(--color-text-muted); margin-top: 0.5rem;">
                        Valid Until: <strong><?= date('d M Y', strtotime($quote['valid_until'])) ?></strong>
                    </div>
                </div>
            </div>

            <div class="grid-2" style="gap: 2rem; margin-bottom: 2.5rem; background-color: var(--color-bg-light); padding: 1.5rem; border-radius: var(--radius-md);">
                <div>
                    <h4 style="margin-bottom: 0.5rem; color: var(--color-text-muted); font-size: 0.85rem; text-transform: uppercase;">Collection Address & Zone</h4>
                    <p><strong>Postcode:</strong> <?= e($quote['pickup_snapshot']['postcode'] ?? 'N/A') ?></p>
                    <p><strong>Zone:</strong> <?= e($quote['pickup_snapshot']['zone'] ?? 'UK Mainland') ?></p>
                </div>
                <div>
                    <h4 style="margin-bottom: 0.5rem; color: var(--color-text-muted); font-size: 0.85rem; text-transform: uppercase;">Destination Address & Zone</h4>
                    <p><strong>Postcode:</strong> <?= e($quote['delivery_snapshot']['postcode'] ?? 'N/A') ?></p>
                    <p><strong>Zone:</strong> <?= e($quote['delivery_snapshot']['zone'] ?? 'UK Mainland') ?></p>
                </div>
            </div>

            <h3 style="margin-bottom: 1rem;">Itemised Quotation Breakdown</h3>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 2rem;">
                <thead>
                    <tr style="border-bottom: 2px solid var(--color-border); text-align: left;">
                        <th style="padding: 0.75rem 0;">Line Description</th>
                        <th style="padding: 0.75rem 0; text-align: right;">Line Amount (GBP)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($quote['items'] as $item): ?>
                        <tr style="border-bottom: 1px solid var(--color-border-light);">
                            <td style="padding: 0.75rem 0;"><?= e($item['description']) ?></td>
                            <td style="padding: 0.75rem 0; text-align: right; font-weight: 600;"><?= money_format_gbp($item['line_total']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr style="border-bottom: 1px solid var(--color-border-light);">
                        <td style="padding: 0.75rem 0; font-weight: 600;">Subtotal</td>
                        <td style="padding: 0.75rem 0; text-align: right; font-weight: 600;"><?= money_format_gbp($quote['subtotal']) ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--color-border-light);">
                        <td style="padding: 0.75rem 0;">UK VAT (<?= e($quote['vat_rate']) ?>%)</td>
                        <td style="padding: 0.75rem 0; text-align: right;"><?= money_format_gbp($quote['vat_amount']) ?></td>
                    </tr>
                    <tr style="font-size: 1.25rem; font-weight: 800;">
                        <td style="padding: 1rem 0;">Total Quote Price</td>
                        <td style="padding: 1rem 0; text-align: right; color: var(--color-accent-blue);"><?= money_format_gbp($quote['total']) ?></td>
                    </tr>
                </tbody>
            </table>

            <?php if ($quote['status'] !== 'accepted' && $quote['status'] !== 'converted'): ?>
                <div style="background-color: var(--color-info-bg); padding: 2rem; border-radius: var(--radius-lg); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
                    <div>
                        <h4 style="color: var(--color-accent-blue); margin-bottom: 0.25rem;">Accept Quote & Proceed to Booking</h4>
                        <p class="text-muted" style="font-size: 0.9rem; margin-bottom: 0;">Accepting locks in this rate and creates your shipment booking reservation.</p>
                    </div>
                    <form action="<?= url("/quote/{$quote['quote_number']}/accept") ?>" method="POST">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-primary btn-lg">Accept Quote Now &rarr;</button>
                    </form>
                </div>
            <?php else: ?>
                <div class="alert alert-success" style="margin-bottom: 0;">
                    <span>✅</span>
                    <div>
                        <strong>Quote Accepted!</strong> This quotation has been accepted and is ready for shipment booking.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
