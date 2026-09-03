<?php ob_start(); ?>

<section class="section" style="padding-top: 2rem;">
    <div class="container" style="max-width: 960px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem;">
            <div>
                <a href="<?= url('/driver/jobs') ?>" class="text-muted" style="font-size: 0.9rem;">&larr; Back to Job Queue</a>
                <h1 style="margin-top: 0.25rem;">Courier Job: <?= e($shipment['tracking_number']) ?></h1>
            </div>
            <div>
                <span class="badge badge-info" style="font-size: 1.05rem; padding: 0.5rem 1.25rem;">
                    <?= e(strtoupper(str_replace('_', ' ', $shipment['status']))) ?>
                </span>
            </div>
        </div>

        <div class="grid-2" style="gap: 2rem; margin-bottom: 2rem;">
            <div class="card" style="padding: 2rem;">
                <h4 style="color: var(--color-accent-blue); margin-bottom: 1rem;">📍 Pickup Address (Sender)</h4>
                <p><strong><?= e($shipment['pickup_address']['name'] ?? '') ?></strong></p>
                <p class="text-muted" style="font-size: 0.95rem; margin-top: 0.25rem;">
                    <?= e($shipment['pickup_address']['house_number'] ?? '') ?> <?= e($shipment['pickup_address']['street'] ?? '') ?><br>
                    <?= e($shipment['pickup_address']['town'] ?? '') ?><br>
                    <strong><?= e($shipment['pickup_address']['postcode'] ?? '') ?></strong>
                </p>
                <div style="margin-top: 1rem;">
                    <a href="tel:<?= e($shipment['pickup_address']['phone'] ?? '') ?>" class="btn btn-outline btn-sm">📞 Call Sender (<?= e($shipment['pickup_address']['phone'] ?? '') ?>)</a>
                </div>
            </div>

            <div class="card" style="padding: 2rem;">
                <h4 style="color: var(--color-accent-blue); margin-bottom: 1rem;">🏁 Delivery Address (Recipient)</h4>
                <p><strong><?= e($shipment['delivery_address']['name'] ?? '') ?></strong></p>
                <p class="text-muted" style="font-size: 0.95rem; margin-top: 0.25rem;">
                    <?= e($shipment['delivery_address']['house_number'] ?? '') ?> <?= e($shipment['delivery_address']['street'] ?? '') ?><br>
                    <?= e($shipment['delivery_address']['town'] ?? '') ?><br>
                    <strong><?= e($shipment['delivery_address']['postcode'] ?? '') ?></strong>
                </p>
                <div style="margin-top: 1rem;">
                    <a href="tel:<?= e($shipment['delivery_address']['phone'] ?? '') ?>" class="btn btn-outline btn-sm">📞 Call Recipient (<?= e($shipment['delivery_address']['phone'] ?? '') ?>)</a>
                </div>
            </div>
        </div>

        <div class="grid-2" style="gap: 2rem; margin-bottom: 2rem;">
            <!-- Status Update Card -->
            <div class="card" style="padding: 2rem;">
                <h3 style="margin-bottom: 1.25rem;">🔄 Quick Status Update</h3>

                <form action="<?= url("/driver/jobs/{$shipment['id']}/status") ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label class="form-label" for="status">Job Action / Status *</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="collected">Collected Parcel from Sender</option>
                            <option value="in_transit">In Transit to Depot / Hub</option>
                            <option value="out_for_delivery">Out for Final Delivery</option>
                            <option value="delivery_failed">Delivery Attempt Failed</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="public_message">Status Message *</label>
                        <input type="text" id="public_message" name="public_message" class="form-control" placeholder="e.g. Parcel loaded on vehicle" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="location_label">Current City / Location</label>
                        <input type="text" id="location_label" name="location_label" class="form-control" placeholder="e.g. Manchester Hub">
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">Update Status &rarr;</button>
                </form>
            </div>

            <!-- POD Signature & Photo Capture Card -->
            <div class="card" style="padding: 2rem; border-left: 4px solid var(--color-success);">
                <h3 style="margin-bottom: 1.25rem;">📷 Capture Proof of Delivery (POD)</h3>

                <form action="<?= url("/driver/jobs/{$shipment['id']}/pod") ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label class="form-label" for="recipient_name">Recipient Name *</label>
                        <input type="text" id="recipient_name" name="recipient_name" class="form-control" placeholder="e.g. J. Doe" value="<?= e($shipment['delivery_address']['name'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="pod_file">Upload Delivery Photo / Signature *</label>
                        <input type="file" id="pod_file" name="pod_file" class="form-control" accept="image/jpeg,image/png,application/pdf" required>
                        <span class="text-muted" style="font-size: 0.8rem; margin-top: 0.25rem; display: block;">Allowed formats: JPG, PNG, PDF (Max 10MB)</span>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; background-color: var(--color-success); border-color: var(--color-success);">Complete Delivery & Save POD &rarr;</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
