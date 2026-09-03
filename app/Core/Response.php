<?php

namespace App\Core;

/**
 * HTTP Response Helper & Renderer.
 */
class Response
{
    protected int $statusCode = 200;
    protected array $headers = [];
    protected string $content = '';

    public function __construct(string $content = '', int $statusCode = 200, array $headers = [])
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public static function make(string $content = '', int $statusCode = 200, array $headers = []): static
    {
        return new static($content, $statusCode, $headers);
    }

    public static function json(mixed $data, int $statusCode = 200, array $headers = []): static
    {
        $headers['Content-Type'] = 'application/json; charset=utf-8';
        $content = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return new static($content, $statusCode, $headers);
    }

    public static function redirect(string $url, int $statusCode = 302): static
    {
        return new static('', $statusCode, ['Location' => $url]);
    }

    public static function render(string $view, array $data = [], int $statusCode = 200): static
    {
        $viewFile = APP_PATH . '/Views/' . str_replace('.', '/', $view) . '.php';

        if (!file_exists($viewFile)) {
            throw new \RuntimeException("View file [{$view}] not found at {$viewFile}");
        }

        extract($data);
        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        return new static($content, $statusCode, ['Content-Type' => 'text/html; charset=utf-8']);
    }

    public function setStatusCode(int $statusCode): static
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function setHeader(string $name, string $value): static
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function send(): void
    {
        if (headers_sent()) {
            echo $this->content;
            return;
        }

        http_response_code($this->statusCode);

        foreach ($this->headers as $name => $value) {
            header("{$name}: {$value}");
        }

        echo $this->content;
    }
}
