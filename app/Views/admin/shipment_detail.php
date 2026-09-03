<?php ob_start(); ?>

<style>
.shipment-detail-container {
  --purple: #8b5cf6;
  --purple-hover: #7c3aed;
  --purple-light: #f3e8ff;
  --purple-text: #6b21a8;
  --ink: #0f172a;
  --muted: #64748b;
  --card-bg: #ffffff;
  --bg: #f8fafc;
  --border: #f1f5f9;
  --shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
}

.shipment-detail-container .top-header { margin-bottom: 24px; }
.shipment-detail-container .back-link { display: inline-flex; align-items: center; gap: 6px; font-size: 13px; color: #475569; text-decoration: none; font-weight: 600; transition: 0.2s; margin-bottom: 6px; }
.shipment-detail-container .back-link:hover { color: var(--purple); }
.shipment-detail-container .page-title { font-size: 26px; font-weight: 800; color: var(--ink); letter-spacing: -0.03em; margin: 0; }
.shipment-detail-container .tracking-id { font-size: 13px; color: var(--muted); font-weight: 600; margin-top: 4px; }

/* 2-Column Main Layout Grid */
.shipment-detail-container .main-grid { display: grid; grid-template-columns: 1.2fr 1fr; gap: 24px; margin-bottom: 28px; }

/* Cards */
.shipment-detail-container .card {
  background: var(--card-bg); border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: var(--shadow); padding: 24px; margin-bottom: 24px;
}
.shipment-detail-container .card:last-child { margin-bottom: 0; }
.shipment-detail-container .card-title { font-size: 18px; font-weight: 800; color: var(--ink); margin-bottom: 20px; letter-spacing: -0.02em; }

/* Left Column: Shipment Info Grid */
.shipment-detail-container .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px 24px; }
.shipment-detail-container .info-item label { display: block; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: capitalize; margin-bottom: 4px; }
.shipment-detail-container .info-item b { display: block; font-size: 14px; font-weight: 800; color: var(--ink); }

