<?php

namespace App\Core\Middleware;

use App\Core\Http\Request;
abstract class Middleware
{
    public function handle(Request $request)
    {}
}