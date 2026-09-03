<?php

namespace App\Services;

use App\Core\Database;
use App\Repositories\InvoiceRepository;
use RuntimeException;

class InvoiceService extends BaseService
{
    protected InvoiceRepository $invoiceRepo;

    public function __construct(?InvoiceRepository $invoiceRepo = null)
    {
        $this->invoiceRepo = $invoiceRepo ?? new InvoiceRepository();
    }

    public function createInvoiceFromShipment(int $shipmentId, ?int $createdBy = null): array
    {
        return $this->transaction(function () use ($shipmentId, $createdBy) {
            $shipment = Database::fetch(
                "SELECT s.*, c.legal_name as customer_name, c.email as customer_email
                 FROM shipments s
                 JOIN customers c ON s.customer_id = c.id
                 WHERE s.id = :id LIMIT 1",
                [':id' => $shipmentId]
            );

            if (!$shipment) {
                throw new RuntimeException("Shipment [ID: {$shipmentId}] not found.");
            }

            // Fetch pickup address for invoice customer address
            $address = Database::fetch("SELECT * FROM shipment_addresses WHERE shipment_id = :sid AND type = 'pickup' LIMIT 1", [':sid' => $shipmentId]);
            $fullAddress = ($address['house_number'] ?? '') . ' ' . ($address['street'] ?? '') . ', ' . ($address['town'] ?? '') . ', ' . ($address['postcode'] ?? '');

            $vatRate = (float)config('app.vat_rate', 20.0);
            $total = (float)$shipment['total_amount'];
            $subtotal = round($total / (1 + ($vatRate / 100.0)), 2);
            $vatAmount = round($total - $subtotal, 2);

            $invoiceData = [
                'customer_id' => $shipment['customer_id'],
                'shipment_id' => $shipment['id'],
                'quote_id' => $shipment['quote_id'],
                'issue_date' => !empty($shipment['scheduled_pickup_at']) ? date('Y-m-d', strtotime($shipment['scheduled_pickup_at'])) : date('Y-m-d'),
                'due_date' => !empty($shipment['scheduled_pickup_at']) ? date('Y-m-d', strtotime($shipment['scheduled_pickup_at'] . ' +30 days')) : date('Y-m-d', strtotime('+30 days')),
                'customer_name' => $shipment['customer_name'],
                'customer_address' => $fullAddress,
                'subtotal' => $subtotal,
                'discount' => 0.00,
                'vat_rate' => $vatRate,
                'vat_amount' => $vatAmount,
                'total' => $total,
                'currency' => 'GBP',
                'status' => 'issued',
                'created_by' => $createdBy,
            ];

            $items = [
                [
                    'description' => "Freight Shipment Carriage ({$shipment['shipment_number']}) — Tracking Ref: {$shipment['tracking_number']}",
                    'quantity' => 1,
                    'unit_price' => $subtotal,
                    'line_total' => $subtotal,
                    'vat_rate' => $vatRate,
                    'vat_amount' => $vatAmount,
                    'reference_type' => 'shipment',
                    'reference_id' => $shipmentId,
                ]
            ];

            return $this->invoiceRepo->createInvoice($invoiceData, $items);
        });
    }

    public function recordPayment(int $invoiceId, float $amount, string $method, string $reference, int $actorUserId, ?string $notes = null): array
    {
        return $this->transaction(function () use ($invoiceId, $amount, $method, $reference, $actorUserId, $notes) {
            $invoice = Database::fetch("SELECT * FROM invoices WHERE id = :id LIMIT 1", [':id' => $invoiceId]);
            if (!$invoice) {
                throw new RuntimeException("Invoice [ID: {$invoiceId}] not found.");
            }

            if ($invoice['status'] === 'void') {
                throw new RuntimeException("Cannot record payment against a voided invoice.");
            }

            Database::query(
                "INSERT INTO payments (invoice_id, amount, payment_method, transaction_reference, paid_at, recorded_by, notes)
                 VALUES (:iid, :amount, :method, :ref, CURRENT_TIMESTAMP, :rec_by, :notes)",
                [
                    ':iid' => $invoiceId,
                    ':amount' => $amount,
                    ':method' => $method,
                    ':ref' => $reference,
                    ':rec_by' => $actorUserId,
                    ':notes' => $notes,
                ]
            );

            // Re-calculate total payments
            $totalPaid = (float)Database::fetch("SELECT SUM(amount) as paid FROM payments WHERE invoice_id = :iid", [':iid' => $invoiceId])['paid'];
            $invoiceTotal = (float)$invoice['total'];

            $newStatus = ($totalPaid >= $invoiceTotal) ? 'paid' : 'partially_paid';
            Database::query("UPDATE invoices SET status = :st, updated_at = CURRENT_TIMESTAMP WHERE id = :id", [
                ':st' => $newStatus,
                ':id' => $invoiceId,
            ]);

            // Audit log
            Database::query(
                "INSERT INTO audit_logs (actor_user_id, action, entity_type, entity_id, new_values_json, ip_address, user_agent)
                 VALUES (:actor, 'record_payment', 'invoice', :iid, :json, '127.0.0.1', 'System')",
                [
                    ':actor' => $actorUserId,
                    ':iid' => $invoiceId,
                    ':json' => json_encode(['amount' => $amount, 'method' => $method, 'reference' => $reference, 'new_status' => $newStatus]),
                ]
            );

            return $this->invoiceRepo->findByNumber($invoice['invoice_number']);
        });
    }

    public function voidInvoice(int $invoiceId, string $reason, int $actorUserId): bool
    {
        return $this->transaction(function () use ($invoiceId, $reason, $actorUserId) {
            $invoice = Database::fetch("SELECT status FROM invoices WHERE id = :id LIMIT 1", [':id' => $invoiceId]);
            if (!$invoice) {
                throw new RuntimeException("Invoice not found.");
            }

            Database::query(
                "UPDATE invoices SET status = 'void', voided_at = CURRENT_TIMESTAMP, updated_at = CURRENT_TIMESTAMP WHERE id = :id",
                [':id' => $invoiceId]
            );

            Database::query(
                "INSERT INTO audit_logs (actor_user_id, action, entity_type, entity_id, new_values_json, ip_address, user_agent)
                 VALUES (:actor, 'void_invoice', 'invoice', :iid, :json, '127.0.0.1', 'System')",
                [
                    ':actor' => $actorUserId,
                    ':iid' => $invoiceId,
                    ':json' => json_encode(['reason' => $reason]),
                ]
            );

            return true;
        });
    }
}
