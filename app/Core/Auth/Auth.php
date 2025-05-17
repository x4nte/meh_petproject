<?php

namespace App\Core\Auth;

use App\Core\Container\Container;
use App\Core\Database\Database;
use App\Core\Session\Session;

class Auth
{
    public static function login($user)
    {
        $container = Container::getInstance();
        $session = $container->get(Session::class);
        $session->set('user_id', $user['id']);
    }
}