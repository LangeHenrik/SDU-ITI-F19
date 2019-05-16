<?php

class PictureController extends controller{
    public function index(){
    }
    public function getAll(){
        $data['pictures'] = $this->model('Picture')->getAllPictures();
        $this->view('picture/pictures', $data);
    }
    public function upload(){
        $this->view('picture/upload');
    }

    public function uploadPic(){
        $title = $_POST['header'];
        $desc = $_POST['desc'];
        $link = $_POST['link'];
        $this->model('Picture')->addPicture($title, $desc, $link);
        header('Location: getall');

    }
}