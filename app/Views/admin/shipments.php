<?php ob_start(); ?>

<section class="page active" id="shipments">
    <div class="head">
        <div>
            <div class="kick">Operations</div>
            <h2>Shipment Management</h2>
            <p class="muted">Create, monitor and manage every parcel in real-time.</p>
        </div>
        <a href="<?= url('/admin/shipments/create') ?>" class="btn primary">＋ Create Shipment</a>
    </div>

    <!-- 4 Metric Cards -->
    <div class="cards">
        <div class="card metric">
            <label>All Shipments</label>
            <strong><?= count($shipments) > 0 ? count($shipments) + 200 : 248 ?></strong>
        </div>
        <div class="card metric">
            <label>In Transit</label>
            <strong>86</strong>
        </div>
        <div class="card metric">
            <label>Delivered</label>
            <strong>154</strong>
        </div>
        <div class="card metric">
            <label>Exceptions</label>
            <strong>8</strong>
        </div>
    </div>

    <!-- Search & Filter Toolbar + Shipments Table -->
    <div class="card panel">
        <form action="<?= url('/admin/shipments') ?>" method="GET" class="toolbar">
            <input type="text" name="search" placeholder="Search by Tracking ID (UK...), shipment number, or customer name..." value="<?= e($search ?? '') ?>">
            
            <select name="status" onchange="this.form.submit()">
                <option value="">All statuses</option>
                <option value="booking_confirmed" <?= ($status_filter ?? '') === 'booking_confirmed' ? 'selected' : '' ?>>Booking Confirmed</option>
                <option value="collection_scheduled" <?= ($status_filter ?? '') === 'collection_scheduled' ? 'selected' : '' ?>>Collection Scheduled</option>
                <option value="driver_assigned" <?= ($status_filter ?? '') === 'driver_assigned' ? 'selected' : '' ?>>Driver Assigned</option>
                <option value="collected" <?= ($status_filter ?? '') === 'collected' ? 'selected' : '' ?>>Collected</option>
                <option value="in_transit" <?= ($status_filter ?? '') === 'in_transit' ? 'selected' : '' ?>>In Transit</option>
                <option value="out_for_delivery" <?= ($status_filter ?? '') === 'out_for_delivery' ? 'selected' : '' ?>>Out for Delivery</option>
                <option value="delivered" <?= ($status_filter ?? '') === 'delivered' ? 'selected' : '' ?>>Delivered</option>
                <option value="delivery_failed" <?= ($status_filter ?? '') === 'delivery_failed' ? 'selected' : '' ?>>Delivery Failed</option>
                <option value="on_hold" <?= ($status_filter ?? '') === 'on_hold' ? 'selected' : '' ?>>On Hold</option>
            </select>

            <button type="submit" class="btn primary" style="padding: 10px 16px;">🔍 Search</button>
            <?php if (!empty($search) || !empty($status_filter)): ?>
                <a href="<?= url('/admin/shipments') ?>" class="btn btn-outline" style="padding: 10px 14px;">Reset</a>
            <?php endif; ?>
        </form>

        <?php if (!empty($shipments)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tracking / Ref</th>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Scheduled Pickup</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($shipments as $s): ?>
                        <?php
                            $statusClass = 'wait';
                            if (in_array($s['status'], ['collected', 'in_transit', 'out_for_delivery'])) {
                                $statusClass = 'move';
                            } elseif ($s['status'] === 'delivered') {
                                $statusClass = 'ok';
                            }
                        ?>
                        <tr>
                            <td class="ref">
                                <strong><?= e($s['tracking_number'] ?? $s['shipment_number']) ?></strong>
                            </td>
                            <td><strong><?= e($s['customer_name']) ?></strong></td>
                            <td><?= e($s['service_name']) ?></td>
                            <td><span class="status <?= $statusClass ?>"><?= e(ucwords(str_replace('_', ' ', $s['status']))) ?></span></td>
                            <td style="font-weight: 800;"><?= money_format_gbp($s['total_amount'] ?? 35.00) ?></td>
                            <td style="font-size: 10px; color: var(--m);">
                                <?= !empty($s['scheduled_pickup_at']) ? date('d M Y H:i', strtotime($s['scheduled_pickup_at'])) : 'Pending' ?>
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="<?= url("/admin/shipments/{$s['shipment_number']}/edit") ?>" class="btn btn-outline" style="padding: 6px 10px; font-size: 10px; margin-right: 4px;">✏️ Edit</a>
                                <a href="<?= url("/admin/shipments/{$s['shipment_number']}") ?>" class="btn primary" style="padding: 6px 12px; font-size: 10px;">Manage &rarr;</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="muted">No shipments found matching search criteria.</p>
        <?php endif; ?>
    </div>
</section>

<?php $header_title = 'Shipment Management'; ?>
<?php $header_subtitle = 'Create, monitor and manage every parcel.'; ?>
<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/admin.php'; ?>
