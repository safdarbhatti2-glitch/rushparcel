<?php

namespace App\Middleware;

use App\Core\Request;
use App\Core\Response;

interface MiddlewareInterface
{
    /**
     * Intercept request. Return Response object to halt pipeline and return immediately, or null to proceed.
     */
    public function handle(Request $request): ?Response;
}
