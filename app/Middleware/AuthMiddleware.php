<?php

namespace App\Middleware;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(Request $request): ?Response
    {
        if (!Session::has('user_id')) {
            if ($request->isAjax()) {
                return Response::json(['error' => 'Unauthenticated'], 401);
            }
            Session::flash('error', 'Please login to access this page.');
            return Response::redirect('/login');
        }

        return null;
    }
}
