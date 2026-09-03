<?php ob_start(); ?>

<section class="section">
    <div class="container" style="max-width: 900px;">
        <div class="card" style="padding: 3rem;">
            <span class="section-tag" style="margin-bottom: 0.5rem;">Legal Document</span>
            <h1 style="margin-bottom: 1rem;"><?= e($document_title ?? 'Legal Terms') ?></h1>
            <div class="text-muted" style="font-size: 0.85rem; margin-bottom: 2rem; border-bottom: 1px solid var(--color-border); padding-bottom: 1rem;">
                Last Updated: <?= date('F Y') ?> | Applicable Jurisdiction: United Kingdom (England & Wales)
            </div>

            <div style="font-size: 0.95rem; line-height: 1.7; color: var(--color-text-main);">
                <?php if ($content_type === 'terms'): ?>
                    <h3>1. Conditions of Carriage</h3>
                    <p>These terms apply to all carriage of goods by UK Delivery Platform. By placing a booking, the customer accepts these terms on behalf of themselves and the recipient.</p>
                    <h3>2. Customer Obligations</h3>
                    <p>The customer must ensure all parcels are properly packed, labelled with correct UK postcodes, and contain no prohibited items as specified in our Prohibited Items Policy.</p>
                    <h3>3. Liability & Claims</h3>
                    <p>Standard carrier liability is limited to £50 per shipment unless enhanced transit insurance was purchased at booking time. All claims must be submitted within 14 days of delivery.</p>

                <?php elseif ($content_type === 'privacy'): ?>
                    <h3>1. UK GDPR & Data Protection Act 2018</h3>
                    <p>We process personal data strictly in accordance with UK Data Protection Act 2018 regulations. Personal data collected includes sender/recipient names, addresses, phone numbers, and email addresses required to fulfill delivery services.</p>
                    <h3>2. Data Retention</h3>
                    <p>Shipment tracking records and financial invoices are retained for the legally required period of 6 years to satisfy UK tax and accounting compliance obligations.</p>

                <?php elseif ($content_type === 'cookies'): ?>
                    <h3>1. Essential Session Cookies</h3>
                    <p>We use essential HTTP session cookies (`UKDELIV_SESSID` and `_csrf_token`) to maintain secure session state, authenticate account logins, and protect against CSRF attacks.</p>
                    <h3>2. No Third-Party Tracking</h3>
                    <p>Our platform does not use invasive third-party cross-site advertising cookies.</p>

                <?php elseif ($content_type === 'delivery_policy'): ?>
                    <h3>1. Delivery Hours & Attempts</h3>
                    <p>Standard delivery takes place between 08:00 and 18:00 Monday to Friday. Drivers will attempt delivery up to 2 times before placing a shipment on hold or returning to depot.</p>
                    <h3>2. Proof of Delivery</h3>
                    <p>Deliveries require recipient signature or clear photographic proof of delivery at the doorstep or designated safe place.</p>

                <?php elseif ($content_type === 'prohibited_items'): ?>
                    <h3>Prohibited Goods List</h3>
                    <p>The following items are strictly forbidden from carriage on our UK network:</p>
                    <ul>
                        <li>Explosives, fireworks, and flammable liquids</li>
                        <li>Illegal drugs and controlled substances</li>
                        <li>Weapons, firearms, and ammunition</li>
                        <li>Perishable foodstuffs requiring temperature control</li>
                        <li>Cash, currency, and bearer bonds over £500 value</li>
                    </ul>

                <?php elseif ($content_type === 'vat_info'): ?>
                    <h3>UK VAT Compliance</h3>
                    <p>All prices displayed on quotes and invoices clearly itemise standard UK Value Added Tax (20.0%) where applicable. Issued VAT invoices include supplier legal name, address, and VAT registration number.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
