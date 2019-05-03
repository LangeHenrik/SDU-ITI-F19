<?php


    class Api extends Controller
    {
      public function __construct()
      {
        $this->userModel = $this->model('User');
      }

       public function users()
       {
         $users = $this->userModel->getUsers();
            $data = [
                'users' => $users
            ];
            return $this->view('users/index', $data);;
       }
    }