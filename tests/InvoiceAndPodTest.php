<?php

namespace Tests;

use App\Core\App;
use App\Core\Database;
use App\Services\QuoteService;
use App\Services\BookingService;
use App\Services\InvoiceService;
use App\Services\PodService;
use App\Repositories\InvoiceRepository;

/**
 * Invoice Engine, Payment Recording & Proof of Delivery (POD) Test Suite.
 */
class InvoiceAndPodTest
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
        echo "  UK Delivery Platform — Invoice & POD   \n";
        echo "=========================================\n\n";

        $this->testInvoiceNumberGeneration();
        $this->testInvoiceCreationAndVat();
        $this->testPaymentRecordingAndStatus();
        $this->testPodUploadAndDeliveryState();

        echo "\n-----------------------------------------\n";
        echo sprintf("Invoice/POD Test Results: %d Passed, %d Failed\n", $this->passed, $this->failed);
        echo "-----------------------------------------\n";

        if ($this->failed > 0) {
            echo "\nFailures:\n";
            foreach ($this->errors as $error) {
                echo "  - {$error}\n";
            }
            exit(1);
        }

        echo "\nAll invoice engine, payment, and POD tests passed cleanly!\n";
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

    protected function testInvoiceNumberGeneration(): void
    {
        echo "[1] Testing Sequential UK VAT Invoice Number Generator...\n";
        $repo = new InvoiceRepository();
        $num = $repo->generateInvoiceNumber();

        $this->assert(strpos($num, 'INV-2026-') === 0, "Invoice number starts with 'INV-2026-' ({$num})");
        $this->assert(strlen($num) === 15, "Invoice number length is 15 characters ({$num})");
    }

    protected function testInvoiceCreationAndVat(): void
    {
        echo "\n[2] Testing Invoice Creation from Shipment & VAT Math...\n";
        $quoteService = new QuoteService();
        $bookingService = new BookingService();
        $invoiceService = new InvoiceService();

        // 1. Create Booking
        $quote = $quoteService->saveQuote([
            'pickup_postcode' => 'SW1A 1AA',
            'delivery_postcode' => 'M1 1AE',
            'service_id' => 1,
            'weight_kg' => 2.0,
        ]);
        $shipment = $bookingService->createBookingFromQuote($quote['quote_number'], [
            'pickup_name' => 'Sender', 'pickup_phone' => '+44 7911 123456', 'pickup_street' => 'St', 'pickup_town' => 'London', 'pickup_postcode' => 'SW1A 1AA',
            'delivery_name' => 'Receiver', 'delivery_phone' => '+44 7911 987654', 'delivery_street' => 'St', 'delivery_town' => 'Manchester', 'delivery_postcode' => 'M1 1AE',
        ]);

        // 2. Generate Invoice
        $invoice = $invoiceService->createInvoiceFromShipment((int)$shipment['id']);

        $this->assert(!empty($invoice['invoice_number']), "Invoice created: {$invoice['invoice_number']}");
        $this->assert($invoice['vat_rate'] == 20.00, "VAT rate recorded as 20.0%");
        $this->assert($invoice['status'] === 'issued', "Invoice initial status is 'issued'");
        $this->assert(count($invoice['items']) > 0, "Invoice line items persisted");
    }

    protected function testPaymentRecordingAndStatus(): void
    {
        echo "\n[3] Testing Payment Recording & Invoice Status Updates...\n";
        $invoiceService = new InvoiceService();
        $repo = new InvoiceRepository();

        $quoteService = new QuoteService();
        $bookingService = new BookingService();
        $quote = $quoteService->saveQuote(['pickup_postcode' => 'SW1A 1AA', 'delivery_postcode' => 'B1 1AA', 'service_id' => 1, 'weight_kg' => 1.0]);
        $shipment = $bookingService->createBookingFromQuote($quote['quote_number'], [
            'pickup_name' => 'Pay Sender', 'pickup_phone' => '07000000000', 'pickup_street' => 'St', 'pickup_town' => 'London', 'pickup_postcode' => 'SW1A 1AA',
            'delivery_name' => 'Pay Recipient', 'delivery_phone' => '07000000000', 'delivery_street' => 'St', 'delivery_town' => 'Birm', 'delivery_postcode' => 'B1 1AA',
        ]);

        $invoice = $invoiceService->createInvoiceFromShipment((int)$shipment['id']);
        $invoiceId = (int)$invoice['id'];

        $updated = $invoiceService->recordPayment($invoiceId, (float)$invoice['total'], 'card', 'TXN_TEST_123', 1, 'Full card payment');

        $this->assert($updated['status'] === 'paid', "Invoice status updated to 'paid' after full payment");
        $this->assert(count($updated['payments']) === 1, "Payment transaction recorded in payments table");
        $this->assert($updated['balance_due'] == 0.0, "Balance due is £0.00");
    }

    protected function testPodUploadAndDeliveryState(): void
    {
        echo "\n[4] Testing POD Upload Validation & Status Transition...\n";
        $podService = new PodService();

        $quoteService = new QuoteService();
        $bookingService = new BookingService();
        $quote = $quoteService->saveQuote(['pickup_postcode' => 'SW1A 1AA', 'delivery_postcode' => 'E1 6AN', 'service_id' => 1, 'weight_kg' => 1.0]);
        $shipment = $bookingService->createBookingFromQuote($quote['quote_number'], [
            'pickup_name' => 'Pod Sender', 'pickup_phone' => '07000000000', 'pickup_street' => 'St', 'pickup_town' => 'London', 'pickup_postcode' => 'SW1A 1AA',
            'delivery_name' => 'Pod Recipient', 'delivery_phone' => '07000000000', 'delivery_street' => 'St', 'delivery_town' => 'London', 'delivery_postcode' => 'E1 6AN',
        ]);

        $shipmentId = (int)$shipment['id'];

        // Transition status to out_for_delivery
        $shipmentRepo = new \App\Repositories\ShipmentRepository();
        $shipmentRepo->updateStatus($shipmentId, 'collection_scheduled', 'Scheduled');
        $shipmentRepo->updateStatus($shipmentId, 'collected', 'Collected');
        $shipmentRepo->updateStatus($shipmentId, 'out_for_delivery', 'Out for delivery');

        // Driver profile check/insert
        $driver = Database::fetch("SELECT id FROM drivers LIMIT 1");
        $driverId = $driver ? (int)$driver['id'] : 1;

        // Create dummy test photo file (valid GIF image bytes)
        $tmpDir = sys_get_temp_dir();
        $tmpFile = $tmpDir . '/test_pod_photo.gif';
        file_put_contents($tmpFile, base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'));

        $fileInput = [
            'tmp_name' => $tmpFile,
            'name' => 'signature.gif',
            'size' => filesize($tmpFile),
            'error' => 0,
        ];

        // Process POD upload
        $result = $podService->processPodUpload($shipmentId, $driverId, $fileInput, 'John Recipient', 1);

        $this->assert(!empty($result['file_id']), "POD file registered in database");

        $updatedShipment = Database::fetch("SELECT status FROM shipments WHERE id = :id LIMIT 1", [':id' => $shipmentId]);
        $this->assert($updatedShipment['status'] === 'delivered', "Shipment status updated to 'delivered'");

        $podRecord = Database::fetch("SELECT * FROM proof_of_delivery WHERE shipment_id = :sid LIMIT 1", [':sid' => $shipmentId]);
        $this->assert($podRecord['recipient_name'] === 'John Recipient', "Recipient name persisted in proof_of_delivery table");

        // Clean up temp file
        @unlink($tmpFile);
    }
}

if (php_sapi_name() === 'cli' && realpath($_SERVER['SCRIPT_FILENAME']) === __FILE__) {
    InvoiceAndPodTest::run();
}
