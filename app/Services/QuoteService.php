<?php

namespace App\Services;

use App\Repositories\QuoteRepository;
use RuntimeException;

class QuoteService extends BaseService
{
    protected PricingEngine $pricingEngine;
    protected QuoteRepository $quoteRepo;

    public function __construct(?PricingEngine $pricingEngine = null, ?QuoteRepository $quoteRepo = null)
    {
        $this->pricingEngine = $pricingEngine ?? new PricingEngine();
        $this->quoteRepo = $quoteRepo ?? new QuoteRepository();
    }

    public function calculateQuote(array $input): array
    {
        $route = [
            'pickup_postcode' => $input['pickup_postcode'] ?? '',
            'delivery_postcode' => $input['delivery_postcode'] ?? '',
        ];

        $parcels = $input['parcels'] ?? [
            [
                'weight_kg' => $input['weight_kg'] ?? 1.0,
                'length_cm' => $input['length_cm'] ?? 10.0,
                'width_cm' => $input['width_cm'] ?? 10.0,
                'height_cm' => $input['height_cm'] ?? 10.0,
                'quantity' => $input['quantity'] ?? 1,
            ]
        ];

        $serviceId = (int)($input['service_id'] ?? 1);

        $options = [
            'is_fragile' => !empty($input['is_fragile']),
            'signature_required' => !empty($input['signature_required']),
            'is_sameday' => !empty($input['is_sameday']),
        ];

        return $this->pricingEngine->calculate($route, $parcels, $serviceId, $options);
    }

    public function saveQuote(array $input): array
    {
        return $this->transaction(function () use ($input) {
            $calculation = $this->calculateQuote($input);

            $pickupSnapshot = [
                'postcode' => uk_postcode_format($input['pickup_postcode'] ?? ''),
                'address_line' => $input['pickup_address'] ?? '',
                'contact_name' => $input['pickup_contact_name'] ?? '',
                'contact_phone' => $input['pickup_phone'] ?? '',
                'zone' => $calculation['route']['pickup_zone'],
            ];

            $deliverySnapshot = [
                'postcode' => uk_postcode_format($input['delivery_postcode'] ?? ''),
                'address_line' => $input['delivery_address'] ?? '',
                'contact_name' => $input['delivery_contact_name'] ?? '',
                'contact_phone' => $input['delivery_phone'] ?? '',
                'zone' => $calculation['route']['delivery_zone'],
            ];

            $quoteData = [
                'customer_id' => $input['customer_id'] ?? null,
                'guest_email' => $input['guest_email'] ?? null,
                'service_id' => $calculation['service']['id'],
                'pickup_snapshot' => $pickupSnapshot,
                'delivery_snapshot' => $deliverySnapshot,
                'subtotal' => $calculation['pricing']['subtotal'],
                'discount' => $calculation['pricing']['discount'],
                'vat_rate' => $calculation['pricing']['vat_rate'],
                'vat_amount' => $calculation['pricing']['vat_amount'],
                'total' => $calculation['pricing']['total'],
                'currency' => 'GBP',
                'status' => 'priced',
                'valid_until' => date('Y-m-d H:i:s', strtotime('+7 days')),
                'pricing_snapshot' => $calculation['snapshot'],
                'created_by' => $input['user_id'] ?? null,
            ];

            $items = [];
            foreach ($calculation['pricing']['line_items'] as $line) {
                $items[] = [
                    'description' => $line['description'],
                    'quantity' => 1,
                    'unit_price' => $line['amount'],
                    'line_total' => $line['amount'],
                    'metadata' => ['key' => $line['key']],
                ];
            }

            return $this->quoteRepo->createQuote($quoteData, $items);
        });
    }

    public function acceptQuote(string $quoteNumber): array
    {
        $quote = $this->quoteRepo->findByNumber($quoteNumber);
        if (!$quote) {
            throw new RuntimeException("Quote [{$quoteNumber}] not found.");
        }

        if (in_array($quote['status'], ['accepted', 'converted'])) {
            return $quote;
        }

        if (strtotime($quote['valid_until']) < time()) {
            $this->quoteRepo->updateStatus($quote['id'], 'expired');
            throw new RuntimeException("Quote [{$quoteNumber}] has expired. Please calculate a new quote.");
        }

        $now = date('Y-m-d H:i:s');
        $this->quoteRepo->updateStatus($quote['id'], 'accepted', $now);

        return $this->quoteRepo->findByNumber($quoteNumber);
    }
}
