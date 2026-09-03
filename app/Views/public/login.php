<?php ob_start(); ?>

<section class="section">
    <div class="container" style="max-width: 480px;">
        <div class="card" style="padding: 2.5rem;">
            <div class="text-center" style="margin-bottom: 2rem;">
                <div class="brand-icon" style="margin: 0 auto 1rem auto; width: 3.5rem; height: 3.5rem; font-size: 1.5rem;">UK</div>
                <h2>Account Login</h2>
                <p class="text-muted" style="font-size: 0.9rem;">Access your UK courier portal to manage bookings, track shipments, and view invoices.</p>
            </div>

            <?php if (\App\Core\Session::has('error')): ?>
                <div class="alert alert-error" style="margin-bottom: 1.5rem; padding: 12px 16px; background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; border-radius: 9px; font-size: 0.88rem; font-weight: 700;">
                    ⚠️ <?= e(\App\Core\Session::getFlash('error')) ?>
                </div>
            <?php endif; ?>

            <?php if (\App\Core\Session::has('success')): ?>
                <div class="alert alert-success" style="margin-bottom: 1.5rem; padding: 12px 16px; background: #f0fdf4; border: 1px solid #bbf7d0; color: #16a34a; border-radius: 9px; font-size: 0.88rem; font-weight: 700;">
                    ✓ <?= e(\App\Core\Session::getFlash('success')) ?>
                </div>
            <?php endif; ?>

            <div style="background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 11px; padding: 14px 16px; margin-bottom: 1.5rem; font-size: 0.85rem; color: #0369a1; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <strong style="display: block; font-weight: 800; color: #0284c7; margin-bottom: 4px;">🔑 Demo Admin Account:</strong>
                    Email: <code style="background:#e0f2fe; padding:2px 6px; border-radius:4px; font-weight:700;">admin@rushparcel.co.uk</code><br>
                    Password: <code style="background:#e0f2fe; padding:2px 6px; border-radius:4px; font-weight:700;">admin123</code>
                </div>
                <button type="button" onclick="fillAdminCreds()" style="background: #0284c7; color: #fff; border: 0; border-radius: 8px; padding: 8px 12px; font-size: 0.78rem; font-weight: 900; cursor: pointer;">
                    Auto-Fill &rarr;
                </button>
            </div>

            <form action="<?= url('/login') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label class="form-label" for="email">Email Address *</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="e.g. admin@rushparcel.co.uk" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password *</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; margin-top: 1rem;">Login to Account &rarr;</button>
            </form>

            <script>
            function fillAdminCreds() {
                document.getElementById('email').value = 'admin@rushparcel.co.uk';
                document.getElementById('password').value = 'admin123';
            }
            </script>

            <div class="text-center" style="margin-top: 2rem; border-top: 1px solid var(--color-border); padding-top: 1.5rem; font-size: 0.9rem;">
                <span class="text-muted">Don't have an account yet?</span> <a href="<?= url('/register') ?>" class="font-semibold">Register Now</a>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
