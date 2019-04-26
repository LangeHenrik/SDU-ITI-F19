<?php

namespace App\Middleware;


use App\Core\Auth\Auth;
use App\Core\Routing\Middleware;

class AuthMiddleware extends Middleware
{

    public function handle()
    {
        if(!Auth::isAuthenticated()) {
            return redirect('/auth/login?access=denied');
        }
    }


}