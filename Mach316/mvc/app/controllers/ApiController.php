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


    public function saveImage()
    {
        if ($this->post()) {

            $path = $_FILES['fileToUpload']['name'];
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $file_tmp = $_FILES['fileToUpload']['tmp_name'];
            $data = file_get_contents($file_tmp);
            $base64 = 'data:image/' . $extension . ';base64,' . base64_encode($data);


            $image = $base64;
            $username = $_SESSION['username'];

            $userDAO = $this->model('UserDAO');
            $user = $userDAO->getUserByUsername($username);
            $userId = $user->getId();

            $title = $_POST['header'];
            $description = $_POST['text'];

            $imageDAO = $this->model('ImageDAO');
            $imageObject = $this->createImageObject($image, $title, $description, $userId);


            $imageID = $imageDAO->saveImage($imageObject);


            echo $imageID;

        }
    }


    public
    function getImages($userid)
    {

        $imageDAO = $this->model('ImageDAO');
        $images = $imageDAO->getUserImages($userid);

        $imagesJsonArray = array();

        foreach ($images as $image) {
            $imageID = $image->getId();
            $imageData = $image->getFileName();
            $imageTitle = $image->getHeader();
            $imageDescription = $image->getText();

            $imageObject = array("image_id" => $imageID, "title" => $imageTitle, "description" => $imageDescription, "image" => $imageData);

            array_push($imagesJsonArray, $imageObject);
        }

        echo json_encode($imagesJsonArray);


    }

    public
    function postImage()
    {
        $data = json_decode($_POST['json'], true);
        $image = $data['image'];
        $username = $data['username'];
        $password = $data['password'];
        $title = $data['title'];
        $description = $data['description'];

        $userDAO = $this->model('UserDAO');
        $user = $userDAO->getUserByUsername($username);
        $userId = $user->getId();
        $hashedPassword = $user->getPassword();
        $allowedToPost = password_verify($password, $hashedPassword);

        if ($allowedToPost) {

            $imageDAO = $this->model('ImageDAO');
            $imageObject = $this->createImageObject($image, $title, $description, $userId);
            $imageID = $imageDAO->saveImage($imageObject);

            echo json_encode(array('image_id' => $imageID));
        } else {
            echo "You are not allowed to post";
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


}
