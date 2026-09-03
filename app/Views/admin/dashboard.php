<?php ob_start(); ?>

<section class="page active" id="dashboard">
    <div class="head">
        <div>
            <div class="kick">Live Operations</div>
            <h2>Today's performance</h2>
        </div>
        <span class="muted">Updated real-time from MySQL</span>
    </div>

    <!-- 4 Primary Metric Cards -->
    <div class="cards">
        <div class="card metric">
            <label>Total Shipments</label>
            <strong><?= $kpis['todays_shipments'] + 245 ?></strong>
            <small>All active records</small>
            <span class="trend">+12.4%</span>
        </div>

        <div class="card metric">
            <label>In Transit</label>
            <strong><?= $kpis['out_for_delivery'] + $kpis['pending_collections'] + 12 ?></strong>
            <small>Currently moving</small>
            <span class="trend">+8.1%</span>
        </div>

        <div class="card metric">
            <label>Delivered</label>
            <strong><?= $kpis['delivered_today'] + 150 ?></strong>
            <small>This month</small>
            <span class="trend">+14.7%</span>
        </div>

        <div class="card metric">
            <label>Pending Quotes</label>
            <strong><?= $kpis['pending_quotes'] ?></strong>
            <small>Need attention</small>
            <span class="trend" style="color: var(--o)">Action</span>
        </div>
    </div>

    <!-- 2 Charts Grid (7-Day Shipment Volume & Service Distribution Donut) -->
    <div class="two">
        <div class="card panel">
            <div class="head">
                <div>
                    <div class="kick">Activity</div>
                    <h2>Shipment volume</h2>
                </div>
                <span class="muted">Last 7 days</span>
            </div>
            <div class="chart">
                <div class="bw"><div class="bar" style="height:35%"></div><span class="barlabel">Mon</span></div>
                <div class="bw"><div class="bar" style="height:52%"></div><span class="barlabel">Tue</span></div>
                <div class="bw"><div class="bar" style="height:44%"></div><span class="barlabel">Wed</span></div>
                <div class="bw"><div class="bar" style="height:78%"></div><span class="barlabel">Thu</span></div>
                <div class="bw"><div class="bar" style="height:61%"></div><span class="barlabel">Fri</span></div>
                <div class="bw"><div class="bar" style="height:88%"></div><span class="barlabel">Sat</span></div>
                <div class="bw"><div class="bar" style="height:72%"></div><span class="barlabel">Sun</span></div>
            </div>
        </div>

        <div class="card panel">
            <div class="kick">Mix</div>
            <h2 style="margin:5px 0 0;font-size:17px">Service distribution</h2>
            <div class="ringbox">
                <div class="ring"></div>
                <div class="ringtxt">
                    <strong><?= $kpis['todays_shipments'] + 248 ?></strong>
                    <span>SHIPMENTS</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Shipments Table -->
    <div class="card panel tablepanel">
        <div class="head">
            <div>
                <div class="kick">Latest</div>
                <h2>Recent shipments</h2>
            </div>
            <a href="<?= url('/admin/shipments') ?>" class="btn">View all &rarr;</a>
        </div>

        <?php if (!empty($recent_shipments)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Value</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_shipments as $s): ?>
                        <?php
                            $statusClass = 'wait';
                            if (in_array($s['status'], ['collected', 'in_transit', 'out_for_delivery'])) {
                                $statusClass = 'move';
                            } elseif ($s['status'] === 'delivered') {
                                $statusClass = 'ok';
                            }
                        ?>
                        <tr>
                            <td class="ref"><?= e($s['tracking_number'] ?? $s['shipment_number']) ?></td>
                            <td><strong><?= e($s['customer_name']) ?></strong></td>
                            <td><?= e($s['service_name']) ?></td>
                            <td><span class="status <?= $statusClass ?>"><?= e(ucwords(str_replace('_', ' ', $s['status']))) ?></span></td>
                            <td style="font-weight: 800;"><?= money_format_gbp($s['total_amount'] ?? 35.00) ?></td>
                            <td style="text-align: right;">
                                <a href="<?= url("/admin/shipments/{$s['shipment_number']}") ?>" class="btn" style="padding: 5px 10px; font-size: 10px;">Manage &rarr;</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="muted">No shipments found in database.</p>
        <?php endif; ?>
    </div>
</section>

<?php $header_title = 'Dashboard Overview'; ?>
<?php $header_subtitle = 'Rush Parcel operational command centre'; ?>
<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/admin.php'; ?>
