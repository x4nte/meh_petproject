<?php

namespace App\Core\Container;

use App\Core\Auth\Auth;
use App\Core\Database\Database;
use App\Core\Http\Request;
use App\Core\Router\Router;
use Closure;
use ReflectionClass;

class Container
{
    private static Container $instance;

    private array $instances = [];

    public function has($key): bool
    {
        if (isset($this->instances[$key])) {
            return true;
        }
        return false;
    }

    public function get($key): mixed
    {
        if ($this->has($key)) {
            return $this->instances[$key];
        }

        if (!class_exists($key)) {
            throw new \Exception("Class {$key} not found");
        }

        $reflector = new ReflectionClass($key);

        $constructor = $reflector->getConstructor();
        $deps = [];
        if ($constructor) {
            $parameters = $constructor->getParameters();
            foreach ($parameters as $parameter) {
                $deps[] = $this->get($parameter->getType()->getName());
            }
        }
            $this->instances[$key] = $reflector->newInstanceArgs($deps);

            return $this->instances[$key];
    }

    public function bind($key, Closure $value): void
    {
        $this->instances[$key] = $value($this);
    }

    public static function getInstance(): self
    {
        if (isset(self::$instance)) {
            return self::$instance;
        }
        self::$instance = new self();
        return self::$instance;
    }
}