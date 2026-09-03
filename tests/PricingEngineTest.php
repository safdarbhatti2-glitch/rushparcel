<?php

namespace Tests;

use App\Core\App;
use App\Services\PricingEngine;
use App\Services\QuoteService;
use App\Repositories\QuoteRepository;

/**
 * Pricing Engine & Quotation System Verification Test Suite.
 */
class PricingEngineTest
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
        echo "  UK Delivery Platform — Pricing Tests   \n";
        echo "=========================================\n\n";

        $this->testPostcodeZoneResolution();
        $this->testVolumetricAndChargeableWeight();
        $this->testPricingCalculationEngine();
        $this->testQuotePersistenceAndAcceptance();

        echo "\n-----------------------------------------\n";
        echo sprintf("Pricing Test Results: %d Passed, %d Failed\n", $this->passed, $this->failed);
        echo "-----------------------------------------\n";

        if ($this->failed > 0) {
            echo "\nFailures:\n";
            foreach ($this->errors as $error) {
                echo "  - {$error}\n";
            }
            exit(1);
        }

        echo "\nAll pricing engine & quotation tests passed cleanly!\n";
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

    protected function testPostcodeZoneResolution(): void
    {
        echo "[1] Testing UK Postcode Zone Resolution...\n";
        $engine = new PricingEngine();

        $zoneLondon = $engine->resolveZone('SW1A 1AA');
        $this->assert($zoneLondon['region'] === 'London', "SW1A 1AA resolved to London zone");

        $zoneScotland = $engine->resolveZone('EH1 1YZ');
        $this->assert($zoneScotland['region'] === 'Scotland Lowlands', "EH1 1YZ resolved to Scotland Lowlands zone");

        $zoneNI = $engine->resolveZone('BT1 4QG');
        $this->assert($zoneNI['region'] === 'Northern Ireland', "BT1 4QG resolved to Northern Ireland zone");
    }

    protected function testVolumetricAndChargeableWeight(): void
    {
        echo "\n[2] Testing Volumetric & Chargeable Weight Calculation...\n";
        $engine = new PricingEngine();

        // 50 x 40 x 30 cm = 60,000 / 5000 = 12.0 kg volumetric
        $result = $engine->calculate(
            ['pickup_postcode' => 'SW1A 1AA', 'delivery_postcode' => 'M1 1AE'],
            [['weight_kg' => 5.0, 'length_cm' => 50, 'width_cm' => 40, 'height_cm' => 30, 'quantity' => 1]],
            1
        );

        $snapshot = $result['snapshot'];
        $this->assert($snapshot['actual_weight_kg'] == 5.0, "Actual weight calculated as 5.0 kg");
        $this->assert($snapshot['volumetric_weight_kg'] == 12.0, "Volumetric weight calculated as 12.0 kg");
        $this->assert($snapshot['chargeable_weight_kg'] == 12.0, "Chargeable weight selected max(5.0, 12.0) = 12.0 kg");
    }

    protected function testPricingCalculationEngine(): void
    {
        echo "\n[3] Testing Surcharge & VAT Calculation Engine...\n";
        $engine = new PricingEngine();

        $result = $engine->calculate(
            ['pickup_postcode' => 'SW1A 1AA', 'delivery_postcode' => 'BT1 1AA'],
            [['weight_kg' => 2.0, 'length_cm' => 20, 'width_cm' => 20, 'height_cm' => 20, 'quantity' => 1]],
            2, // Express service
            ['is_fragile' => true, 'signature_required' => true]
        );

        $lineKeys = array_column($result['pricing']['line_items'], 'key');
        $this->assert(in_array('fragile', $lineKeys), "Fragile fee applied to line items");
        $this->assert(in_array('signature', $lineKeys), "Signature fee applied to line items");
        $this->assert(in_array('remote_area', $lineKeys), "Remote area fee applied for Northern Ireland destination");
        $this->assert(in_array('fuel', $lineKeys), "Fuel surcharge applied to line items");

        $subtotal = (float)$result['pricing']['subtotal'];
        $vatAmount = (float)$result['pricing']['vat_amount'];
        $total = (float)$result['pricing']['total'];

        $expectedVat = round($subtotal * 0.20, 2);
        $this->assert(abs($vatAmount - $expectedVat) < 0.01, "VAT calculated as 20% of taxable subtotal");
        $this->assert(abs($total - ($subtotal + $vatAmount)) < 0.01, "Grand Total equals Subtotal + VAT");
    }

    protected function testQuotePersistenceAndAcceptance(): void
    {
        echo "\n[4] Testing Quote Persistence & Acceptance Workflow...\n";
        $service = new QuoteService();
        $repo = new QuoteRepository();

        $input = [
            'pickup_postcode' => 'EC1A 1BB',
            'delivery_postcode' => 'G1 1XQ',
            'service_id' => 1,
            'weight_kg' => 3.5,
            'length_cm' => 25,
            'width_cm' => 20,
            'height_cm' => 15,
            'quantity' => 1,
            'is_fragile' => true,
            'guest_email' => 'testguest@ukdelivery.co.uk',
        ];

        $quote = $service->saveQuote($input);
        $this->assert(!empty($quote['quote_number']), "Quote generated with unique number: {$quote['quote_number']}");
        $this->assert($quote['status'] === 'priced', "Initial quote status set to 'priced'");
        $this->assert(count($quote['items']) > 0, "Quote items persisted in database");

        $accepted = $service->acceptQuote($quote['quote_number']);
        $this->assert($accepted['status'] === 'accepted', "Quote status transitioned to 'accepted'");
        $this->assert(!empty($accepted['accepted_at']), "Accepted timestamp persisted in database");
    }
}

if (php_sapi_name() === 'cli' && realpath($_SERVER['SCRIPT_FILENAME']) === __FILE__) {
    PricingEngineTest::run();
}
