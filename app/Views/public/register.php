<?php ob_start(); ?>

<section class="section">
    <div class="container" style="max-width: 550px;">
        <div class="card" style="padding: 2.5rem;">
            <div class="text-center" style="margin-bottom: 2rem;">
                <div class="brand-icon" style="margin: 0 auto 1rem auto; width: 3.75rem; height: 3.75rem; font-size: 1.5rem; background: linear-gradient(135deg, #EA580C, #C2410C); color: #FFF; border-radius: 14px; display: grid; place-items: center; font-weight: 900; box-shadow: 0 4px 14px rgba(234,88,12,0.25);">RP</div>
                <h2>Create Account</h2>
                <p class="text-muted" style="font-size: 0.9rem;">Register for an individual or business account to unlock fast courier bookings.</p>
            </div>

            <form action="<?= url('/register') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label class="form-label" for="type">Account Type *</label>
                    <select id="type" name="type" class="form-control" required>
                        <option value="individual">Individual Sender</option>
                        <option value="business">Business / Corporate Account</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="name">Full Contact Name *</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Sarah Jenkins" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="company_name">Company Name (Optional for Business)</label>
                    <input type="text" id="company_name" name="company_name" class="form-control" placeholder="e.g. Jenkins Logistics Ltd">
                </div>

                <div class="grid-2" style="gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label" for="email">Email Address *</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="e.g. sarah@example.co.uk" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" class="form-control" placeholder="e.g. 07700 900123" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password (8+ characters) *</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" minlength="8" required>
                </div>

                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; margin-top: 1rem;">Create Account &rarr;</button>
            </form>

            <div class="text-center" style="margin-top: 2rem; border-top: 1px solid var(--color-border); padding-top: 1.5rem; font-size: 0.9rem;">
                <span class="text-muted">Already registered?</span> <a href="<?= url('/login') ?>" class="font-semibold">Login to Account</a>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
