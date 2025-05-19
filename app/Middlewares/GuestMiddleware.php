<?php

namespace App\Middlewares;

use App\Core\Http\Request;
use App\Core\Middleware\Middleware;
use Closure;

class GuestMiddleware extends Middleware
{
    public function handle(Request $request)
    {
        if($request->session->has("user_id")) {
            $request->redirect("/");
        }
    }
}