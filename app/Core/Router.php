<?php

declare(strict_types=1);

namespace App\Core;

final class Router
{
    /**
     * @var array<string, array<string, array>>
     */
    private array $routes = [];

    /**
     * Register a GET route.
     */
    public function get(string $uri, array $action): void
    {
        $this->routes['GET'][$uri] = $action;
    }

    /**
     * Dispatch the current request.
     */
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $uri = parse_url(
            $_SERVER['REQUEST_URI'] ?? '/',
            PHP_URL_PATH
        );

        $uri = rtrim((string) $uri, '/');

        if ($uri === '') {
            $uri = '/';
        }

        $routes = $this->routes[$method] ?? [];

        /**
         * -----------------------------------------------------
         * Match Exact Routes First
         * -----------------------------------------------------
         */

        if (isset($routes[$uri])) {

            [$controller, $function] = $routes[$uri];

            (new $controller())->{$function}();

            return;
        }

        /**
         * -----------------------------------------------------
         * Match Dynamic Routes
         * -----------------------------------------------------
         */

        foreach ($routes as $route => $action) {

            if (strpos($route, '{') === false) {
                continue;
            }

            $pattern = preg_replace(
                '#\{([a-zA-Z0-9_]+)\}#',
                '([^/]+)',
                $route
            );

            $pattern = '#^' . $pattern . '$#';

            if (
                preg_match(
                    $pattern,
                    $uri,
                    $matches
                )
            ) {

                array_shift($matches);

                [$controller, $function] = $action;

                (new $controller())->{$function}(...$matches);

                return;
            }
        }

        /**
         * -----------------------------------------------------
         * No Route Found
         * -----------------------------------------------------
         */

        http_response_code(404);

        exit('404 Page Not Found');
    }
}