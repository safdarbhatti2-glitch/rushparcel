<?php

namespace App\Repositories;

use App\Core\Database;

class ShipmentRepository extends BaseRepository
{
    protected string $table = 'shipments';

    protected array $allowedTransitions = [
        'booking_confirmed' => ['collection_scheduled', 'driver_assigned', 'cancelled', 'on_hold'],
        'collection_scheduled' => ['driver_assigned', 'collected', 'cancelled', 'on_hold'],
        'driver_assigned' => ['collected', 'collection_scheduled', 'cancelled', 'on_hold'],
        'collected' => ['at_depot', 'in_transit', 'out_for_delivery', 'on_hold'],
        'at_depot' => ['in_transit', 'out_for_delivery', 'customs_clearance', 'on_hold'],
        'in_transit' => ['at_depot', 'out_for_delivery', 'customs_clearance', 'on_hold'],
        'customs_clearance' => ['at_depot', 'in_transit', 'out_for_delivery', 'on_hold'],
        'out_for_delivery' => ['delivered', 'delivery_attempted', 'delivery_failed', 'on_hold'],
        'delivery_attempted' => ['out_for_delivery', 'at_depot', 'returned', 'on_hold'],
        'delivery_failed' => ['out_for_delivery', 'returned', 'on_hold'],
        'on_hold' => ['booking_confirmed', 'collection_scheduled', 'driver_assigned', 'collected', 'at_depot', 'in_transit', 'out_for_delivery', 'cancelled'],
        'delivered' => [],
        'returned' => [],
        'cancelled' => [],
    ];

    public function generateShipmentNumber(): string
    {
        $prefix = 'SH-' . date('Y') . '-';
        $random = strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
        $number = $prefix . $random;

        $existing = Database::fetch("SELECT id FROM shipments WHERE shipment_number = :num", [':num' => $number]);
        if ($existing) {
            return $this->generateShipmentNumber();
        }

        return $number;
    }

    public function generateTrackingNumber(): string
    {
        $digits = '';
        for ($i = 0; $i < 10; $i++) {
            $digits .= mt_rand(0, 9);
        }
        $trackingNumber = 'UK' . $digits;

        $existing = Database::fetch("SELECT id FROM shipments WHERE tracking_number = :track", [':track' => $trackingNumber]);
        if ($existing) {
            return $this->generateTrackingNumber();
        }

        return $trackingNumber;
    }

    public function createShipment(array $data, array $pickupAddress, array $deliveryAddress, array $items): array
    {
        $shipmentNumber = $this->generateShipmentNumber();
        $trackingNumber = $this->generateTrackingNumber();

        $sql = "INSERT INTO shipments (
                    shipment_number, tracking_number, customer_id, quote_id, service_id,
                    status, scheduled_pickup_at, scheduled_delivery_at, total_amount,
                    currency, declared_value, cod_amount, special_instructions, created_by
                ) VALUES (
                    :shipment_number, :tracking_number, :customer_id, :quote_id, :service_id,
                    :status, :scheduled_pickup, :scheduled_delivery, :total_amount,
                    :currency, :declared_value, :cod_amount, :special_instructions, :created_by
                )";

        Database::query($sql, [
            ':shipment_number' => $shipmentNumber,
            ':tracking_number' => $trackingNumber,
            ':customer_id' => $data['customer_id'],
            ':quote_id' => $data['quote_id'] ?? null,
            ':service_id' => $data['service_id'],
            ':status' => $data['status'] ?? 'booking_confirmed',
            ':scheduled_pickup' => $data['scheduled_pickup_at'] ?? null,
            ':scheduled_delivery' => $data['scheduled_delivery_at'] ?? null,
            ':total_amount' => $data['total_amount'],
            ':currency' => $data['currency'] ?? 'GBP',
            ':declared_value' => $data['declared_value'] ?? 0.00,
            ':cod_amount' => $data['cod_amount'] ?? 0.00,
            ':special_instructions' => $data['special_instructions'] ?? null,
            ':created_by' => $data['created_by'] ?? null,
        ]);

        $shipmentId = (int)Database::lastInsertId();

