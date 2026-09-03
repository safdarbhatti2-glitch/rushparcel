<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Repositories\QuoteRepository;
use App\Repositories\ShipmentRepository;
use App\Services\BookingService;
use RuntimeException;

class BookingController extends BaseController
{
    protected BookingService $bookingService;
    protected QuoteRepository $quoteRepo;
    protected ShipmentRepository $shipmentRepo;

    public function __construct(
        ?BookingService $bookingService = null,
        ?QuoteRepository $quoteRepo = null,
        ?ShipmentRepository $shipmentRepo = null
    ) {
        $this->bookingService = $bookingService ?? new BookingService();
        $this->quoteRepo = $quoteRepo ?? new QuoteRepository();
        $this->shipmentRepo = $shipmentRepo ?? new ShipmentRepository();
    }

    public function create(Request $request, array $params): Response
    {
        $quoteNumber = strtoupper(trim($params['quoteNumber'] ?? ''));
        $quote = $this->quoteRepo->findByNumber($quoteNumber);

        if (!$quote) {
            return Response::make("404 Quote Not Found", 404);
        }

        if ($quote['status'] === 'converted') {
            Session::flash('error', "Quote [{$quoteNumber}] has already been booked as a shipment.");
            return Response::redirect("/quote/{$quoteNumber}");
        }

        return $this->render('public.booking_form', [
            'title' => "Complete Booking — Quote {$quote['quote_number']}",
            'active_page' => 'quote',
            'quote' => $quote,
        ]);
    }

    public function store(Request $request, array $params): Response
    {
        if (!$this->validateCsrf($request)) {
            return Response::redirect("/booking/{$params['quoteNumber']}");
        }

        $quoteNumber = strtoupper(trim($params['quoteNumber'] ?? ''));

        $input = [
            'pickup_name' => trim($request->input('pickup_name', '')),
            'pickup_phone' => trim($request->input('pickup_phone', '')),
            'pickup_email' => trim($request->input('pickup_email', '')),
            'pickup_house_number' => trim($request->input('pickup_house_number', '')),
            'pickup_street' => trim($request->input('pickup_street', '')),
            'pickup_town' => trim($request->input('pickup_town', '')),
            'pickup_postcode' => trim($request->input('pickup_postcode', '')),

            'delivery_name' => trim($request->input('delivery_name', '')),
            'delivery_phone' => trim($request->input('delivery_phone', '')),
            'delivery_house_number' => trim($request->input('delivery_house_number', '')),
            'delivery_street' => trim($request->input('delivery_street', '')),
            'delivery_town' => trim($request->input('delivery_town', '')),
            'delivery_postcode' => trim($request->input('delivery_postcode', '')),

            'scheduled_pickup_date' => trim($request->input('scheduled_pickup_date', '')),
            'special_instructions' => trim($request->input('special_instructions', '')),
            'declared_value' => (float)$request->input('declared_value', 50.00),
            'user_id' => Session::get('user_id'),
        ];

        try {
            $shipment = $this->bookingService->createBookingFromQuote($quoteNumber, $input);
            Session::flash('success', "Shipment Booking Confirmed! Tracking Number: {$shipment['tracking_number']}");
            return Response::redirect("/booking/confirmation/{$shipment['shipment_number']}");
        } catch (\Throwable $e) {
            Session::flash('error', "Booking failed: " . $e->getMessage());
            return Response::redirect("/booking/{$quoteNumber}");
        }
    }

    public function confirmation(Request $request, array $params): Response
    {
        $shipmentNumber = strtoupper(trim($params['shipmentNumber'] ?? ''));
        $shipment = $this->shipmentRepo->findByNumber($shipmentNumber);

        if (!$shipment) {
            return Response::make("404 Shipment Not Found", 404);
        }

        return $this->render('public.booking_confirmation', [
            'title' => "Booking Confirmed — Shipment {$shipment['shipment_number']}",
            'active_page' => 'quote',
            'shipment' => $shipment,
        ]);
    }
}
