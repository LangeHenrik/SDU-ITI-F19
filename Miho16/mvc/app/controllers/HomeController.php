<?php
Class HomeController extends Controller
{
    public $path = '../../upload/';
    public function index()
    {

        if ($this->isloggedIn()) {
            $imageModel = $this->model('Asset');
            $imageModel->username = $_SESSION['username'];
            $userAssets = $imageModel->getGalleryForUser();
            $viewbag['userAssets'] = $userAssets;
            $userModel = $this->model('User');
            $userModel->username = $_SESSION['username'];
            $user = $userModel->getUserByUsername();
            $viewbag['user'] = $user;
        }
        $this->view('home/index', $viewbag);

    }
    public function login()
    {
        if ($this->post()) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $this->validateLoginInput($username, $password);
            $userModel = $this->model('User');
            $userModel->username = $username;
            $user = $userModel->getUserByUsername();
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                echo "Hello " . $user["firstName"];
                header('location: ./');
            } else {
                echo "Wrong username or password <br>";
                echo "<button onclick='window.history.back()'>Try again</button>";
            }
        }
    }

    public function logout()
    {
        if ($this->post()) {
            session_unset();
            header('Location: ./');
        } else {
            echo 'You can only log out with a post method';
        }
    }
    public function upload()
    {
        if ($this->post()) {
            $imageModel = $this->model('Asset');
            $imageModel->username = $_SESSION['username'];
            //$imageModel->file = $_FILES["file"];
            $imageModel->headline = $_POST["headline"];
            $imageModel->text = $_POST["text"];
            $imageModel->fileID = rand(100000000, 999999999);
            $targetFile = $this->path . basename($_FILES["file"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $isImage = getimagesize($_FILES["file"]["tmp_name"]);
            if ($imageModel->isFileIDAvailable()) {
                if ($isImage == true) {
                    if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
                        && $imageFileType == "gif") {
                        if (move_uploaded_file($_FILES["file"]["tmp_name"], $this->path . $imageModel->fileID)) {
                            $imageModel->uploadAsset();
                        } else {
                            echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
                            die("Unable to upload");
                        }
                    } else {
                        echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
                        die($imageFileType . " is not a supported image file");
                    }
                } elseif ($imageFileType == null) {
                    echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
                    die("No file selected");
                } else {
                    echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
                    die("File is not an image");
                }
            } else {
                echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
                die("Error uploading file...");
            }
            header('location: ./');
        }
    }
    public function delete()
    {
        if ($this->post()) {
            if (!$this->isloggedIn()) {
                echo "<button onclick='window.history.back()'>Try again</button>";
                die("Failed: you need to log in first.");
            }
            $fileID = $_POST["fileID"];
            if (!isset($fileID)) {
                echo "<button onclick='window.history.back()'>Try again</button>";
                die("Failed: no file specified");
            }
            $imageModel = $this->model('Asset');
            $imageModel->fileID = $fileID;
            $imageModel->deleteAsset();
            unlink($this->path . $fileID);
            header('location: ./');
        }
    }

    public function register()
    {
        if ($this->post()) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $password2 = $_POST["password2"];
            $firstname = $_POST["firstName"];
            $lastname = $_POST["lastName"];
            $zip = $_POST["zip"];
            $city = $_POST["city"];
            $mail = $_POST["emailAddress"];
            $phonenumber = $_POST["phoneNumber"];
            $this->validateRegisterInput($username, $password, $password2);
            $userModel = $this->model('User');
            $userModel->username = $username;
            $userModel->password = $password;
            $userModel->password2 = $password2;
            $userModel->firstname = $firstname;
            $userModel->lastname = $lastname;
            $userModel->zip = $zip;
            $userModel->city = $city;
            $userModel->mail = $mail;
            $userModel->phonenumber = $phonenumber;
            if ($userModel->isUsernameAvailable()) {
                $userModel->registerUser();
                $_SESSION['username'] = $username;
                header('location: ./');
            } else {
                echo "<button onclick='window.history.back()'>Try another username</button>" . "<br>";
                die("username already exists");
            }
        }
    }
    public function users()
    {
        if ($this->post()) {
            if ($this->isloggedIn()) {
                $userModel = $this->model('User');
                $allUsers = $userModel->getAllUsers();
                for ($i = 0; $i < count($allUsers); $i++) {
                    $viewbag[$i] = $allUsers[$i]["username"] . ' - ' . $allUsers[$i]["firstName"] . ' - ' . $allUsers[$i]["emailAddress"] . ' - ' . $allUsers[$i]["phoneNumber"] . "<br><br>";
                }
                $this->view('home/users',$viewbag);
            }
        }
    }
    public function gallery()
    {
        $viewbag['search'] = "";
        $viewbag['gallery'] = "";
        if ($this->isloggedIn()) {
            $imageModel = $this->model('Asset');
            //$imageModel->username = $_SESSION['username'];
            $userAssets = $imageModel->getGallery();
            $viewbag['gallery'] = $userAssets;

        }
        $this->view('home/gallery', $viewbag);
    }
    public function getGallery($search)
    {
        if ($this->get()) {
            $imageModel = $this->model('Asset');
            $gallery = $imageModel->getGallery();
            $viewbag['search'] = $search;
            $viewbag['gallery'] = $gallery;
            $this->view('home/searchAssets', $viewbag);
        }
    }
    private function validateLoginInput($username, $password)
    {
        $userRegex = "/^[a-z0-9_-]*$/i";
        $passRegex = "/^(?=.*\d).{8,}$/";
        if (!preg_match($userRegex, $username)) {
            echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
            die("Username: " . $username . " contains illegal characters");
        }
        if (!preg_match($passRegex, $password)) {
            echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
            die("Password must contain 8 characters and at least 1 number");
        }
    }
    private function validateRegisterInput($username, $password, $password2)
    {
        $userRegex = "/^[a-z0-9_-]*$/i";
        $passRegex = "/^(?=.*\d).{8,}$/";
        if (!preg_match($userRegex, $username)) {
            echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
            die("Username: " . $username . " contains illegal characters");
        }
        if (!preg_match($passRegex, $password)) {
            echo "<button onclick='window.history.back()'>Try again</button>" . "<br>";
            die("Password must contain 8 characters and at least 1 number");
        }

        if ($password !== $password2) {
            die("Password mismatch");
        }
    }
    private function isloggedIn()
    {
        return isset($_SESSION['username']);
    }
}
