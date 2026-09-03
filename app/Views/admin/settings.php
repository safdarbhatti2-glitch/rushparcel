<?php ob_start(); ?>

<section class="page active" id="settings">
    <div class="head">
        <div>
            <div class="kick">Configuration</div>
            <h2>Platform Settings</h2>
            <p class="muted">Control company, pricing, notification and security preferences.</p>
        </div>
        <button class="btn primary" onclick="alert('Settings saved successfully!')">Save Changes</button>
    </div>

    <div class="settings">
        <div class="card setnav">
            <button class="sel">Company Profile</button>
            <button>Pricing &amp; VAT</button>
            <button>Notifications</button>
            <button>Security</button>
            <button>Invoice Defaults</button>
        </div>

        <div class="card setbody">
            <div class="row">
                <div>
                    <b>Company trading name</b>
                    <p>Rush Parcel</p>
                </div>
                <button class="btn btn-outline">Edit</button>
            </div>

            <div class="row">
                <div>
                    <b>Default currency</b>
                    <p>GBP (£) &middot; United Kingdom</p>
                </div>
                <button class="btn btn-outline">Edit</button>
            </div>

            <div class="row">
                <div>
                    <b>VAT registration</b>
                    <p>Configure VAT number and invoice tax rules (20% Standard UK Rate).</p>
                </div>
                <button class="btn btn-outline">Configure</button>
            </div>

            <div class="row">
                <div>
                    <b>Shipment status notifications</b>
                    <p>Email customers when key milestones change.</p>
                </div>
                <button class="toggle on"></button>
            </div>

            <div class="row">
                <div>
                    <b>Two-factor authentication</b>
                    <p>Require 2FA for administrator accounts.</p>
                </div>
                <button class="toggle on"></button>
            </div>
        </div>
    </div>
</section>

<?php $header_title = 'Platform Settings'; ?>
<?php $header_subtitle = 'Configure your Rush Parcel platform.'; ?>
<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/admin.php'; ?>
