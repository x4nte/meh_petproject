<?php

namespace App\Core\Session;

use App\Core\Http\Request;

class Session
{
    public function get(string $key)
    {
        return $_SESSION[$key];
    }

    public function set(string $key, string $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function getFlash(string $key)
    {
        $value =  $_SESSION[$key];
        unset($_SESSION[$key]);
        return $value;
    }

    public function has(string $key) : bool
    {
        return (bool) $_SESSION[$key];
    }
}