<?php
/** @var App $app */

use App\App;
use App\Core\Config\DatabaseConfig;
use App\Core\Container\Container;
use App\Core\Database\Database;

$container = Container::getInstance();

$container->bind(DatabaseConfig::class, function ($c) {
    return new DatabaseConfig()->load('database');
});

$container->bind(Database::class, function ($c) {
    return new Database($c->get(DatabaseConfig::class))->connect();
});