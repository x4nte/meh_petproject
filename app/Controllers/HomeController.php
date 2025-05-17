<?php

namespace App\Controllers;

use App\Core\Controller\Controller;

class HomeController extends Controller
{
    public function index() : void
    {
         $this->view('home');
    }
}