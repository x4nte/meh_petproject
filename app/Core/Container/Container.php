<?php

namespace App\Core\Container;

use App\Core\Http\Request;
use App\Core\Router\Route;
use App\Core\Router\Router;
use App\Core\Validator\Validator;
use App\Core\View\View;
use Closure;

class StaticData
{
    public static string $someData;
}



class Container
{
    private static Container $instance;

    private array $objects = [];

    private array $factories = [];

    public function has($key) : bool
    {
        if(isset($this->objects[$key])){
            return true;
        }
        return false;
    }

    public function get($key) : mixed
    {
        if(!$this->has($key)){
            $this->objects[$key] = $this->factories[$key]($this);
        }
        return $this->objects[$key];
    }

    public function set($key, Closure $value) : void
    {
        $this->factories[$key] = $value;
    }

    public static function getInstance() : self
    {
        if(isset(self::$instance)){
            return self::$instance;
        }
        self::$instance = new self();
        return self::$instance;
    }
}