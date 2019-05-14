<?php

class UsersController extends Controller
{
    public function index()
    {
        $viewbag = $this->model('User')->getAllUsers();
        $this->view('users/index', $viewbag);
    }

    public function ajax($hint)
    {
        $request = $hint . "%";
        $result = $this->model('User')->ajax($request);
        $result_array = array();
        foreach ($result as $value) {
            array_push($result_array, $value['username']);
        }
        echo implode(', ', $result_array);
    }
}
