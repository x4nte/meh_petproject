<?php

namespace App\Core\Router;

use App\Core\Container\Container;
use App\Core\Controller\Controller;
use App\Core\Http\Request;
use App\Core\Middleware\Middleware;
use App\Core\View\View;

class Router
{
    private array $routes = [];

    public function __construct(private Request $request)
    {
        $this->initRoutes();
    }

    public function dispatch(): void
    {
        /** @var Request $request */
        $route = $this->findRoute($this->request->uri(), $this->request->method);
        if (!$route) {
            http_response_code(404);
            echo "Error 404";
            exit;
        }
        /** @var Route $route */
        if (is_array($route[0]->getAction())) {
            [$controller, $action] = $route[0]->getAction();
            /** @var Middleware $middleware */
            foreach ($route[0]->getMiddlewares() as $middleware) {
                $middleware = new $middleware();
                $middleware->handle($this->request);
            };
            $controller = new $controller;
            call_user_func([$controller, $action], ...$route[1]);
        } else if (is_callable($route[0]->getAction())) {
            $route[0]->getAction()();
        }
    }

    public function findRoute(string $uri, string $method): false|array
    {
        $uriExploded = explode('/', $uri);
        $pattern = '/[{}]/';
        foreach ($this->routes[$method] as $route) {
            $routeExploded = explode('/', $route->getUri());
            $bindings = [];
            if (count($routeExploded) == count($uriExploded)) {
                foreach ($routeExploded as $index => $routeExplodedIndex) {
                    $uriExplodedIndex = $uriExploded[$index];
                    if ($routeExplodedIndex == $uriExplodedIndex) {
                        continue;
                    }
                    if (preg_match($pattern, $routeExplodedIndex)) {
                        $routeExplodedIndex = preg_replace($pattern, '', $routeExplodedIndex);
                        $bindings[$routeExplodedIndex] = $uriExplodedIndex;
                        continue;
                    }
                    continue 2;
                }

                return [$route, $bindings];
            }
        }
        return false;
    }

    public
    function initRoutes(): void
    {
        $routes = $this->getRoutes();
        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    public
    function getRoutes(): array
    {
        return require APP_PATH . "config/routes.php";
    }
}