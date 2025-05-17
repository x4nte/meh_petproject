<?php

namespace App\Core\Router;

use App\Core\Container\Container;
use App\Core\Controller\Controller;
use App\Core\Http\Request;
use App\Core\View\View;

class Router
{
    private array $routes = [];

    public function __construct()
    {
        $this->initRoutes();
    }

    public function dispatch(): void
    {
        /** @var Request $request */
        $request = Container::getInstance()->get(Request::class);

        $route = $this->findRoute($request->uri(), $request->method());
        if (!$route) {
            http_response_code(404);
            exit;
        }
        if (is_array($route->getAction())) {
            [$controller, $action] = $route->getAction();
            $controller = new $controller;
            call_user_func([$controller, $action]);
        } else {
            $route->getAction()();
        }
    }

    public function findRoute(string $uri, string $method): false|Route
    {
        if (!isset($this->routes[$method][$uri])) {
            return false;
        }
        return $this->routes[$method][$uri];
    }

    public function initRoutes(): void
    {
        $routes = $this->getRoutes();
        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    public function getRoutes(): array
    {
        return require APP_PATH . "config/routes.php";
    }
}