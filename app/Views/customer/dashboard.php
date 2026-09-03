<?php ob_start(); ?>

<section class="section">
    <div class="container" style="max-width: 1100px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 2.5rem;">
            <div>
                <span class="section-tag">Customer Portal</span>
                <h1 style="margin-top: 0.25rem;">Welcome, <?= e($user['name'] ?? 'Customer') ?></h1>
                <p class="text-muted" style="margin-bottom: 0;">Manage your UK courier shipments, saved quotes, and address book.</p>
            </div>
            <div style="display: flex; gap: 1rem;">
                <a href="<?= url('/quote') ?>" class="btn btn-primary">+ New Quote</a>
                <form action="<?= url('/logout') ?>" method="POST" style="display: inline;">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-outline">Logout</button>
                </form>
            </div>
        </div>

        <div class="grid-3" style="margin-bottom: 2.5rem;">
            <div class="card">
                <span class="text-muted" style="font-size: 0.85rem; text-transform: uppercase;">Active Shipments</span>
                <div style="font-size: 2rem; font-weight: 800; color: #EA580C; margin-top: 0.25rem;">
                    <?= count($shipments) ?>
                </div>
            </div>
            <div class="card">
                <span class="text-muted" style="font-size: 0.85rem; text-transform: uppercase;">Saved Quotes</span>
                <div style="font-size: 2rem; font-weight: 800; color: #0284C7; margin-top: 0.25rem;">
                    <?= count($quotes) ?>
                </div>
            </div>
            <div class="card">
                <span class="text-muted" style="font-size: 0.85rem; text-transform: uppercase;">Account Status</span>
                <div style="margin-top: 0.5rem;">
                    <span class="badge badge-success" style="font-size: 0.95rem; padding: 0.4rem 0.85rem;">Active Customer</span>
                </div>
            </div>
        </div>

        <div class="card" style="padding: 2rem; margin-bottom: 2rem;">
            <h3 style="margin-bottom: 1.25rem;">Recent Courier Shipments</h3>

            <?php if (!empty($shipments)): ?>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 2px solid var(--color-border); text-align: left;">
                            <th style="padding: 0.75rem;">Tracking Ref</th>
                            <th style="padding: 0.75rem;">Service</th>
                            <th style="padding: 0.75rem;">Status</th>
                            <th style="padding: 0.75rem;">Amount</th>
                            <th style="padding: 0.75rem; text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($shipments as $s): ?>
                            <tr style="border-bottom: 1px solid var(--color-border-light);">
                                <td style="padding: 0.75rem;"><strong><?= e($s['tracking_number']) ?></strong></td>
                                <td style="padding: 0.75rem;"><?= e($s['service_name']) ?></td>
                                <td style="padding: 0.75rem;">
                                    <span class="badge badge-info"><?= e(ucwords(str_replace('_', ' ', $s['status']))) ?></span>
                                </td>
                                <td style="padding: 0.75rem; font-weight: 600;"><?= money_format_gbp($s['total_amount']) ?></td>
                                <td style="padding: 0.75rem; text-align: right;">
                                    <a href="<?= url("/track/{$s['tracking_number']}") ?>" class="btn btn-outline btn-sm">Track &rarr;</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted">No recent shipments found. Click 'New Quote' above to calculate a price and book your first shipment.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
