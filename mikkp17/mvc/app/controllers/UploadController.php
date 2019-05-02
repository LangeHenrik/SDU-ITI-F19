<?php

class UploadController extends Controller
{
    public function index()
    {
        $this->view('upload/index');
    }

    public function uploadImage()
    {
        $this->model('Picture')->uploadImage($_POST['imageTitle'], $_POST['imageDescription']);
    }
}
