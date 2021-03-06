<?php
class ApiController extends Controller
{
    public $path = '../../upload/';

    public function users()
    {
        if ($this->get()) {
            $userModel = $this->model('User');
            $allUsers = $userModel->getAllUsers();
            for ($i = 0; $i < count($allUsers); $i++) {
                $apiOutput[$i]['user_id'] = $i + 1;
                $apiOutput[$i]['username'] = $allUsers[$i]['username'];
            }
            echo json_encode($apiOutput);
        }
    }

    public function pictures($_,$user_id)
    {
        $paramUser = $user_id;

        if ($this->post()) {
            $jsontext = $_POST["json"];
            $json = json_decode($jsontext, true);
            $username = $json["username"];
            $password = $json["password"];
            $userModel = $this->model('User');
            $userModel->username = $username;
            $user = $userModel->getUserByUsername();
            if (password_verify($password, $user['password'])) {
                $assetModel = $this->model('Asset');
                $assetModel->username = $username;
                $assetModel->headline = $json["title"];
                $assetModel->text = $json["description"];
                $assetModel->fileID = rand(100000000, 999999999);
                if ($assetModel->isFileIDAvailable()) {
                    $ifp = fopen($this->path . $assetModel->fileID, 'wb');
                    $data = explode(',', $json["image"]);
                    fwrite($ifp, base64_decode($data[1]));
                    fclose($ifp);
                    $assetModel->uploadAsset();
                    $id = $assetModel->fileID;
                    $postToJson['image_id'] = $id;
                }
            }
        }
        //expected format
        //[{"image_id": 1, "title": "Mr. Bean", "description": "Beanscription", "image": "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABg....WpxlVjd26n/9k="}]
        if ($this->get()) {
            $userModel = $this->model('User');
            $allUsers = $userModel->getAllUsers();
            $userNumber = $paramUser - 1;
            $gottenUsername = $allUsers[$userNumber]['username'];
            $assetModel = $this->model('Asset');
            $assetModel->username = $gottenUsername;
            $userAssets = $assetModel->getGalleryForUser();
            for ($i = 0; $i < count($userAssets); $i++) {
                $getToJson[$i]['image_id'] = $userAssets[$i]['fileID'];
                $getToJson[$i]['title'] = $userAssets[$i]['headline'];
                $getToJson[$i]['name'] = $userAssets[$i]['username'];
                $getToJson[$i]['description'] = $userAssets[$i]['text'];
                $getToJson[$i]['image'] = 'data:image/jpeg;base64,'.base64_encode(file_get_contents($this->path . $userAssets[$i]['fileID']));
            }
            echo json_encode($getToJson);
        }
    }

}
