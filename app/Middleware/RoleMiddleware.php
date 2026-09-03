<?php

namespace App\Middleware;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;

class RoleMiddleware implements MiddlewareInterface
{
    protected array $allowedRoles;

    public function __construct(array $allowedRoles = ['admin', 'super_admin', 'operations'])
    {
        $this->allowedRoles = $allowedRoles;
    }

    public function handle(Request $request): ?Response
    {
        if (!Session::has('user_id')) {
            if ($request->isAjax()) {
                return Response::json(['error' => 'Unauthenticated'], 401);
            }
            Session::flash('error', 'Please login to access this operational area.');
            return Response::redirect('/login');
        }

        $userRole = Session::get('user_role', 'customer');
        if (!in_array($userRole, $this->allowedRoles)) {
            if ($request->isAjax()) {
                return Response::json(['error' => 'Forbidden: Insufficient Permissions'], 403);
            }
            return Response::make("403 Forbidden — You do not have authorization to access this area.", 403);
        }

        return null;
    }
}
