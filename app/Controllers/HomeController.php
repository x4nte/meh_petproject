<?php

namespace App\Controllers;

use App\Core\Container\Container;
use App\Core\Controller\Controller;
use App\Core\Session\Session;

class HomeController extends Controller
{
    public function index(): void
    {
        $session = Container::getInstance()->get(Session::class);
        $this->view('home');
    }

}