<?php

namespace App\Middleware;

use App\Core\Config;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;

class RateLimitMiddleware implements MiddlewareInterface
{
    protected string $key;

    public function __construct(string $key = 'default')
    {
        $this->key = $key;
    }

    public function handle(Request $request): ?Response
    {
        $limits = Config::get("security.rate_limiting.{$this->key}", ['max_attempts' => 60, 'decay_seconds' => 60]);
        $maxAttempts = $limits['max_attempts'];
        $decaySeconds = $limits['decay_seconds'];

        $ip = $request->ip();
        $sessionKey = "_rate_limit_{$this->key}_" . md5($ip);

        $data = Session::get($sessionKey, ['attempts' => 0, 'reset_at' => time() + $decaySeconds]);

        if (time() > $data['reset_at']) {
            $data = ['attempts' => 0, 'reset_at' => time() + $decaySeconds];
        }

        $data['attempts']++;
        Session::set($sessionKey, $data);

        if ($data['attempts'] > $maxAttempts) {
            $retryAfter = $data['reset_at'] - time();
            if ($request->isAjax()) {
                return Response::json([
                    'error' => 'Too Many Requests',
                    'retry_after_seconds' => $retryAfter
                ], 429, ['Retry-After' => (string)$retryAfter]);
            }
            return Response::make("429 Too Many Requests. Please wait {$retryAfter} seconds before retrying.", 429, ['Retry-After' => (string)$retryAfter]);
        }

        return null;
    }
}
