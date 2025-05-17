<?php

namespace App\Controllers;

use App\Core\Container\Container;
use App\Core\Controller\Controller;
use App\Core\Database\Database;
use App\Core\Http\Request;

class RegisterController extends Controller
{
    public function create(): void
    {
        Container::getInstance()->get(Database::class);
        $this->view('auth/register');
    }

    public function store(): void
    {
        $validation = $this->request()->validate(['email' => ['required','email' ], 'password' => ['required', 'min:7', 'max:20']]);
        if (!$validation) {
            $this->validationError('/register');
        }
        $db = Container::getInstance()->get(Database::class);
        $data = $this->request()->validated();
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $db->insert('users',$data);
        $this->redirect('/login');
    }
}