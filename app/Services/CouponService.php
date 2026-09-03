<?php

namespace App\Services;

use App\Core\Database;
use RuntimeException;

class CouponService extends BaseService
{
    public function createCoupon(array $data): array
    {
        $code = strtoupper(trim($data["code"] ?? ""));
        if (empty($code)) {
            throw new RuntimeException("Coupon code is required.");
        }

        $existing = Database::fetch("SELECT id FROM coupons WHERE code = :code LIMIT 1", [":code" => $code]);
        if ($existing) {
            throw new RuntimeException("Coupon code [{$code}] already exists.");
        }

        $type = in_array($data["discount_type"] ?? "", ["percentage", "fixed"]) ? $data["discount_type"] : "percentage";
        $value = (float)($data["discount_value"] ?? 0.0);
        $minOrder = (float)($data["min_order_amount"] ?? 0.0);
        $maxDiscount = isset($data["max_discount"]) ? (float)$data["max_discount"] : null;
        $usageLimit = (int)($data["usage_limit"] ?? 100);
        $status = ($data["status"] ?? "active") === "inactive" ? "inactive" : "active";
        $expiresAt = !empty($data["expires_at"]) ? date("Y-m-d H:i:s", strtotime($data["expires_at"])) : null;

        Database::query(
            "INSERT INTO coupons (code, discount_type, discount_value, min_order_amount, max_discount, usage_limit, status, expires_at)
             VALUES (:code, :type, :val, :min_ord, :max_disc, :limit, :status, :exp)",
            [
                ":code" => $code,
                ":type" => $type,
                ":val" => $value,
                ":min_ord" => $minOrder,
                ":max_disc" => $maxDiscount,
                ":limit" => $usageLimit,
                ":status" => $status,
                ":exp" => $expiresAt,
            ]
        );

        return $this->getCouponByCode($code);
    }

    public function getCouponByCode(string $code): ?array
    {
        return Database::fetch("SELECT * FROM coupons WHERE code = :code LIMIT 1", [":code" => strtoupper(trim($code))]);
    }

    public function validateAndCalculateDiscount(string $code, float $orderSubtotal): array
    {
        $coupon = $this->getCouponByCode($code);
        if (!$coupon) {
            return ["valid" => false, "message" => "Invalid or non-existent coupon code.", "discount" => 0.00];
        }

        if ($coupon["status"] !== "active") {
            return ["valid" => false, "message" => "This coupon is currently inactive.", "discount" => 0.00];
        }

        if (!empty($coupon["expires_at"]) && strtotime($coupon["expires_at"]) < time()) {
            return ["valid" => false, "message" => "This coupon code has expired.", "discount" => 0.00];
        }

        if ($coupon["used_count"] >= $coupon["usage_limit"]) {
            return ["valid" => false, "message" => "Coupon usage limit reached.", "discount" => 0.00];
        }

        if ($orderSubtotal < (float)$coupon["min_order_amount"]) {
            return [
                "valid" => false,
                "message" => sprintf("Minimum order amount of £%.2f required for this coupon.", $coupon["min_order_amount"]),
                "discount" => 0.00
            ];
        }

        $discount = 0.0;
        if ($coupon["discount_type"] === "percentage") {
            $discount = round(($orderSubtotal * (float)$coupon["discount_value"]) / 100.0, 2);
            if ($coupon["max_discount"] !== null && (float)$coupon["max_discount"] > 0) {
                $discount = min($discount, (float)$coupon["max_discount"]);
            }
        } else {
            $discount = min((float)$coupon["discount_value"], $orderSubtotal);
        }

        return [
            "valid" => true,
            "message" => "Coupon applied successfully!",
            "coupon" => $coupon,
            "discount" => $discount,
            "final_subtotal" => max(0.0, round($orderSubtotal - $discount, 2)),
        ];
    }

    public function toggleStatus(int $couponId, string $status): bool
    {
        $status = in_array($status, ["active", "inactive"]) ? $status : "active";
        Database::query("UPDATE coupons SET status = :st WHERE id = :id", [":st" => $status, ":id" => $couponId]);
        return true;
    }
}

