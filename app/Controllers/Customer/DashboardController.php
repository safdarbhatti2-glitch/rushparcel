<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Core\Database;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;

class DashboardController extends BaseController
{
    public function index(Request $request): Response
    {
        $customerId = Session::get('customer_id');
        $userId = Session::get('user_id');

        $shipments = [];
        $quotes = [];

        if ($customerId) {
            $shipments = Database::fetchAll(
                "SELECT s.*, srv.name as service_name
                 FROM shipments s
                 JOIN services srv ON s.service_id = srv.id
                 WHERE s.customer_id = :cid
                 ORDER BY s.created_at DESC LIMIT 5",
                [':cid' => $customerId]
            );

            $quotes = Database::fetchAll(
                "SELECT q.*, srv.name as service_name
                 FROM quotes q
                 JOIN services srv ON q.service_id = srv.id
                 WHERE q.customer_id = :cid
                 ORDER BY q.created_at DESC LIMIT 5",
                [':cid' => $customerId]
            );
        }

        return $this->render('customer.dashboard', [
            'title' => 'Customer Portal Dashboard — Rush Parcel',
            'active_page' => 'dashboard',
            'user' => Session::get('user'),
            'shipments' => $shipments,
            'quotes' => $quotes,
        ]);
    }
}
