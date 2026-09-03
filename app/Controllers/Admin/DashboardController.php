<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Core\Database;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;

class DashboardController extends BaseController
{
    public function index(Request $request): Response
    {
        $today = date('Y-m-d');

        // Calculate Key Operational KPIs
        $todaysShipments = (int)Database::fetch("SELECT COUNT(*) FROM shipments WHERE DATE(created_at) = :today", [':today' => $today])['COUNT(*)'];
        $pendingCollections = (int)Database::fetch("SELECT COUNT(*) FROM shipments WHERE status IN ('booking_confirmed', 'collection_scheduled')")['COUNT(*)'];
        $outForDelivery = (int)Database::fetch("SELECT COUNT(*) FROM shipments WHERE status = 'out_for_delivery'")['COUNT(*)'];
        $deliveredToday = (int)Database::fetch("SELECT COUNT(*) FROM shipments WHERE status = 'delivered' AND DATE(updated_at) = :today", [':today' => $today])['COUNT(*)'];
        $failedDeliveries = (int)Database::fetch("SELECT COUNT(*) FROM shipments WHERE status IN ('delivery_attempted', 'delivery_failed')")['COUNT(*)'];

        $totalRevenue = (float)Database::fetch("SELECT SUM(total_amount) as total FROM shipments")['total'];
        $outstandingInvoices = (int)Database::fetch("SELECT COUNT(*) FROM invoices WHERE status IN ('issued', 'sent', 'overdue')")['COUNT(*)'];
        $pendingQuotes = (int)Database::fetch("SELECT COUNT(*) FROM quotes WHERE status IN ('submitted', 'priced', 'sent')")['COUNT(*)'];
        $activeDrivers = (int)Database::fetch("SELECT COUNT(*) FROM drivers WHERE status = 'active'")['COUNT(*)'];

        // Recent Operational Shipments
        $recentShipments = Database::fetchAll(
            "SELECT s.*, srv.name as service_name, c.legal_name as customer_name
             FROM shipments s
             JOIN services srv ON s.service_id = srv.id
             JOIN customers c ON s.customer_id = c.id
             ORDER BY s.created_at DESC LIMIT 10"
        );

        return $this->render('admin.dashboard', [
            'title' => 'Operations Admin Dashboard — Rush Parcel',
            'active_page' => 'admin_dashboard',
            'user' => Session::get('user'),
            'kpis' => [
                'todays_shipments' => $todaysShipments,
                'pending_collections' => $pendingCollections,
                'out_for_delivery' => $outForDelivery,
                'delivered_today' => $deliveredToday,
                'failed_deliveries' => $failedDeliveries,
                'total_revenue' => $totalRevenue,
                'outstanding_invoices' => $outstandingInvoices,
                'pending_quotes' => $pendingQuotes,
                'active_drivers' => $activeDrivers,
            ],
            'recent_shipments' => $recentShipments,
        ]);
    }

    public function quotations(Request $request): Response
    {
        $quotes = Database::fetchAll(
            "SELECT q.*, c.legal_name as customer_name
             FROM quotes q
             LEFT JOIN customers c ON q.customer_id = c.id
             ORDER BY q.created_at DESC LIMIT 30"
        );

        return $this->render('admin.quotations', [
            'title' => 'Quotation Management — Admin',
            'active_page' => 'admin_quotations',
            'user' => Session::get('user'),
            'quotes' => $quotes,
        ]);
    }

    public function invoices(Request $request): Response
    {
        $search = trim($request->get('search', ''));
        $statusFilter = trim($request->get('status', ''));

        if (!empty($search)) {
            $searchUpper = strtoupper($search);
            if (str_starts_with($searchUpper, 'UK') || str_starts_with($searchUpper, 'SH')) {
                $matchingShipment = Database::fetch(
                    "SELECT id FROM shipments WHERE tracking_number = :s1 OR shipment_number = :s2 LIMIT 1",
                    [':s1' => $searchUpper, ':s2' => $searchUpper]
                );
                if ($matchingShipment) {
                    $existingInv = Database::fetch("SELECT id FROM invoices WHERE shipment_id = :sid LIMIT 1", [':sid' => $matchingShipment['id']]);
                    if (!$existingInv) {
                        $invoiceService = new \App\Services\InvoiceService();
                        $invoiceService->createInvoiceFromShipment($matchingShipment['id']);
                    }
                }
            }
        }

        $sql = "SELECT i.*, s.shipment_number, s.tracking_number, c.legal_name as customer_name
                FROM invoices i
                LEFT JOIN shipments s ON i.shipment_id = s.id
                LEFT JOIN customers c ON i.customer_id = c.id
                WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (i.invoice_number LIKE :s1 OR s.shipment_number LIKE :s2 OR s.tracking_number LIKE :s3 OR c.legal_name LIKE :s4 OR i.customer_name LIKE :s5)";
            $params[':s1'] = "%{$search}%";
            $params[':s2'] = "%{$search}%";
            $params[':s3'] = "%{$search}%";
            $params[':s4'] = "%{$search}%";
            $params[':s5'] = "%{$search}%";
        }

