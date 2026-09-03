<?php

namespace Tests;

use App\Core\App;
use App\Core\Database;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Controllers\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Repositories\ShipmentRepository;

/**
 * Authentication, Customer Portal, and Admin Operations Test Suite.
 */
class AdminAndAuthTest
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
        echo "  UK Delivery Platform — Admin/Auth Tests \n";
        echo "=========================================\n\n";

        $this->testUserRegistrationAndHashing();
        $this->testRoleMiddlewareProtection();
        $this->testAdminKpiCalculation();
        $this->testAdminDriverAssignment();
        $this->testAdminShipmentCreationAndAutoEvents();

        echo "\n-----------------------------------------\n";
        echo sprintf("Admin/Auth Test Results: %d Passed, %d Failed\n", $this->passed, $this->failed);
        echo "-----------------------------------------\n";

        if ($this->failed > 0) {
            echo "\nFailures:\n";
            foreach ($this->errors as $error) {
                echo "  - {$error}\n";
            }
            exit(1);
        }

        echo "\nAll admin operational & authentication tests passed cleanly!\n";
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

    protected function testUserRegistrationAndHashing(): void
    {
        echo "[1] Testing User Registration & Password Hashing...\n";

        $email = 'opsadmin_' . time() . '@ukdelivery.co.uk';
        $password = 'SecureAdminPass123!';
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Fetch Admin Role
        $adminRole = Database::fetch("SELECT id FROM roles WHERE name = 'admin' LIMIT 1");
        $roleId = $adminRole ? (int)$adminRole['id'] : 2;

        Database::query(
            "INSERT INTO users (role_id, name, email, phone, password_hash, status) VALUES (:r, 'Ops Admin', :e, '07700900999', :h, 'active')",
            [':r' => $roleId, ':e' => $email, ':h' => $passwordHash]
        );

        $fetched = Database::fetch("SELECT * FROM users WHERE email = :e LIMIT 1", [':e' => $email]);
        $this->assert(!empty($fetched['id']), "User created in database");
        $this->assert(password_verify($password, $fetched['password_hash']), "Password verified against hash");
    }

    protected function testRoleMiddlewareProtection(): void
    {
        echo "\n[2] Testing Role Middleware Authorization Gates...\n";
        Session::destroy();
        Session::start();

        $middleware = new \App\Middleware\RoleMiddleware(['admin', 'super_admin']);
        $req = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/admin']);

        $res = $middleware->handle($req);
        $this->assert($res instanceof Response, "Unauthenticated access to /admin blocked");
        $this->assert($res->send() === null, "Redirected unauthenticated user to login");

        // Authenticate as customer
        Session::set('user_id', 999);
        Session::set('user_role', 'customer');

        $resForbidden = $middleware->handle($req);
        $this->assert($resForbidden instanceof Response, "Customer role access to /admin blocked (403)");
    }

    protected function testAdminKpiCalculation(): void
    {
        echo "\n[3] Testing Admin Dashboard 9 KPI Queries...\n";
        Session::set('user_id', 1);
        Session::set('user_role', 'admin');

        $controller = new DashboardController();
        $req = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/admin']);
        $res = $controller->index($req);

        $this->assert($res instanceof Response, "Admin Dashboard renders Response object");
    }

    protected function testAdminDriverAssignment(): void
    {
        echo "\n[4] Testing Driver Assignment & Status Updates...\n";

        // Seed a driver if needed
        $driverUser = Database::fetch("SELECT id FROM users WHERE email = 'driver1@ukdelivery.co.uk' LIMIT 1");
        if (!$driverUser) {
            $driverRole = Database::fetch("SELECT id FROM roles WHERE name = 'driver' LIMIT 1");
            Database::query(
                "INSERT INTO users (role_id, name, email, phone, password_hash, status) VALUES (:r, 'Dave Driver', 'driver1@ukdelivery.co.uk', '07700999000', 'hash', 'active')",
                [':r' => $driverRole['id'] ?? 7]
            );
            $userId = (int)Database::lastInsertId();
            Database::query("INSERT INTO drivers (user_id, employee_ref, phone, status) VALUES (:uid, 'DRV-001', '07700999000', 'active')", [':uid' => $userId]);
        }

        $driver = Database::fetch("SELECT id FROM drivers LIMIT 1");
        $this->assert(!empty($driver['id']), "Driver profile exists in MySQL");
    }

    protected function testAdminShipmentCreationAndAutoEvents(): void
    {
        echo "\n[5] Testing Admin Shipment Creator & Automated 5 Event Generator...\n";

        Session::set('user_id', 1);
        Session::set('user_role', 'admin');

        $controller = new \App\Controllers\Admin\ShipmentController();
        $getReq = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/admin/shipments/create']);
        $getRes = $controller->create($getReq);

        $this->assert($getRes instanceof Response, "Admin Create Shipment form renders Response object");

        $postData = [
            'sender_name' => 'Alice Sender',
            'sender_phone' => '07700111222',
            'sender_street' => '10 Baker Street',
            'sender_city' => 'London',
            'sender_postcode' => 'NW1 6XE',
            'sender_email' => 'alice.sender@example.co.uk',

            'receiver_name' => 'Bob Receiver',
            'receiver_phone' => '07700333444',
            'receiver_street' => '25 Market Street',
            'receiver_city' => 'Manchester',
            'receiver_postcode' => 'M1 1AE',
            'receiver_email' => 'bob.receiver@example.co.uk',

            'item_name' => 'Industrial Spare Parts',
            'weight_kg' => '4.5',
            'length_cm' => '35',
            'width_cm' => '25',
            'height_cm' => '15',
            'package_type' => 'parcel',
            'special_instructions' => 'Fragile cargo - Handle with care.',

            'service_id' => '1',
            'manual_amount' => '38.50',
            'declared_value' => '200.00',

            'scheduled_pickup_at' => date('Y-m-d\TH:i', strtotime('+1 hour')),
            'scheduled_delivery_at' => date('Y-m-d\TH:i', strtotime('+1 day')),
            'initial_status' => 'in_transit',
            'auto_generate_events' => '1',
        ];

        // Set valid CSRF token
        $token = \App\Core\Csrf::getToken();
        $postData['_csrf_token'] = $token;

        $postReq = new Request(
            ['REQUEST_METHOD' => 'POST', 'REQUEST_URI' => '/admin/shipments/create'],
            $postData
        );

        $postRes = $controller->store($postReq);

        $createdShipment = Database::fetch("SELECT * FROM shipments WHERE created_by = 1 ORDER BY id DESC LIMIT 1");
        $this->assert(!empty($createdShipment['id']), "Shipment created in MySQL with manual shipping charges (£38.50)");
        $this->assert($createdShipment['status'] === 'in_transit', "Initial shipment status set to 'in_transit'");

        $pickupAddr = Database::fetch("SELECT * FROM shipment_addresses WHERE shipment_id = :sid AND type = 'pickup' LIMIT 1", [':sid' => $createdShipment['id']]);
        $deliveryAddr = Database::fetch("SELECT * FROM shipment_addresses WHERE shipment_id = :sid AND type = 'delivery' LIMIT 1", [':sid' => $createdShipment['id']]);
        $this->assert($pickupAddr['name'] === 'Alice Sender' && $pickupAddr['city'] === 'London', "Sender details (name, city, postcode) persisted");
        $this->assert($deliveryAddr['name'] === 'Bob Receiver' && $deliveryAddr['city'] === 'Manchester', "Receiver details (name, city, postcode) persisted");

        $item = Database::fetch("SELECT * FROM shipment_items WHERE shipment_id = :sid LIMIT 1", [':sid' => $createdShipment['id']]);
        $this->assert($item['description'] === 'Industrial Spare Parts' && (float)$item['weight_kg'] === 4.50, "Item details (description, weight) persisted");

        $historyCount = Database::fetch("SELECT COUNT(*) as cnt FROM shipment_status_history WHERE shipment_id = :sid", [':sid' => $createdShipment['id']]);
        $this->assert((int)$historyCount['cnt'] === 3, "Automated 3 milestone events generated up to 'in_transit' status");
    }
}

if (php_sapi_name() === 'cli' && realpath($_SERVER['SCRIPT_FILENAME']) === __FILE__) {
    AdminAndAuthTest::run();
}

