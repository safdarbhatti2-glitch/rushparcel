<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Services\QuoteService;
use RuntimeException;

class QuoteController extends BaseController
{
    protected QuoteService $quoteService;

    public function __construct(?QuoteService $quoteService = null)
    {
        $this->quoteService = $quoteService ?? new QuoteService();
    }

    public function index(Request $request): Response
    {
        $services = Database::fetchAll("SELECT id, name, slug, description FROM services WHERE active = 1 ORDER BY sort_order ASC");

        return $this->render('public.quote_wizard', [
            'title' => 'Instant Quote Calculator — Rush Parcel',
            'active_page' => 'quote',
            'services' => $services,
            'calculation' => null,
            'input' => [],
        ]);
    }

    public function calculate(Request $request): Response
    {
        $services = Database::fetchAll("SELECT id, name, slug, description FROM services WHERE active = 1 ORDER BY sort_order ASC");

        $input = [
            'pickup_postcode' => trim($request->input('pickup_postcode', '')),
            'delivery_postcode' => trim($request->input('delivery_postcode', '')),
            'service_id' => (int)$request->input('service_id', 1),
            'weight_kg' => (float)$request->input('weight_kg', 1.0),
            'length_cm' => (float)$request->input('length_cm', 10.0),
            'width_cm' => (float)$request->input('width_cm', 10.0),
            'height_cm' => (float)$request->input('height_cm', 10.0),
            'quantity' => (int)$request->input('quantity', 1),
            'is_fragile' => !empty($request->input('is_fragile')),
            'signature_required' => !empty($request->input('signature_required')),
            'guest_email' => trim($request->input('guest_email', '')),
        ];

        $calculation = null;
        $error = null;

        try {
            $calculation = $this->quoteService->calculateQuote($input);

            if ($request->isAjax()) {
                return Response::json(['success' => true, 'calculation' => $calculation]);
            }
        } catch (\Throwable $e) {
            $error = $e->getMessage();
            if ($request->isAjax()) {
                return Response::json(['success' => false, 'error' => $error], 400);
            }
        }

        return $this->render('public.quote_wizard', [
            'title' => 'Instant Quote Calculation — Rush Parcel',
            'active_page' => 'quote',
            'services' => $services,
            'calculation' => $calculation,
            'input' => $input,
            'error_message' => $error,
        ]);
    }

    public function store(Request $request): Response
    {
        if (!$this->validateCsrf($request)) {
            return Response::redirect('/quote');
        }

        $input = [
            'pickup_postcode' => trim($request->input('pickup_postcode', '')),
            'delivery_postcode' => trim($request->input('delivery_postcode', '')),
            'service_id' => (int)$request->input('service_id', 1),
            'weight_kg' => (float)$request->input('weight_kg', 1.0),
            'length_cm' => (float)$request->input('length_cm', 10.0),
            'width_cm' => (float)$request->input('width_cm', 10.0),
            'height_cm' => (float)$request->input('height_cm', 10.0),
            'quantity' => (int)$request->input('quantity', 1),
            'is_fragile' => !empty($request->input('is_fragile')),
            'signature_required' => !empty($request->input('signature_required')),
            'guest_email' => trim($request->input('guest_email', '')),
            'pickup_address' => trim($request->input('pickup_address', '')),
            'delivery_address' => trim($request->input('delivery_address', '')),
            'customer_id' => Session::get('customer_id'),
            'user_id' => Session::get('user_id'),
        ];

        try {
            $quote = $this->quoteService->saveQuote($input);
            Session::flash('success', "Quote [{$quote['quote_number']}] generated successfully!");
            return Response::redirect("/quote/{$quote['quote_number']}");
        } catch (\Throwable $e) {
            Session::flash('error', "Failed to save quote: " . $e->getMessage());
            return Response::redirect('/quote');
        }
    }

    public function show(Request $request, array $params): Response
    {
        $quoteNumber = strtoupper(trim($params['quoteNumber'] ?? ''));
        $quoteRepo = new \App\Repositories\QuoteRepository();
        $quote = $quoteRepo->findByNumber($quoteNumber);

        if (!$quote) {
            return Response::make("404 Quote Not Found", 404);
        }

        return $this->render('public.quote_detail', [
            'title' => "Quote {$quote['quote_number']} — Rush Parcel",
            'active_page' => 'quote',
            'quote' => $quote,
        ]);
    }

    public function accept(Request $request, array $params): Response
    {
        if (!$this->validateCsrf($request)) {
            return Response::redirect("/quote/{$params['quoteNumber']}");
        }

        $quoteNumber = strtoupper(trim($params['quoteNumber'] ?? ''));

        try {
            $quote = $this->quoteService->acceptQuote($quoteNumber);
            Session::flash('success', "Quote [{$quote['quote_number']}] accepted! Proceeding to booking...");
            return Response::redirect("/quote/{$quote['quote_number']}");
        } catch (\Throwable $e) {
            Session::flash('error', $e->getMessage());
            return Response::redirect("/quote/{$quoteNumber}");
        }
    }

    public function pdf(Request $request, array $params): Response
    {
        $quoteNumber = strtoupper(trim($params['quoteNumber'] ?? ''));
        $quoteRepo = new \App\Repositories\QuoteRepository();
        $quote = $quoteRepo->findByNumber($quoteNumber);

        if (!$quote) {
            return Response::make("404 Quote Not Found", 404);
        }

        return Response::render('public.quote_pdf', [
            'quote' => $quote,
        ]);
    }
}
