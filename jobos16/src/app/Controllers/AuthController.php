<?php
namespace App\Controllers;

use App\Core\Auth\Auth;
use App\Core\Response\Redirect;
use App\Core\Utility\Hash;
use App\Core\Utility\Input;
use App\Core\ViewRenderer\View;
use App\User;

class AuthController extends Controller
{

    public function index()
    {
        if(Auth::isAuthenticated()) {
            return Redirect::to("/feed");
        }
        return Redirect::to("/auth/login");
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginProcess()
    {
        $user = User::findWhere(["email", "=", Input::get('email')]);
        if($user) {
            if(Hash::validate(Input::get('password', false), $user->password)) {
                // Create session for user
                Auth::authenticate($user->id);

                return redirect('/feed');
            }
        }

        return redirect('/auth/login?error=true');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerProcess()
    {
        // Create user instance
        $user = new User([
            'first_name'    => Input::get('first_name'),
            'last_name'     => Input::get('last_name'),
            'email'         => Input::get('email'),
            'gender'        => Input::get('gender'),
            'city'          => Input::get('city'),
            'zip'           => Input::get('zip'),
            'password'      => Hash::generate(Input::get('password', false)),
        ]);

        // Check to see if the user was created
        if($user->save()) {
            return redirect('/auth/login?created=true');
        }

        // If the user was not created, show the registration from again
        return view('auth.register', [
            'error' => true
        ]);
    }

}