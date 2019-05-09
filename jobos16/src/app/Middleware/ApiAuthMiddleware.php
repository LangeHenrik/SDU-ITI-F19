<?php

namespace App\Middleware;


use App\Core\Auth\Auth;
use App\Core\Routing\Middleware;
use App\Core\Utility\Hash;
use App\Core\Utility\Input;
use App\User;

class ApiAuthMiddleware extends Middleware
{

    public function handle()
    {
        // Validate login on post
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !Auth::isAuthenticated()) {
            // Try to auth user
            if(Input::get('json/username') && Input::get('json/password')) {
                $user = User::findWhere(["email", "=", Input::get('json/username')]);

                if($user) {
                    if(Hash::validate(Input::get('json/password', false), $user->password)) {
                        // Create session for user
                        Auth::authenticate($user->id);
                    } else {
                        return ['auth' => [
                            'error' => 'Username and password combination is wrong',
                        ]];
                    }
                } else {
                    return ['auth' => [
                        'error' => 'Unable to find user',
                    ]];
                }
            } else {
                return ['auth' => [
                    'error' => 'Username and password was not supplied',
                ]];
            }
        }
    }


}