<?php ob_start(); ?>

<section class="section">
    <div class="container" style="max-width: 960px;">
        <div class="section-header">
            <span class="section-tag">Final Step</span>
            <h2>Confirm Addresses & Complete Booking</h2>
            <p class="text-muted">Enter full collection and delivery addresses for Quote <strong><?= e($quote['quote_number']) ?></strong>.</p>
        </div>

        <div class="card" style="padding: 2.5rem; margin-bottom: 2rem;">
            <form action="<?= url("/booking/{$quote['quote_number']}") ?>" method="POST">
                <?= csrf_field() ?>

                <div style="background-color: var(--color-info-bg); padding: 1.25rem; border-radius: var(--radius-md); margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <strong>Service:</strong> <?= e($quote['service_name']) ?><br>
                        <span class="text-muted" style="font-size: 0.85rem;">Quote Total: <strong><?= money_format_gbp($quote['total']) ?></strong> (inc. VAT)</span>
                    </div>
                    <a href="<?= url("/quote/{$quote['quote_number']}") ?>" class="btn btn-outline btn-sm">View Quote Summary</a>
                </div>

                <h3 style="margin-bottom: 1.25rem; border-bottom: 1px solid var(--color-border); padding-bottom: 0.75rem;">1. Collection (Pickup) Contact & Address</h3>
                <div class="grid-2" style="gap: 1.5rem; margin-bottom: 2rem;">
                    <div class="form-group">
                        <label class="form-label" for="pickup_name">Sender / Contact Name *</label>
                        <input type="text" id="pickup_name" name="pickup_name" class="form-control" placeholder="e.g. John Smith" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pickup_phone">Sender Phone Number *</label>
                        <input type="tel" id="pickup_phone" name="pickup_phone" class="form-control" placeholder="e.g. 07700 900123" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pickup_email">Sender Email Address *</label>
                        <input type="email" id="pickup_email" name="pickup_email" class="form-control" value="<?= e($quote['guest_email'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pickup_house_number">Building / House Number *</label>
                        <input type="text" id="pickup_house_number" name="pickup_house_number" class="form-control" placeholder="e.g. 12B or Unit 4" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pickup_street">Street Name *</label>
                        <input type="text" id="pickup_street" name="pickup_street" class="form-control" placeholder="e.g. High Street" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pickup_town">Town / City *</label>
                        <input type="text" id="pickup_town" name="pickup_town" class="form-control" placeholder="e.g. London" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pickup_postcode">Collection Postcode *</label>
                        <input type="text" id="pickup_postcode" name="pickup_postcode" class="form-control tracking-input" value="<?= e($quote['pickup_snapshot']['postcode'] ?? '') ?>" readonly required>
                    </div>
                </div>

                <h3 style="margin-bottom: 1.25rem; border-bottom: 1px solid var(--color-border); padding-bottom: 0.75rem;">2. Delivery (Recipient) Contact & Address</h3>
                <div class="grid-2" style="gap: 1.5rem; margin-bottom: 2rem;">
                    <div class="form-group">
                        <label class="form-label" for="delivery_name">Recipient Contact Name *</label>
                        <input type="text" id="delivery_name" name="delivery_name" class="form-control" placeholder="e.g. Jane Doe" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="delivery_phone">Recipient Phone Number *</label>
                        <input type="tel" id="delivery_phone" name="delivery_phone" class="form-control" placeholder="e.g. 07800 900456" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="delivery_house_number">Building / House Number *</label>
                        <input type="text" id="delivery_house_number" name="delivery_house_number" class="form-control" placeholder="e.g. Flat 3 or Suite 100" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="delivery_street">Street Name *</label>
                        <input type="text" id="delivery_street" name="delivery_street" class="form-control" placeholder="e.g. Victoria Road" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="delivery_town">Town / City *</label>
                        <input type="text" id="delivery_town" name="delivery_town" class="form-control" placeholder="e.g. Manchester" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="delivery_postcode">Delivery Postcode *</label>
                        <input type="text" id="delivery_postcode" name="delivery_postcode" class="form-control tracking-input" value="<?= e($quote['delivery_snapshot']['postcode'] ?? '') ?>" readonly required>
                    </div>
                </div>

                <h3 style="margin-bottom: 1.25rem; border-bottom: 1px solid var(--color-border); padding-bottom: 0.75rem;">3. Collection Date & Driver Instructions</h3>
                <div class="grid-2" style="gap: 1.5rem; margin-bottom: 2rem;">
                    <div class="form-group">
                        <label class="form-label" for="scheduled_pickup_date">Preferred Collection Date *</label>
                        <input type="date" id="scheduled_pickup_date" name="scheduled_pickup_date" class="form-control" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="special_instructions">Driver Special Instructions</label>
                        <input type="text" id="special_instructions" name="special_instructions" class="form-control" placeholder="e.g. Leave with receptionist or reception desk">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">Confirm Booking & Generate Tracking Number &rarr;</button>
            </form>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
