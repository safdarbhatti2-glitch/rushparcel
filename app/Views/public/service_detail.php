<?php ob_start(); ?>

<section class="section">
    <div class="container" style="max-width: 960px;">
        <div style="margin-bottom: 2rem;">
            <a href="<?= url('/services') ?>" class="text-muted" style="font-size: 0.9rem;">&larr; Back to Services Overview</a>
        </div>

        <div class="card" style="padding: 3rem;">
            <div class="service-icon" style="width: 4rem; height: 4rem; font-size: 2rem;"><?= $service['icon'] ?></div>
            <h1 style="margin-bottom: 0.75rem;"><?= e($service['title']) ?></h1>
            <p class="text-muted" style="font-size: 1.15rem; margin-bottom: 2rem; font-weight: 500;"><?= e($service['tagline']) ?></p>

            <div style="font-size: 1.05rem; line-height: 1.7; color: var(--color-text-main); margin-bottom: 2.5rem;">
                <p><?= e($service['description']) ?></p>
            </div>

            <h3 style="margin-bottom: 1.25rem;">Key Features & Specifications</h3>
            <div class="grid-2" style="gap: 1rem; margin-bottom: 3rem;">
                <?php foreach ($service['features'] as $feature): ?>
                    <div style="background-color: var(--color-bg-light); padding: 1rem 1.25rem; border-radius: var(--radius-md); border-left: 3px solid var(--color-accent-blue);">
                        <strong>✔️ <?= e($feature) ?></strong>
                    </div>
                <?php endforeach; ?>
            </div>

            <div style="background-color: var(--color-info-bg); padding: 2rem; border-radius: var(--radius-lg); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
                <div>
                    <h4 style="color: var(--color-accent-blue); margin-bottom: 0.25rem;">Ready to send your shipment?</h4>
                    <p class="text-muted" style="font-size: 0.9rem; margin-bottom: 0;">Calculate your instant UK postcode price in under 30 seconds.</p>
                </div>
                <a href="<?= url('/quote') ?>" class="btn btn-primary btn-lg">Calculate Price Now &rarr;</a>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
