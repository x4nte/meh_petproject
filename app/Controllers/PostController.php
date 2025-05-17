<?php

namespace App\Controllers;

use App\Core\Container\Container;
use App\Core\Controller\Controller;
use App\Core\Database\Database;

class PostController extends Controller
{
    public function index(): void
    {
        $this->view('posts/index');
    }

    public function create(): void
    {
        $this->view('posts/create');
    }

    public function store() : void
    {
        $validation = $this->request()->validate(['title' => ['min:5', 'required'], 'body' => ['required', 'min:5']]);
        if (!$validation) {
            $this->validationError('/posts/create');
        }
    }
}