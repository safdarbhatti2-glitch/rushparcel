<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;

class ServiceController extends BaseController
{
    protected array $services = [
        'parcel-delivery' => [
            'title' => 'Standard & Express Parcel Delivery',
            'icon' => '📦',
            'tagline' => 'Reliable UK door-to-door parcel delivery with full online tracking.',
            'description' => 'Send packages anywhere across the United Kingdom with flexible collection and delivery windows. Choose standard 48-hour or express next-day services backed by photo proof of delivery.',
            'features' => [
                'Door-to-door collection from your home or office',
                'Real-time GPS milestone tracking',
                'Signature on delivery & delivery photo capture',
                'Up to 30kg parcel weight allowance',
            ]
        ],
        'business-logistics' => [
            'title' => 'B2B & Corporate Logistics',
            'icon' => '🏢',
            'tagline' => 'Tailored scheduled logistics, multi-parcel bookings, and monthly invoicing.',
            'description' => 'Designed for UK businesses requiring daily collections, dedicated courier routes, volume discounts, and credit account facilities with itemised monthly VAT invoices.',
            'features' => [
                'Dedicated corporate account manager',
                'Volume rate cards & custom postcode discounts',
                'Multi-parcel CSV booking import',
                'Flexible 30-day payment terms for credit accounts',
            ]
        ],
        'same-day-delivery' => [
            'title' => 'Same-Day Courier Service',
            'icon' => '⚡',
            'tagline' => 'Urgent direct courier delivery within hours across major UK cities.',
            'description' => 'When time is critical, our dedicated same-day couriers pick up your urgent parcel or document within 60 minutes and drive directly to the destination with live status updates.',
            'features' => [
                'Collection within 60 minutes of booking confirmation',
                'Direct van/motorcycle courier transport',
                'Instant recipient signature notification',
                'Available 24/7 365 days a year',
            ]
        ],
        'international-shipping' => [
            'title' => 'Worldwide International Shipping',
            'icon' => '✈️',
            'tagline' => 'Global parcel shipping with integrated customs document assistance.',
            'description' => 'Ship parcels to Europe, North America, Asia, and over 220 worldwide destinations with full customs paperwork clearance, HS code classification guidance, and duty estimates.',
            'features' => [
                'Express air freight & economy courier routes',
                'Commercial invoice & customs declaration support',
                'DDP and DAP incoterm options',
                'Door-to-door international tracking',
            ]
        ],
        'uk-europe-shipping' => [
            'title' => 'UK & Europe Road Freight',
            'icon' => '🚚',
            'tagline' => 'Scheduled European road freight and pallet delivery services.',
            'description' => 'Economical road transport connecting the UK to European Union destinations. Ideal for larger shipments, multi-box deliveries, and palletized commercial goods.',
            'features' => [
                'Scheduled weekly departures across Europe',
                'Pallet & oversized cargo transport',
                'Customs transit declarations (T1/T2)',
                'Full cargo transit insurance coverage',
            ]
        ],
        'forwarding-address' => [
            'title' => 'UK Forwarding Address Service',
            'icon' => '📫',
            'tagline' => 'Virtual UK mailing address with parcel consolidation and international forwarding.',
            'description' => 'Get a dedicated UK address to receive online shopping or business mail. We inspect, consolidate, and forward your items anywhere worldwide at low courier rates.',
            'features' => [
                'Dedicated UK suite address',
                'Parcel photo inspection upon arrival',
                'Multi-package consolidation to save shipping fees',
                'Repackaging & international dispatch',
            ]
        ],
        'customs-clearance' => [
            'title' => 'Customs Clearance & Brokerage',
            'icon' => '📑',
            'tagline' => 'Expert UK import & export customs clearance management.',
            'description' => 'Navigate UK post-Brexit customs procedures seamlessly. Our experienced customs team prepares import/export declarations, checks HS tariff codes, and processes duty payments.',
            'features' => [
                'CDS import & export customs entries',
                'EORI & VAT compliance verification',
                'Customs duty & VAT assessment',
                'Document validation & clearance status tracking',
            ]
        ],
    ];

    public function index(Request $request): Response
    {
        return $this->render('public.services', [
            'title' => 'Courier & Logistics Services — Rush Parcel',
            'active_page' => 'services',
            'services' => $this->services,
        ]);
    }

    public function show(Request $request, array $params): Response
    {
        $slug = $params['slug'] ?? '';
        if (!isset($this->services[$slug])) {
            return Response::make("Service not found", 404);
        }

        return $this->render('public.service_detail', [
            'title' => $this->services[$slug]['title'] . ' — Rush Parcel',
            'active_page' => 'services',
            'service' => $this->services[$slug],
            'slug' => $slug,
        ]);
    }
}
