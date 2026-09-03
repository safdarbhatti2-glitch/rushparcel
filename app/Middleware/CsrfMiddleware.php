<?php

namespace App\Middleware;

use App\Core\Csrf;
use App\Core\Request;
use App\Core\Response;

class CsrfMiddleware implements MiddlewareInterface
{
    public function handle(Request $request): ?Response
    {
        if (in_array($request->method(), ['POST', 'PUT', 'DELETE'])) {
            $token = $request->input('_csrf_token') ?? $request->input('csrf_token');

            if (!$token && isset($_SERVER['HTTP_X_CSRF_TOKEN'])) {
                $token = $_SERVER['HTTP_X_CSRF_TOKEN'];
            }

            if (!Csrf::validate($token)) {
                if ($request->isAjax()) {
                    return Response::json(['error' => 'CSRF Token Mismatch'], 419);
                }
                return Response::make('419 Page Expired - CSRF token mismatch or expired.', 419);
            }
        }

        return null;
    }
}
