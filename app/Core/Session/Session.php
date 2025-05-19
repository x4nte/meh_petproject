<?php

namespace App\Core\Session;
class Session
{
    public function get(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public function set(string $key, string|array $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function unset(string $key): void
    {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public function getFlash(string $key)
    {
        $value = $this->get($key);
        $this->unset($key);
        return $value;
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }
}