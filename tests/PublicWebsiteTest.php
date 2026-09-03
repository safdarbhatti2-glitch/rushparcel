<?php

namespace Tests;

use App\Core\App;
use App\Core\Request;
use App\Core\Response;

/**
 * Public Website Verification Test Suite.
 */
class PublicWebsiteTest
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
        $app = App::boot($basePath);

        echo "=========================================\n";
        echo "  UK Delivery Platform — Public Site Tests \n";
        echo "=========================================\n\n";

        $routesToTest = [
            '/' => 'Rush Parcel',
            '/services' => 'Courier &amp; Logistics Services',
            '/services/parcel-delivery' => 'Standard &amp; Express Parcel Delivery',
            '/services/business-logistics' => 'B2B &amp; Corporate Logistics',
            '/services/same-day-delivery' => 'Same-Day Courier Service',
            '/services/international-shipping' => 'Worldwide International Shipping',
            '/services/uk-europe-shipping' => 'UK &amp; Europe Road Freight',
            '/services/forwarding-address' => 'UK Forwarding Address Service',
            '/services/customs-clearance' => 'Customs Clearance &amp; Brokerage',
            '/track' => 'Track Your UK Shipment',
            '/about' => 'Architected for Modern UK Logistics',
            '/partners' => 'Business Partnerships',
            '/drop-off' => 'UK Parcel Drop-off Locations',
            '/faq' => 'Frequently Asked Questions',
            '/contact' => 'Contact Rush Parcel Support',
            '/terms' => 'Terms &amp; Conditions',
            '/privacy' => 'Privacy Policy &amp; UK GDPR',
            '/cookies' => 'Cookie &amp; Local Storage Policy',
            '/delivery-policy' => 'Delivery Service Terms',
            '/prohibited-items' => 'Prohibited &amp; Dangerous Goods',
            '/vat-info' => 'UK Value Added Tax (VAT)',
            '/health' => 'healthy',
        ];

        foreach ($routesToTest as $uri => $expectedSubstring) {
            $req = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => $uri]);
            $res = $app->router()->dispatch($req);

            $this->assert(
                $res instanceof Response,
                "Route [{$uri}] returned Response object"
            );

            ob_start();
            $res->send();
            $content = ob_get_clean();

            $this->assert(
                strpos($content, $expectedSubstring) !== false,
                "Route [{$uri}] contained expected string '{$expectedSubstring}'"
            );
        }

        echo "\n-----------------------------------------\n";
        echo sprintf("Public Site Test Results: %d Passed, %d Failed\n", $this->passed, $this->failed);
        echo "-----------------------------------------\n";

        if ($this->failed > 0) {
            echo "\nFailures:\n";
            foreach ($this->errors as $error) {
                echo "  - {$error}\n";
            }
            exit(1);
        }

        echo "\nAll public website tests passed cleanly!\n";
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
}

if (php_sapi_name() === 'cli' && realpath($_SERVER['SCRIPT_FILENAME']) === __FILE__) {
    PublicWebsiteTest::run();
}
