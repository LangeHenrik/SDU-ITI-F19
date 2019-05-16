<?php

class ABIController extends Controller
{
    public function index(){
        echo 'API index';
    }

    public function users()
    {
        $users = $this->model('User')->getUsersAPI();
        header("Content-Type:application/json");
        $user = $users[0]['username'];
        echo json_encode($users);
    }

    public function pictures($user, $user_id)
    {
        header("Content-type:application/json");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $posted_json = json_decode($_POST['json'], true);

            $title = $posted_json['title'];
            $image = $posted_json['image'];
            $description = $posted_json['description'];
            $username = $posted_json['username'];
            $password = $posted_json['password'];

            $user_id_fromDB = $this->model('User')->validateUserId($username, $password);

            if ($user_id_fromDB == $user_id) {
                $image_id = $this->model('Picture')->uploadImageFromAPI($image, $title, $description, $user_id);

                $array = array('image_id' => $image_id);
                echo json_encode($array);
            } else {
                echo "-1";
            }
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $images = $this->model('Picture')->getUserImagesAPI($user_id);
            echo json_encode($images);
        }
    }
}
