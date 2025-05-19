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

    public function view(string $name,array $data = []): void
    {
        $this->container->get(View::class)->view($name, $data);
    }

    public function redirect($to)
    {
         $this->request()->redirect($to);
    }

    public function abort(int $code)
    {
        $this->view("errors/{$code}");
    }

    public function request(): Request
    {
        return $this->container->get(Request::class);
    }

    public function validationError($path, $errors = []) : void
    {
        $this->request()->session->set('errors', array_merge($errors, $this->request()->errors()));
        $this->request()->session->set('formData', $this->request()->post);
        $this->redirect($path);
    }
}