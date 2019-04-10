<?php
class ApiController extends Controller
{

    public function getuser($id) {
        $userDAO = $this->model('UserDAO');
        $user = $userDAO->getUserById($id);
        echo json_encode($user);
    }

    public function allusers() {
        $userDAO = $this->model('UserDAO');
        $users = $userDAO->getAllUsers();
        echo json_encode($users);
    }

    public function pictures($userid) {
        $imageDAO  = $this->model('ImageDAO');
        $images = $imageDAO->getUserImages($userid);
        echo json_encode($images);
    }

}
