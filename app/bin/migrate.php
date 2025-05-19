<?php

use App\App;
use App\Core\Container\Container;
use App\Core\Database\Migrator;


const APP_PATH = __DIR__ . '/../../';

require_once APP_PATH . 'vendor/autoload.php';

require APP_PATH . 'bootstrap/bootstrap.php';

Container::getInstance()->get(Migrator::class)->migrate();