        if (!empty($statusFilter) && $statusFilter !== 'All billing status') {
            $sql .= " AND i.status = :st";
            $params[':st'] = strtolower($statusFilter);
        }

        $sql .= " ORDER BY i.created_at DESC LIMIT 50";

        $invoices = Database::fetchAll($sql, $params);

        return $this->render('admin.invoices', [
            'title' => 'Receipts & Invoices — Admin',
            'active_page' => 'admin_invoices',
            'user' => Session::get('user'),
            'invoices' => $invoices,
            'search' => $search,
            'status_filter' => $statusFilter,
        ]);
    }

    public function settings(Request $request): Response
    {
        return $this->render('admin.settings', [
            'title' => 'Platform Settings — Admin',
            'active_page' => 'admin_settings',
            'user' => Session::get('user'),
        ]);
    }

    public function invoicePdf(Request $request, array $params): Response
    {
        $invNumber = strtoupper(trim($params['invoiceNumber'] ?? ''));
        $invoice = Database::fetch(
            "SELECT i.*, s.shipment_number, s.tracking_number, s.scheduled_pickup_at, s.id as shipment_id, c.legal_name as customer_name, c.email as customer_email, c.phone as customer_phone
             FROM invoices i
             LEFT JOIN shipments s ON i.shipment_id = s.id
             LEFT JOIN customers c ON i.customer_id = c.id
             WHERE i.invoice_number = :n1 OR s.tracking_number = :n2 OR s.shipment_number = :n3 LIMIT 1",
            [':n1' => $invNumber, ':n2' => $invNumber, ':n3' => $invNumber]
        );

        if (!$invoice) {
            $shipment = Database::fetch(
                "SELECT id FROM shipments WHERE tracking_number = :t1 OR shipment_number = :t2 LIMIT 1",
                [':t1' => $invNumber, ':t2' => $invNumber]
            );
            if ($shipment) {
                $service = new \App\Services\InvoiceService();
                $created = $service->createInvoiceFromShipment($shipment['id']);
                return Response::redirect("/admin/invoices/{$created['invoice_number']}/pdf");
            }
        }

        if (!$invoice) {
            return Response::make("404 Invoice Not Found", 404);
        }

        $shipmentRepo = new \App\Repositories\ShipmentRepository();
        $shipment = null;
        if (!empty($invoice['shipment_number'])) {
            $shipment = $shipmentRepo->findByNumber($invoice['shipment_number']);
        }

        $items = Database::fetchAll("SELECT * FROM invoice_items WHERE invoice_id = :iid", [':iid' => $invoice['id']]);
        $payments = Database::fetchAll("SELECT * FROM payments WHERE invoice_id = :iid", [':iid' => $invoice['id']]);

        return Response::render('admin.invoice_pdf', [
            'invoice' => $invoice,
            'shipment' => $shipment,
            'items' => $items,
            'payments' => $payments,
        ]);
    }

    public function thermalReceipt(Request $request, array $params): Response
    {
        $invNumber = strtoupper(trim($params['invoiceNumber'] ?? ''));
        $invoice = Database::fetch(
            "SELECT i.*, s.shipment_number, s.tracking_number, s.id as shipment_id
             FROM invoices i
             LEFT JOIN shipments s ON i.shipment_id = s.id
             WHERE i.invoice_number = :n1 OR s.tracking_number = :n2 OR s.shipment_number = :n3 LIMIT 1",
            [':n1' => $invNumber, ':n2' => $invNumber, ':n3' => $invNumber]
        );

        if (!$invoice) {
            $shipment = Database::fetch(
                "SELECT id FROM shipments WHERE tracking_number = :t1 OR shipment_number = :t2 LIMIT 1",
                [':t1' => $invNumber, ':t2' => $invNumber]
            );
            if ($shipment) {
                $service = new \App\Services\InvoiceService();
                $created = $service->createInvoiceFromShipment($shipment['id']);
                return Response::redirect("/admin/invoices/{$created['invoice_number']}/thermal");
            }
        }

        $shipmentRepo = new \App\Repositories\ShipmentRepository();
        $shipment = null;
        if (!empty($invoice['shipment_number'])) {
            $shipment = $shipmentRepo->findByNumber($invoice['shipment_number']);
        }

        return Response::render('admin.thermal_receipt', [
            'invoice' => $invoice,
            'shipment' => $shipment,
        ]);
    }
}
