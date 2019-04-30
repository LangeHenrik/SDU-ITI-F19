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

    public function saveImage()
    {
        if ($this->post()) {

            $userDAO = $this->model('UserDAO');
            $user = $userDAO->getUserByUsername($_SESSION['username']);
            $userid = $user->getId();

            $path = $_FILES['fileToUpload']['name'];
            $extension = pathinfo($path, PATHINFO_EXTENSION);

            $fileName = $this->createRandomFileName($extension);
            $header = $_POST['header'];
            $imagetext = $_POST['text'];

            //Save the image data in the database
            $imageObject = new Image();
            $imageObject->setFileName($fileName);
            $imageObject->setHeader($header);
            $imageObject->setText($imagetext);
            $imageObject->setUserId($userid);

            $imageDAO = $this->model('ImageDAO');
            $imageDAO->saveImage($imageObject);


            //Save the image locally in the uploads folder
            $target_dir = $this->getFullRootPath() . "/uploads/";
            $target_file = $target_dir . $fileName;
            $this->saveImageLocally($target_file);
            header('Location: /Mach316/mvc/public/home/managepictures');
        } else {
            echo "<h1>Image was not uploaded</h1>";
        }
    }

    public
    function pictures($param, $userid)

    {
        if ($param == 'user') {
            if ($this->get()) {
                $this->getImages($userid);
            } elseif ($this->post()) {
                $this->postImage();
            }
        }
    }

    private function getImages($userid)
    {
        $imageDAO = $this->model('ImageDAO');
        $images = $imageDAO->getUserImages($userid);
        $imageBase64Array = array();
        if ($images != null) {
            foreach ($images as $image) {
                $path = $this->getFullRootPath() . '/uploads/' . $image->getFileName();


                $data = file_get_contents($path, true);
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $base64 = $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                $imageObject = array(
                    "image_id" => $image->getId()
                , "title" => $image->getHeader()
                , "description" => $image->getText()
                , "image" => $base64);


                array_push($imageBase64Array, $imageObject);
            }
        }
        echo json_encode($imageBase64Array);
    }

    private function postImage()
    {
        $base64Image = $_POST['json'];
        $imageDataJSON = json_decode($base64Image, true);
        //User info
        $userDAO = $this->model('UserDAO');
        $username = $imageDataJSON['username'];
        $password = $imageDataJSON['password'];
        $user = $userDAO->getUserByUsername($username);
        $userId = $user->getId();
        $isLoggedIn = $this->isLoggedIn($password, $username, $userDAO);


        if ($isLoggedIn) {
            //Image info
            $header = $imageDataJSON['title'];
            $imagetext = $imageDataJSON['description'];

            $extension = $this->getExtension($base64Image);
            $fileName = $this->createRandomFileName($extension);

            $imageObject = $this->createImageObject($fileName, $header, $imagetext, $userId);

            $imageDAO = $this->model('ImageDAO');
            $imageID = $imageDAO->saveImage($imageObject);


            $imageIDJson = json_encode(array('image_id' => $imageID));

            if ($imageID != -1) {
                //Save the image locally in the uploads folder
                $target_dir = $this->getFullRootPath() . "/uploads/";
                $target_file = $target_dir . $fileName;
                $base64ImageJSON = $imageDataJSON['image'];
                $success = $this->saveImageLocallyFromBase64($base64ImageJSON, $target_file);


                echo $imageIDJson;
            } else {
                echo "Something went wrong. Image was not saved";
            }
        } else {
            echo "Try again";
        }
    }


    private
    function createImageObject($filename, $header, $imagetext, $userId)
    {
        //Save the image data in the database
        $imageObject = new Image();
        $imageObject->setUserId($userId);
        $imageObject->setFileName($filename);
        $imageObject->setHeader($header);
        $imageObject->setText($imagetext);

        return $imageObject;
    }

    private
    function isLoggedIn($password, $username, $userDAO)
    {
        $isOwner = false;
        $user = $userDAO->getUserByUsername($username);
        if (password_verify($password, $user->getPassword())) {
            $isOwner = true;
        }
        return $isOwner;
    }

    private
    function createRandomFileName($extension)
    {
        $randomString = "";

        $randomChars = array();
        for ($i = 0; $i < 10; $i++) {
            $randomCharASCII = rand(65, 90);
            $randomChar = chr($randomCharASCII);
            array_push($randomChars, $randomChar);
        }

        for ($i = 0; $i < sizeof($randomChars); $i++) {
            $randomString .= $randomChars[$i];
        }

        $randomNumber = rand(1, 10000000);
        $randomString .= $randomNumber;
        $randomFileName = $randomString . "." . $extension;

        return $randomFileName;
    }

    private
    function getExtension($base64Image)
    {

        $jsonBase64 = json_decode($base64Image, true);
        $img = $jsonBase64['image'];
        $img = explode(',', $img);

        $ini = substr($img[0], 11);

        $extension = explode(';', $ini)[0];

        return $extension;
    }

    private
    function saveImageLocallyFromBase64($imageInBase64, $target_file)
    {
        $imageInBase64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageInBase64));
        $success = file_put_contents($target_file, $imageInBase64);
        return $success;
    }

    private function getFullRootPath()
    {

        $pathConcatinator = $this->getOSSpecificPathConcatinator();


        $targetDir = __DIR__;

        $targetDir = explode($pathConcatinator, $targetDir);
        $targetDirLength = sizeof($targetDir) - 1;
        $targetDir = array_splice($targetDir, 0, $targetDirLength);

        $count = 0;

        $targetDirString = "";
        foreach ($targetDir as $pathElement) {
            if ($count == 0 && $pathConcatinator == "\\") {
                $targetDirString .= $pathElement;
                $count += 1;
            }else {
                $targetDirString .= $pathConcatinator . $pathElement;
            }
        }
        return $targetDirString;
    }

    private function getOSSpecificPathConcatinator()
    {
        $os = $this->getOperatingSystem();
        $pathConcatinator = "";
        if ($os == "Mac" || $os == "Unknown") {
            $pathConcatinator = "/";
        } else {
            $pathConcatinator = "\\";
        }
        return $pathConcatinator;
    }


    private function getOperatingSystem()
    {
        $agent = $_SERVER['HTTP_USER_AGENT'];

        // Detect Device/Operating System

        if (preg_match('/Linux/i', $agent)) $os = 'Linux';
        elseif (preg_match('/Mac/i', $agent)) $os = 'Mac';
        elseif (preg_match('/iPhone/i', $agent)) $os = 'iPhone';
        elseif (preg_match('/iPad/i', $agent)) $os = 'iPad';
        elseif (preg_match('/Droid/i', $agent)) $os = 'Droid';
        elseif (preg_match('/Unix/i', $agent)) $os = 'Unix';
        elseif (preg_match('/Windows/i', $agent)) $os = 'Windows';
        else $os = 'Unknown';


        return $os;

    }

    private function saveImageLocally($target_file)
    {


        $this->getOperatingSystem();

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

        }
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            return;
        }

    }

}
