<?php

class HomeController extends Controller {

	public function index () {
	    if (isset($_SESSION['logged_in'])){
            echo "<br> session:". $_SESSION['logged_in'];
        }
        $this ->view('home/index');
	}
	
	public function loggedin () {
        if ($this->post()){
            $user = $this->model('UserTable');
            $username = $_POST['db_username'];
            $password = $_POST['db_password'];
            $user_verify = $user -> getData("username", $username, "name");

            if ($user_verify[0][1]===$username && password_verify($password, $user_verify[0][8])){
                $_SESSION['logged_in']=true;
                $user->name = $_POST['db_username']; //user in model
                $_SESSION['UserTable'] = $username;
                $viewbag['username'] = $user->name;
                $images = $this->model('ImagesTable');
                $images_results = $images -> getData("id_user", $user_verify[0][0], "user");
                $viewbag['ImagesTable'] = $images_results;
                $this->view('home/images', $viewbag);
            } else {
                $viewbag['error'] = 'Wrong username or password';
                $this->view('home/index', $viewbag);
            }
        } else {
            $this->images();
        }
	}
	
	public function login() {
	    if ($this->post()){
            $_SESSION['logged_in'] = true;
            echo $_POST['db_username'];
            echo $_POST['db_password'];
        }else{
	        if (isset($_SESSION['logged_in'])){
	            unset($_SESSION['logged_in']);
	            session_abort();
            }
            $this->view('home/login');
        }
	}

	# create a button for logout?
	public function logout() {
		if($this->post()) {
			session_unset();
			header('Location: loggedout');
		} else {
			echo 'You can only log out with a post method';
		}
	}
	
	public function loggedout() {
		echo 'You are now logged out';
        header('Location: index');
	}

	public function images(){
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']===true){
            $viewbag['username']= $_SESSION['username'];
            $images = $this->model('ImagesTable');
            $user = $this->model('UserTable');
            $results = $user->getData('username', $_SESSION['username'], 'name');
            $user_id = $results[0][0];
            $images_results = $images -> getData("id_user", $user_id, "user");
            $viewbag['ImagesTable'] = $images_results;
            $this->view('home/images', $viewbag);
        }
        else{
            $viewbag['error'] = 'You must be logged in to view your pictures';
            $this->view('home/index', $viewbag);
        }
        if ($this->post()){
            echo 'post';
            $this ->upload();
        }
    }

    public function community(){
	    $user = $this ->model('UserTable');
        $viewbag['all_users']= $user -> select();
        $this -> view('home/community', $viewbag);
    }

    public function users(){
	    if ($this -> get()){
	        echo "all users:";
            $user = $this ->model('User');
            $all_users = $user -> select();
            echo json_encode($all_users);
        }
    }

    public function upload(){
        $new_img = $this->model('ImagesTable');
        $header = htmlentities($_POST['img_title']);
        $text = htmlentities($_POST["img_text"]);
        // all this to get the images - create function
        $user = $this->model('UserTable');
        $results = $user->getData('username', $_SESSION['UserTable'], 'name');
        $user_id = $results[0][0];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $fieldarray = array("header" => $header, "text" => $text, "id_user" => $user_id, "image" => $target_file);
        $new_img->insert($fieldarray);
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
            $viewbag['ImagesTable'] = $new_img -> getData("id_user", $user_id, "user");
            $viewbag['username'] = $_SESSION['UserTable'];
            $this->view('home/images', $viewbag);
            //header('Location: annik19/mvc/public/home/images');
            //$this->images();
        }
    }

    public function register(){
        include_once(__DIR__."\\..\\models\\ValidateRegister.php");
        $register = new validateRegister();
        $errors = $register ->register();
        if (!empty($errors)){
            $viewbag['messages'] = $errors;
            $this->view('home/login', $viewbag);
        } else {
            $pwd_hash = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $fieldarray = array('username' => $_POST['username'], 'pwd' => $pwd_hash,
                'fname' => $_POST['fname'],
                'lname' => $_POST['last'],
                'city' => $_POST['city'],
                'zip' => $_POST['zip'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone']);
            $new_user = $this->model('UserTable');
            $new_user->insert($fieldarray);
            $viewbag['messages'] = 'You have been registered';
            $this->view('home/login', $viewbag);
        }
    }
}