<?php
class ApiController extends Controller {

    public function index() {
        echo "API Index<br>";
    }

    public function pictures($var, $value){
        $this->model('Image');
        $this->model('User');
        $db = new Database();
        $images = $db->getImages();
        $users = $db->getUsers();

        // GET /public/api/pictures/user/ID: returns JSON containing "image_id", "title", "description", "image" for all images that belong to a user "ID"
        if($this->get()){
            $arr = array();
            foreach($images as $image){
                if($value == NULL || $image->$var == $value){
                    $imageArr = array(
                        'image_id' => $image->id,
                        'title' => $image->header,
                        'description' => $image->text,
                        'image' => $image->data,
                    );
                    array_push($arr, $imageArr);
                }
            }

            echo json_encode($arr);
        }

        if($this->post()) {

            // TODO
            // $json = file_get_contents('http://localhost:8080/jahen19/mvc/public/api/pictures/"'.$var.'"/"'.$value.'"');

            // $image = json_decode($json);


            // foreach($users as $user){
            //     if($user->id == $value){
            //         $newImage = new UploadImage($image->name, $user->user_name, $image->description);
            //     }
            // }
            // echo $newImage;
        }
    }

    // GET /public/api/users: returns JSON containing "user_id" and "username" of all users
    public function users(){
        $this->model('User');
        $db = new Database();
        $users = $db->getUsers();

        $arr = array();
        foreach($users as $user){
            $userArr = array(
                'user_id' => $user->name,
                'username' => $user->name,
            );
            array_push($arr, $userArr);
        }

        echo json_encode($arr);
    }

    public function register() {
        $this->model('User');
        $user = new User();
        // TODO: input validation
        $username = $_POST['username'];
        if ($user->checkUsername($username) == FALSE) {
            echo "Invalid username";
            return;
        }
        $user->name = $username;
        $password = $_POST['password'];
        $user->hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $user->city = $_POST['city'];
        $user->email = $_POST['email'];

        $db = new Database();
        $db->createUser($user);
        Location('')
        echo "Successfully created new user";

    }
}
