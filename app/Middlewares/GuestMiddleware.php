<?php

namespace App\Middlewares;

use App\Core\Http\Request;
use App\Core\Middleware\Middleware;
use Closure;

class AuthMiddleware extends Middleware
{
    public function handle(Request $request)
    {
        $userId = $request->session->get("user_id");
        if(!$userId) {
            $request->redirect("/login");
        }
    }
}