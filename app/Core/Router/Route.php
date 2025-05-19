<?php

namespace App\Core\Router;

class Route
{
    private array $middlewares = [];

    public function __construct(private string $uri, private string $method, private mixed $action)
    {
    }

    private static function addRoute($uri, $method, $action)
    {
        return new static($uri, $method, $action);
    }

    public static function get(string $uri, mixed $action)
    {
        return self::addRoute($uri, 'GET', $action);
    }

    public static function post(string $uri, mixed $action)
    {
        return self::addRoute($uri, 'POST', $action);
    }

    public static function delete(string $uri, mixed $action)
    {
        return self::addRoute($uri, 'DELETE', $action);
    }

    public static function patch(string $uri, mixed $action)
    {
        return self::addRoute($uri, 'PATCH', $action);
    }

    public function middleware(string $class): self
    {
        $this->middlewares[] = $class;
        return $this;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getAction(): mixed
    {
        return $this->action;
    }


}