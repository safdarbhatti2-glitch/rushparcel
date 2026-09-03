<?php

namespace App\Services;

use App\Core\Config;
use App\Core\Database;

class NotificationService extends BaseService
{
    public function sendShipmentNotification(int $shipmentId, string $event, array $extraData = []): bool
    {
        $shipment = Database::fetch(
            "SELECT s.*, c.email as customer_email, c.legal_name as customer_name
             FROM shipments s
             JOIN customers c ON s.customer_id = c.id
             WHERE s.id = :id LIMIT 1",
            [':id' => $shipmentId]
        );

        if (!$shipment) {
            return false;
        }

        $email = $shipment['customer_email'];
        $trackingNumber = $shipment['tracking_number'];

        $subjects = [
            'booking_confirmed' => "Booking Confirmed — Tracking Reference: {$trackingNumber}",
            'collected' => "Parcel Collected — Tracking Reference: {$trackingNumber}",
            'out_for_delivery' => "Out for Delivery Today — Tracking Reference: {$trackingNumber}",
            'delivered' => "Parcel Delivered Successfully — Tracking Reference: {$trackingNumber}",
        ];

        $subject = $subjects[$event] ?? "Shipment Update [{$trackingNumber}]";

        // Log notification record in notifications table
        Database::query(
            "INSERT INTO notifications (user_id, channel, recipient, template_key, payload_json, status, sent_at)
             VALUES (NULL, 'email', :recipient, :tmpl, :json, 'sent', CURRENT_TIMESTAMP)",
            [
                ':recipient' => $email,
                ':tmpl' => 'shipment_' . $event,
                ':json' => json_encode(array_merge([
                    'subject' => $subject,
                    'tracking_number' => $trackingNumber,
                    'shipment_number' => $shipment['shipment_number'],
                    'customer_name' => $shipment['customer_name'],
                ], $extraData)),
            ]
        );

        return true;
    }
}
