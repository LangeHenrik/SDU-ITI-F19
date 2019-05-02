<?php
include_once(__DIR__."\\..\\models\\User.php");
include_once(__DIR__."\\..\\models\\Image.php");

class ApiController extends Controller {

    public function index(){

    }

    public function users(){
        if ($this -> get()){
            $user = $this ->model('UserTable');
            $all_users = $user -> select();
            $arr_users = array();
            foreach ($all_users as $user){
                $new_user = new User($user[0], $user[1]);
                array_push($arr_users, $new_user);
            }
            echo json_encode($arr_users);
        }
    }

    public function pictures($path, $user_id){
        if ($path === 'user'){
            if ($this->post()){
                $post = json_decode($_POST['json'], true);
                $title = $post['title'];
                $description = $post['description'];
                $image = $post['image'];

                $user_model = $this ->model('UserTable');
                $user = $user_model -> getData("id", $user_id, "bind");

                if ($post['username'] === $user[0][1] && password_verify($post['password'], $user[0][8])) {
                    $fieldarray = array("header" => $title, "text" => $description, "id_user" => $user_id, "image" => $image);
                    $new_img = $this->model('ImagesTable');
                    $img_id = $new_img->insert($fieldarray);
                    $imgIdJson = json_encode(array("image_id" => $img_id));
                    echo $imgIdJson;
                } else {
                    echo 'Username and password do not match';
                }
            }

            if ($this->get()){
                $images = $this->model('ImagesTable');
                $images_results = $images -> getData("id_user", $user_id, "user");
                $arr_images = array();
                foreach ($images_results as $img){
                    //$base64 = $this->createFromPath($img[4]);
                    $new_img = new Image($img[0], $img[4], $img[1], $img[2] );
                    array_push($arr_images, $new_img);
                }
                echo json_encode($arr_images);
            }
        }
        else{
            echo 'path not user';
        }
    }

    public function createFromPath($fileName){
        $fileName= str_replace('/', '\\', $fileName);
        $path = $this->getFullRootPath().'\\public\\'.$fileName;
        //echo "PATH: ". $path;
        $data = file_get_contents($path, true);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $base64  = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

    private function getFullRootPath()
    {
        $targetDir = __DIR__;
        $targetDir = explode('\\', $targetDir);
        $targetDirLength = sizeof($targetDir) - 2;
        $targetDir = array_splice($targetDir, 0, $targetDirLength);

        $targetDirString = "";
        $count=0;
        foreach ($targetDir as $pathElement) {
            if ($count===0){ $targetDirString.=$pathElement; $count += 1;} else {
            $targetDirString .= '\\' . $pathElement; }
        }
        return $targetDirString;
    }
}

