<?php

namespace Tests;

use App\Core\App;
use App\Services\QuoteService;
use App\Services\BookingService;
use App\Repositories\ShipmentRepository;

/**
 * Booking Engine & Shipment State Machine Test Suite.
 */
class BookingEngineTest
{
    protected int $passed = 0;
    protected int $failed = 0;
    protected array $errors = [];

    public static function run(): void
    {
        $test = new static();
        $test->executeAll();
    }

    public function executeAll(): void
    {
        $basePath = dirname(__DIR__);
        require_once $basePath . '/app/Core/App.php';
        App::boot($basePath);

        echo "=========================================\n";
        echo "  UK Delivery Platform — Booking Tests   \n";
        echo "=========================================\n\n";

        $this->testTrackingNumberGenerator();
        $this->testQuoteToBookingConversion();
        $this->testStatusStateMachineTransitions();

        echo "\n-----------------------------------------\n";
        echo sprintf("Booking Test Results: %d Passed, %d Failed\n", $this->passed, $this->failed);
        echo "-----------------------------------------\n";

        if ($this->failed > 0) {
            echo "\nFailures:\n";
            foreach ($this->errors as $error) {
                echo "  - {$error}\n";
            }
            exit(1);
        }

        echo "\nAll booking engine & shipment tests passed cleanly!\n";
    }

    protected function assert(bool $condition, string $message): void
    {
        if ($condition) {
            $this->passed++;
            echo "  [PASS] {$message}\n";
        } else {
            $this->failed++;
            $this->errors[] = $message;
            echo "  [FAIL] {$message}\n";
        }
    }

    protected function testTrackingNumberGenerator(): void
    {
        echo "[1] Testing UK Tracking Number Generator...\n";
        $repo = new ShipmentRepository();
        $tracking = $repo->generateTrackingNumber();

        $this->assert(strlen($tracking) === 12, "Tracking number length is 12 characters ({$tracking})");
        $this->assert(strpos($tracking, 'UK') === 0, "Tracking number starts with 'UK' prefix");
        $this->assert(ctype_digit(substr($tracking, 2)), "Tracking number contains 10 trailing digits");
    }

    protected function testQuoteToBookingConversion(): void
    {
        echo "\n[2] Testing Quote-to-Booking Conversion in MySQL...\n";
        $quoteService = new QuoteService();
        $bookingService = new BookingService();

        // 1. Generate & Accept Quote
        $quote = $quoteService->saveQuote([
            'pickup_postcode' => 'SW1A 1AA',
            'delivery_postcode' => 'M1 1AE',
            'service_id' => 1,
            'weight_kg' => 2.0,
            'guest_email' => 'bookingtest@ukdelivery.co.uk',
        ]);
        $quoteService->acceptQuote($quote['quote_number']);

        // 2. Convert to Booking
        $bookingInput = [
            'pickup_name' => 'Alice Sender',
            'pickup_phone' => '07700900111',
            'pickup_email' => 'bookingtest@ukdelivery.co.uk',
            'pickup_house_number' => '10',
            'pickup_street' => 'Downing Street',
            'pickup_town' => 'London',
            'pickup_postcode' => 'SW1A 1AA',

            'delivery_name' => 'Bob Recipient',
            'delivery_phone' => '07800900222',
            'delivery_house_number' => '50',
            'delivery_street' => 'Market Street',
            'delivery_town' => 'Manchester',
            'delivery_postcode' => 'M1 1AE',

            'scheduled_pickup_date' => date('Y-m-d', strtotime('+1 day')),
            'special_instructions' => 'Ring doorbell twice',
        ];

        $shipment = $bookingService->createBookingFromQuote($quote['quote_number'], $bookingInput);

        $this->assert(!empty($shipment['shipment_number']), "Shipment created with number: {$shipment['shipment_number']}");
        $this->assert(!empty($shipment['tracking_number']), "Shipment created with tracking number: {$shipment['tracking_number']}");
        $this->assert($shipment['status'] === 'booking_confirmed', "Initial status is 'booking_confirmed'");
        $this->assert($shipment['pickup_address']['name'] === 'Alice Sender', "Pickup address persisted");
        $this->assert($shipment['delivery_address']['name'] === 'Bob Recipient', "Delivery address persisted");

        // 3. Test Idempotency (attempt duplicate booking)
        $duplicate = $bookingService->createBookingFromQuote($quote['quote_number'], $bookingInput);
        $this->assert($duplicate['shipment_number'] === $shipment['shipment_number'], "Idempotent booking returns existing shipment");
    }

    protected function testStatusStateMachineTransitions(): void
    {
        echo "\n[3] Testing Shipment Status State Machine...\n";
        $repo = new ShipmentRepository();

        $quoteService = new QuoteService();
        $bookingService = new BookingService();
        $quote = $quoteService->saveQuote([
            'pickup_postcode' => 'EC1A 1BB',
            'delivery_postcode' => 'B1 1AA',
            'service_id' => 2,
            'weight_kg' => 1.5,
        ]);
        $shipment = $bookingService->createBookingFromQuote($quote['quote_number'], [
            'pickup_name' => 'Test', 'pickup_phone' => '07000000000', 'pickup_street' => 'Street', 'pickup_town' => 'Town', 'pickup_postcode' => 'EC1A 1BB',
            'delivery_name' => 'Test', 'delivery_phone' => '07000000000', 'delivery_street' => 'Street', 'delivery_town' => 'Town', 'delivery_postcode' => 'B1 1AA',
        ]);

        $shipmentId = (int)$shipment['id'];

        // Test valid status transitions
        $this->assert($repo->isValidStatusTransition('booking_confirmed', 'collection_scheduled'), "Valid transition: booking_confirmed -> collection_scheduled");
        $repo->updateStatus($shipmentId, 'collection_scheduled', 'Collection scheduled for tomorrow morning.');

        $this->assert($repo->isValidStatusTransition('collection_scheduled', 'collected'), "Valid transition: collection_scheduled -> collected");
        $repo->updateStatus($shipmentId, 'collected', 'Parcel picked up by driver.');

        // Test invalid status transition (collected directly to delivered without in_transit/out_for_delivery)
        $this->assert(!$repo->isValidStatusTransition('collected', 'delivered'), "Invalid transition blocked: collected -> delivered");

        $updated = $repo->findByNumber($shipment['shipment_number']);
        $this->assert($updated['status'] === 'collected', "Current status maintained as 'collected'");
        $this->assert(count($updated['history']) >= 3, "Status history log recorded 3 timeline entries");
    }
}

if (php_sapi_name() === 'cli' && realpath($_SERVER['SCRIPT_FILENAME']) === __FILE__) {
    BookingEngineTest::run();
}
