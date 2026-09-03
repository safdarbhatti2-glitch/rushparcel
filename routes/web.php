<?php

/**
 * Web & API Route Definitions — UK Delivery Platform
 */

/** @var \App\Core\Router $router */

// Public Pages
$router->get('/', 'HomeController@index');

$router->get('/services', 'ServiceController@index');
$router->get('/services/{slug}', 'ServiceController@show');

// Authentication Routes
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@authenticate', [\App\Middleware\CsrfMiddleware::class]);
$router->get('/register', 'AuthController@register');
$router->post('/register', 'AuthController@storeUser', [\App\Middleware\CsrfMiddleware::class]);
$router->post('/logout', 'AuthController@logout', [\App\Middleware\CsrfMiddleware::class]);

// Customer Portal
$router->get('/dashboard', 'Customer\DashboardController@index', [\App\Middleware\AuthMiddleware::class]);

// Driver Portal
$router->get('/driver', 'Driver\JobController@index', [\App\Middleware\AuthMiddleware::class]);
$router->get('/driver/jobs', 'Driver\JobController@index', [\App\Middleware\AuthMiddleware::class]);
$router->get('/driver/jobs/{id}', 'Driver\JobController@show', [\App\Middleware\AuthMiddleware::class]);
$router->post('/driver/jobs/{id}/status', 'Driver\JobController@updateStatus', [\App\Middleware\AuthMiddleware::class, \App\Middleware\CsrfMiddleware::class]);
$router->post('/driver/jobs/{id}/pod', 'Driver\JobController@uploadPod', [\App\Middleware\AuthMiddleware::class, \App\Middleware\CsrfMiddleware::class]);

// Admin Operations Portal (Role Restricted)
$router->get('/admin', 'Admin\DashboardController@index', [\App\Middleware\RoleMiddleware::class]);
$router->get('/admin/shipments', 'Admin\ShipmentController@index', [\App\Middleware\RoleMiddleware::class]);
$router->get('/admin/shipments/create', 'Admin\ShipmentController@create', [\App\Middleware\RoleMiddleware::class]);
$router->post('/admin/shipments/create', 'Admin\ShipmentController@store', [\App\Middleware\RoleMiddleware::class, \App\Middleware\CsrfMiddleware::class]);
$router->get('/admin/shipments/{id}', 'Admin\ShipmentController@show', [\App\Middleware\RoleMiddleware::class]);
$router->get('/admin/shipments/{id}/edit', 'Admin\ShipmentController@edit', [\App\Middleware\RoleMiddleware::class]);
$router->post('/admin/shipments/{id}/edit', 'Admin\ShipmentController@update', [\App\Middleware\RoleMiddleware::class, \App\Middleware\CsrfMiddleware::class]);
$router->get('/admin/shipments/{id}/thermal', 'Admin\ShipmentController@thermalReceipt', [\App\Middleware\RoleMiddleware::class]);
$router->post('/admin/shipments/{id}/status', 'Admin\ShipmentController@updateStatus', [\App\Middleware\RoleMiddleware::class, \App\Middleware\CsrfMiddleware::class]);
$router->post('/admin/shipments/{id}/auto-generate', 'Admin\ShipmentController@autoGenerateEvents', [\App\Middleware\RoleMiddleware::class, \App\Middleware\CsrfMiddleware::class]);
$router->post('/admin/shipments/{id}/events/{eventId}/delete', 'Admin\ShipmentController@deleteEvent', [\App\Middleware\RoleMiddleware::class, \App\Middleware\CsrfMiddleware::class]);
$router->post('/admin/shipments/{id}/assign-driver', 'Admin\ShipmentController@assignDriver', [\App\Middleware\RoleMiddleware::class, \App\Middleware\CsrfMiddleware::class]);
$router->get('/admin/quotations', 'Admin\DashboardController@quotations', [\App\Middleware\RoleMiddleware::class]);
$router->get('/admin/invoices', 'Admin\DashboardController@invoices', [\App\Middleware\RoleMiddleware::class]);
$router->get('/admin/invoices/{invoiceNumber}/pdf', 'Admin\DashboardController@invoicePdf', [\App\Middleware\RoleMiddleware::class]);
$router->get('/admin/invoices/{invoiceNumber}/thermal', 'Admin\DashboardController@thermalReceipt', [\App\Middleware\RoleMiddleware::class]);
$router->get('/admin/settings', 'Admin\DashboardController@settings', [\App\Middleware\RoleMiddleware::class]);

// Quotation System
$router->get('/quote', 'QuoteController@index');
$router->post('/quote/calculate', 'QuoteController@calculate', [\App\Middleware\CsrfMiddleware::class]);
$router->post('/quote', 'QuoteController@store', [\App\Middleware\CsrfMiddleware::class]);
$router->get('/quote/{quoteNumber}', 'QuoteController@show');
$router->post('/quote/{quoteNumber}/accept', 'QuoteController@accept', [\App\Middleware\CsrfMiddleware::class]);
$router->get('/quote/{quoteNumber}/pdf', 'QuoteController@pdf');

// Booking Engine
$router->get('/booking/{quoteNumber}', 'BookingController@create');
$router->post('/booking/{quoteNumber}', 'BookingController@store', [\App\Middleware\CsrfMiddleware::class]);
$router->get('/booking/confirmation/{shipmentNumber}', 'BookingController@confirmation');

// Tracking Portal
$router->get('/track', 'TrackingController@index');
$router->get('/track/{trackingNumber}', 'TrackingController@show');

// Information & Support
$router->get('/about', 'PageController@about');
$router->get('/partners', 'PageController@partners');
$router->get('/drop-off', 'PageController@dropOff');
$router->get('/faq', 'PageController@faq');

$router->get('/contact', 'ContactController@index');
$router->post('/contact', 'ContactController@submit', [\App\Middleware\CsrfMiddleware::class]);

// Legal & Compliance
$router->get('/terms', 'PageController@terms');
$router->get('/privacy', 'PageController@privacy');
$router->get('/cookies', 'PageController@cookies');
$router->get('/delivery-policy', 'PageController@deliveryPolicy');
$router->get('/prohibited-items', 'PageController@prohibitedItems');
$router->get('/vat-info', 'PageController@vatInfo');

// System Health API
$router->get('/health', function (\App\Core\Request $request) {
    return \App\Core\Response::json([
        'status' => 'healthy',
        'app' => config('app.name'),
        'environment' => config('app.env'),
        'timestamp' => date('c'),
    ]);
});
