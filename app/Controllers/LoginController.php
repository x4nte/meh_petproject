<?php

namespace App\Controllers;

use App\Core\Auth\Auth;
use App\Core\Container\Container;
use App\Core\Controller\Controller;
use App\Core\Database\Database;
use App\Core\Http\Request;

class LoginController extends Controller
{
    private Auth $auth;

    public function __construct()
    {
        parent::__construct();
        $this->auth = Container::getInstance()->get(Auth::class);
    }

    public function create(): void
    {
        $this->view('auth/login');
    }

    public function store(): void
    {
        $validation = $this->request()->validate(['email' => ['required', 'email'], 'password' => ['required', 'min:7', 'max:20']]);
        if (!$validation) {
            $this->validationError('/login');
        }

        $data = $this->request()->validated();

        $db = Container::getInstance()->get(Database::class);
        $result = $db->find('users', ['email' => $data['email']]);
        if (!$result) {
            $this->validationError('/login', ['email' => 'User does not exist']);
        }
        if (password_verify($data['password'], $result['password'])) {
            $this->auth->login($result);
            $this->redirect('/');
            return;
        }
        $this->validationError('/login', ['email' => 'Invalid credentials']);
    }

    public function destroy()
    {
        $this->auth->logout();
        $this->redirect('/login');
    }
}