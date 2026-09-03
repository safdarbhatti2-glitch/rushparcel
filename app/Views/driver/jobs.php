<?php ob_start(); ?>

<section class="section" style="padding-top: 2rem;">
    <div class="container" style="max-width: 1000px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem;">
            <div>
                <span class="section-tag">Driver Portal</span>
                <h1 style="margin-top: 0.25rem;">Assigned Courier Jobs Queue</h1>
                <p class="text-muted" style="margin-bottom: 0;">Driver Ref: <strong><?= e($driver['employee_ref'] ?? 'DRV-001') ?></strong></p>
            </div>
            <form action="<?= url('/logout') ?>" method="POST">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-outline">Logout</button>
            </form>
        </div>

        <div class="card" style="padding: 2rem;">
            <?php if (!empty($jobs)): ?>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 2px solid var(--color-border); text-align: left;">
                            <th style="padding: 0.75rem;">Tracking Ref</th>
                            <th style="padding: 0.75rem;">Service</th>
                            <th style="padding: 0.75rem;">Current Status</th>
                            <th style="padding: 0.75rem;">Scheduled Pickup</th>
                            <th style="padding: 0.75rem; text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jobs as $j): ?>
                            <tr style="border-bottom: 1px solid var(--color-border-light);">
                                <td style="padding: 0.75rem; color: var(--color-accent-blue); font-weight: 700;"><?= e($j['tracking_number']) ?></td>
                                <td style="padding: 0.75rem;"><?= e($j['service_name']) ?></td>
                                <td style="padding: 0.75rem;">
                                    <span class="badge badge-info"><?= e(ucwords(str_replace('_', ' ', $j['status']))) ?></span>
                                </td>
                                <td style="padding: 0.75rem; font-size: 0.85rem; text-transform: uppercase;">
                                    <?= !empty($j['scheduled_pickup_at']) ? date('d M H:i', strtotime($j['scheduled_pickup_at'])) : 'Pending' ?>
                                </td>
                                <td style="padding: 0.75rem; text-align: right;">
                                    <a href="<?= url("/driver/jobs/{$j['id']}") ?>" class="btn btn-primary btn-sm">Manage Job &rarr;</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="text-center" style="padding: 3rem 0;">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">🚚</div>
                    <h3>No Active Courier Jobs Assigned</h3>
                    <p class="text-muted">You have no pending collection or delivery assignments right now.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
