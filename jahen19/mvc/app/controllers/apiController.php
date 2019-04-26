<?php
class ApiController extends Controller {

    public function index() {
        echo "API Index<br>";
    }

    public function pictures($var, $value){
        $this->model('Image');
        $this->model('User');
        $db = new Database();

        // GET /public/api/pictures/user/ID: returns JSON containing "image_id", "title", "description", "image" for all images that belong to a user "ID"
        if($this->get()){
            $images = $db->getImages();
            $users = $db->getUsers();
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

        // POST /public/api/pictures/user/ID: `$_POST['json']` contains JSON with "image" base64-encoded, "title", "description", "username", "password", returns "image_id"
        if($this->post()) {
            $image = new Image();

            $json = json_decode($_POST['json'], true);

            if (isset($_SESSION['username'])) {
                // user is logged in, just use those credentials
                $image->user = $_SESSION['username'];
            } else {
                $image->user = $json["username"];
                $password = $json["password"];

                if ( $db->checkUserPassword($image->user, $password) == false ) {
                    echo "Invalid credentials";
                    return;
                }
            }

            $image->header = $json["title"];
            $image->text = $json["description"];
            $image->data = $json["image"];

            $image_id = $db->insertImage($image);
            echo $image_id;
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
        $user->name = $_POST['username'];
        if ($user->checkUsername() == FALSE) {
            echo "Invalid username";
            return;
        }
        $password = $_POST['password'];
        $user->hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $user->city = $_POST['city'];
        $user->email = $_POST['email'];

        $db = new Database();
        $db->createUser($user);

        // log user in and redirect to home page
        $_SESSION['username'] = $user->name;
        header('Location: /jahen19/mvc/public/home/');

        echo "Successfully created new user '". $user->name . "'<br>";
    }

    public function login() {
        $db = new Database();
        if ( $db->checkUserPassword($_POST['username'], $POST['password']) == TRUE ) {
            // username / password combination correct, log user in, redirect to home page
            $_SESSION['username'] = $_POST['username'];
            header("Location: /jahen19/mvc/public/home");
            echo "Successfully logged in '". $_POST['username'] . "'</br>";
        } else {
            echo "Username / Pasword incorrect</br>";
        }
    }
}
