<div class="top">
    <span class="pink">✦</span> Rush Parcel — UK Same-Day & Next-Day Express Courier Coverage 
    <span>•</span> ☎ Customer Support: <b>0800 123 4567</b> 
    <span>•</span> ✉ support@rushparcel.co.uk
</div>

<header class="nav">
    <div class="container navin">
        <a class="brand" href="<?= url('/') ?>" aria-label="Rush Parcel Home">
            <picture>
                <source media="(max-width: 640px)" srcset="<?= asset('brand/rushparcel-logo-compact.png') ?>">
                <img src="<?= asset('brand/rushparcel-logo-primary.png') ?>" alt="Rush Parcel" class="header-logo-img">
            </picture>
        </a>
        <nav class="links">
            <a href="<?= url('/') ?>" class="<?= ($active_page ?? '') === 'home' ? 'active' : '' ?>">Home</a>
            <a href="<?= url('/services') ?>" class="<?= ($active_page ?? '') === 'services' ? 'active' : '' ?>">Services</a>
            <a href="<?= url('/quote') ?>" class="<?= ($active_page ?? '') === 'quote' ? 'active' : '' ?>">Get a Quote</a>
            <a href="<?= url('/track') ?>" class="<?= ($active_page ?? '') === 'track' ? 'active' : '' ?>">Track Parcel</a>
            <a href="<?= url('/drop-off') ?>" class="<?= ($active_page ?? '') === 'drop-off' ? 'active' : '' ?>">Drop-off Locations</a>
            <a href="<?= url('/about') ?>" class="<?= ($active_page ?? '') === 'about' ? 'active' : '' ?>">About Us</a>
            <a href="<?= url('/contact') ?>" class="<?= ($active_page ?? '') === 'contact' ? 'active' : '' ?>">Contact</a>
        </nav>
        <div class="actions">
            <?php if (!empty($current_user)): ?>
                <a class="btn primary" href="<?= url('/dashboard') ?>">My Portal</a>
            <?php else: ?>
                <a class="btn outline" href="<?= url('/login') ?>">Login</a>
                <a class="btn primary" href="<?= url('/register') ?>">Register</a>
            <?php endif; ?>
        </div>
    </div>
</header>
