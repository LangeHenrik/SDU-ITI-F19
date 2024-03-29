<?php
namespace App\Controllers;

use App\Auth\Auth;
use App\Core\Persistence\File\File;
use App\Core\Response\Redirect;
use App\Core\Utility\Hash;
use App\Core\Utility\Input;
use App\Core\Utility\Uuid;
use App\Core\ViewRenderer\View;
use App\Middleware\AuthMiddleware;
use App\Picture;
use App\PictureLike;
use App\User;

class ApiUserController extends Controller
{

    public function index()
    {
        return User::all();
    }

}