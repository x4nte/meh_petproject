<?php

namespace App\Core\Auth;

use App\Core\Container\Container;
use App\Core\Database\Database;
use App\Core\Session\Session;

class Auth
{
    public function __construct(private Session $session,private Database $database)
    {
    }

    public function login($user)
    {
        $this->session->set('user_id', $user['id']);
    }

    public function logout()
    {
        $this->session->unset('user_id');
    }
}