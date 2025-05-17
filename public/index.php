<?php
session_start();
use App\App;

const APP_PATH = __DIR__ . '/../';
require APP_PATH . 'vendor/autoload.php';
$app = new App();

require APP_PATH . 'bootstrap/bootstrap.php';

$app->run();
