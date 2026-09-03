<?php

namespace App\Services;

use App\Core\Config;
use App\Core\Database;
use RuntimeException;

/**
 * Server-Side Logistics Pricing Engine.
 */
class PricingEngine extends BaseService
{
    public function resolveZone(string $postcode): array
    {
        $clean = uk_postcode_format($postcode);
        $parts = explode(' ', $clean);
        $outward = $parts[0] ?? '';

        // Extract alpha prefix e.g. "SW1A" -> "SW", "BT12" -> "BT", "E1" -> "E"
        preg_match('/^[A-Z]+/', $outward, $matches);
        $alphaPrefix = $matches[0] ?? $outward;

        $zones = Database::fetchAll("SELECT id, name, postcode_prefix, region FROM zones WHERE active = 1");

        foreach ($zones as $zone) {
            $prefixes = array_map('trim', explode(',', strtoupper($zone['postcode_prefix'])));
            if (in_array($alphaPrefix, $prefixes) || in_array($outward, $prefixes)) {
                return $zone;
            }
        }

        // Fallback default zone (UK Mainland South)
        return [
            'id' => 2,
            'name' => 'UK Mainland South & Midlands',
            'postcode_prefix' => 'DEFAULT',
            'region' => 'UK Mainland South',
        ];
    }

