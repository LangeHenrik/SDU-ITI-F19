<?php

class HomeController extends Controller
{

    public function index()
    {
        $this->enforceLogin();
        require_once '../app/services/Box.php';
        $this->view('home/index');
    }

    public function myimage()
    {
        $this->enforceLogin();
        require_once '../app/services/Box.php';
        $DB = new Database();
        $bag = [];
        $result = $DB->conn->query("SELECT name, image_id, description, rating, imgblob FROM image WHERE user LIKE '" . $_SESSION['ID'] . "'");
        if ($result->rowCount() > 0) {
            $i = 0;
            while ($row = $result->fetch()) {
                $bag[$i]['image_id'] = $row['image_id'];
                $bag[$i]['name'] = $row['name'];
                $bag[$i]['blob'] = $row['imgblob'];
                $i++;
            }
        }
       $this->view('home/myimage', $bag);
    }

    public function profile()
    {

        $this->enforceLogin();
        $this->view('home/profile');
    }

    public function logout()
    {
        if ($this->post()) {
            session_unset();
            unset($_SESSION);
            header('Location: /mvc/public/home/loggedout');
        } else {
            echo 'You can only log out with a post method';
        }
    }

    public function loggedout()
    {
        echo 'You are now logged out';
    }

    private function enforceLogin()
    {
        if (!isset($_SESSION['logged_in'])) {
                header("location: /mvc/public/home/auth/login/");
            //die();
        }
    }

    public function upload()
    {

        $this->enforceLogin();
        if(isset($_FILES['fileToUpload'])){
//            var_dump($_FILES['fileToUpload']);
            $img = base64_encode(file_get_contents($_FILES['fileToUpload']['tmp_name']));
            if (isset($_POST['name'])) {
                $imagename = htmlentities($_POST['name']);
            } else {
                $imagename = htmlentities(basename($_FILES["fileToUpload"]["name"]));
            }
            $user = $_SESSION['ID'];
            $imageid = basename($this->getUUID());
            $imagedescription = $_POST['desc'];
            $DB = new Database();
            $stmt = $DB->conn->prepare("INSERT INTO image (image_id, name, description, user, imgblob) VALUES (:id,:name,:desc,:user,:blob)");
            $stmt->bindParam(':id',$imageid);
            $stmt->bindParam(':name',$imagename);
            $stmt->bindParam(':desc',$imagedescription);
            $stmt->bindParam(':user',$user);
            $stmt->bindParam(':blob',$img);
            $stmt->execute();
            header("Location: /mvc/public/home/home/myimage");
        }
        /*

        if (isset($_FILES['fileToUpload'])) {
            $target_dir = $_SERVER['DOCUMENT_ROOT'].UPLOADPATH;
            echo $target_dir;
            if(!file_exists($target_dir)) {
                mkdir($target_dir, 0744);
            }
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $target_file = $target_dir . basename($this->getUUID() . "." . $imageFileType);
            echo $imageFileType;
            $uploadOk = 1;
// Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
// Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
// Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
// Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
// Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $user = $_SESSION['name'];
                    if (isset($_POST['name'])) {
                        $imagename = htmlentities($_POST['name']);
                    } else {
                        $imagename = htmlentities(basename($_FILES["fileToUpload"]["name"]));
                    }
                    $user = $_SESSION['ID'];
                    $imageid = basename($target_file);
                    $imagedescription = $_POST['desc'];

                    $DB = new Database();
                    $stmt = $DB->conn->prepare("INSERT INTO image (image_id, name, description, user) VALUES (:id,:name,:desc,:user)");
                    $stmt->bindParam(':id',$imageid);
                    $stmt->bindParam(':name',$imagename);
                    $stmt->bindParam(':desc',$imagedescription);
                    $stmt->bindParam(':user',$user);
                    $stmt->execute();
                    echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                    header("Location: /mvc/public/home/home/myimage");
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }*/
    }

    public function profiles(){
        $DB = new Database();
        require_once '../app/services/Box.php';
        $bag = [];
        $result = $DB->conn->query("SELECT ID, username FROM user");
        if ($result->rowCount() > 0) {
            $i = 0;
            while ($row = $result->fetch()) {
                $bag[$i]['id'] = $row['ID'];
                $bag[$i]['name'] = $row['username'];
                $i++;
            }
        }
        $this->view('home/profiles', $bag);
    }


    function images(){

        require_once '../app/services/Box.php';
        $DB = new Database();
        $bag = [];
        $result = $DB->conn->query("SELECT name, image_id, description, imgblob FROM image");
        if ($result->rowCount() > 0) {
            $i = 0;
            while ($row = $result->fetch()) {
                $bag[$i]['image_id'] = $row['image_id'];
                $bag[$i]['name'] = $row['name'];
                $bag[$i]['blob'] = $row['imgblob'];
                $i++;
            }
        }
        $this->view('home/images', $bag);
    }

}