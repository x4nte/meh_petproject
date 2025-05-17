<?php

namespace App\Core\Controller;


use App\Core\Container\Container;
use App\Core\Http\Request;
use App\Core\Validator\Validator;
use App\Core\View\View;

abstract class Controller
{
    protected Container $container;

    public function __construct()
    {
        $this->container = Container::getInstance();
    }

    public function view(string $name): void
    {
        $this->container->get(View::class)->view($name);
    }

    public function redirect($to)
    {
         $this->request()->redirect($to);
    }

    public function request(): Request
    {
        return $this->container->get(Request::class);
    }

    public function validationError($path, $errors = []) : void
    {
        foreach (array_merge($this->request()->errors(), $errors) as $key => $error) {
            $this->request()->session->set($key, $error);
        }
        $this->redirect($path);
    }
}