    public function calculate(array $route, array $parcels, int $serviceId, array $options = []): array
    {
        $pickupPostcode = $route['pickup_postcode'] ?? '';
        $deliveryPostcode = $route['delivery_postcode'] ?? '';

        if (empty($pickupPostcode) || empty($deliveryPostcode)) {
            throw new RuntimeException("Collection and delivery postcodes are required for quote calculation.");
        }

        $zoneFrom = $this->resolveZone($pickupPostcode);
        $zoneTo = $this->resolveZone($deliveryPostcode);

        // Fetch Service details
        $service = Database::fetch("SELECT id, name, slug, service_type FROM services WHERE id = :id AND active = 1", [':id' => $serviceId]);
        if (!$service) {
            throw new RuntimeException("Selected courier service [ID: {$serviceId}] is not active or available.");
        }

        // Calculate parcel weights and volumetric weight
        $totalActualWeight = 0.0;
        $totalVolumetricWeight = 0.0;
        $parcelSummaries = [];

        foreach ($parcels as $idx => $item) {
            $weight = max(0.1, (float)($item['weight_kg'] ?? 1.0));
            $length = max(1.0, (float)($item['length_cm'] ?? 10.0));
            $width = max(1.0, (float)($item['width_cm'] ?? 10.0));
            $height = max(1.0, (float)($item['height_cm'] ?? 10.0));
            $qty = max(1, (int)($item['quantity'] ?? 1));

            $volumetricWeight = ($length * $width * $height) / 5000.0;

            $totalActualWeight += ($weight * $qty);
            $totalVolumetricWeight += ($volumetricWeight * $qty);

            $parcelSummaries[] = [
                'item_number' => $idx + 1,
                'weight_kg' => number_format($weight, 2, '.', ''),
                'dimensions_cm' => "{$length} × {$width} × {$height}",
                'volumetric_weight_kg' => number_format($volumetricWeight, 2, '.', ''),
                'quantity' => $qty,
                'chargeable_weight_kg' => number_format(max($weight, $volumetricWeight), 2, '.', ''),
            ];
        }

        $chargeableWeight = max($totalActualWeight, $totalVolumetricWeight);

        // Fetch Rate Card
        $rateCard = Database::fetch(
            "SELECT * FROM rate_cards
             WHERE service_id = :service_id AND zone_from_id = :from_id AND zone_to_id = :to_id AND active = 1
             ORDER BY base_price ASC LIMIT 1",
            [
                ':service_id' => $serviceId,
                ':from_id' => $zoneFrom['id'],
                ':to_id' => $zoneTo['id'],
            ]
        );

        if (!$rateCard) {
            // Fallback rate card
            $rateCard = [
                'id' => 0,
                'base_price' => 12.50,
                'per_kg_price' => 1.00,
            ];
        }

        $basePrice = (float)$rateCard['base_price'];
        $perKgPrice = (float)$rateCard['per_kg_price'];
        $freightCharge = $basePrice + ($chargeableWeight * $perKgPrice);

        $lineItems = [];
        $lineItems[] = [
            'key' => 'freight',
            'description' => "Freight Charge ({$service['name']}) — " . number_format($chargeableWeight, 2) . "kg chargeable weight",
            'amount' => round($freightCharge, 2),
        ];

        $surchargesTotal = 0.0;

        // Remote Area Surcharge (Highlands or Northern Ireland)
        if (in_array($zoneFrom['region'], ['Scottish Highlands', 'Northern Ireland']) ||
            in_array($zoneTo['region'], ['Scottish Highlands', 'Northern Ireland'])) {
            $remoteFee = 12.50;
            $surchargesTotal += $remoteFee;
            $lineItems[] = [
                'key' => 'remote_area',
                'description' => "Remote Area Surcharge (" . $zoneTo['region'] . ")",
                'amount' => round($remoteFee, 2),
            ];
        }

        // Fragile Handling
        if (!empty($options['is_fragile'])) {
            $fragileFee = 5.00;
            $surchargesTotal += $fragileFee;
            $lineItems[] = [
                'key' => 'fragile',
                'description' => "Fragile Item Special Handling Fee",
                'amount' => round($fragileFee, 2),
            ];
        }

        // Signature Required
        if (!empty($options['signature_required'])) {
            $sigFee = 2.50;
            $surchargesTotal += $sigFee;
            $lineItems[] = [
                'key' => 'signature',
                'description' => "Recipient Signature Required Fee",
                'amount' => round($sigFee, 2),
            ];
        }

        // Same-Day Dispatch Surcharge
        if ($service['service_type'] === 'sameday' || !empty($options['is_sameday'])) {
            $samedayFee = 25.00;
            $surchargesTotal += $samedayFee;
            $lineItems[] = [
                'key' => 'sameday_express',
                'description' => "Urgent Direct Courier Dispatch Surcharge",
                'amount' => round($samedayFee, 2),
            ];
        }

        // Fuel Surcharge (5.0%)
        $taxableBase = $freightCharge + $surchargesTotal;
        $fuelSurchargePct = 5.00;
        $fuelFee = $taxableBase * ($fuelSurchargePct / 100.0);
        $lineItems[] = [
            'key' => 'fuel',
            'description' => "Fuel Surcharge (" . number_format($fuelSurchargePct, 1) . "%)",
            'amount' => round($fuelFee, 2),
        ];

        $subtotal = $taxableBase + $fuelFee;

        // Discount
        $discount = 0.0;
        if (!empty($options['discount_amount'])) {
            $discount = min($subtotal, (float)$options['discount_amount']);
        }

        $taxableSubtotal = max(0.0, $subtotal - $discount);

        // VAT Calculation
        $vatRate = (float)Config::get('app.vat_rate', 20.0);
        $vatAmount = $taxableSubtotal * ($vatRate / 100.0);
        $grandTotal = $taxableSubtotal + $vatAmount;

        $pricingSnapshot = [
            'pickup_zone' => $zoneFrom['name'],
            'delivery_zone' => $zoneTo['name'],
            'actual_weight_kg' => round($totalActualWeight, 2),
            'volumetric_weight_kg' => round($totalVolumetricWeight, 2),
            'chargeable_weight_kg' => round($chargeableWeight, 2),
            'base_freight_price' => round($freightCharge, 2),
            'line_items' => $lineItems,
            'subtotal' => round($subtotal, 2),
            'discount' => round($discount, 2),
            'vat_rate' => round($vatRate, 2),
            'vat_amount' => round($vatAmount, 2),
            'total' => round($grandTotal, 2),
            'currency' => 'GBP',
            'calculated_at' => date('Y-m-d H:i:s'),
        ];

        return [
            'route' => [
                'pickup_postcode' => uk_postcode_format($pickupPostcode),
                'delivery_postcode' => uk_postcode_format($deliveryPostcode),
                'pickup_zone' => $zoneFrom['name'],
                'delivery_zone' => $zoneTo['name'],
            ],
            'parcels' => $parcelSummaries,
            'service' => $service,
            'pricing' => [
                'subtotal' => number_format($subtotal, 2, '.', ''),
                'discount' => number_format($discount, 2, '.', ''),
                'vat_rate' => number_format($vatRate, 2, '.', ''),
                'vat_amount' => number_format($vatAmount, 2, '.', ''),
                'total' => number_format($grandTotal, 2, '.', ''),
                'currency' => 'GBP',
                'currency_symbol' => '£',
                'line_items' => $lineItems,
            ],
            'snapshot' => $pricingSnapshot,
        ];
    }
}
