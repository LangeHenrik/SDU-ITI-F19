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

class FeedController extends Controller
{

    protected $middleware = [
        AuthMiddleware::class,
    ];

    public function index()
    {
        return view('social.feed', [
            'pictures' => Picture::all(),
            'user'  => User::currentUser()
        ]);
    }

    public function upload()
    {
        return view('social.upload');
    }

    public function uploadProcess()
    {
        // Upload file
        $id = Uuid::generate();
        $upload = File::save($_FILES["file"], $id);

        // Make sure the file was uploaded
        if($upload) {
            $picture = new Picture([
                'id'        => $id,
                'user'      => User::currentUser()->id,
                'file'      => $upload,
                'caption'   => Input::get('caption')
            ]);

            // Save picture to database
            if(!$picture->save()) {
                return redirect('/feed/upload?error=true');
            }
            return redirect("/feed");
        }
        return redirect('/feed/upload?error=true');
    }

    public function show()
    {
        echo "Hello";
    }

    public function like()
    {
        // Extract ID from URL
        $id = explode("/", $_SERVER['REQUEST_URI'])[3];

        // Find picture
        $picture = Picture::find($id);

        if($picture) {
            // If the picture was found then current like status for the picture and user is checked
            $likes = PictureLike::findWithQuery("SELECT * FROM `picture_likes` WHERE picture = ? AND user = ?", [
                $id,
                User::currentUser()->id,
            ]);

            // Delete the like if found, otherwise just create a new one
            if(count($likes) > 0) {
                $likes[0]->delete();
            } else {
                $like = new PictureLike([
                    'picture'   => $id,
                    'user'      => User::currentUser()->id
                ]);
                $like->save();
            }

            return $picture->likes();
        }
        die('No.');
    }

}