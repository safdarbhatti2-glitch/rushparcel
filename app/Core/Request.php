<?php

namespace App\Core;

/**
 * HTTP Request Abstraction Wrapper.
 */
class Request
{
    protected array $server;
    protected array $get;
    protected array $post;
    protected array $files;
    protected array $cookies;
    protected ?array $jsonBody = null;

    public function __construct(
        ?array $server = null,
        ?array $get = null,
        ?array $post = null,
        ?array $files = null,
        ?array $cookies = null
    ) {
        $this->server = $server ?? $_SERVER;
        $this->get = $get ?? $_GET;
        $this->post = $post ?? $_POST;
        $this->files = $files ?? $_FILES;
        $this->cookies = $cookies ?? $_COOKIE;
    }

    public function method(): string
    {
        $method = strtoupper($this->server['REQUEST_METHOD'] ?? 'GET');
        if ($method === 'POST' && isset($this->post['_method'])) {
            $method = strtoupper($this->post['_method']);
        }
        return $method;
    }

    public function uri(): string
    {
        $uri = $this->server['REQUEST_URI'] ?? '/';
        $position = strpos($uri, '?');
        if ($position !== false) {
            $uri = substr($uri, 0, $position);
        }
        return '/' . trim($uri, '/');
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->get[$key] ?? $default;
    }

    public function post(string $key, mixed $default = null): mixed
    {
        return $this->post[$key] ?? $default;
    }

    public function input(string $key, mixed $default = null): mixed
    {
        if (isset($this->post[$key])) {
            return $this->post[$key];
        }

        if (isset($this->get[$key])) {
            return $this->get[$key];
        }

        $json = $this->json();
        if (isset($json[$key])) {
            return $json[$key];
        }

        return $default;
    }

    public function all(): array
    {
        return array_merge($this->get, $this->post, $this->json() ?? []);
    }

    public function json(): ?array
    {
        if ($this->jsonBody === null) {
            $content = file_get_contents('php://input');
            if (!empty($content)) {
                $decoded = json_decode($content, true);
                $this->jsonBody = is_array($decoded) ? $decoded : [];
            } else {
                $this->jsonBody = [];
            }
        }
        return $this->jsonBody;
    }

    public function file(string $key): ?array
    {
        return $this->files[$key] ?? null;
    }

    public function ip(): string
    {
        if (!empty($this->server['HTTP_CLIENT_IP'])) {
            return $this->server['HTTP_CLIENT_IP'];
        }
        if (!empty($this->server['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(',', $this->server['HTTP_X_FORWARDED_FOR']);
            return trim($ips[0]);
        }
        return $this->server['REMOTE_ADDR'] ?? '127.0.0.1';
    }

    public function userAgent(): string
    {
        return $this->server['HTTP_USER_AGENT'] ?? '';
    }

    public function isAjax(): bool
    {
        return isset($this->server['HTTP_X_REQUESTED_WITH']) &&
               strtolower($this->server['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    public function isSecure(): bool
    {
        return (!empty($this->server['HTTPS']) && $this->server['HTTPS'] !== 'off') ||
               (isset($this->server['SERVER_PORT']) && $this->server['SERVER_PORT'] == 443);
    }
}
