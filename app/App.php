<?php

namespace App;

use App\Core\Container\Container;
use App\Core\Router\Router;
use Closure;

class App
{
    private Container $container;

    public function __construct()
    {
        $this->container = Container::getInstance();
    }

    public function register($key, Closure $value) : void
    {
        $this->container->set($key, $value);
    }

    public function run()
    {
        $this->container->get(Router::class)->dispatch();
    }
}