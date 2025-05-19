<?php

namespace App;

use App\Core\Container\Container;
use App\Core\Router\Router;
use Closure;

class App
{
    public function __construct(private Router $router)
    {
    }

    public function bind($key, Closure $value) : void
    {
        Container::getInstance()->bind($key, $value);
    }

    public function run()
    {
        $this->router->dispatch();
    }
}