.shipment-detail-container .status-badge {
  display: inline-block; padding: 4px 14px; border-radius: 20px; font-size: 11px; font-weight: 800; text-transform: lowercase; background: #8b5cf6; color: #fff;
}
.shipment-detail-container .status-badge.delivered { background: #10b981; }
.shipment-detail-container .status-badge.in_transit { background: #f59e0b; }
.shipment-detail-container .status-badge.out_for_delivery { background: #ec4899; }

/* Forms */
.shipment-detail-container .field { margin-bottom: 16px; }
.shipment-detail-container .field:last-child { margin-bottom: 0; }
.shipment-detail-container .field label { display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 6px; }
.shipment-detail-container .field input,
.shipment-detail-container .field select {
  width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 14px; font-size: 13px; color: var(--ink); background: #f8fafc; outline: none; transition: 0.2s;
}
.shipment-detail-container .field input:focus,
.shipment-detail-container .field select:focus {
  border-color: var(--purple); background: #fff; box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.12);
}

.shipment-detail-container .purple-btn {
  width: 100%; border: none; background: #7c3aed; color: #fff; border-radius: 10px; padding: 13px; font-size: 13px; font-weight: 800; cursor: pointer; transition: 0.2s; box-shadow: 0 8px 20px rgba(124, 58, 237, 0.25);
}
.shipment-detail-container .purple-btn:hover { background: #6d28d9; transform: translateY(-1px); }

/* Parcel Updates Timeline Section */
.shipment-detail-container .timeline { display: grid; gap: 16px; margin-top: 16px; }
.shipment-detail-container .tl-row { display: flex; gap: 16px; padding: 16px; border-radius: 12px; background: #f8fafc; border: 1px solid #f1f5f9; align-items: flex-start; }
.shipment-detail-container .tl-icon { width: 36px; height: 36px; border-radius: 50%; background: #f3e8ff; color: #7c3aed; display: grid; place-items: center; font-size: 14px; font-weight: 900; flex: none; }
.shipment-detail-container .tl-body { flex: 1; }
.shipment-detail-container .tl-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px; }
.shipment-detail-container .tl-title { font-size: 13px; font-weight: 800; color: var(--ink); }
.shipment-detail-container .tl-time { font-size: 11px; color: var(--muted); font-weight: 600; }
.shipment-detail-container .tl-msg { font-size: 12px; color: #475569; line-height: 1.5; }
.shipment-detail-container .tl-loc { display: inline-block; font-size: 10px; font-weight: 700; background: #e0f2fe; color: #0369a1; padding: 2px 8px; border-radius: 10px; margin-top: 6px; }

@media (max-width: 900px) {
  .shipment-detail-container .main-grid { grid-template-columns: 1fr; }
}
</style>

<div class="shipment-detail-container">
    <!-- Header -->
    <div class="top-header" style="display:flex; justify-content:space-between; align-items:flex-end;">
        <div>
            <a href="<?= url('/admin/shipments') ?>" class="back-link">&larr;</a>
            <h1 class="page-title">Shipment Details</h1>
            <div class="tracking-id">Tracking ID: <?= e($shipment['tracking_number']) ?></div>
        </div>
        <div style="display:flex; gap:10px;">
            <a href="<?= url("/admin/shipments/{$shipment['shipment_number']}/edit") ?>" style="background: #0764d7; color: #fff; padding: 10px 16px; border-radius: 8px; font-weight: 800; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 4px 14px rgba(7, 100, 215, 0.25);">
                ✏️ Edit Shipment Details
            </a>
            <a href="<?= url("/admin/shipments/{$shipment['shipment_number']}/thermal") ?>" target="_blank" style="background: #7c3aed; color: #fff; padding: 10px 16px; border-radius: 8px; font-weight: 800; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 4px 14px rgba(124, 58, 237, 0.25);">
                🧾 Thermal Receipt (4x6)
            </a>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="main-grid">
        <!-- LEFT SECTION: Shipment Information Card -->
        <div class="left-col">
            <div class="card">
                <h2 class="card-title">Shipment Information</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Status</label>
                        <?php
                            $st = $shipment['status'];
                            $badgeClass = '';
                            if ($st === 'delivered') $badgeClass = 'delivered';
                            elseif ($st === 'in_transit') $badgeClass = 'in_transit';
                            elseif ($st === 'out_for_delivery') $badgeClass = 'out_for_delivery';
                        ?>
                        <span class="status-badge <?= $badgeClass ?>"><?= e(str_replace('_', '-', strtolower($st))) ?></span>
                    </div>

                    <div class="info-item">
                        <label>Service Type</label>
                        <b><?= e(strtolower($shipment['service_name'] ?? 'next-day')) ?></b>
                    </div>

                    <div class="info-item">
                        <label>Sender Name</label>
                        <b><?= e($shipment['pickup_address']['name'] ?? 'N/A') ?></b>
                    </div>

                    <div class="info-item">
                        <label>Sender Phone</label>
                        <b><?= e($shipment['pickup_address']['phone'] ?? 'N/A') ?></b>
                    </div>

                    <div class="info-item">
                        <label>Receiver Name</label>
                        <b><?= e($shipment['delivery_address']['name'] ?? 'N/A') ?></b>
                    </div>

                    <div class="info-item">
                        <label>Receiver Phone</label>
                        <b><?= e($shipment['delivery_address']['phone'] ?? 'N/A') ?></b>
                    </div>

                    <div class="info-item">
                        <label>Route</label>
                        <b><?= e($shipment['pickup_address']['city'] ?? 'London') ?> &rarr; <?= e($shipment['delivery_address']['city'] ?? 'Manchester') ?></b>
                    </div>

                    <div class="info-item">
                        <label>Weight</label>
                        <b><?= e($shipment['items'][0]['weight_kg'] ?? '1.0') ?> kg</b>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT SECTION: Update Status & Auto Generate Timeline Cards -->
        <div class="right-col">
            <!-- Card 1: Update Status -->
            <div class="card">
                <h2 class="card-title">Update Status</h2>
                <form action="<?= url("/admin/shipments/{$shipment['id']}/status") ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="field">
                        <label for="statusSelect">Status</label>
                        <select id="statusSelect" name="status" required>
                            <option value="booking_confirmed" <?= $st === 'booking_confirmed' ? 'selected' : '' ?>>Pending / Booked</option>
                            <option value="collected" <?= $st === 'collected' ? 'selected' : '' ?>>Picked Up (Collected)</option>
                            <option value="in_transit" <?= $st === 'in_transit' ? 'selected' : '' ?>>In Transit</option>
                            <option value="out_for_delivery" <?= $st === 'out_for_delivery' ? 'selected' : '' ?>>Out for Delivery</option>
                            <option value="delivered" <?= $st === 'delivered' ? 'selected' : '' ?>>Delivered</option>
                            <option value="on_hold" <?= $st === 'on_hold' ? 'selected' : '' ?>>On Hold</option>
                        </select>
                    </div>

                    <div class="field">
                        <label for="estimatedDelivery">Estimated Delivery</label>
                        <input type="datetime-local" id="estimatedDelivery" name="estimated_delivery" value="<?= !empty($shipment['scheduled_delivery_at']) ? date('Y-m-d\TH:i', strtotime($shipment['scheduled_delivery_at'])) : '' ?>">
                    </div>

                    <button type="submit" class="purple-btn">Update Status</button>
                </form>
            </div>

            <!-- Card 2: Auto Generate Timeline -->
            <div class="card">
                <h2 class="card-title">Auto Generate Timeline</h2>
                <form action="<?= url("/admin/shipments/{$shipment['id']}/auto-generate") ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="field">
                        <label for="pickupDate">Pick Up Date &amp; Time</label>
                        <input type="datetime-local" id="pickupDate" name="pickup_date" value="<?= !empty($shipment['scheduled_pickup_at']) ? date('Y-m-d\TH:i', strtotime($shipment['scheduled_pickup_at'])) : date('Y-m-d\TH:i') ?>">
                    </div>

                    <div class="field">
                        <label for="deliveryDate">Delivery Date &amp; Time</label>
                        <input type="datetime-local" id="deliveryDate" name="delivery_date" value="<?= !empty($shipment['scheduled_delivery_at']) ? date('Y-m-d\TH:i', strtotime($shipment['scheduled_delivery_at'])) : date('Y-m-d\TH:i', strtotime('+1 day')) ?>">
                    </div>

                    <button type="submit" class="purple-btn">Auto Generate Events</button>
                </form>
            </div>
        </div>
    </div>

    <!-- BOTTOM SECTION: Parcel Updates -->
    <div class="card">
        <h2 class="card-title">Parcel Updates</h2>
        <?php if (!empty($shipment['history'])): ?>
            <div class="timeline">
                <?php foreach ($shipment['history'] as $item): ?>
                    <div class="tl-row">
                        <div class="tl-icon">✓</div>
                        <div class="tl-body">
                            <div class="tl-top">
                                <span class="tl-title"><?= e($item['public_message']) ?></span>
                                <span class="tl-time"><?= date('d M Y, h:i A', strtotime($item['created_at'])) ?></span>
                            </div>
                            <?php if (!empty($item['location_label'])): ?>
                                <span class="tl-loc">📍 <?= e($item['location_label']) ?></span>
                            <?php endif; ?>
                        </div>
                        <form action="<?= url("/admin/shipments/{$shipment['shipment_number']}/events/{$item['id']}/delete") ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this event milestone?');" style="margin: 0; flex: none;">
                            <?= csrf_field() ?>
                            <button type="submit" style="background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; border-radius: 8px; padding: 6px 12px; font-size: 11px; font-weight: 800; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
                                🗑️ Delete
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p style="color: var(--muted); font-size: 13px;">No updates recorded yet.</p>
        <?php endif; ?>
    </div>
</div>

<?php $header_title = "Shipment Details"; ?>
<?php $header_subtitle = "Tracking ID: {$shipment['tracking_number']}"; ?>
<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/admin.php'; ?>
