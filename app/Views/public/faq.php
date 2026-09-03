<?php ob_start(); ?>

<section class="section">
    <div class="container" style="max-width: 900px;">
        <div class="section-header">
            <span class="section-tag">Knowledge Base</span>
            <h2>Frequently Asked Questions</h2>
            <p class="text-muted">Find quick answers to common questions about UK parcel shipping, quotes, tracking, and invoicing.</p>
        </div>

        <div class="faq-item">
            <button class="faq-question">How is parcel price calculated? <span>+</span></button>
            <div class="faq-answer">
                <p>Prices are calculated server-side based on collection/destination postcodes, package actual weight vs dimensional (volumetric) weight, selected service speed (Standard 48h, Express 24h, Same-Day), and requested options (signature, fragile handling, insurance).</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">What is volumetric weight? <span>+</span></button>
            <div class="faq-answer">
                <p>Volumetric weight measures the space a parcel occupies during transport. It is calculated using standard industry formula: (Length cm × Width cm × Height cm) ÷ 5000. Courier pricing uses whichever is greater between actual weight (kg) and volumetric weight (kg).</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">How does proof of delivery work? <span>+</span></button>
            <div class="faq-answer">
                <p>When a driver delivers a package, they capture the recipient's digital signature and a clear photo of the parcel at the door or safe location. These are uploaded immediately to private secure storage and accessible on your tracking timeline.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Are shipments insured? <span>+</span></button>
            <div class="faq-answer">
                <p>All standard shipments include basic transit cover up to £50 declared value. Higher value goods can be covered by choosing enhanced transit cover during the quotation process.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Can I ship internationally outside the UK? <span>+</span></button>
            <div class="faq-answer">
                <p>Yes. We offer international courier services to Europe, North America, and over 220 worldwide destinations, including commercial invoice generator tools and customs declaration assistance.</p>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/main.php'; ?>
