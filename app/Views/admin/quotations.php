<?php ob_start(); ?>

<section class="page active" id="quotations">
    <div class="head">
        <div>
            <div class="kick">Commercial</div>
            <h2>Quotation Management</h2>
            <p class="muted">Review, approve and convert delivery quotations into live shipments.</p>
        </div>
        <a href="<?= url('/quote') ?>" class="btn primary" target="_blank">＋ New Quotation</a>
    </div>

    <!-- 4 Commercial Metric Cards -->
    <div class="cards">
        <div class="card metric">
            <label>Open Quotes</label>
            <strong><?= !empty($quotes) ? count($quotes) : 18 ?></strong>
        </div>
        <div class="card metric">
            <label>Awaiting Customer</label>
            <strong>11</strong>
        </div>
        <div class="card metric">
            <label>Approved</label>
            <strong>32</strong>
        </div>
        <div class="card metric">
            <label>Conversion</label>
            <strong>71%</strong>
        </div>
    </div>

    <!-- Quote Grid -->
    <?php if (!empty($quotes)): ?>
        <div class="quotegrid">
            <?php foreach ($quotes as $q): ?>
                <div class="card quote">
                    <span class="ref"><?= e($q['quote_number']) ?></span>
                    <h3><?= e($q['customer_name'] ?? 'Guest Customer') ?></h3>
                    <p>London &rarr; Regional UK Hub &middot; Standard & Express Service</p>
                    <div class="price"><?= money_format_gbp($q['total_amount'] ?? 45.00) ?></div>
                    <p style="margin-bottom: 12px;">Status: <strong><?= e(ucwords($q['status'])) ?></strong> &middot; Created <?= date('d M Y', strtotime($q['created_at'])) ?></p>
                    <a href="<?= url("/quote/{$q['quote_number']}") ?>" class="btn primary" style="width: 100%; justify-content: center;">Review Quote &rarr;</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="quotegrid">
            <div class="card quote">
                <span class="ref">QT-260902-018</span>
                <h3>Bright Commerce Ltd</h3>
                <p>London &rarr; Manchester &middot; 12 parcels &middot; Next-Day</p>
                <div class="price">£184.60</div>
                <p style="margin-bottom: 12px;">Created 18 min ago &middot; Awaiting response</p>
                <a href="<?= url('/quote') ?>" class="btn primary" style="width: 100%; justify-content: center;">Review Quote</a>
            </div>
            <div class="card quote">
                <span class="ref">QT-260902-017</span>
                <h3>Northstar Retail</h3>
                <p>London &rarr; Leeds &middot; 6 parcels &middot; Express</p>
                <div class="price">£96.40</div>
                <p style="margin-bottom: 12px;">Created today &middot; Approved</p>
                <a href="<?= url('/quote') ?>" class="btn" style="background:#e8faf4;color:#079b77; width: 100%; justify-content: center;">Convert to Shipment</a>
            </div>
            <div class="card quote">
                <span class="ref">QT-260901-014</span>
                <h3>Westline Ltd</h3>
                <p>Birmingham &rarr; Bristol &middot; 20 parcels &middot; B2B</p>
                <div class="price">£328.00</div>
                <p style="margin-bottom: 12px;">Created yesterday &middot; Awaiting response</p>
                <a href="<?= url('/quote') ?>" class="btn primary" style="width: 100%; justify-content: center;">Review Quote</a>
            </div>
        </div>
    <?php endif; ?>
</section>

<?php $header_title = 'Quotation Management'; ?>
<?php $header_subtitle = 'Review, approve and convert delivery quotations.'; ?>
<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/admin.php'; ?>
