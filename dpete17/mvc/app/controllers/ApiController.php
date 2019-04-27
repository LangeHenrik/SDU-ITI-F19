<?php

require_once '../app/models/User.php';
require_once '../app/models/Image.php';

class ApiController extends Controller {
    
    

    // GET localhost:8080/xx/mvc/public/api/users
    public function users() {
        if($this -> isGet()) {
            $users = User::getAllUsers();

            $format_users = array();
            foreach ($users as $user) {
                $format_user['user_id'] = $user -> id;
                $format_user['username'] = $user -> name;

                array_push($format_users, $format_user);
            }

            echo json_encode($format_users);
        }
    }

    public function pictures($type = '', $account_id = 0) {
        $account_id = intval($account_id);

        if($account_id == 0) {
            print 'Given id is either 0 or not an integer!';
        } else if(!$type == 'user') {
            print 'Given type is not a valid type.';
        } else {
            if($this -> isPost()) {
                $this -> postUserPictures($type, $account_id);
            } else if($this -> isGet()) {
                $this -> getUserPictures($account_id);
            }
        }
    }

    private function getUserPictures($account_id) {
        $images = Image::getImagesByAccount($account_id);

        foreach ($images as $image) {
            $image -> image = $image -> base64;
            $image -> title = $image -> header;
            $image -> description = $image -> content;

            unset($image -> base64);
            unset($image -> header);
            unset($image -> content);
            unset($image -> likes);
            unset($image -> dislikes);
            unset($image -> uploaded_at);
        }

        echo json_encode($images);
    }

    private function postUserPictures($type, $account_id) {
        $json = json_decode($_POST['json']);

        $login_id = User::login($json -> username, $json -> password);

        if($account_id == $login_id) {
            $image = new Image();
            $image -> base64 = $json -> image;
            $image -> header = $json -> title;
            $image -> content = $json -> description;
            
            $image = Image::postImage($account_id, $image);

            if($image == null) {
                $image_id = array('image_id' => null);
            } else {
                $image_id = array('image_id' => $image -> id);
            }
            
            echo json_encode($image_id);
        } else {
            print 'Wrong username/password or account id.';
        }
    }
}

?>