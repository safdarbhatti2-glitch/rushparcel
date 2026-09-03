<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\Request;
use App\Core\Response;

class TrackingController extends BaseController
{
    public function index(Request $request): Response
    {
        $trackingNumber = trim($request->get('tracking_number', ''));

        if (!empty($trackingNumber)) {
            return $this->show($request, ['trackingNumber' => $trackingNumber]);
        }

        return $this->render('public.track', [
            'title' => 'Track Your Parcel — Rush Parcel',
            'active_page' => 'track',
            'search_tracking' => '',
            'shipment' => null,
            'history' => [],
        ]);
    }

    public function show(Request $request, array $params): Response
    {
        $trackingNumber = strtoupper(trim($params['trackingNumber'] ?? ''));

        $shipment = null;
        $history = [];
        $error = null;

        if (!empty($trackingNumber)) {
            try {
                $shipment = Database::fetch(
                    "SELECT s.id, s.shipment_number, s.tracking_number, s.status, s.scheduled_pickup_at, s.scheduled_delivery_at, s.created_at,
                            srv.name as service_name, c.legal_name as customer_name
                     FROM shipments s
                     JOIN services srv ON s.service_id = srv.id
                     LEFT JOIN customers c ON s.customer_id = c.id
                     WHERE s.tracking_number = :t1 OR s.shipment_number = :t2
                     LIMIT 1",
                    [':t1' => $trackingNumber, ':t2' => $trackingNumber]
                );

                if ($shipment) {
                    $shipmentId = (int)$shipment['id'];

                    $shipment['pickup_address'] = Database::fetch(
                        "SELECT name, phone, city, town, postcode FROM shipment_addresses WHERE shipment_id = :sid AND type = 'pickup' LIMIT 1",
                        [':sid' => $shipmentId]
                    );

                    $shipment['delivery_address'] = Database::fetch(
                        "SELECT name, phone, city, town, postcode FROM shipment_addresses WHERE shipment_id = :sid AND type = 'delivery' LIMIT 1",
                        [':sid' => $shipmentId]
                    );

                    $history = Database::fetchAll(
                        "SELECT old_status, new_status, public_message, location_label, created_at
                         FROM shipment_status_history
                         WHERE shipment_id = :shipment_id
                         ORDER BY created_at DESC",
                        [':shipment_id' => $shipmentId]
                    );

                    $hasDeliveredHistory = false;
                    foreach ($history as $h) {
                        if (($h['new_status'] ?? '') === 'delivered') {
                            $hasDeliveredHistory = true;
                            break;
                        }
                    }

                    $isPastDeliveryDate = !empty($shipment['scheduled_delivery_at']) && strtotime($shipment['scheduled_delivery_at']) <= time();

                    if (($hasDeliveredHistory || $isPastDeliveryDate) && !in_array($shipment['status'] ?? '', ['cancelled', 'on_hold'])) {
                        $shipment['status'] = 'delivered';
                        Database::query("UPDATE shipments SET status = 'delivered' WHERE id = :sid AND status NOT IN ('cancelled', 'on_hold')", [':sid' => $shipmentId]);
                    }
                } else {
                    $error = "No shipment found matching tracking reference [{$trackingNumber}]. Please check your tracking number and try again.";
                }
            } catch (\Throwable $e) {
                $error = "Unable to fetch tracking history at this moment.";
            }
        }

        return $this->render('public.track', [
            'title' => !empty($shipment) ? "Tracking Shipment {$trackingNumber} — Rush Parcel" : "Track Your Parcel",
            'active_page' => 'track',
            'search_tracking' => $trackingNumber,
            'shipment' => $shipment,
            'history' => $history,
            'error_message' => $error,
        ]);
    }
}
