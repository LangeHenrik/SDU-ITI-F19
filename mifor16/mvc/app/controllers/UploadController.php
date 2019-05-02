<?php
/**
 * Created by PhpStorm.
 * User: forberg
 * Date: 2019-04-30
 * Time: 10:26
 */

namespace controllers;

use core\Controller;
use models\UploadModel;
use services\ImageConversionService;

class UploadController extends Controller
{

    public function index() {
        return $this->view("home/Upload");
    }

    public function upload()
    {
        if ($this->post()) {
            $uploadModel = new UploadModel();
            $imageService = new ImageConversionService();
            $type = $_FILES["fileToUpload"]["type"];

            $imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if (!$check) {
                    return $this->view("home/Upload", array("error_msg" => "File is too large."));
                }
            }
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                return $this->view("home/Upload", array("error_msg" => "File format not allowed."));
            }

            $username = $_SESSION['login_user'];
            $blob_data = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);

            $title = $_POST['title'];
            $description = $_POST['description'];


            $uploadModel->uploadImage($username, $blob_data, $title, $description, $type);

            header("Location: /mifor16/mvc/public/home");
        }

    }
}