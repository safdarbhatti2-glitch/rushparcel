<div class="tracking-widget">
    <h3>📦 Track Your Shipment</h3>
    <p>Enter your 12-character UK tracking reference (e.g. UK123456789) to view real-time delivery status.</p>
    
    <form action="<?= url('/track') ?>" method="GET">
        <div class="form-group mb-0">
            <div class="input-group">
                <input type="text" 
                       name="tracking_number" 
                       class="form-control tracking-input" 
                       placeholder="e.g. UK123456789" 
                       value="<?= e($search_tracking ?? '') ?>" 
                       required 
                       pattern="[A-Za-z0-9\-]+" 
                       maxlength="30"
                       aria-label="Tracking Number">
                <button type="submit" class="btn btn-primary">Track Parcel</button>
            </div>
        </div>
    </form>
</div>
