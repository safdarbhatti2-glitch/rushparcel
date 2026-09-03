<?php

namespace Tests;

$basePath = dirname(__DIR__);
require_once $basePath . "/app/Core/App.php";
\App\Core\App::boot($basePath);

use App\Core\Database;
use App\Services\CouponService;
use App\Services\CsvImportService;

function runCouponsAndCsvImportTests() {
    echo "=========================================\n";
    echo "  UK Delivery Platform — Coupons & CSV  \n";
    echo "=========================================\n\n";

    $passed = 0;
    $failed = 0;

    $assert = function(bool $condition, string $message) use (&$passed, &$failed) {
        if ($condition) {
            echo "  [PASS] {$message}\n";
            $passed++;
        } else {
            echo "  [FAIL] {$message}\n";
            $failed++;
        }
    };

    $couponService = new CouponService();
    $csvService = new CsvImportService();

    // 1. Coupon Creation & Duplicate Code Rejection
    echo "[1] Testing Coupon Creation & Unique Code Rules...\n";
    $code = "SAVE20_" . rand(1000, 9999);
    $coupon = $couponService->createCoupon([
        "code" => $code,
        "discount_type" => "percentage",
        "discount_value" => 20.0,
        "min_order_amount" => 30.0,
        "max_discount" => 15.0,
        "usage_limit" => 50,
    ]);

    $assert(!empty($coupon) && $coupon["code"] === $code, "Coupon created with code {$code}");
    $assert((float)$coupon["discount_value"] === 20.0, "Discount value set to 20%");

    $duplicateCaught = false;
    try {
        $couponService->createCoupon(["code" => $code, "discount_type" => "fixed", "discount_value" => 5.0]);
    } catch (\Throwable $e) {
        $duplicateCaught = true;
    }
    $assert($duplicateCaught, "Duplicate coupon code correctly rejected");

    // 2. Coupon Validation & Math
    echo "\n[2] Testing Coupon Discount Calculation Engine...\n";
    $calc1 = $couponService->validateAndCalculateDiscount($code, 50.00); // 20% of 50 = 10 (below 15 max)
    $assert($calc1["valid"] === true, "Valid coupon applied to £50.00 order");
    $assert($calc1["discount"] === 10.00, "Discount calculated as £10.00");
    $assert($calc1["final_subtotal"] === 40.00, "Final subtotal is £40.00");

    $calcMin = $couponService->validateAndCalculateDiscount($code, 20.00); // Below £30 min
    $assert($calcMin["valid"] === false, "Coupon rejected for order below minimum threshold (£20 < £30)");

    // 3. Coupon Toggle Status
    echo "\n[3] Testing Coupon Status Toggle (Publish/Unpublish)...\n";
    $couponService->toggleStatus((int)$coupon["id"], "inactive");
    $calcInactive = $couponService->validateAndCalculateDiscount($code, 50.00);
    $assert($calcInactive["valid"] === false, "Inactive coupon rejected during validation");

    $couponService->toggleStatus((int)$coupon["id"], "active");
    $calcActive = $couponService->validateAndCalculateDiscount($code, 50.00);
    $assert($calcActive["valid"] === true, "Re-activated coupon accepted");

    // 4. CSV File Parsing & Preview
    echo "\n[4] Testing CSV Upload Validation & Preview Engine...\n";
    $tempCsvPath = sys_get_temp_dir() . "/test_bulk_shipments.csv";
    $csvContent = "Sender Name,Sender City,Sender Postcode,Receiver Name,Receiver City,Receiver Postcode,Weight,Item Description\n" .
                 "Sarah Jenkins,London,SW1A 1AA,David Miller,Manchester,M1 1AE,4.5,Electronics Box\n" .
                 ",London,SW1A 1AA,Invalid Receiver,,M1 1AE,0.0,Corrupted Row\n" .
                 "Michael Scott,Birmingham,B1 1BB,Jim Halpert,Leeds,LS1 2AB,12.0,Office Supplies\n";
    file_put_contents($tempCsvPath, $csvContent);

    $preview = $csvService->parseAndPreviewCsv($tempCsvPath, "test_bulk_shipments.csv");
    $assert($preview["total_rows"] === 3, "Parsed total 3 rows from CSV");
    $assert($preview["valid_rows_count"] === 2, "Identified 2 valid rows");
    $assert($preview["failed_rows_count"] === 1, "Identified 1 invalid row with validation errors");
    $assert($preview["failed_rows"][0]["row_number"] === 3, "Flagged correct row index 3 for corrupted data");

    // 5. CSV Commit Batch
    echo "\n[5] Testing CSV Batch Commit & Shipment Generation...\n";
    $commitResult = $csvService->commitImportBatch($preview["batch_id"], $preview["valid_rows"]);
    $assert($commitResult["committed_rows"] === 2, "Committed 2 valid shipments into database");
    $assert($commitResult["status"] === "committed", "Batch status updated to committed");

    $idempotentCaught = false;
    try {
        $csvService->commitImportBatch($preview["batch_id"], $preview["valid_rows"]);
    } catch (\Throwable $e) {
        $idempotentCaught = true;
    }
    $assert($idempotentCaught, "Re-committing already processed CSV batch rejected");

    @unlink($tempCsvPath);

    echo "\n-----------------------------------------\n";
    echo "Coupons & CSV Test Results: {$passed} Passed, {$failed} Failed\n";
    echo "-----------------------------------------\n\n";

    if ($failed > 0) {
        exit(1);
    }
}

runCouponsAndCsvImportTests();

