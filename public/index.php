<?php
session_start();

use App\App;
use App\Core\Container\Container;
use App\Core\Database\Database;

const APP_PATH = __DIR__ . '/../';
require APP_PATH . 'vendor/autoload.php';

require APP_PATH . 'bootstrap/bootstrap.php';

$app = Container::getInstance()->get(App::class);
$app->run();
