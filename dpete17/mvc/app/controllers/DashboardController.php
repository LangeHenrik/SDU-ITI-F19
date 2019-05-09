<?php

require_once '../app/models/User.php';
require_once '../app/models/Image.php';

class DashboardController extends Controller {
	
	public function index() {
        $viewbag['username'] = $_SESSION['USERNAME'];
        $viewbag['images'] = Image::getImagesByAccount($_SESSION['ID'], 20);

		$this->view('dashboard/account', $viewbag);
    }

    public function images() {
        $viewbag['images'] = Image::getAllImages(20);

        $this->view('dashboard/allimages', $viewbag);
    }

    public function accounts() {
        $viewbag['users'] = User::getAllUsers();

        $this->view('dashboard/allaccounts', $viewbag);
    }

    public function opinion($image_id = 0, $opinion = '') {
        $opinions = array('LIKES', 'DISLIKES');

        $image_id = intval($image_id);

        $redirect = true;
        if(empty($image_id) || empty($opinion)) {
            $_SESSION['MESSAGE'] = 'Opinion system is broken. Contact owners immediately!';
        } else if(!in_array($opinion, $opinions)) {
            $_SESSION['MESSAGE'] = 'Opinion not valid.';
        } else if(!is_int($image_id)) {
            $_SESSION['MESSAGE'] = 'Image ID has to be an integer!';
        } else {
            $redirect = false;
            print Image::opinion($_SESSION['ID'], $image_id, $opinion);
        }

        if($redirect) header('Location ../');
    }

    public function upload() {
        if($this -> isPost()) {
            $allowed = array('image/gif','image/png' ,'image/jpg', 'image/jpeg');
       
            $header = $_POST['header'];
            $header = htmlentities($header);

            if(!$_FILES['image']['size'] > 0 && in_array($_FILES['image']['type'], $allowed)) {
                $_SESSION['MESSAGE'] = 'Image is either 0 or file is not allowed.';
            } else if(empty($header)) {
                $_SESSION['MESSAGE'] = 'Header cannot be empty.';
            } else {
                $image = new Image();

                $image -> base64 = base64_encode(file_get_contents($_FILES['image']['tmp_name']));
                $image -> header = $header;
                $image -> content = $_POST['content'];
                $image -> content = htmlentities($image -> content);

                $image = Image::postImage($_SESSION['ID'], $image);

                if($image !== null) {
                    $_SESSION['MESSAGE'] = 'Image uploaded!';
                }
            }

            header('Location: .');
        }
    }

    public function logout() {
        unset($_SESSION['ID']);
        unset($_SESSION['USERNAME']);

        header('Location: /dpete17/mvc/public/home');
    }
}

?>