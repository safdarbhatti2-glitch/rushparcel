<?php ob_start(); ?>

<section class="page active" id="invoices">
    <div class="head">
        <div>
            <div class="kick">Finance</div>
            <h2>Receipts &amp; Invoices</h2>
            <p class="muted">Billing records, receipts and VAT-ready documents.</p>
        </div>
        <a href="<?= url('/admin/shipments/create') ?>" class="btn primary">＋ Create Invoice</a>
    </div>

    <!-- 4 Finance Metric Cards -->
    <div class="cards">
        <div class="card metric">
            <label>Issued</label>
            <strong>£18.4k</strong>
            <small>This month</small>
        </div>
        <div class="card metric">
            <label>Paid</label>
            <strong>£14.8k</strong>
            <small>80.4% collected</small>
        </div>
        <div class="card metric">
            <label>Outstanding</label>
            <strong>£3.6k</strong>
            <small>Requires follow-up</small>
        </div>
        <div class="card metric">
            <label>Receipts</label>
            <strong>196</strong>
            <small>Generated</small>
        </div>
    </div>

    <!-- Invoices Table & Toolbar -->
        <form action="<?= url('/admin/invoices') ?>" method="GET" class="toolbar" style="margin-bottom: 20px;">
            <input type="text" name="search" placeholder="Search invoice number, tracking ID (UK...), customer or shipment..." value="<?= e($search ?? '') ?>">
            <select name="status" onchange="this.form.submit()">
                <option value="">All billing status</option>
                <option value="paid" <?= ($status_filter ?? '') === 'paid' ? 'selected' : '' ?>>Paid</option>
                <option value="issued" <?= ($status_filter ?? '') === 'issued' ? 'selected' : '' ?>>Issued / Outstanding</option>
            </select>
            <button type="submit" class="btn primary" style="padding: 10px 16px;">🔍 Search</button>
            <?php if (!empty($search) || !empty($status_filter)): ?>
                <a href="<?= url('/admin/invoices') ?>" class="btn btn-outline" style="padding: 10px 14px;">Reset</a>
            <?php endif; ?>
        </form>

        <?php if (!empty($invoices)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Shipment</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Document</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoices as $inv): ?>
                        <?php $isPaid = $inv['status'] === 'paid'; ?>
                        <?php $amount = $inv['total'] ?? $inv['total_amount'] ?? 0.0; ?>
                        <tr>
                            <td class="ref">
                                <a href="<?= url("/admin/invoices/{$inv['invoice_number']}/pdf") ?>" target="_blank" style="color: var(--b); font-weight: 800; text-decoration: underline;">
                                    <?= e($inv['invoice_number']) ?>
                                </a>
                            </td>
                            <td><strong><?= e($inv['customer_name'] ?? 'Rush Parcel Customer') ?></strong></td>
                            <td>
                                <?php if (!empty($inv['shipment_number'])): ?>
                                    <a href="<?= url("/admin/shipments/{$inv['shipment_number']}") ?>" style="color: #0284c7; font-weight: 700;">
                                        <?= e($inv['shipment_number']) ?>
                                    </a>
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                            <td><?= date('d M Y', strtotime($inv['created_at'])) ?></td>
                            <td style="font-weight: 800;"><?= money_format_gbp($amount) ?></td>
                            <td>
                                <span class="status <?= $isPaid ? 'ok' : 'wait' ?>"><?= e(ucwords($inv['status'])) ?></span>
                            </td>
                            <td style="display:flex; gap:12px; align-items:center;">
                                <a href="<?= url("/admin/invoices/{$inv['invoice_number']}/pdf") ?>" target="_blank" style="color: var(--b); font-weight: 800;">📄 PDF &middot; <?= $isPaid ? 'Receipt' : 'Invoice' ?></a>
                                <a href="<?= url("/admin/invoices/{$inv['invoice_number']}/thermal") ?>" target="_blank" style="color: #7c3aed; font-weight: 800; background: #f3e8ff; padding: 4px 10px; border-radius: 6px; text-decoration: none; font-size: 12px;">🧾 Thermal Receipt</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="padding: 30px; text-align: center; color: var(--m); font-size: 13px; font-weight: 700;">
                No invoice or receipt records found matching <?= !empty($search) ? 'search term "' . e($search) . '"' : 'your criteria' ?>.
            </p>
        <?php endif; ?>
    </div>
</section>

<?php $header_title = 'Receipts & Invoices'; ?>
<?php $header_subtitle = 'Billing records, receipts and VAT-ready documents.'; ?>
<?php $content = ob_get_clean(); ?>
<?php include APP_PATH . '/Views/layouts/admin.php'; ?>
