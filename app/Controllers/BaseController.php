<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;

/**
 * Base Controller providing view rendering, JSON responses, CSRF validation, and session helpers.
 */
abstract class BaseController
{
    protected function render(string $view, array $data = [], int $statusCode = 200): Response
    {
        // Inject common layout variables
        $data['csrf_token'] = Csrf::getToken();
        $data['csrf_field'] = Csrf::field();
        $data['flash_success'] = Session::flash('success');
        $data['flash_error'] = Session::flash('error');
        $data['current_user'] = Session::get('user');

        return Response::render($view, $data, $statusCode);
    }

    protected function json(mixed $data, int $statusCode = 200): Response
    {
        return Response::json($data, $statusCode);
    }

    protected function redirect(string $url): Response
    {
        return Response::redirect($url);
    }

    protected function validateCsrf(Request $request): bool
    {
        $token = $request->input('_csrf_token') ?? $request->input('csrf_token');
        if (!$token && isset($_SERVER['HTTP_X_CSRF_TOKEN'])) {
            $token = $_SERVER['HTTP_X_CSRF_TOKEN'];
        }

        if (!Csrf::validate($token)) {
            Session::flash('error', 'Invalid or expired security token. Please try again.');
            return false;
        }

        return true;
    }
}
