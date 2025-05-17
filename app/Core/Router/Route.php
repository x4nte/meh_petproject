<?php

namespace App\Core\Router;

class Route
{
    public function __construct(private string $uri, private string $method, private mixed $action)
    {
    }

    public static function get(string $uri, mixed $action)
    {
        return new static($uri, "GET", $action);
    }

    public static function post(string $uri, mixed $action)
    {
        return new static($uri, "POST", $action);
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