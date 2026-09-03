<?php ob_start(); ?>

<section class="section">
    <div class="container" style="max-width: 900px;">
        <div class="card text-center" style="padding: 3rem; margin-bottom: 2rem;">
            <div style="width: 4.5rem; height: 4.5rem; border-radius: var(--radius-full); background-color: var(--color-success-bg); color: var(--color-success); font-size: 2.25rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto;">
                ✓
            </div>

            <span class="section-tag" style="background-color: var(--color-success-bg); color: var(--color-success);">Booking Confirmed</span>
            <h1 style="margin: 0.5rem 0 1rem 0;">Shipment Reservation Successful!</h1>
            <p class="text-muted" style="font-size: 1.1rem; max-width: 600px; margin: 0 auto 2rem auto;">
                Your UK courier booking <strong><?= e($shipment['shipment_number']) ?></strong> has been created. A driver will be assigned for collection.
            </p>

            <div style="background-color: var(--color-bg-light); padding: 2rem; border-radius: var(--radius-lg); margin-bottom: 2rem; display: inline-block; width: 100%; max-width: 500px; border: 2px dashed var(--color-accent-blue);">
                <span class="text-muted" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em;">Your 12-Character Tracking Reference</span>
                <div style="font-size: 2.25rem; font-weight: 900; color: var(--color-accent-blue); letter-spacing: 0.1em; margin: 0.5rem 0;">
                    <?= e($shipment['tracking_number']) ?>
                </div>
                <div style="font-size: 0.85rem; color: var(--color-text-muted);">
                    Scheduled Pickup: <strong><?= date('d M Y', strtotime($shipment['scheduled_pickup_at'])) ?></strong>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="<?= url("/track/{$shipment['tracking_number']}") ?>" class="btn btn-primary btn-lg">Track Shipment Live &rarr;</a>
                <a href="<?= url('/quote') ?>" class="btn btn-outline btn-lg">Book Another Shipment</a>
            </div>
        </div>

        <div class="card" style="padding: 2.5rem;">
            <h3>Shipment & Address Summary</h3>

            <div class="grid-2" style="gap: 2rem; margin-top: 1.5rem;">
                <div style="background-color: var(--color-bg-light); padding: 1.5rem; border-radius: var(--radius-md);">
                    <h4 style="margin-bottom: 0.75rem; color: var(--color-accent-blue);">📍 Collection Address</h4>
                    <p style="margin-bottom: 0.25rem;"><strong><?= e($shipment['pickup_address']['name']) ?></strong> (<?= e($shipment['pickup_address']['phone']) ?>)</p>
                    <p class="text-muted" style="font-size: 0.9rem;">
                        <?= e($shipment['pickup_address']['house_number']) ?> <?= e($shipment['pickup_address']['street']) ?><br>
                        <?= e($shipment['pickup_address']['town']) ?><br>
                        <strong><?= e($shipment['pickup_address']['postcode']) ?></strong>
                    </p>
                </div>

                <div style="background-color: var(--color-bg-light); padding: 1.5rem; border-radius: var(--radius-md);">
                    <h4 style="margin-bottom: 0.75rem; color: var(--color-accent-blue);">🏁 Delivery Address</h4>
                    <p style="margin-bottom: 0.25rem;"><strong><?= e($shipment['delivery_address']['name']) ?></strong> (<?= e($shipment['delivery_address']['phone']) ?>)</p>
                    <p class="text-muted" style="font-size: 0.9rem;">
                        <?= e($shipment['delivery_address']['house_number']) ?> <?= e($shipment['delivery_address']['street']) ?><br>
                        <?= e($shipment['delivery_address']['town']) ?><br>
                        <strong><?= e($shipment['delivery_address']['postcode']) ?></strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
