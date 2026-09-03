<?php

namespace App\Core;

/**
 * Fast URL Router supporting GET, POST, PUT, DELETE routes, regex matching, and middleware.
 */
class Router
{
    protected array $routes = [];

    public function get(string $path, callable|array|string $action, array $middleware = []): void
    {
        $this->addRoute('GET', $path, $action, $middleware);
    }

    public function post(string $path, callable|array|string $action, array $middleware = []): void
    {
        $this->addRoute('POST', $path, $action, $middleware);
    }

    public function put(string $path, callable|array|string $action, array $middleware = []): void
    {
        $this->addRoute('PUT', $path, $action, $middleware);
    }

    public function delete(string $path, callable|array|string $action, array $middleware = []): void
    {
        $this->addRoute('DELETE', $path, $action, $middleware);
    }

    public function addRoute(string $method, string $path, callable|array|string $action, array $middleware = []): void
    {
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $path);
        $pattern = '#^' . $pattern . '$#';

        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'pattern' => $pattern,
            'action' => $action,
            'middleware' => $middleware,
        ];
    }

    public function dispatch(Request $request): Response
    {
        $method = $request->method();
        $uri = $request->uri();

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            if (preg_match($route['pattern'], $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Run Middleware Pipeline
                foreach ($route['middleware'] as $middlewareClass) {
                    $middleware = new $middlewareClass();
                    $result = $middleware->handle($request);
                    if ($result instanceof Response) {
                        return $result;
                    }
                }

                // Resolve Action
                $action = $route['action'];

                if (is_callable($action)) {
                    $response = call_user_func_array($action, [$request, $params]);
                } elseif (is_array($action) && count($action) === 2) {
                    $controller = new $action[0]();
                    $response = call_user_func_array([$controller, $action[1]], [$request, $params]);
                } elseif (is_string($action) && strpos($action, '@') !== false) {
                    list($controllerClass, $methodName) = explode('@', $action, 2);
                    $fullController = 'App\\Controllers\\' . $controllerClass;
                    $controller = new $fullController();
                    $response = call_user_func_array([$controller, $methodName], [$request, $params]);
                } else {
                    throw new \RuntimeException("Invalid route handler defined for path [{$uri}]");
                }

                if ($response instanceof Response) {
                    return $response;
                }

                if (is_string($response)) {
                    return new Response($response);
                }

                if (is_array($response) || is_object($response)) {
                    return Response::json($response);
                }

                return new Response();
            }
        }

        return Response::make("404 Not Found - The requested URL {$uri} was not found.", 404);
    }
}
