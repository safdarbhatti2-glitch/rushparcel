<?php

namespace App\Middleware;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;

class RoleMiddleware implements MiddlewareInterface
{
    protected array $allowedRoles;

    public function __construct(array $allowedRoles = ['admin', 'super_admin', 'operations', 'dispatcher', 'finance', 'support'])
    {
        $this->allowedRoles = $allowedRoles;
    }

    public function handle(Request $request): ?Response
    {
        if (!Session::has('user_id')) {
            if ($request->isAjax()) {
                return Response::json(['error' => 'Unauthenticated'], 401);
            }
            Session::flash('error', 'Please login to access the Admin Control Centre.');
            return Response::redirect('/login');
        }

        $userRole = Session::get('user_role', 'customer');
        if (!in_array($userRole, $this->allowedRoles)) {
            if ($request->isAjax()) {
                return Response::json(['error' => 'Forbidden: Insufficient Permissions'], 403);
            }
            Session::flash('error', 'Administrator access required. Please login with your admin account credentials (admin@rushparcel.co.uk).');
            return Response::redirect('/login');
        }

        return null;
    }
}
