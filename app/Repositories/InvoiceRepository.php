<?php

namespace App\Repositories;

use App\Core\Database;

class InvoiceRepository extends BaseRepository
{
    protected string $table = 'invoices';

    public function generateInvoiceNumber(): string
    {
        $year = date('Y');
        $prefix = 'INV-' . $year . '-';

        $max = Database::fetch(
            "SELECT MAX(CAST(SUBSTRING(invoice_number, 10) AS UNSIGNED)) as last_seq
             FROM invoices
             WHERE invoice_number LIKE :prefix",
            [':prefix' => $prefix . '%']
        );

        $nextSeq = ($max && $max['last_seq']) ? ((int)$max['last_seq'] + 1) : 1;
        return $prefix . str_pad((string)$nextSeq, 6, '0', STR_PAD_LEFT);
    }

    public function createInvoice(array $data, array $items): array
    {
        $invoiceNumber = $this->generateInvoiceNumber();

        $sql = "INSERT INTO invoices (
                    invoice_number, customer_id, shipment_id, quote_id, issue_date, due_date,
                    supplier_name, supplier_address, supplier_vat_number,
                    customer_name, customer_address, customer_vat_number,
                    subtotal, discount, vat_rate, vat_amount, total, currency, status, created_by
                ) VALUES (
                    :invoice_number, :customer_id, :shipment_id, :quote_id, :issue_date, :due_date,
                    :supplier_name, :supplier_address, :supplier_vat_number,
                    :customer_name, :customer_address, :customer_vat_number,
                    :subtotal, :discount, :vat_rate, :vat_amount, :total, :currency, :status, :created_by
                )";

        Database::query($sql, [
            ':invoice_number' => $invoiceNumber,
            ':customer_id' => $data['customer_id'],
            ':shipment_id' => $data['shipment_id'] ?? null,
            ':quote_id' => $data['quote_id'] ?? null,
            ':issue_date' => $data['issue_date'] ?? date('Y-m-d'),
            ':due_date' => $data['due_date'] ?? date('Y-m-d', strtotime('+30 days')),
            ':supplier_name' => $data['supplier_name'] ?? 'Rush Parcel Ltd',
            ':supplier_address' => $data['supplier_address'] ?? "Logistics Centre, Park Royal, London NW10 7XQ",
            ':supplier_vat_number' => $data['supplier_vat_number'] ?? 'GB 987 6543 21',
            ':customer_name' => $data['customer_name'],
            ':customer_address' => $data['customer_address'],
            ':customer_vat_number' => $data['customer_vat_number'] ?? null,
            ':subtotal' => $data['subtotal'],
            ':discount' => $data['discount'] ?? 0.00,
            ':vat_rate' => $data['vat_rate'] ?? 20.00,
            ':vat_amount' => $data['vat_amount'],
            ':total' => $data['total'],
            ':currency' => $data['currency'] ?? 'GBP',
            ':status' => $data['status'] ?? 'draft',
            ':created_by' => $data['created_by'] ?? null,
        ]);

        $invoiceId = (int)Database::lastInsertId();

        foreach ($items as $item) {
            Database::query(
                "INSERT INTO invoice_items (
                    invoice_id, description, quantity, unit_price, discount, vat_rate, vat_amount, line_total, reference_type, reference_id
                 ) VALUES (
                    :invoice_id, :desc, :qty, :unit_price, :discount, :vat_rate, :vat_amount, :line_total, :ref_type, :ref_id
                 )",
                [
                    ':invoice_id' => $invoiceId,
                    ':desc' => $item['description'],
                    ':qty' => $item['quantity'] ?? 1,
                    ':unit_price' => $item['unit_price'],
                    ':discount' => $item['discount'] ?? 0.00,
                    ':vat_rate' => $item['vat_rate'] ?? 20.00,
                    ':vat_amount' => $item['vat_amount'] ?? 0.00,
                    ':line_total' => $item['line_total'],
                    ':ref_type' => $item['reference_type'] ?? null,
                    ':ref_id' => $item['reference_id'] ?? null,
                ]
            );
        }

        return $this->findByNumber($invoiceNumber);
    }

    public function findByNumber(string $invoiceNumber): ?array
    {
        $invoice = Database::fetch(
            "SELECT i.*, c.legal_name as customer_company, c.email as customer_email
             FROM invoices i
             JOIN customers c ON i.customer_id = c.id
             WHERE i.invoice_number = :num LIMIT 1",
            [':num' => $invoiceNumber]
        );

        if ($invoice) {
            $invoice['items'] = Database::fetchAll("SELECT * FROM invoice_items WHERE invoice_id = :iid", [':iid' => $invoice['id']]);
            $invoice['payments'] = Database::fetchAll("SELECT * FROM payments WHERE invoice_id = :iid ORDER BY paid_at DESC", [':iid' => $invoice['id']]);
            $invoice['total_paid'] = (float)Database::fetch("SELECT SUM(amount) as paid FROM payments WHERE invoice_id = :iid", [':iid' => $invoice['id']])['paid'];
            $invoice['balance_due'] = max(0.0, (float)$invoice['total'] - $invoice['total_paid']);
        }

        return $invoice;
    }
}
