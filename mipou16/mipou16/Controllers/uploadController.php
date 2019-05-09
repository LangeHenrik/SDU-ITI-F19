<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 29-04-2019
 */

include_once($_SERVER['DOCUMENT_ROOT'] . "/Core/database.php");
error_reporting(0);


$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
if (isset($_POST)) {
    $target_dir = "../View/upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {

            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
        } else {


            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                session_start();
                $username = $_SESSION['login_user'];
                $imagepath = $target_file;
                $imagename = $_POST['imagename'];
                $comment = $_POST['comment'];

                uploadImage($username, $imagename, $comment, $imagepath);

                header("location: ../View/index.php");
            }
        }
    }
}

class uploadController
{
    public function upload($username, $headertext, $comment, $img)
    {
        define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'] . '/View/upload/');
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $uniqueID = uniqid();
        $file = UPLOAD_DIR . $uniqueID . '.png';
        file_put_contents($file, $data);
        $imagepath = "../View/upload/" . $uniqueID . ".png";

        uploadImage($username, $headertext, $comment, $imagepath);

        echo json_encode(["image_id" => $uniqueID]);
    }
}