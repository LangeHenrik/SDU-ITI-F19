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
use App\Middleware\ApiAuthMiddleware;

class ApiFeedController extends Controller
{

    protected $middleware = [
        ApiAuthMiddleware::class,
    ];

    public function uploadPicture()
    {
        // Extract ID from URL
        $user = explode("/", $_SERVER['REQUEST_URI'])[6];
        $id = Uuid::generate();

        // Create and save picture
        $picture = new Picture([
            'id' => $id,
            'user' => $user,
            'title' => Input::get('json/title'),
            'caption' => Input::get('json/description'),
            'file' => File::saveBase64(Input::get('json/image', false), $id),
        ]);
        $picture->save();

        return $picture;
    }

    public function listUserPictures()
    {
        // Extract ID from URL
        $id = explode("/", $_SERVER['REQUEST_URI'])[6];

        return Picture::findAllWhere(['user', '=', $id]);
    }

}