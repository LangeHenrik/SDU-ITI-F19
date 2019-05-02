<?php

class ProfileController extends Controller
{
    public function index()
    {
        $viewbag = $this->model('Picture')->getAllUserPictures();
        $this->view('profile/index', $viewbag);
    }
}