        // Insert Addresses (Pickup & Delivery)
        $addrSql = "INSERT INTO shipment_addresses (
                        shipment_id, type, name, phone, postcode, house_number, street, town, city, county, country, landmark
                    ) VALUES (
                        :shipment_id, :type, :name, :phone, :postcode, :house_number, :street, :town, :city, :county, :country, :landmark
                    )";

        Database::query($addrSql, [
            ':shipment_id' => $shipmentId,
            ':type' => 'pickup',
            ':name' => $pickupAddress['name'],
            ':phone' => $pickupAddress['phone'],
            ':postcode' => uk_postcode_format($pickupAddress['postcode']),
            ':house_number' => $pickupAddress['house_number'] ?? null,
            ':street' => $pickupAddress['street'],
            ':town' => $pickupAddress['town'],
            ':city' => $pickupAddress['city'] ?? $pickupAddress['town'],
            ':county' => $pickupAddress['county'] ?? null,
            ':country' => $pickupAddress['country'] ?? 'United Kingdom',
            ':landmark' => $pickupAddress['landmark'] ?? null,
        ]);

        Database::query($addrSql, [
            ':shipment_id' => $shipmentId,
            ':type' => 'delivery',
            ':name' => $deliveryAddress['name'],
            ':phone' => $deliveryAddress['phone'],
            ':postcode' => uk_postcode_format($deliveryAddress['postcode']),
            ':house_number' => $deliveryAddress['house_number'] ?? null,
            ':street' => $deliveryAddress['street'],
            ':town' => $deliveryAddress['town'],
            ':city' => $deliveryAddress['city'] ?? $deliveryAddress['town'],
            ':county' => $deliveryAddress['county'] ?? null,
            ':country' => $deliveryAddress['country'] ?? 'United Kingdom',
            ':landmark' => $deliveryAddress['landmark'] ?? null,
        ]);

        // Insert Items
        $itemSql = "INSERT INTO shipment_items (
                        shipment_id, description, quantity, weight_kg, length_cm, width_cm, height_cm, package_type, declared_value
                    ) VALUES (
                        :shipment_id, :desc, :qty, :weight, :length, :width, :height, :pkg_type, :val
                    )";

        foreach ($items as $item) {
            Database::query($itemSql, [
                ':shipment_id' => $shipmentId,
                ':desc' => $item['description'] ?? 'Parcel',
                ':qty' => $item['quantity'] ?? 1,
                ':weight' => $item['weight_kg'] ?? 1.00,
                ':length' => $item['length_cm'] ?? 10.00,
                ':width' => $item['width_cm'] ?? 10.00,
                ':height' => $item['height_cm'] ?? 10.00,
                ':pkg_type' => $item['package_type'] ?? 'parcel',
                ':val' => $item['declared_value'] ?? 0.00,
            ]);
        }

        // Insert Initial History Record
        Database::query(
            "INSERT INTO shipment_status_history (
                shipment_id, old_status, new_status, public_message, internal_note, location_label, actor_user_id
             ) VALUES (
                :shipment_id, NULL, :new_status, :pub_msg, :int_note, :loc, :actor
             )",
            [
                ':shipment_id' => $shipmentId,
                ':new_status' => $data['status'] ?? 'booking_confirmed',
                ':pub_msg' => 'Booking confirmed. Order received and pending collection scheduling.',
                ':int_note' => 'System created booking from quotation',
                ':loc' => $pickupAddress['town'] ?? 'UK Hub',
                ':actor' => $data['created_by'] ?? null,
            ]
        );

        return $this->findByNumber($shipmentNumber);
    }

    public function findByNumber(string $shipmentNumber): ?array
    {
        $shipment = Database::fetch(
            "SELECT s.*, srv.name as service_name, srv.slug as service_slug, c.legal_name as customer_name, c.email as customer_email
             FROM shipments s
             LEFT JOIN services srv ON s.service_id = srv.id
             LEFT JOIN customers c ON s.customer_id = c.id
             WHERE s.shipment_number = :num LIMIT 1",
            [':num' => $shipmentNumber]
        );

        if ($shipment) {
            $shipment['pickup_address'] = Database::fetch(
                "SELECT * FROM shipment_addresses WHERE shipment_id = :sid AND type = 'pickup' LIMIT 1",
                [':sid' => $shipment['id']]
            );
            $shipment['delivery_address'] = Database::fetch(
                "SELECT * FROM shipment_addresses WHERE shipment_id = :sid AND type = 'delivery' LIMIT 1",
                [':sid' => $shipment['id']]
            );
            $shipment['items'] = Database::fetchAll(
                "SELECT * FROM shipment_items WHERE shipment_id = :sid",
                [':sid' => $shipment['id']]
            );
            $shipment['history'] = Database::fetchAll(
                "SELECT * FROM shipment_status_history WHERE shipment_id = :sid ORDER BY created_at DESC",
                [':sid' => $shipment['id']]
            );
        }

        return $shipment;
    }

    public function findByTrackingNumber(string $trackingNumber): ?array
    {
        $shipment = Database::fetch("SELECT shipment_number FROM shipments WHERE tracking_number = :track LIMIT 1", [':track' => $trackingNumber]);
        return $shipment ? $this->findByNumber($shipment['shipment_number']) : null;
    }

    public function isValidStatusTransition(string $currentStatus, string $newStatus): bool
    {
        if ($currentStatus === $newStatus) {
            return true;
        }

        $allowed = $this->allowedTransitions[$currentStatus] ?? [];
        return in_array($newStatus, $allowed);
    }

    public function updateStatus(
        int $shipmentId,
        string $newStatus,
        string $publicMessage,
        ?string $internalNote = null,
        ?string $locationLabel = null,
        ?int $actorUserId = null
    ): bool {
        $shipment = Database::fetch("SELECT status FROM shipments WHERE id = :id LIMIT 1", [':id' => $shipmentId]);
        if (!$shipment) {
            return false;
        }

        $oldStatus = $shipment['status'];

        if (!$this->isValidStatusTransition($oldStatus, $newStatus)) {
            throw new \RuntimeException("Invalid status transition from [{$oldStatus}] to [{$newStatus}].");
        }

        Database::query("UPDATE shipments SET status = :status, updated_at = CURRENT_TIMESTAMP WHERE id = :id", [
            ':status' => $newStatus,
            ':id' => $shipmentId,
        ]);

        Database::query(
            "INSERT INTO shipment_status_history (
                shipment_id, old_status, new_status, public_message, internal_note, location_label, actor_user_id
             ) VALUES (
                :shipment_id, :old_status, :new_status, :pub_msg, :int_note, :loc, :actor
             )",
            [
                ':shipment_id' => $shipmentId,
                ':old_status' => $oldStatus,
                ':new_status' => $newStatus,
                ':pub_msg' => $publicMessage,
                ':int_note' => $internalNote,
                ':loc' => $locationLabel,
                ':actor' => $actorUserId,
            ]
        );

        return true;
    }
}
