<?php

class ApiController extends Controller
{

    public function getuser($id)
    {
        $userDAO = $this->model('UserDAO');
        $user = $userDAO->getUserById($id);
        echo json_encode($user);
    }

    public function users()
    {
        $userDAO = $this->model('UserDAO');
        $users = $userDAO->getAllUsers();
        echo json_encode($users);
    }

    public function pictures($param, $userid)

    {
        if ($param == 'user') {

            if ($this->get()) {

                $imageDAO = $this->model('ImageDAO');
                $images = $imageDAO->getUserImages($userid);
                $imageBase64Array = array();

                if ($images != null) {
                    foreach ($images as $image) {
                        $path = $this->getFullRootPath() . '/uploads/' . $image->getFileName();
                        $data = file_get_contents($path);
                        $base64 = base64_encode($data);
                        array_push($imageBase64Array, $base64);
                    }
                }


                echo "Lol det var også en get" . json_encode($imageBase64Array);


            } elseif ($this->post()) {
                $image = $_POST['json'];
                $fileName = basename($_FILES["fileToUpload"]["name"]);
                $header = $_POST['header'];
                $imagetext = $_POST['text'];

                //Save the image locally in the uploads folder
                $target_dir = $this->getFullRootPath() . "/uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $this->saveImageLocally($target_file);

                //Save the image data in the database
                $imageObject = new Image();
                $imageObject->setFileName($fileName);
                $imageObject->setHeader($header);
                $imageObject->setText($imagetext);


                $imageDAO = $this->model('ImageDAO');
                $imageDAO->saveImage($imageObject);

                //echo json_encode($image);
            }


        }
    }

    private function getFullRootPath()
    {
        $targetDir = __DIR__;
        $targetDir = explode('/', $targetDir);
        $targetDirLength = sizeof($targetDir) - 1;
        $targetDir = array_splice($targetDir, 0, $targetDirLength);

        $targetDirString = "";
        foreach ($targetDir as $pathElement) {
            $targetDirString .= '/' . $pathElement;
        }
        return $targetDirString;
    }

    private function saveImageLocally($target_file)
    {


        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";

        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                header('Location: managepictures');
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

    }

}
