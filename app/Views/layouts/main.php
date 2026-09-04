<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Rush Parcel — Fast, Reliable Nationwide Courier & Logistics Services') ?></title>
    <meta name="description" content="<?= e($meta_description ?? 'Professional UK courier and delivery service offering same-day delivery, parcel shipping, business logistics, and international freight.') ?>">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= e($title ?? 'Rush Parcel') ?>">
    <meta property="og:description" content="Nationwide UK courier and logistics delivery platform.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= url() ?>">
    
    <!-- Favicons & Brand Icons -->
    <link rel="icon" type="image/x-icon" href="<?= asset('favicon.ico') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= asset('brand/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= asset('brand/favicon-16x16.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= asset('brand/apple-touch-icon.png') ?>">

    <!-- CSS Design System -->
    <link rel="stylesheet" href="<?= asset('css/main.css') ?>">
</head>
<body>

    <?php include APP_PATH . '/Views/partials/header.php'; ?>

    <main class="main-content">
        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="container" style="padding-top: 1rem;">
                <?php include APP_PATH . '/Views/partials/alerts.php'; ?>
            </div>
        <?php endif; ?>
        
        <?= $content ?? '' ?>
    </main>

    <?php include APP_PATH . '/Views/partials/footer.php'; ?>

    <!-- JS Scripts -->
    <script src="<?= asset('js/main.js') ?>"></script>
</body>
</html>
