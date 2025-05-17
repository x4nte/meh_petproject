<?php
/** @var App $app */

use App\App;
use App\Core\Auth\Auth;
use App\Core\Config\DatabaseConfig;
use App\Core\Database\Database;
use App\Core\Database\Migrator;
use App\Core\Http\Request;
use App\Core\Router\Router;
use App\Core\Session\Session;
use App\Core\Validator\Validator;
use App\Core\View\View;


$app->register(Router::class, function ($c){
    return new Router();
});

$app->register(View::class, function ($c){
    return new View($c->get(Session::class));
});

$app->register(Validator::class, function ($c){
    return new Validator();
});

$app->register(Request::class, function ($c) {
    return new Request($c->get(Validator::class), $c->get(Session::class));
});
$app->register(Session::class, function ($c) {
    return new Session();
});

$app->register(DatabaseConfig::class, function ($c) {
    return new DatabaseConfig()->load('database');
});

$app->register(Database::class, function ($c) {
    return new Database($c->get(DatabaseConfig::class))->connect();
});

$app->register(Migrator::class, function ($c) {
    return new Migrator($c->get(Database::class));
});

$app->register(Auth::class, function ($c) {
    return new Auth($c->get(Database::class));
});