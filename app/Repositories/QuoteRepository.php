<?php

namespace App\Repositories;

use App\Core\Database;

class QuoteRepository extends BaseRepository
{
    protected string $table = 'quotes';

    public function generateQuoteNumber(): string
    {
        $prefix = 'Q-' . date('Y') . '-';
        $random = strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
        $number = $prefix . $random;

        // Ensure uniqueness
        $existing = Database::fetch("SELECT id FROM quotes WHERE quote_number = :num", [':num' => $number]);
        if ($existing) {
            return $this->generateQuoteNumber();
        }

        return $number;
    }

    public function createQuote(array $data, array $items): array
    {
        $quoteNumber = $this->generateQuoteNumber();

        $sql = "INSERT INTO quotes (
                    quote_number, customer_id, guest_email, service_id,
                    pickup_snapshot_json, delivery_snapshot_json, subtotal, discount,
                    vat_rate, vat_amount, total, currency, status, valid_until,
                    pricing_snapshot_json, created_by
                ) VALUES (
                    :quote_number, :customer_id, :guest_email, :service_id,
                    :pickup_json, :delivery_json, :subtotal, :discount,
                    :vat_rate, :vat_amount, :total, :currency, :status, :valid_until,
                    :pricing_json, :created_by
                )";

        Database::query($sql, [
            ':quote_number' => $quoteNumber,
            ':customer_id' => $data['customer_id'] ?? null,
            ':guest_email' => $data['guest_email'] ?? null,
            ':service_id' => $data['service_id'],
            ':pickup_json' => json_encode($data['pickup_snapshot']),
            ':delivery_json' => json_encode($data['delivery_snapshot']),
            ':subtotal' => $data['subtotal'],
            ':discount' => $data['discount'] ?? 0.00,
            ':vat_rate' => $data['vat_rate'] ?? 20.00,
            ':vat_amount' => $data['vat_amount'],
            ':total' => $data['total'],
            ':currency' => $data['currency'] ?? 'GBP',
            ':status' => $data['status'] ?? 'priced',
            ':valid_until' => $data['valid_until'] ?? date('Y-m-d H:i:s', strtotime('+7 days')),
            ':pricing_json' => json_encode($data['pricing_snapshot']),
            ':created_by' => $data['created_by'] ?? null,
        ]);

        $quoteId = (int)Database::lastInsertId();

        // Insert quote items
        foreach ($items as $item) {
            Database::query(
                "INSERT INTO quote_items (quote_id, description, quantity, unit_price, line_total, metadata_json)
                 VALUES (:quote_id, :desc, :qty, :unit_price, :line_total, :meta_json)",
                [
                    ':quote_id' => $quoteId,
                    ':desc' => $item['description'],
                    ':qty' => $item['quantity'] ?? 1,
                    ':unit_price' => $item['unit_price'],
                    ':line_total' => $item['line_total'],
                    ':meta_json' => isset($item['metadata']) ? json_encode($item['metadata']) : null,
                ]
            );
        }

        return $this->findByNumber($quoteNumber);
    }

    public function findByNumber(string $quoteNumber): ?array
    {
        $quote = Database::fetch(
            "SELECT q.*, s.name as service_name, s.slug as service_slug
             FROM quotes q
             JOIN services s ON q.service_id = s.id
             WHERE q.quote_number = :num LIMIT 1",
            [':num' => $quoteNumber]
        );

        if ($quote) {
            $quote['items'] = Database::fetchAll(
                "SELECT * FROM quote_items WHERE quote_id = :qid",
                [':qid' => $quote['id']]
            );
            $quote['pickup_snapshot'] = json_decode($quote['pickup_snapshot_json'] ?? '{}', true);
            $quote['delivery_snapshot'] = json_decode($quote['delivery_snapshot_json'] ?? '{}', true);
            $quote['pricing_snapshot'] = json_decode($quote['pricing_snapshot_json'] ?? '{}', true);
        }

        return $quote;
    }

    public function updateStatus(int $quoteId, string $status, ?string $acceptedAt = null): bool
    {
        $sql = "UPDATE quotes SET status = :status, accepted_at = :accepted_at, updated_at = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt = Database::prepare($sql);
        return $stmt->execute([
            ':status' => $status,
            ':accepted_at' => $acceptedAt,
            ':id' => $quoteId,
        ]);
    }
}
