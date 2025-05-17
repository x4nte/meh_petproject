<?php

namespace App\Core\Config;

abstract class Config
{
    private array $loaded = [];

    public function load($key): self
    {
        $this->loaded = require APP_PATH . '/config/' . $key . '.php';
        return $this;
    }

    public function get(string $key) // database.
    {
        return $this->loaded[$key];
    }
}