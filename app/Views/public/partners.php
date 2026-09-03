<?php ob_start(); ?>

<section class="section">
    <div class="container" style="max-width: 960px;">
        <div class="section-header">
            <span class="section-tag">Corporate & Fleet</span>
            <h2>Business Partnerships & Freight Accounts</h2>
            <p class="text-muted">Scale your e-commerce order fulfillment or regional distribution with dedicated courier accounts.</p>
        </div>

        <div class="card" style="padding: 3rem;">
            <h3>Corporate Account Benefits</h3>
            <p class="text-muted" style="margin-bottom: 2rem;">Apply for a UK Business Account to unlock custom rate cards, bulk booking CSV uploads, itemised monthly VAT billing, and dedicated account dispatchers.</p>

            <div class="grid-2" style="gap: 1.5rem; margin-bottom: 2.5rem;">
                <div style="background-color: var(--color-surface-alt); padding: 1.25rem; border-radius: var(--radius-md);">
                    <h4 style="margin-bottom: 0.5rem;">💼 30-Day Monthly Credit</h4>
                    <p class="text-muted" style="font-size: 0.9rem;">Consolidate your shipping costs into a single monthly VAT invoice with flexible 30-day payment terms.</p>
                </div>
                <div style="background-color: var(--color-surface-alt); padding: 1.25rem; border-radius: var(--radius-md);">
                    <h4 style="margin-bottom: 0.5rem;">📊 Volume Rate Cards</h4>
                    <p class="text-muted" style="font-size: 0.9rem;">Enjoy tiered discounts based on your weekly or monthly parcel volume commitments.</p>
                </div>
            </div>

            <div class="text-center">
                <a href="<?= url('/contact') ?>" class="btn btn-primary btn-lg">Apply for Business Account &rarr;</a>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
