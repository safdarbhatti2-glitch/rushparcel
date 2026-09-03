<?php

namespace App\Services;

use App\Core\Database;
use App\Repositories\QuoteRepository;
use App\Repositories\ShipmentRepository;
use RuntimeException;

class BookingService extends BaseService
{
    protected QuoteRepository $quoteRepo;
    protected ShipmentRepository $shipmentRepo;

    public function __construct(?QuoteRepository $quoteRepo = null, ?ShipmentRepository $shipmentRepo = null)
    {
        $this->quoteRepo = $quoteRepo ?? new QuoteRepository();
        $this->shipmentRepo = $shipmentRepo ?? new ShipmentRepository();
    }

    public function createBookingFromQuote(string $quoteNumber, array $bookingInput): array
    {
        return $this->transaction(function () use ($quoteNumber, $bookingInput) {
            $quote = $this->quoteRepo->findByNumber($quoteNumber);
            if (!$quote) {
                throw new RuntimeException("Quote [{$quoteNumber}] not found.");
            }

            if ($quote['status'] === 'converted') {
                // If already converted, find existing shipment and return it
                $existing = Database::fetch("SELECT shipment_number FROM shipments WHERE quote_id = :qid LIMIT 1", [':qid' => $quote['id']]);
                if ($existing) {
                    return $this->shipmentRepo->findByNumber($existing['shipment_number']);
                }
                throw new RuntimeException("Quote [{$quoteNumber}] has already been converted to a booking.");
            }

            if (strtotime($quote['valid_until']) < time()) {
                throw new RuntimeException("Quote [{$quoteNumber}] has expired. Please calculate a new quote.");
            }

            // Ensure Customer record
            $customerId = $quote['customer_id'];
            if (!$customerId) {
                $email = $bookingInput['pickup_email'] ?? ($quote['guest_email'] ?? 'guest@ukdelivery.co.uk');
                $phone = $bookingInput['pickup_phone'] ?? '07000000000';
                $name = $bookingInput['pickup_name'] ?? 'Guest Sender';

                // Check existing customer by email
                $existingCustomer = Database::fetch("SELECT id FROM customers WHERE email = :email LIMIT 1", [':email' => $email]);
                if ($existingCustomer) {
                    $customerId = (int)$existingCustomer['id'];
                } else {
                    Database::query(
                        "INSERT INTO customers (type, legal_name, email, phone, status) VALUES ('individual', :name, :email, :phone, 'active')",
                        [':name' => $name, ':email' => $email, ':phone' => $phone]
                    );
                    $customerId = (int)Database::lastInsertId();
                }
            }

            $pickupAddress = [
                'name' => $bookingInput['pickup_name'] ?? ($quote['pickup_snapshot']['contact_name'] ?? 'Sender'),
                'phone' => $bookingInput['pickup_phone'] ?? ($quote['pickup_snapshot']['contact_phone'] ?? '07000000000'),
                'postcode' => uk_postcode_format($bookingInput['pickup_postcode'] ?? ($quote['pickup_snapshot']['postcode'] ?? '')),
                'house_number' => $bookingInput['pickup_house_number'] ?? '',
                'street' => $bookingInput['pickup_street'] ?? 'Collection Street',
                'town' => $bookingInput['pickup_town'] ?? 'Town',
                'city' => $bookingInput['pickup_city'] ?? ($bookingInput['pickup_town'] ?? 'City'),
                'county' => $bookingInput['pickup_county'] ?? null,
                'country' => 'United Kingdom',
                'landmark' => $bookingInput['pickup_landmark'] ?? null,
            ];

            $deliveryAddress = [
                'name' => $bookingInput['delivery_name'] ?? ($quote['delivery_snapshot']['contact_name'] ?? 'Recipient'),
                'phone' => $bookingInput['delivery_phone'] ?? ($quote['delivery_snapshot']['contact_phone'] ?? '07000000000'),
                'postcode' => uk_postcode_format($bookingInput['delivery_postcode'] ?? ($quote['delivery_snapshot']['postcode'] ?? '')),
                'house_number' => $bookingInput['delivery_house_number'] ?? '',
                'street' => $bookingInput['delivery_street'] ?? 'Delivery Street',
                'town' => $bookingInput['delivery_town'] ?? 'Town',
                'city' => $bookingInput['delivery_city'] ?? ($bookingInput['delivery_town'] ?? 'City'),
                'county' => $bookingInput['delivery_county'] ?? null,
                'country' => 'United Kingdom',
                'landmark' => $bookingInput['delivery_landmark'] ?? null,
            ];

            // Parcel Items
            $items = [];
            $pricingSnapshot = $quote['pricing_snapshot'];
            $items[] = [
                'description' => "Parcel shipment via " . $quote['service_name'],
                'quantity' => 1,
                'weight_kg' => $pricingSnapshot['actual_weight_kg'] ?? 1.00,
                'length_cm' => 20,
                'width_cm' => 20,
                'height_cm' => 20,
                'package_type' => 'parcel',
                'declared_value' => $bookingInput['declared_value'] ?? 50.00,
            ];

            $scheduledPickup = !empty($bookingInput['scheduled_pickup_date'])
                ? date('Y-m-d H:i:s', strtotime($bookingInput['scheduled_pickup_date'] . ' 09:00:00'))
                : date('Y-m-d H:i:s', strtotime('+1 day 09:00:00'));

            $shipmentData = [
                'customer_id' => $customerId,
                'quote_id' => $quote['id'],
                'service_id' => $quote['service_id'],
                'status' => 'booking_confirmed',
                'scheduled_pickup_at' => $scheduledPickup,
                'scheduled_delivery_at' => null,
                'total_amount' => $quote['total'],
                'currency' => 'GBP',
                'declared_value' => $bookingInput['declared_value'] ?? 50.00,
                'cod_amount' => 0.00,
                'special_instructions' => $bookingInput['special_instructions'] ?? null,
                'created_by' => $bookingInput['user_id'] ?? null,
            ];

            $shipment = $this->shipmentRepo->createShipment($shipmentData, $pickupAddress, $deliveryAddress, $items);

            // Update Quote status to converted
            $this->quoteRepo->updateStatus($quote['id'], 'converted');

            return $shipment;
        });
    }
}
